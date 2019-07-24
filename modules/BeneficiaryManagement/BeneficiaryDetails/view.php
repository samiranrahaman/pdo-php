<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
$projectPath = "http://localhost/SBM/";
include_once $serverRoot.'/SBM/includes/logics/Crud.php';
include_once $serverRoot.'/SBM/includes/logics/baseurl.php';

$baseurls= new baseurl();


//echo "ddd: ".$MAINPAGE;

    $db = new Crud();

    $result = $db->getRows('beneficiarydetail',array('order_by'=>'BeneficiaryDetailId DESC'));
    
	//mysqli_stmt_bind_result($query, $id, $name, $username, $password);
	
	?>
	<style>
	.btncon
	{
		background: #110c63;
    padding: 5px 13px;
    border-radius: 5px;
    color: #fff;
	}
	.editbutton
	{
		 background: #110c63;
    padding: 5px 13px;
    border-radius: 5px;
    color: #fff;
    margin-right: 5px;
	}
	</style>


	<div class="table-responsive" style="padding: 20px;">
		<div class="row">

	


              <table id="example1" class="table table-bordered table-striped">
                <thead>
               
			<tr>
			<!--<th>SL</th>-->
			<th>Beneficiary Code</th>
			<th>Beneficiary Name</th>
			<th>Branch - Locatione</th>
			<th>Occupation</th>


			<th colspan="5">Action</th>
			
		</tr>
		</thead>
	<?php

if(!empty($result)){ $count = 0; foreach($result as $res){ $count++;?>
    <?php
     //  $RoleName = $db->getRows('Role',array('where'=>array('RoleId'=>$res["RoleId"]),'return_type'=>'single'));
	 //  $BranchName = $db->getRows('BranchLocation',array('where'=>array('BranchId'=>$res["BranchId"]),'return_type'=>'single'));
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
			
			<td>'.$res["BeneficiaryDetailId"].'</td>
			
			
			<td>'.$res["BeneficiaryName"].'</td>
			<td>'.$res["BeneficiaryBranchId"].'</td>
			<td>'.$res["BeneficiaryOccupation"].'</td>

			';
			?>
			<td colspan="5">
			 <a href="<?php echo $baseurls->url;?>modules/BeneficiaryManagement/BeneficiaryDetails/editpage?id=<?php echo $res['BeneficiaryDetailId'] ?>" class="btncon"><i class="fa fa-eye"></i></a>
			 
			  <a href="<?php echo $baseurls->url;?>modules/BeneficiaryManagement/BeneficiaryDetails/editpage?id=<?php echo $res['BeneficiaryDetailId'] ?>" class="btncon">  <i class="fa fa-edit"></i></a>
			  
			
			  <a href="#" class="del btncon" id="<?php echo $res["BeneficiaryDetailId"] ?>" style="margn-right: 5px;">
			  <i class="fa fa-trash"></i>
			  </a>
			 <a href="<?php echo $baseurls->url;?>modules/BeneficiaryManagement/BeneficiaryDetails/actionpage?id=<?php echo $res['BeneficiaryDetailId'] ?>" style="margin-left:5px;" class="btncon"> Action</a>
			<?php
			echo ' 
           
			</td>
		</tr>';
	}
}else{ ?>
    <tr><td >No Data found......</td></tr>
    <?php } ?><?php 
		echo '</table>
		';
	
?>
</div>
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

</script>