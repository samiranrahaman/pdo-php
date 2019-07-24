<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
    $db = new Crud();

    $result = $db->getRows('LoginDetails',array('order_by'=>'UserId DESC'));
    
	//mysqli_stmt_bind_result($query, $id, $name, $username, $password);
	
	?>
	
           
              <table id="example1" class="table table-bordered table-striped">
                <thead>
               
			<tr>
			<!--<th>SL</th>-->
			<th>Employee Name</th>
			<th>User Name</th>
			<th>Password</th>
			<th>Last Login Date</th>
			<th>Last Login Time</th>
            <th>Created By</th>
			<th>Last Login Updated Date</th>
			<th>Last Login Updated Time</th>
			<th>Updated By</th>
			<!--<th>Active</th> -->
			<th>Action</th>
		</tr>
		</thead>
	<?php

if(!empty($result)){ $count = 0; foreach($result as $res){ $count++;?>
    <?php
       $EmployeeName = $db->getRows('Employee',array('where'=>array('EmployeeId'=>$res["EmployeeId"]),'return_type'=>'single'));
	  // $BranchName = $db->getRows('BranchLocation',array('where'=>array('BranchId'=>$res["BranchId"]),'return_type'=>'single'));
	   
		echo '
        <tr>
			
			<td>'.$EmployeeName["EmployeeName"].'</td>
			
			<td>'.$res["UserName"].'</td>
			<td>'.$res["Password"].'</td>
			<td>'.$res["LastLoginDate"].'</td>
			<td>'.$res["LastLoginTime"].'</td>
			<td>'.$res["CreatedBy"].'</td>
			<td>'.$res["LastLoginUpdatedDate"].'</td>
			<td>'.$res["LastLoginUpdatedTime"].'</td>
            <td>'.$res["UpdatedBy"].'</td>
            
			<td><button id="'.$res["EmployeeId"].'" class="edit btn btn-info">Edit</button> <button class="del btn btn-danger" id="'.$res["EmployeeId"].'">Delete</button></td>
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
    $('#example1').DataTable();
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