<?php
	require_once("security.php"); 
	if(!isset($_SESSION["admin"])){
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'login.php';
		header("Location: http://$host$uri/$extra");
		exit;
	}
	require_once("header.php");?>
		<script type="text/javascript">
			jQuery(function($){
				$("#users").jqGrid({
					url: "user_manage.php",
					datatype: "json",
					colNames:['ID','Name', 'Login Count', 'Is Admin'], 
					colModel:[ 
							{
								name: 'id', 
								editable : false, 
								jsonmap : 'id',
								width : 50
							}, 
							{
								name:'name', 
								editable : true, 
								jsonmap : 'name', 
								width : 100, 
								editrules : {
									required : true,
									maxlength : 24
								} 
							}, 
							{
								name:'login_count', 
								editable : true, 
								jsonmap: "login_count",
								width : 100 
							},
							{
								name:'end', 
								editable : true, 
								formatter: 'date',
								formatoptions: {
									newformat: "Y-m-d"
								},
								jsonmap : 'end', 
								width : 100
							},

					]
				});
			});
		</script>
		<div id="content" class="clearfix">
			<table id="users">
			</table>
			<div id="user_pager"></div>
		</div>
<?php require_once("footer.php");?>
