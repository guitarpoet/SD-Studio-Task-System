<?php 
	require_once("security.php");
	require_once("config.php");
	header("Content-Type: application/json;charset=utf-8");

	if(isset($_GET["_search"])) {
		$isSearch = $_GET["_search"] == "true";
		$page = $_GET["page"];
		$rows = $_GET["rows"];
		$sidx = $_GET["sidx"];
		$sord = $_GET["sord"];

		$query = "select * from users";
		$countQuery = "select count(*) as count from users";
		if($isSearch) {	
			$searchField = $_GET["searchField"];
			$searchOper = $_GET["searchOper"];
			$searchString = $_GET["searchString"];
			switch($searchOper) {
				case "eq":
					$searchOper = "=";
					break;
				case "ne":
					$searchOper = "!=";
					break;
				case "lt":
					$searchOper = "<";
					break;
				case "le":
					$searchOper = "<=";
					break;
				case "gt":
					$searchOper = ">";
					break;
				case "ge":
					$searchOper = ">=";
					break;
				case "bw":
					$searchOper = "like";
					$searchString = $searchString."%";
					break;
				case "ew":
					$searchOper = "like";
					$searchString = "%".$searchString;
					break;
				case "bn":
					$searchOper = "not like";
					$searchString = "%".$searchString;
					break;
				case "en":
					$searchOper = "not like";
					$searchString = $searchString."%";
					break;
				case "cn":
					$searchOper = "like";
					$searchString = "%".$searchString."%";
					break;
				case "nc":
					$searchOper = "not like";
					$searchString = "%".$searchString."%";
					break;

			}
			$query = "$query where $searchField $searchOper $searchString";
			$countQuery = "$countQuery where $searchField $searchOper $searchString";
		}
		else {
		}

		$ret = array();
		$off = ($page - 1) * $rows;
		$query = "$query order by $sidx $sord limit $off, $rows";

		$result = mysql_query($countQuery);
		$row = mysql_fetch_assoc($result);
		$ret["records"] = (int)$row["count"];
		$ret["rows"] = array();

		$result = mysql_query($query);
		while($row = mysql_fetch_assoc($result)) {
			array_push($ret["rows"], $row);
		}
		mysql_close();

		$ret["page"] = 	(int)($page);
		$ret["count"] = (int)($ret["records"] / $rows);
		echo json_encode($ret);
	}
	else {
		$id = $_POST["id"];
		$name = $_POST["name"];
		$is_admin  = $_POST["is_admin"];
		if($id == "_empty"){
			$sql = "insert into users(name, is_admin, login_count, password) values ('$name', $is_admin, 0, password('password'))";
		}
		else {
			$sql = "update users set name = '$name', is_admin = $is_admin where id = $id";
		}
		mysql_query($sql);
		mysql_close();
	}
?>
