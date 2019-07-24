<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
    $db = new Crud();

    $result = $db->getRows('RoleAssignment',array('order_by'=>'Id DESC'));
    
	//mysqli_stmt_bind_result($query, $id, $name, $username, $password);
	
	?>
	
           
              <table id="example1" class="table table-bordered table-striped">
                <thead>
               
			<tr>
			<th>SL</th>
			<th>Role Name</th>
			<th>Module Name</th>
			<th>IsAdd</th>
			<th>IsEdit</th>
			<th>IsDelete</th>
			<th>IsView</th>
			<th>IsPrint</th>
			<th>IsDownload</th>
			<th>IsShare</th>
			<th>Created Date</th>
            <th>Created By</th>
            <th>Updated Date</th>
			<th>Updated By</th>
			
			<th>Action</th>
		</tr>
		</thead>
	<?php

if(!empty($result)){ $count = 0; foreach($result as $res){ $count++;?>
    <?php
		$RoleName = $db->getRows('Role',array('where'=>array('RoleId'=>$res['RoleId']),'return_type'=>'single'));
       //$RoleName = $db->getRows('Role',array('order_by'=>'RoleId DESC'));
	   $ModuleName = $db->getRows('Module',array('where'=>array('ModuleId'=>$res['ModuleId']),'return_type'=>'single'));
	   
	   $IsAdd = $res["IsAdd"] == 1 ? "Yes":"No";
	   $IsEdit = $res["IsEdit"] == 1 ? "Yes":"No";
	   $IsDelete = $res["IsDelete"] == 1 ? "Yes":"No";
	   $IsView = $res["IsView"] == 1 ? "Yes":"No";
	   $IsPrint = $res["IsPrint"] == 1 ? "Yes":"No";
	   $IsDownload = $res["IsDownload"] == 1 ? "Yes":"No";
	   $IsShare = $res["IsShare"] == 1 ? "Yes":"No";


	   $AdminUser = $db->getRows('Administrator',array('where'=>array('AdminId'=>$res["CreatedBy"]),'return_type'=>'single'));
	   if(!$AdminUser['UserName']=='Admin'){
		   
		   $EmployeeUser = $db->getRows('Employee',array('where'=>array('EmployeeId'=>$res["CreatedBy"]),'return_type'=>'single'));
	   
	   }else{
		   $EmployeeUser = $AdminUser;
	   }

	   $AdminUserU = $db->getRows('Administrator',array('where'=>array('AdminId'=>$res["UpdatedBy"]),'return_type'=>'single'));
	   

	   if(!$AdminUserU['UserName']=='Admin'){
		   
		   $EmployeeUserU = $db->getRows('Employee',array('where'=>array('EmployeeId'=>$res["UpdatedBy"]),'return_type'=>'single'));
	   
	   }else{
		   $EmployeeUserU = $AdminUserU;
	   }

		echo '
        <tr>
            <td>'.$count.'</td>
			<td>'.$RoleName["RoleName"].'</td>
			<td>'.$ModuleName["ModuleTitle"].'</td>
			<td>'.$IsAdd.'</td>
			<td>'.$IsEdit.'</td>
			<td>'.$IsDelete.'</td>
			<td>'.$IsView.'</td>
			<td>'.$IsPrint.'</td>
			<td>'.$IsDownload.'</td>
			<td>'.$IsShare.'</td>
			<td>'.$res["CreatedDate"].'</td>
			<td>'.$EmployeeUser["UserName"].'</td>
            <td>'.$res["UpdatedDate"].'</td>
            <td>'.$EmployeeUserU["UserName"].'</td>
           
			<td><button id="'.$res["Id"].'" class="edit btn btn-info">Edit</button> <button class="del btn btn-danger" id="'.$res["Id"].'">Delete</button></td>
		</tr>';
	}
}else{ ?>
    <tr><td >No Data found......</td></tr>
    <?php } ?><?php 
		echo '</table>
		';
	
?>
<script>
  $(function () {
    $('#example1').DataTable(
		{
			"scrollX": true
		}
	);
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script type="text/javascript">

	$('.del').click(function() {
        var id = $(this).attr('id');
        var action_type = "delete";
		$.ajax({
	    url : "delete.php",
	    type: "POST",
	    data : { id: id, action_type:action_type },
	    success: function(data)
	    {
            if(data == 'success'){
                $('#records_content').fadeOut(1100).html(data);
                $.get("view.php", function(data)
                {	
                    $("#table_content").html(data); 
                });
            }
	    	
	    }
	});
}); // delete close

	$('.edit').click(function() {
		var id = $(this).attr('id');
		$('#show-add').hide();
		$('#link-add').hide();
		$.ajax({
	    url : 'edit.php',
	    type: 'POST',
	    data : { id: id },
	    success: function(data)
	    {
    		$("#link-update").html(data);
    		$('#link-update').slideDown(700);
	    }
	});
}); // edit close

</script>