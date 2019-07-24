<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
$projectPath = "http://localhost/SBM/";
session_start();
// Check to see if the session user email exists.
if(!isset($_SESSION['email'])) {

    header("Location: ../../../index"); // Since the session userid doesn't exist, redirect them back to the login page.
  die(); // Ignore anything after this. Redundant, but trying to be safe here.

}
include_once $serverRoot.'/SBM/includes/layouts/header.php';
include_once $serverRoot.'/SBM/includes/layouts/navbar.php';
include_once $serverRoot.'/SBM/includes/logics/Crud.php';
$db = new Crud();
$RoleName = $db->getRows('Role',array('order_by'=>'RoleId DESC'));
$MemberTypeName = $db->getRows('MemberType',array('order_by'=>'MemberTypeId DESC'));
$BranchName = $db->getRows('BranchLocation',array('order_by'=>'BranchId DESC'));
$IdProofType = $db->getRows('IdProofType',array('order_by'=>'IdProofTypeId DESC'));
$Religion = $db->getRows('Religion',array('order_by'=>'ReligionId DESC'));

$cty = $db->getRows('city',array('order_by'=>'CityId DESC'));
$country = $db->getRows('country',array('order_by'=>'CountryId DESC'));
$state = $db->getRows('state',array('order_by'=>'StateId DESC'));

$charitablefundtype = $db->getRows('charitablefundtype',array('order_by'=>'CharitableFundTypeId DESC'));
$religiousfundtypeview = $db->getRows('religiousfundtype',array('order_by'=>'ReligiousFundTypeId DESC'));








?>
			



<style>
.content {
    min-height: 250px;
  
   
}
.h3 {
	font-size: 15px;
}

.form-group {
    margin-bottom: 8px;
}
</style>
 <div class="container-fluid" style="padding: 0px; margin: 0px;">
        <div class="row">
            <h3 class="text-center"> </h3>
			
			
			
			
        </div>
    </div>
    <div class="container">
<div class="box box-warning" style="border-top:3px solid #3c8dbc">
				<div class="box-header with-border">
					<h3 class="box-title">Update New Vendor</h3>
				</div>
