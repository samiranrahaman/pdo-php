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
					<h3 class="box-title">Add New Project</h3>
				</div>

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


  
<div class="new_application_form">
<div class="form-group">
<label for="inputPassword3" class="col-sm-3 control-label">Branch - Location</label>
<div class="col-sm-9">
 <select class="form-control select2" id="BeneficiaryBranchId" name="BeneficiaryBranchId" style="width: 100%;"  required >
                        <?php
                                echo '<option vaue="">Select Branch</option>';
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
<label for="inputPassword3" class="col-sm-3 control-label">Project Name</label>
<div class="col-sm-9">
 <input type="text" name="projectname" id="projectname" value="" class="form-control" required="required">
</div>
</div>   
<div class="form-group">
<label for="inputPassword3" class="col-sm-3 control-label">Project Budget</label>
<div class="col-sm-9">
 <input type="text" name="ProjectBudget" id="ProjectBudget" value="" class="form-control" required="required">
</div>
</div> 

<div class="form-group">
<label for="inputPassword3" class="col-sm-3 control-label">Project Details</label>
<div class="col-sm-9">
 <input type="text" name="ProjectDetails" id="ProjectDetails" value="" class="form-control" required="required">
</div>
</div> 
<div class="form-group">
<label for="inputPassword3" class="col-sm-3 control-label">Project Links</label>
<div class="col-sm-9">
 <input type="text" name="ProjectLink1" id="ProjectLink1" value="" class="form-control" required="required">
</div>
</div> 


<div class="form-group">
<label for="inputPassword3" class="col-sm-3 control-label">Responsible Person</label>
<div class="col-sm-9">
 <input type="text" name="ProjectResponsiblePerson" id="ProjectResponsiblePerson" value="" class="form-control" required="required">
</div>
</div> 
<div class="form-group">
<label for="Expenses" class="col-sm-3 control-label">Account Details</label>
<div class="col-sm-9">
<textarea name="account_details" id="account_details"  value="" class="form-control account_details"></textarea>
</div>
</div>
<div class="form-group">
<label for="inputPassword3" class="col-sm-3 control-label">Name</label>
<div class="col-sm-9">
 <input type="text" name="name" id="name" value="" class="form-control" required="required">
</div>
</div> 
<div class="form-group">
<label for="Occupation" class="col-sm-3 control-label">Occupation</label>
<div class="col-sm-9">
 <input type="text" name="occupation" id="occupation" value="" class="form-control" required="required">
</div>
</div>
    
<div class="form-group">
<label for="Occupation" class="col-sm-3 control-label">Phone Number</label>
<div class="col-sm-9">
 <input type="text" name="phone1" id="phone1" value="" class="form-control" required="required">
</div>
</div>
<div class="form-group">
<label for="Occupation" class="col-sm-3 control-label">Email</label>
<div class="col-sm-9">
 <input type="text" name="email" id="email" value="" class="form-control" required="required">
</div>
</div>       
    
<div class="form-group">
<label for="Expenses" class="col-sm-3 control-label">Address</label>
<div class="col-sm-9">
    <textarea name="address" id="address" value="" class="form-control address" required="required"></textarea>
</div>
</div> 


<div class="form-group">
<label for="State" class="col-sm-3 control-label">Country</label>
<div class="col-sm-9">

   
   <select class="form-control select2" id="country" name="country" style="width: 100%;">
<?php
		echo '<option vaue="">Select Country</option>';
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
				echo '<option vaue="">Select City</option>';

				?>
				</select>
</div>
</div> 

<div class="form-group">
<label for="State" class="col-sm-3 control-label">Landmark</label>
<div class="col-sm-9">
   <input type="text" name="landmark" id="landmark" value="" class="form-control" required="required">
</div>
</div> 
          
        
    </div>
    <div class="application_aid data-hide">


        
        

          
        
    </div>

 
    
   <div class="form-group">
<label for="Expenses" class="col-sm-3 control-label">Remarks</label>
<div class="col-sm-9">
    <textarea name="remarks" id="remarks" value="" class="form-control"></textarea>
</div>
</div>  
				<div class="form-group">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-9">
     <input type="text" id='action_type' name="action_type" value="add" hidden/> 
                        <button type="button" class="btn btn-primary" id="add" name="add" style="margin-top: 20px">Submit</button>

<a href="<?php echo $GLOBALS['basepath'];?>modules/AccountsManagment/project/index"
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
	
	//DonorCountryId
$('#country').change(function() {
	var BeneficiaryCountryId = $('#country').val();
	//alert(DonorCountryId);
	
	 $.ajax({
        url: "state.php",
        type: "POST",
        data: { BeneficiaryCountryId : BeneficiaryCountryId},

        success: function(data, status, xhr) {

          
                $('#BeneficiaryStateId').html(data);
         
            
        },
        error: function() {
           // $('#records_content').fadeIn(3000).html('<div class="text-center">error here</div>');
        },
        beforeSend: function() {
           // $('#records_content').fadeOut(700).html('<div class="text-center">Loading...</div>');
        },
        complete: function() {
         
        }
    });
	
	
	
});
	 
	
   $('#add').click(function() {
    var action_type = $('#action_type').val();
    var BeneficiaryBranchId = $("#BeneficiaryBranchId").val();
	//alert(BeneficiaryApplicaitonTypeId);


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
	
	
	
    var projectname = $("#projectname").val();
    var ProjectBudget = $("#ProjectBudget").val();
    var ProjectDetails = $("#ProjectDetails").val();
    var ProjectLink1 = $("#ProjectLink1").val();
    var ProjectResponsiblePerson = $("#ProjectResponsiblePerson").val();
	
	
	
	
	
//	alert('ddd');


    $.ajax({
        url: "add.php",
        type: "POST",
        data: {name:name,occupation:occupation,phone1:phone1,email:email,country:country,BeneficiaryStateId:BeneficiaryStateId,landmark:landmark,action_type:action_type,BeneficiaryBranchId:BeneficiaryBranchId,address:address,BeneficiaryCityId:BeneficiaryCityId,account_details:account_details,remarks:remarks,projectname:projectname,ProjectBudget:ProjectBudget,ProjectDetails:ProjectDetails,ProjectLink1:ProjectLink1,ProjectResponsiblePerson:ProjectResponsiblePerson},
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
	


