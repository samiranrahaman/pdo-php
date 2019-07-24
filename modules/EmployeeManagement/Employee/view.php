<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
    $db = new Crud();

    $result = $db->getRows('Employee',array('order_by'=>'EmployeeId DESC'));
    
	//mysqli_stmt_bind_result($query, $id, $name, $username, $password);
	
	?>
	
           
              <table id="example1" class="table table-bordered table-striped">
                <thead>
               
			<tr>
			<!--<th>SL</th>-->
			<th>Employee Name</th>
			<th>Role</th>
			<th>Branch</th>
			<th>Employee Image</th>
			<th>Username</th>
			<!--<th>Password</th>-->
			<th>Created Date</th>
            <th>Created By</th>
            <th>Updated Date</th>
			<th>Updated By</th>
		    <th>Is Active</th> 
			<th>Action</th>
		</tr>
		</thead>
	<?php

if(!empty($result)){ $count = 0; foreach($result as $res){ $count++;?>
    <?php
       $RoleName = $db->getRows('Role',array('where'=>array('RoleId'=>$res["RoleId"]),'return_type'=>'single'));
	   $BranchName = $db->getRows('BranchLocation',array('where'=>array('BranchId'=>$res["BranchId"]),'return_type'=>'single'));
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
			
			<td>'.$res["EmployeeName"].'</td>
			
			<td>'.$RoleName["RoleName"].'</td>
			<td>'.$BranchName["BranchName"].'</td>
			<td><img id="upreview" class="direct-chat-img" src='.$res["EmployeeImageUrl"].' /></td>
			<td>'.$res["UserName"].'</td>
			
			<td>'.$res["CreatedDate"].'</td>
			<td>'.$EmployeeUser["UserName"].'</td>
            <td>'.$res["UpdatedDate"].'</td>
            <td>'.$EmployeeUserU["UserName"].'</td>';
			if($res["IsActive"] == 1){
				echo '				
					<td><label id="'.$res["EmployeeId"].'" class="switch">
					<input id="'.$res["EmployeeId"].'" onclick="IsActive('.$res["EmployeeId"].')" checked class="IsActive'.$res["EmployeeId"].'" type="checkbox">
					<span class="slider round"></span>
					</label></td>';
			}else{
				echo '				
				<td><label id="'.$res["EmployeeId"].'" class="switch">
					<input id="'.$res["EmployeeId"].'" onclick="IsActive('.$res["EmployeeId"].')" type="checkbox" class="IsActive'.$res["EmployeeId"].'">
					<span class="slider round"></span>
					</label></td>';
			}
			echo ' 
            
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
    $('#example1').DataTable({
			"scrollX": true
		});
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

function IsActive(c_id){
	//alert(c_id);
	//$('.IsActive'+c_id).click(function() {
		var id = c_id;
        var IsActive ; 
		//alert(id);
		if($('.IsActive'+c_id).is(':checked')){
			//$('.IsActive').attr( "checked" ,"checked" );
			//$('.IsActive').is(':checked') == false;
			IsActive = 1;
			//alert(IsActive);
		}else{
		//	$('.IsActive').is(':checked') == true;
			IsActive = 0;
			//alert(IsActive);
		}
		
        //var EmailTemplateName = $('#uEmailTemplateName').val();
       // var EmailTemplateSubject = $('#uEmailTemplateSubject').val();
       // var EmailTemplateDescription = CKEDITOR.instances["uEmailTemplateDescription"].getData();
        
        var action_type = "edit";
        //var password = $('#password').val();
       // console.log(EmailTemplateName);
        $.ajax({
            url: "IsActive.php",
            type: "POST",
            data: { id: id,IsActive:IsActive, action_type : action_type},
            success: function(data, status, xhr) {
                //$('#uEmailTemplateName').val('');
             //   $('#uEmailTemplateSubject').val('');
               // $('#uEmailTemplateDescription').val('');
              // CKEDITOR.instances["uEmailTemplateDescription"].setData("");
               // alert(data);
                if(data == 'success'){
                    $('#records_content').fadeOut(1100).html(data);
                    $.get("view.php", function(html) {
                        $("#table_content").html(html);
                    });
                    $('#records_content').fadeOut(1100).html(data);

                }
               
            },
            complete: function() {
                $('#link-add').hide();
                $('#link-update').hide();
                $('#show-add').show(700);
            }
        });
    //}); // update close
}
</script>