<?php
$id = $_GET['id'];
$result = $db->getRows('vendor',array('where'=>array('Id'=>$id),'return_type'=>'single'));
if(!empty($result)){ 
?>
<!--<form id="user_form" method="post" enctype="multipart/form-data">-->  
        <div class="row"  style="margin-right: 74px;">
            <div class="col-md-12">
				<div id="link-update" >
                </div>
            
                <div id="link-add" >
 
<div class="row">
<div class="col-md-2"></div>
<!-- left column -->
<div class="col-md-8">
<!-- Horizontal Form -->
<div class="box_ box-warning_">
<div class="box-header with-border">
<h3 class="box-title">Please fill the following details</h3>
</div><!-- /.box-header -->
<div class="form-horizontal" id="identicalForm">  
<div class="box-body">

<!--
<div class="form-group">
<label for="inputPassword3" class="col-sm-3 control-label">Password</label>
<div class="col-sm-9">
 <input type="password" name="password" placeholder="Password" class="form-control" id="password" >
</div>
</div>
<div class="form-group">
<label for="inputPassword3" class="col-sm-3 control-label">Re-Password</label>
<div class="col-sm-9">
<input type="password" placeholder="Confirm Password" class="form-control" id="confirm_password" >
</div>
</div>    -->
  
<div class="new_application_form">
<div class="form-group">
<label for="inputPassword3" class="col-sm-3 control-label">Branch - Location</label>
<div class="col-sm-9">
 <select class="form-control select2" id="BeneficiaryBranchId" name="BeneficiaryBranchId" style="width: 100%;"  required >
                        <?php
						$BranchIds = $result['BranchId'];
  $BranchName_vew = $db->getRows('BranchLocation',array('where'=>array('BranchId'=>$BranchIds),'return_type'=>'single'));	
$BranchName = $BranchName_vew['BranchName'];
			
						
						
						 echo '<option value="'.$result['BranchId'].'">'.$BranchName_vew['BranchName'].'</option>';
                                if(!empty($BranchName)){ foreach($BranchName as $res){
                                                       echo "<option value='".$res['BranchId']."'>".$res['BranchName']."</option>";

                                }}
                                else{
                                    echo '<option vaue="">No Branch</option>';
                                }
                        ?>
   </select>
</div>
</div>    
<div class="form-group">
<label for="inputPassword3" class="col-sm-3 control-label">Vendor Id</label>
<div class="col-sm-9">
 <input type="text" name="vendor_id" id="vendor_id" value="<?php echo $result['VendorId']; ?>" class="form-control" required="required">
</div>
</div> 
<div class="form-group">
<label for="inputPassword3" class="col-sm-3 control-label">Name</label>
<div class="col-sm-9">
 <input type="text" name="name" id="name" class="form-control" value="<?php echo $result['VendorName']; ?>" required="required">
 <input type="hidden" name="name" id="autoid" class="form-control" value="<?php echo $result['Id']; ?>" required="required">
</div>
</div>   

<div class="form-group">
<label for="Occupation" class="col-sm-3 control-label">Occupation</label>
<div class="col-sm-9">
 <input type="text" name="occupation" id="occupation" class="form-control" value="<?php echo $result['VendorOccupation']; ?>" required="required">
</div>
</div>
    
<div class="form-group">
<label for="Occupation" class="col-sm-3 control-label">Phone Number</label>
<div class="col-sm-9">
 <input type="text" name="phone1" id="phone1" class="form-control" value="<?php echo $result['VendorPhoneNo']; ?>" required="required">
</div>
</div>
<div class="form-group">
<label for="Occupation" class="col-sm-3 control-label">Email</label>
<div class="col-sm-9">
 <input type="text" name="email" id="email" class="form-control" value="<?php echo $result['VendorEmail']; ?>" required="required">
</div>
</div>       
    
<div class="form-group">
<label for="Expenses" class="col-sm-3 control-label">Address</label>
<div class="col-sm-9">
    <textarea name="address" id="address" class="form-control address" required="required"><?php echo $result['VendorAddress']; ?></textarea>
</div>
</div> 


<div class="form-group">
<label for="State" class="col-sm-3 control-label">Country</label>
<div class="col-sm-9">

   
   <select class="form-control select2" id="country" name="country" style="width: 100%;">
<?php
$VendorCountry = $result['VendorCountry'];

$countryresult = $db->getRows('country',array('where'=>array('CountryId'=>$VendorCountry),'return_type'=>'single'));


 echo '<option value="'.$result['VendorCountry'].'">'.$countryresult['CountryName'].'</option>';
 
	    if(!empty($country)){ foreach($country as $res){
							   echo "<option value='".$res['CountryId']."'>".$res['CountryName']."</option>";

		}}
		else{
			echo '<option vaue="">No Member Type</option>';
		}
?>
</select>
   
</div>
</div> 

<div class="form-group">
<label for="State" class="col-sm-3 control-label">State</label>
<div class="col-sm-9">

   
<select class="form-control select2" id="BeneficiaryStateId" name="BeneficiaryStateId" style="width: 100%;">
<?php

$BeneficiaryStateId = $result['VendorState'];
$stateresult = $db->getRows('state',array('where'=>array('StateId'=>$BeneficiaryStateId),'return_type'=>'single'));



 echo '<option value="'.$result['VendorState'].'">'.$stateresult['StateName'].'</option>';

		echo '<option vaue="">Select State</option>';
		
?>
</select>
</div>
</div> 

<div class="form-group">
<label for="City" class="col-sm-3 control-label">City</label>
<div class="col-sm-9">

   				<select class="form-control select2" id="BeneficiaryCityId" name="BeneficiaryCityId" style="width: 100%;">
				<?php
	$BeneficiaryCityId = $result['VendorCity'];
    $cityresult = $db->getRows('city',array('where'=>array('CityId'=>$BeneficiaryCityId),'return_type'=>'single'));

  echo '<option value="'.$result['VendorCity'].'">'.$cityresult['CityName'].'</option>';				
				
				
				echo '<option vaue="">Select City</option>';

				?>
				</select>
</div>
</div> 

<div class="form-group">
<label for="State" class="col-sm-3 control-label">Landmark</label>
<div class="col-sm-9">
   <input type="text" name="landmark" id="landmark" class="form-control" value="<?php echo $result['VendorLandMark']; ?>" required="required">
</div>
</div> 
          
        
    </div>
    <div class="application_aid data-hide">


        
        

          
        
    </div>

<div class="form-group">
<label for="Expenses" class="col-sm-3 control-label">Account Details</label>
<div class="col-sm-9">
<textarea name="account_details" id="account_details"  class="form-control account_details"><?php echo $result['VendorAccountDetails']; ?></textarea>
</div>
</div> 
    
   <div class="form-group">
<label for="Expenses" class="col-sm-3 control-label">Remarks</label>
<div class="col-sm-9">
    <textarea name="remarks" id="remarks"  class="form-control"><?php echo $result['VendorRemarks']; ?></textarea>
</div>
</div>  
				<div class="form-group">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-9">
     <input type="text" id='action_type' name="action_type" value="add" hidden/> 
                        <button type="button" class="btn btn-primary" id="add" name="add" style="margin-top: 20px">Update</button>

<a href="<?php echo $GLOBALS['basepath'];?>modules/AccountsManagment/Vendor/index"
		class="btn btn-primary" style="text-align:right; margin-top: 20px;">
		Cancel</a>



				</div>
				</div>




       </div><!-- /.box-body -->
 
    
</form>   
    
 </div><!-- /.box -->

</div>
</div>				
				
				
				
				
				
			</div>	


				
				

<?php
}
?>			

	
			<div class="col-md-12">
 
  
			</div>			
          
            </div>
        </div>
        </div>


    </div>
    </div>
