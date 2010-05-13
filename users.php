<?php
	require_once("security.php"); 
	if($_SESSION["admin"]){
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
					pager: "#user_pager",
					sortname: 'id', 
					colModel:[ 
							{
								name: 'id', 
								editable : false, 
								jsonmap : 'id',
								width : 150
							}, 
							{
								name:'name', 
								editable : true, 
								jsonmap : 'name', 
								width : 300, 
								editrules : {
									required : true,
									maxlength : 24
								} 
							}, 
							{
								name:'login_count', 
								editable : false, 
								jsonmap: "login_count",
								width : 200 
							},
							{
								name:'is_admin', 
								editable : true, 
								edittype: "select",
								formatter: "select",
								editoptions: {
									value: "0:false;1:true"
								},
								jsonmap : 'is_admin', 
								width : 300
							},

					],
					editurl: "user_manage.php",
					jsonReader: {
					    repeatitems: false,
					}
				}).navGrid("#user_pager", {search:true, edit: true, add:true, del:true});
			});
		</script>
		<div id="content" class="clearfix">
			<table id="users">
			</table>
			<div id="user_pager"></div>
		</div>
<?php require_once("footer.php");?>
