<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>SD Studio Inner System</title>
	<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
	<script type="text/javascript" src="js/grid.loader.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8rc3.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery.tokeninput.js"></script>
	<script type="text/javascript" src="js/jquery.jNice.js"></script>

	<script type="text/javascript" src="js/jquery.editinplace.js"></script>
	<script type="text/javascript" src="js/flot/excanvas.js"></script>
	<script type="text/javascript" src="js/flot/jquery.colorhelpers.js"></script>
	<script type="text/javascript" src="js/flot/jquery.flot.js"></script>
	<script type="text/javascript" src="js/flot/jquery.flot.image.js"></script>
	<script type="text/javascript" src="js/flot/jquery.flot.navigate.js"></script>

	<script type="text/javascript" src="js/flot/jquery.flot.selection.js"></script>
	<script type="text/javascript" src="js/flot/jquery.flot.stack.js"></script>
	<script type="text/javascript" src="js/flot/jquery.flot.threshold.js"></script>
	<script type="text/javascript" src="js/flot/jquery.flot.crosshair.js"></script>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="css/main.css"/>
	<script type="text/javascript">
		var functionsMap = {
			go_orders : "index.php",
			go_reports : "reports.php"
		}
		jQuery(function($){
			$("#functions").buttonset();
			$("#functions input").click(function(){
				window.location = functionsMap[$(this).attr("id")];
			});
			var pathname = $(window.location).attr("pathname");
			if(pathname.match("index.php$") || pathname.match("/$") )
				$("#go_orders").next().addClass("ui-state-active");
			if(pathname.match("reports.php"))
				$("#go_reports").next().addClass("ui-state-active");
		});
	</script>
</head>
<body>
	<div id="page">
		<div id="header" class="clearfix">
			<span id="logo"> SD Studio Task System </span>
			</script>
			<?php
				if(isset($_SESSION)) {
			?>
			<ul class="navigation">
				<li class="username navigation first_navigation"><?php echo $_SESSION["user"];?></li>
				<?php
					if($_SESSION["admin"]){
				?>
				<li class="navigation"><a href="users.php">User Management</a></li>
				<?php
					}
				?>
				<li class="navigation"><a href="change_password.php">Change Password</a></li>
				<li class="navigation"><a href="logout.php">Logout</a></li>
			</ul>
			<?php } ?>
			<span id="functions">
				<input type="radio" name="function" id="go_orders" /><label for="go_orders">Orders</label>
				<input type="radio" name="function" id="go_reports"/><label for="go_reports">Reports</label>
			</span>
		</div>