<?php
        include_once '../../../includes/layouts/footer.php';
?>

<script>

$(function() {

	 $('#add').click(function() {
    var action_type = $('#action_type').val();
    var BeneficiaryBranchId = $("#BeneficiaryBranchId").val();
	//alert(BeneficiaryApplicaitonTypeId);

    var autoid = $("#autoid").val();
    var vendor_id = $("#vendor_id").val();
    var name = $("#name").val();
    var occupation = $("#occupation").val();
    var phone1 = $("#phone1").val();
    var email = $("#email").val();
    var address = $(".address").val();
    var country = $("#country").val();

    var BeneficiaryCityId = $("#BeneficiaryCityId").val();
    var BeneficiaryStateId = $("#BeneficiaryStateId").val();

    var landmark = $("#landmark").val();
    var remarks = $("#remarks").val();
    var account_details = $("#account_details").val();
  

    $.ajax({
        url: "update_data.php",
        type: "POST",
        data: {vendor_id:vendor_id,name:name,occupation:occupation,phone1:phone1,email:email,country:country,BeneficiaryStateId:BeneficiaryStateId,landmark:landmark,action_type:action_type,BeneficiaryBranchId:BeneficiaryBranchId,address:address,BeneficiaryCityId:BeneficiaryCityId,account_details:account_details,remarks:remarks,autoid:autoid},
        //processData: false,
        //contentType: false,,
		//
		
		
        success: function(data, status, xhr) {
         //   alert(data);
           // $('#BranchName').val('');
          // $('#EmployeeName').val('');
           // $("#BranchRoleId option:selected").val('');
           
           // $('#preview').attr('src');
            //alert(data);
           if(data == 'success'){
			   
			 //  alert('Successfully');

           }else{
             alert('Error');
           }
            
        },
        error: function() {
            alert('Error');
        },
        beforeSend: function() {
              //alert('Error');
        },
        complete: function() {
           // $('#link-add').hide();
           // $('#link-update').hide();
           // $('#show-add').show(700);
		    alert('Successfully');
        }
    });
}); // add close
	


});


</script>	
	
