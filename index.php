<?php 
	require_once("security.php");
	require_once("header.php");
?>
		<script type="text/javascript">
			jQuery(function($){
				$("#orders").jqGrid({ 
					url:'order_manage.php', 
					datatype: "json", 
					colNames:['ID','Name', 'Begin', 'End', 'Status', 'Price', 'Charged', 'Customer', 'In Charge'], 
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
								name:'begin', 
								editable : true, 
								formatter: 'date',
								formatoptions: {
									newformat: "Y-m-d"
								},
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
							{
								name:'status', 
								editable : true, 
								jsonmap : 'status', 
								width: 100,
								edittype: "select",
								formatter: "select",
								editoptions: {
									value: "0:start;1:in progress;2:complete;3:droped"
								}
							},
							{
								name: 'price',
								editable: true,
								jsonmap: "price",
								width: 100
							},
							{
								name: 'charged',
								editable: true,
								jsonmap: 'charged',
								width: 100
							},
							{
								name: 'customer',
								editable: true,
								jsonmap: 'customer',
								width: 150
							},
							{
								name: 'in_charge',
								editable: true,
								jsonmap: 'in_charge',
								width: 150
							}
						], 
					rowNum: 10, 
					rowList: [10,20,30],
					sortname: 'id', 
					viewrecords: true, 
					sortorder: "desc", 
					caption:"Orders",   
					imgpath: 'images',
					pager: '#order_pager', 
					editurl: "order_manage.php",
					subGrid: true,
					subGridRowExpanded: function(subgrid_id, row_id) { 
						var subgrid_table_id, pager_id;
						subgrid_table_id = subgrid_id+"_t";
						pager_id = "p_"+subgrid_table_id; 
						$("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>"); 
						$("#"+subgrid_table_id).jqGrid({ 
							url:"task_manage.php?order_id=" + row_id,
							datatype: "json", 
							jsonReader: {
							    repeatitems: false,
							},
							colNames: ['ID','Name', 'Resource','Begin','End'], 
							colModel: [ 
								{
									name: "task_id",
									editable: false,
									key: true,
									jsonmap: "task_id",
									width: 50
								},
								{
									name: "task_name",
									editable: true,
									jsonmap: "task_name",
									width: 100
								},
								{
									name:"task_resource",
									jsonmap: "task_resource",
									width:130,
									editable: true
								}, 
								{
									name:"task_begin",
									jsonmap:"task_begin",
									width:100,
									editable: true
								}, 
								{
									name:"task_end",
									jsonmap:"task_end",
									width:100,
									editable:true
								} 
							], 
							editurl: "task_manage.php?order_id=" + row_id,
							rowNum:20, 
							pager: pager_id, 
							sortname: 'task_id', 
							sortorder: "asc",
							height: "100%"
						}); 
						$("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id, {search:true, edit: true, add:true, del:true}, {
							onInitializeForm : function(){
								$("#task_begin").datepicker({
									dateFormat:'yy-m-d',
									beforeShow: function(){
										var val =  $("#task_begin").val() != null? $("#task_begin").val() : new Date();
										$("#task_begin").datepicker("setDate", val);
									}
								});
								$("#task_end").datepicker({
									dateFormat:'yy-m-d',
									beforeShow: function(){
										var val =  $("#task_end").val() != null? $("#task_end").val() : new Date();
										$("#task_end").datepicker("setDate", val);
									}
								});
							}
						});
					},
					jsonReader: {
					    repeatitems: false,
					}
				
				}).navGrid('#order_pager', {search:true, edit: true, add:true, del:true}, {
					beforeShowForm : function(){
						if($("#begin").is(".hasDatepicker"))
							return;
						$("#begin").datepicker({
							dateFormat:'yy-m-d',
							beforeShow: function(){
								var val =  $("#begin").val() != null? $("#begin").val() : new Date();
								$("#begin").datepicker("setDate", val);
						    	}
						});
						$("#end").datepicker({
							dateFormat:'yy-m-d',
							beforeShow: function(){
								var val =  $("#end").val() != null? $("#end").val() : new Date();
								$("#end").datepicker("setDate", val);
						    	}
						});
					}
				});
			});		</script>
		<div id="content" class="clearfix">
			<table id="orders">
			</table>
			<div id="order_pager"></div>
		</div>
<?php require_once("footer.php");?>
