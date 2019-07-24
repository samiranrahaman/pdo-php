<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
$projectPath = "http://localhost/SBM/";
include_once $serverRoot.'/SBM/includes/logics/Crud.php';
include_once $serverRoot.'/SBM/includes/logics/baseurl.php';

$baseurls= new baseurl();
    $db = new Crud();

    $result = $db->getRows('Donor',array('order_by'=>'DonorId DESC'));
    
	//mysqli_stmt_bind_result($query, $id, $name, $username, $password);
	
	?>
	
	<div class="table-responsive">



              <table id="example1" class="table table-bordered table-striped">
                <thead>
               
			<tr>
			<!--<th>SL</th>-->
			<th>Donaiton ID</th>
			<th>Age</th>
			<th>Id Proof Type</th>
			<th>Id Proof Number</th>

<!--
			<th>Share Location</th>
			<th>Donor Pan No</th>
			<th>Is Pan Verified</th>
			<th>Phone No 1</th>
			<th>Phone No 2</th>
			<th>Phone No 3</th>
			<th>Phone No 4</th>

			<th>Address</th>
			<th>City</th>
			<th>State</th>
			<th>Country</th>
			<th>Landmark</th>
			<th>Donation Type</th>
			<th>Date of Collection For First Week</th>
			<th>Date of Collection For Second Week</th>
			<th>Date of Collection For Third Week</th>
			<th>Date of Collection For Fourth Week</th>
			<th>Day of Collection For Monday</th>
			<th>Day of Collection For Tuesday</th>
			<th>Day of Collection For Wednesday</th>
			<th>Day of Collection For Thursday</th>
			<th>Day of Collection For Friday</th>
			<th>Day of Collection For Saturday</th>
			<th>Day of Collection For Sunday</th>
			<th>Collection Type</th>
			<th>Collection Time </th>
			<th>Health Status</th>
			<th>Blood Dontion Time</th>


			<th>Blood Group</th>
			
			<th>Blood Collection on Monday</th>
			<th>Blood Collection on Tuesday</th>
			<th>Blood Collection on Wednesday</th>
			<th>Blood Collection on Thursday</th>
			<th>Blood Collection on Friday</th>
			<th>Blood Collection on Saturday</th>
			<th>Blood Collection on Sunday</th>
			<th>Eligible For Loan</th>
			<th>Eligible For Medical SponsorShip</th>
			<th>Want To Be Volounter</th>
			<th>Volounteer Availability On Week Days</th>
			<th>Volounteer Availability On Week Ends</th>
			<th>Volounteer Type As Professional Work</th>
			<th>Volounteer Type As Field Work</th>
			<th>Want A Donaiton Box</th>
			<th>Donaiton Time On One Month</th>
			<th>Donaiton Time On Second Month</th>
			<th>Donaiton Time On Third Month</th>
			<th>Donaiton Box Number</th>
			<th>Donaiton Remarks</th>
-->
			<th>Created Date</th>
            <th>Created By</th>
            <th>Updated Date</th>
			<th>Updated By</th>
		    <th>Is Active</th> 
			<th>Action</th>
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
			
			<td>'.$res["DonorId"].'</td>
			
			
			<td>'.$res["DonorAge"].'</td>
			<td>'.$res["DonorIdProofType"].'</td>
			<td>'.$res["DonorIdProofNumber"].'</td>
		
			<td>'.$res["CreatedDate"].'</td>
			<td>'.$res["CreatedBy"].'</td>
			<td>'.$res["UpdatedBy"].'</td>
			<td>'.$res["UpdatedDate"].'</td>';
			if($res["IsActive"] == 1){
				echo '				
					<td><label id="'.$res["DonorId"].'" class="switch">
					<input id="'.$res["DonorId"].'" onclick="IsActive('.$res["DonorId"].')" checked class="IsActive'.$res["DonorId"].'" type="checkbox">
					<span class="slider round"></span>
					</label></td>';
			}else{
				echo '				
				<td><label id="'.$res["DonorId"].'" class="switch">
					<input id="'.$res["DonorId"].'" onclick="IsActive('.$res["DonorId"].')" type="checkbox" class="IsActive'.$res["DonorId"].'">
					<span class="slider round"></span>
					</label></td>';
			}
			?>
			<td>
			
			 <a href="<?php echo $baseurls->url;?>modules/DonorManagement/DonorDetails/editpage?id=<?php echo $res['DonorId'] ?>" class="btn btn-default btn-flat">Edit</a></td>
			
			<?php
			echo ' 
            <td>
			
			<button class="del btn btn-danger" id="'.$res["DonorId"].'">Delete</button></td>
		</tr>';
	}
}else{ ?>
    <tr><td >No Data found......</td></tr>
    <?php } ?><?php 
		echo '</table>
		';
	
?>
</div>
<script>
  $(function () {
    $('#example1').DataTable(
		{
			"scrollX": true,
			"autoWidth": true
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
	    url : 'editpage.php',
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