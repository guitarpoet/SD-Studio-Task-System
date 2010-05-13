<?php
	require_once("security.php"); 
	require_once("config.php");
	if(isset($_POST["pass"])){
		$pass = $_POST["pass"];
		$user = $_SESSION["user"];
		$query = "update users set password = password('$pass') where name = '$user'";
		mysql_query($query);
		mysql_close();
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php';
		header("Location: http://$host$uri/$extra");
		exit;
	}
	require_once("header.php");
?>
	<script type="text/javascript">
		jQuery(function($){
			$("input").keyup(function(){
				if($("#password").val() == $("#password_again").val()){
					$("#submit").attr("disabled", false);
				}
				else {
					$("#submit").attr("disabled", true);
				}
			});
		});
	</script>
	<div class="panel">
		<form action="change_password.php" method="post" class="jNice panel_body">
			<h3 style="margin-bottom: 5px;" class="panel_header ui-widget-header ui-corner-all">Change Password</h3>
			<dl>
				<dt>
					<label for="password">New Password: </label>
					<dd>
						<input id="password" name="pass" type="password" />
					</dd>
				</dt>
			</dl>
			<dl>
				<dt>
					<label for="password_again">Password Again: </label>
					<dd>
						<input id="password_again" id="password_again" type="password" />
					</dd>
				</dt>
			</dl>
			<fieldset>
				<input id="submit" disabled="true" type="submit" class="action" value="submit" />
			</fieldset>
		</form>
	</div>
	<?php require_once("footer.php");?>
