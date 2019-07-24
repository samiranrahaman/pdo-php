<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
    $db = new Crud();

    $result = $db->getRows('BranchLocation',array('order_by'=>'BranchId DESC'));
    
	//mysqli_stmt_bind_result($query, $id, $name, $username, $password);
	
	?>
	
           
              <table id="example1" class="table table-bordered table-striped">
                <thead>
               
			<tr>
			<th>SL</th>
			<th>Branch Code</th>
			<th>Branch Name</th>
			<th>Trust Type</th>
			<th>Branch Logo</th>
			<th>Created Date</th>
            <th>Created By</th>
            <th>Updated Date</th>
			<th>Updated By</th>
			<th>Active</th>
			<th>Action</th>
		</tr>
		</thead>
	<?php

if(!empty($result)){ $count = 0; foreach($result as $res){ $count++;?>
    <?php
       $TrustTypeName = $db->getRows('TrustType',array('where'=>array('TrustTypeId'=>$res["BranchTrustTypeId"]),'return_type'=>'single'));
	   
		echo '
        <tr>
			<td>'.$count.'</td>
			<td>'.$res["BranchCode"].'</td>
			<td>'.$res["BranchName"].'</td>
			<td>'.$TrustTypeName["TrustTypeName"].'</td>
			<td><img id="upreview" class="direct-chat-img" src='.$res["BranchLogoImageUrl"].' /></td>
			<td>'.$res["CreatedDate"].'</td>
			<td>'.$res["CreatedBy"].'</td>
            <td>'.$res["UpdatedDate"].'</td>
            <td>'.$res["UpdatedBy"].'</td>
            <td>'.$res["IsActive"].'</td>
			<td><button id="'.$res["BranchId"].'" class="edit btn btn-info">Edit</button> <button class="del btn btn-danger" id="'.$res["BranchId"].'">Delete</button></td>
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