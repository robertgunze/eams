<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>MEAC Strategic Plan</title>
	<link rel="stylesheet" type="text/css" href="../js/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../js/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="../js/easyui/demo/demo.css">
	<script type="text/javascript" src="../js/easyui/jquery.min.js"></script>
	<script type="text/javascript" src="../js/easyui/jquery.easyui.min.js"></script>
</head>
<body>
	<div style="margin:20px 0;">
		<a href="javascript:void(0)" class="easyui-linkbutton" onclick="edit()">Edit</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" onclick="save()">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" onclick="cancel()">Cancel</a>
	</div>
	<table id="tg" class="easyui-treegrid" title="MEAC Strategic Plan" style="width:100%;height:400px"
			data-options="
				iconCls: 'icon-ok',
				rownumbers: true,
				animate: true,
				collapsible: true,
				fitColumns: true,
				url: 'http://localhost/eams/index.php?r=eamsFramework/LoadSPFramework',
				method: 'get',
				idField: 'id',
				treeField: 'name',
				showFooter: true
			">
		<thead>
			<tr>
				<th data-options="field:'name',width:180,editor:'text'">Description</th>
				<th data-options="field:'type',width:60,align:'right',editor:'numberbox'">Type</th>
		        </tr>
		</thead>
	</table>
	<script type="text/javascript">
		function formatProgress(value){
	    	if (value){
		    	var s = '<div style="width:100%;border:1px solid #ccc">' +
		    			'<div style="width:' + value + '%;background:#cc0000;color:#fff">' + value + '%' + '</div>'
		    			'</div>';
		    	return s;
	    	} else {
		    	return '';
	    	}
		}
		var editingId;
		function edit(){
			if (editingId != undefined){
				$('#tg').treegrid('select', editingId);
				return;
			}
			var row = $('#tg').treegrid('getSelected');
			if (row){
				editingId = row.id
				$('#tg').treegrid('beginEdit', editingId);
			}
		}
		function save(){
			if (editingId != undefined){
				var t = $('#tg');
				t.treegrid('endEdit', editingId);
				editingId = undefined;
				var persons = 0;
				var rows = t.treegrid('getChildren');
				for(var i=0; i<rows.length; i++){
					var p = parseInt(rows[i].persons);
					if (!isNaN(p)){
						persons += p;
					}
				}
				var frow = t.treegrid('getFooterRows')[0];
				frow.persons = persons;
				t.treegrid('reloadFooter');
			}
		}
		function cancel(){
			if (editingId != undefined){
				$('#tg').treegrid('cancelEdit', editingId);
				editingId = undefined;
			}
		}
	</script>

</body>
</html>
