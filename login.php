<?php
	require_once("config.php");

	if(isset($_POST["username"])){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$sql = "select * from users where name = '$username' and password = password('$password')";
		$result = mysql_query($sql);
		if(mysql_num_rows($result)){
			session_start();
			$_SESSION["user"] = $username;
			$row = mysql_fetch_assoc($result);
			$_SESSION["admin"] = $row["is_admin"];
			$count = $row["login_count"] + 1;
			$userId = $row["id"];
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			mysql_query("update users set login_count = $count where id = $userId");
			header("Location: http://$host$uri/");
			exit;
		}
		$failed = true;
	};
?>
<?php require_once("header.php");?>
		<script type="text/javascript">
		</script>
		<div class="panel" style="width: 253px; margin:auto">
			<h2 class="panel_header ui-widget-header ui-corner-all">Login</h2>
			<form action="login.php" class="jNice panel_body" method="post">
				<?php if(isset($failed) && $failed){?>
				<span style="color: red; font-size:12px">Username and password not match!</span>
				<?php } ?>
				<dl>
					<dt>
						<label for="username">username: </label>
					</dt>
					<dd>
						<input name="username" id="username"/>
					</dd>
				</dl>
				<dl>
					<dt>
						<label for="password">password: </label>
					</dt>
					<dd>
						<input name="password" id="password" type="password"/>
					</dd>
				</dl>
				<fieldset class="action">
					<input type="submit" value="login"/>
				</fieldset>
			</form>
		</div>
<?php require_once("footer.php");?>
