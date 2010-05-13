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

		$query = "select * from orders";
		$countQuery = "select count(*) as count from orders";
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
		$countQuery = "$countQuery order by $sidx $sord";

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
		$ret["count"] =$ret["records"] / $rows;
		echo json_encode($ret);
	}
	else {
		$id = $_POST["id"];
		$name = $_POST["name"];
		$begin  = ($_POST["begin"]);
		$end = ($_POST["end"]);
		$status = $_POST["status"];
		$price = $_POST["price"];
		$charged = $_POST["charged"];
		$customer = $_POST["customer"];
		$in_charge = $_POST["in_charge"];
		if($id == "_empty"){
			$sql = "insert into orders(name, begin, end, status, price, charged, customer, in_charge) values ('$name', date($begin), date($end), $status, $price, $charged, '$customer', '$in_charge')";
		}
		else {
			$sql = "update orders set name = $name, begin = date('$begin'), end = date('$end'), status = $status, price = $price, charged = $charged, customer = '$customer', in_charge = '$in_charge' where id = $id";
		}
		mysql_query($sql);
		mysql_close();
	}
?>
