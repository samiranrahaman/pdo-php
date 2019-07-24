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
					<h3 class="box-title">View/ Assign Executive</h3>
				</div>
<?php
$id = $_GET['id'];
$result = $db->getRows('beneficiarydetail',array('where'=>array('BeneficiaryDetailId'=>$id),'return_type'=>'single'));
if(!empty($result)){ 
?>
<!--<form id="user_form" method="post" enctype="multipart/form-data">-->  
        <div class="row"  style="margin-right: 74px;">
            <div class="col-md-12">
				<div id="link-update" >
                </div>
            
                <div id="link-add" >
 

				<div class="form-group col-lg-2">
				 <label>Branch Name</label>
				</div>
				<div class="form-group col-lg-10">
						
                        
                        <select class="form-control select2" id="BeneficiaryBranchId" name="BeneficiaryBranchId" style="width: 100%;"  required disabled >
                        <?php
						$BeneficiaryBranchId = $result['BeneficiaryBranchId'];
  $BranchName_vew = $db->getRows('BranchLocation',array('where'=>array('BranchId'=>$BeneficiaryBranchId),'return_type'=>'single'));	
$BranchName = $BranchName_vew['BranchName'];
			
						
						
						 echo '<option value="'.$result['BeneficiaryBranchId'].'">'.$BranchName.'</option>';
                              
                                if(!empty($BranchName)){ foreach($BranchName as $res){
                                                       echo "<option value='".$res['BranchId']."'>".$res['BranchName']."</option>";

                                }}
                                else{
                                    echo '<option vaue="">No Branch</option>';
                                }
                        ?>
                        </select>
				</div>
				<div class="form-group col-lg-2">
				<label>Beneficiary Name</label>
				</div>
				<div class="form-group col-lg-10">
					   
                        <input type="text"  name="BeneficiaryName" id="BeneficiaryName" placeholder="" class="form-control" value="<?php echo $result['BeneficiaryName'] ?>" required disabled />
						
						
                        <input type="hidden"  name="BeneficiaryDetailId" id="BeneficiaryDetailId" placeholder="" class="form-control" value="<?php echo $result['BeneficiaryDetailId'] ?>" required disabled />
				</div>
				<div class="form-group col-lg-2">
			<label>Occupation <?php echo $result['BeneficiaryOccupation'] ?></label>
				</div>
				<div class="form-group col-lg-10">
						  
                          <input type="text"  name="BeneficiaryOccupation" id="BeneficiaryOccupation" class="form-control" value="<?php echo $result['BeneficiaryOccupation'] ?>" required disabled />
                      
				</div>

			<div class="col-md-12">  	
				<!-- -->
				
				<div class="form-group col-lg-9">
						   <label>Phone Number</label>
                        <input type="text"  name="BeneficiaryPhoneNo1" id="BeneficiaryPhoneNo1" placeholder="" class="form-control" value="<?php echo $result['BeneficiaryPhoneNo1'] ?>" disabled required />
				</div>
				<div class="form-group col-lg-9">
						   <label>ID Proof Type</label>
						 <select class="form-control select2" id="BeneficiaryIdProofTypeId" name="BeneficiaryIdProofTypeId" style="width: 100%;" disabled  required >
                        <?php
						
						      echo '<option value="'.$result['BeneficiaryIdProofTypeId'].'">'.$result['BeneficiaryIdProofTypeId'].'</option>';
                                if(!empty($IdProofType)){ foreach($IdProofType as $res){
                                                       echo "<option value='".$res['IdProofTypeId']."'>".$res['IdProofTypeName']."</option>";

                                }}
                                else{
                                    echo '<option vaue="">No Id Proof Type</option>';
                                }
                        ?>
                        </select>
                       
				</div>
				<div class="form-group col-lg-9">
						   <label>Id Proof File</label>
						   
                        <input type="file" onchange="showMyImage(this,'preview')" name="EmployeeImageUrl" id="EmployeeImageUrl" class="form-control" required disabled />
                      <!-- <img id="preview" style="width:10%" src="../../../resources/images/BranchImages/noimage.png" />--> 
                     
				</div>
				<div class="form-group col-lg-3">
				 <img id="upreview" class="img-thumbnail" style="width:30%" src="<?php echo $result['BeneficiaryIdProofDoccumentImageUrl1'] ?>" />
				
				
				  <img id="preview" style="width:25%" src="../../../resources/images/BranchImages/noimage.png" /> 
				</div>
				<!-- -->
			</div>
		
				<div class="form-group col-lg-9">
				 <label>ID Proof Number</label>
                        <input type="text"  name="BeneficiaryIdProofTypeId" id="BeneficiaryIdProofTypeId" placeholder="" class="form-control" value="<?php echo $result['BeneficiaryIdProofTypeId'] ?>" required disabled />
                     
				</div>
				
				<div class="form-group col-lg-9">
				 <label>Problem</label>
                        
                       <input type="text"  name="BeneficiaryProblem" id="BeneficiaryProblem" placeholder="" class="form-control" value="<?php echo $result['BeneficiaryProblem'] ?>" required disabled />
				
				</div>
				
				<div class="form-group col-lg-9">
				    <label>Problem Document 1</label>
                        <input type="file"  name="BeneficiaryProblemDoccumentImageUrl1" id="BeneficiaryProblemDoccumentImageUrl1" placeholder="" class="form-control" disabled />
		
				
				</div>
				<div class="form-group col-lg-3">
				 <img id="upreview" class="img-thumbnail" style="width:30%" src="<?php echo $result['BeneficiaryProblemDoccumentImageUrl1'] ?>" disabled />

				</div> 				
				<div class="form-group col-lg-9">
				       <label>Problem Document 2</label>
                        <input type="file"  name="BeneficiaryProblemDoccumentImageUrl2" id="BeneficiaryProblemDoccumentImageUrl2" placeholder="" class="form-control"/>

				</div>
				<div class="form-group col-lg-3">
				 <img id="ProblemDocument2" class="img-thumbnail" style="width:30%" src="<?php echo $result['BeneficiaryProblemDoccumentImageUrl2'] ?>" />

				<!-- -->
			</div>
		
				<div class="form-group col-lg-9">
				
					 <label>Problem Document 3
						
						 </label>
                      <input type="file"  name="BeneficiaryProblemDoccumentImageUrl3" id="BeneficiaryProblemDoccumentImageUrl3" placeholder="" class="form-control" disabled />

				
				</div>
				<div class="form-group col-lg-3">
				 <img id="ProblemDocument3" class="img-thumbnail" style="width:30%" src="<?php echo $result['BeneficiaryProblemDoccumentImageUrl3'] ?>" />

				</div> 	
				<div class="form-group col-lg-9">
					<label>Income</label>
                        <input type="text"  name="BeneficiaryMonthlyIncome" id="BeneficiaryMonthlyIncome" placeholder=" " class="form-control" value="<?php echo $result['BeneficiaryMonthlyIncome'] ?>"  required disabled />
				
				</div>
				<div class="form-group col-lg-9">
						<label>Expences</label>
                        <input type="text"  name="BeneficiaryMonthlyExpences" id="BeneficiaryMonthlyExpences" placeholder=" " class="form-control" value="<?php echo $result['BeneficiaryMonthlyExpences'] ?>"  required disabled />
				
				</div>
				<div class="form-group col-lg-9">
						<label>Address</label>
                        <input type="text"  name="BeneficiaryAddress" id="BeneficiaryAddress" placeholder=" " class="form-control" value="<?php echo $result['BeneficiaryAddress'] ?>" required disabled />
				
				</div>

		
				<!-- -->
				<div class="form-group col-lg-9">
					<label>City</label>
<select class="form-control select2" id="BeneficiaryCityId" name="BeneficiaryCityId" style="width: 100%;" disabled>
<?php

	
	$BeneficiaryCityId = $result['BeneficiaryCityId'];
    $cityresult = $db->getRows('city',array('where'=>array('CityId'=>$BeneficiaryCityId),'return_type'=>'single'));

  echo '<option value="'.$result['BeneficiaryCityId'].'">'.$cityresult['CityName'].'</option>';
		echo '<option vaue="">Select City</option>';
		if(!empty($cty)){ foreach($cty as $res){
							   echo "<option value='".$res['CityId']."'>".$res['CityName']."</option>";

		}}
		else{
			echo '<option vaue="">No Member Type</option>';
		}
?>
</select>
	

				</div>
				<div class="form-group col-lg-9">
					 <label>State</label>

<select class="form-control select2" id="BeneficiaryStateId" name="BeneficiaryStateId" style="width: 100%;" disabled >
<?php
$BeneficiaryStateId = $result['BeneficiaryStateId'];
$stateresult = $db->getRows('state',array('where'=>array('StateId'=>$BeneficiaryStateId),'return_type'=>'single'));



 echo '<option value="'.$result['BeneficiaryStateId'].'">'.$stateresult['StateName'].'</option>';
		if(!empty($state)){ foreach($state as $res){
							   echo "<option value='".$res['StateId']."'>".$res['StateName']."</option>";

		}}
		else{
			echo '<option vaue="">No Member Type</option>';
		}
?>
</select>		


				</div>
				<div class="form-group col-lg-9">
							 <label>Country</label>
                       
<select class="form-control select2" id="BeneficiaryCountryId" name="BeneficiaryCountryId" style="width: 100%;" disabled>
<?php
$BeneficiaryCountryId = $result['BeneficiaryCountryId'];

$countryresult = $db->getRows('country',array('where'=>array('CountryId'=>$BeneficiaryCountryId),'return_type'=>'single'));


 echo '<option value="'.$result['BeneficiaryCountryId'].'">'.$countryresult['CountryName'].'</option>';

		if(!empty($country)){ foreach($country as $res){
							   echo "<option value='".$res['CountryId']."'>".$res['CountryName']."</option>";

		}}
		else{
			echo '<option vaue="">No Member Type</option>';
		}
?>
</select>							
						
				</div>
				<div class="form-group col-lg-9">
					   <label>Langmark</label>
                        <input type="text"  name="BeneficiaryLandmark" id="BeneficiaryLandmark" placeholder=" " class="form-control" value="<?php echo $result['BeneficiaryLandmark'] ?>" required disabled />
				</div>


				
				<div class="form-group col-lg-9">
					 <label>Remarks</label>
                        <input type="text"  name="BeneficiaryRemarks" id="BeneficiaryRemarks" placeholder=" " class="form-control" value="<?php echo $result['BeneficiaryRemarks'];?>" required disabled />
				</div>

				<div class="form-group col-lg-9">
<!-- -->
<div class="application_aid">
								

									<div class="clearfix"></div>
									<div class="row" style="border-bottom: 2px solid silver; ">
										<h3 class="col-sm-12 sub2-heading" style="font-size: 16; color: green; margin-bottom: 5px;">
										Managers Application 
										</h3>
									</div>     
									<br>
									<!-- Update on 06-05-2018 --->

									<!---->

									<div class="form-group col-sm-12">
										<label for="TypeofPayment" class="col-sm-3 control-label">AID Status</label>
										<div class="col-sm-9">   
											<label class="radio-inline">
												<input type="radio" name="beneficary_app_status" id="approved" class="ben_type" value="Approved"> Approved
											</label>
											<label class="radio-inline">
												<input type="radio" name="beneficary_app_status" class="ben_type" value="Rejected"> Rejected
											</label>  
											<label class="radio-inline">
												<input type="radio" name="beneficary_app_status" class="ben_type" value="Pending"> Pending
											</label>

										</div>
									</div>   

									<div class="form-group  data-hide col-sm-12" id="type_of_payment_div">
										<label for="TypeofPayment" class="col-sm-3 control-label">Service Type</label>

										<div class="col-sm-9">   
											<label class="radio-inline">
												<input type="radio" name="type_of_payment" class="type_of_payment" value="aid"> Aid
											</label>
											<label class="radio-inline">
												<input type="radio" name="type_of_payment" class="type_of_payment" value="pension"> Pension
											</label>  

										</div>
									</div>   
                          
									<div class="form-group col-sm-12   data-hide" id="pension_type_div">
										<label for="TypeofPayment" class="col-sm-3 control-label">Pension Type </label>

										<div class="col-sm-9">   
											<label class="radio-inline"> 
												<input type="radio" name="pension_charge_type" class="pension_charge_type" value="monthly"> Monthly
											</label>
											<label class="radio-inline">
												<input type="radio" name="pension_charge_type" class="pension_charge_type"  value="quarterly"> Quarterly
											</label>  

										</div>
									</div>  

									<div class="form-group col-sm-12 data-hide" id="date_range_div">
										<label for="TypeofPayment" class="col-sm-3 control-label">Star From </label>

										<div class="col-sm-9">   
											<label class="radio-inline">                
												<input type="date" name="pension_star_date" id="pension_star_date" class="form-control" value="1970-01-01">
											</label>
										</div>
										<label for="TypeofPayment" class="col-sm-3 control-label">End To </label>
										<div class="col-sm-9">   
											<label class="radio-inline">
												<input type="date" name="pension_end_date" id="pension_end_date" class="form-control" value="1970-01-01">
											</label>  
										</div>                                   
									</div>                                             




									<div class="form-group col-sm-12">
										<label for="TypeofPayment" class="col-sm-3 control-label">Sanctioned Amount</label>
										<div class="col-sm-9">   
											<label class="radio-inline">                
												<input type="number" name="sanctioned_amount" id="sanctioned_amount" class="form-control" value=""> 
											</label>


										</div>
									</div>  

									<div class="form-group col-sm-12">
										<label for="TypeofPayment" class="col-sm-3 control-label"> As per Sponsored</label>
										<div class="col-sm-9">   
											<label class="radio-inline">                
												<input type="checkbox" name="as_per_sponsored" id="as_per_sponsored" value="1"> 
											</label> 


										</div>
									</div>  

									<div class="form-group col-sm-12">
										<label for="TypeofPayment" class="col-sm-3 control-label"> Share Benefeciary</label>
										<div class="col-sm-9">   
											<label class="radio-inline">                
												<input type="checkbox" name="data_can_share" id="data_can_share" value="1"> 
											</label>


										</div>
									</div>  

									<div class="form-group col-sm-12">
										<label for="Expenses" class="col-sm-3 control-label">Remarks</label>
										<div class="col-sm-9">
											<textarea name="remarks" id="remarks" class="form-control">626030967541</textarea>
										</div>
									</div> 

</div>


<!-- -->


				
				</div>
				
				<div class="form-group col-lg-9">
				
     <input type="text" id='action_type' name="action_type" value="add" hidden/> 
                        <button type="button" class="btn btn-primary" id="add" name="add" style="margin-top: 20px">Submit</button>

<a href="<?php echo $GLOBALS['basepath'];?>modules/BeneficiaryManagement/BeneficiaryDetails/index"
		class="btn btn-primary" style="text-align:right; margin-top: 20px;">
		Cancel</a>



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
		$(document).ready(function() {
$("#type_of_payment_div").hide();
				$(".ben_type").on("click",function(){

						var type = $(this).val();

						if(type=='Approved'){

							$("#type_of_payment_div").show();
						}
						else{
							$("#type_of_payment_div").hide();
							$("#pension_type_div").hide();
							$("#date_range_div").hide();

						}

					}); 

				$(".type_of_payment").on("click",function(){

						var type = $(this).val();

						if(type=='pension'){

							$("#pension_type_div").show();
							$("#date_range_div").show();
						}
						else{
							$("#pension_type_div").hide();
							$("#date_range_div").hide();

						}

					});   
			});
	</script>
<script>

$(function() {
	$("#chartytype").html('Charitable Fund Type');
	$("#religiousfundtype").hide();	
	
	
	
	
	   $('#add').click(function() 
	   {
		   
		   
    var action_type = $('#action_type').val();
    var BeneficiaryDetailId = $('#BeneficiaryDetailId').val();
   // var BeneficiaryApplicaitonTypeId = $("#BeneficiaryApplicaitonTypeId:checked").val();
	//alert(BeneficiaryApplicaitonTypeId);
    //var ben_related_to = $(".ben_related_to:checked").val();
	
	
    var ben_type = $(".ben_type:checked").val();
    var type_of_payment = $(".type_of_payment:checked").val();
    var pension_charge_type = $(".pension_charge_type:checked").val();
	
	
    var pension_star_date = $("#pension_star_date").val();
    var pension_end_date = $("#pension_end_date").val();
    var sanctioned_amount = $("#sanctioned_amount").val();
    var as_per_sponsored = $("#as_per_sponsored:checked").val();
    var data_can_share = $("#data_can_share:checked").val();
    var remarks = $("#remarks").val();

	          

    $.ajax({
        url: "actionupdate_data.php",
        type: "POST",
        data: {ben_type:ben_type,type_of_payment:type_of_payment,pension_charge_type:pension_charge_type,pension_star_date:pension_star_date,pension_end_date:pension_end_date,sanctioned_amount:sanctioned_amount,as_per_sponsored:as_per_sponsored,data_can_share:data_can_share,remarks:remarks,BeneficiaryDetailId:BeneficiaryDetailId,action_type:action_type},
        //processData: false,
        //contentType: false,,
		//
		
		
        success: function(data, status, xhr) {
           // alert(data);
           // $('#BranchName').val('');
          // $('#EmployeeName').val('');
           // $("#BranchRoleId option:selected").val('');
           
           // $('#preview').attr('src');
            //alert(data);
           if(data == 'success'){
			   
			 //  alert('Successfully');

           }else{
            // alert('Error');
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
	
<script type="text/javascript">
    


function showMyImage(fileInput,id) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            }           
            var img=document.getElementById(""+id);            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }
    </script>

