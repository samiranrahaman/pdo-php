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
?>
<style>
.content {
    min-height: 250px;
  
   
}
.h3 {
	font-size: 15px;
}
</style>
 <div class="container-fluid" style="padding: 0px; margin: 0px;">
        <div class="row">
            <h3 class="text-center"></h3>
        </div>
    </div>
    <div class="container">
<div class="box box-warning" style="border-top:3px solid #3c8dbc">
				<div class="box-header with-border">
					<h3 class="box-title">Donors Management </h3>
				</div>		
        <div class="row"  style="margin-right: 74px;">
            <div class="col-md-12">
				<div id="link-update" >
                </div>
                <div class="pull-right">
                    <button class="btn btn-success" id="show-add">Add New Donor</button>
                </div>
            
                <div id="link-add" >
            <div class="col-md-12">  
                <div class="form-group col-lg-3">
						<label>Donor Name</label>
                        <input type="text"  name="DonorName" id="DonorName" placeholder="Donor Name" class="form-control" required />
				</div>
				<div class="form-group col-lg-3">
                        <label>Role Type</label>
                        
                        <select class="form-control select2" id="RoleId" style="width: 100%;">
                        <?php
                                echo '<option vaue="">Select Role</option>';
                                if(!empty($RoleName)){ foreach($RoleName as $res){
                                                       echo "<option value='".$res['RoleId']."'>".$res['RoleName']."</option>";

                                }}
                                else{
                                    echo '<option vaue="">No Role</option>';
                                }
                        ?>
                        </select>
				</div>
				<div class="form-group col-lg-3">
					 <label>	Donor Member Type</label>
                        
                        <select class="form-control select2" id="DonorMemberType" style="width: 100%;">
                        <?php
                                echo '<option vaue="">Select Member Type</option>';
                                if(!empty($MemberTypeName)){ foreach($MemberTypeName as $res){
                                                       echo "<option value='".$res['MemberTypeId']."'>".$res['MemberTypeName']."</option>";

                                }}
                                else{
                                    echo '<option vaue="">No Member Type</option>';
                                }
                        ?>
                        </select>
				</div>
				<div class="form-group col-lg-3">
						 <label>Branch Name</label>
                        
                        <select class="form-control select2" id="BranchId" style="width: 100%;">
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
			<div class="col-md-12">  	
				<!-- -->
				<div class="form-group col-lg-3">
					   <label>Age</label>
                        <input type="number"  name="DonorAge" id="DonorAge" placeholder="Age" class="form-control" required />
				</div>
				
				<div class="form-group col-lg-3">
						  <label>Id Proof Type</label>
                        
                        <select class="form-control select2" id="DonorIdProofType" style="width: 100%;">
                        <?php
                                echo '<option vaue="">Select Id Proof Type</option>';
                                if(!empty($IdProofType)){ foreach($IdProofType as $res){
                                                       echo "<option value='".$res['IdProofTypeId']."'>".$res['IdProofTypeName']."</option>";

                                }}
                                else{
                                    echo '<option vaue="">No Id Proof Type</option>';
                                }
                        ?>
                        </select>
				</div>
				<div class="form-group col-lg-3">
						   <label>Id Proof Number</label>
                        <input type="text"  name="DonorIdProofNumber" id="DonorIdProofNumber" placeholder="Id Proof Number" class="form-control" required />
				</div>
				<div class="form-group col-lg-3">
						   <label>Id Proof Doccument Image</label>
                        <input type="file" onchange="showMyImage(this,'preview')" name="DonorIdProofDoccumentImageUrl" id="DonorIdProofDoccumentImageUrl" class="form-control" required />
                      <!-- <img id="preview" style="width:10%" src="../../../resources/images/BranchImages/noimage.png" />--> 
                       <img id="preview" style="width:10%" src="../../../resources/images/BranchImages/noimage.png" /> 
				</div>
				<!-- -->
			</div>
			<div class="col-md-12">  		
				<div class="form-group col-lg-3">
				 <label>Profession</label>
                        <input type="text"  name="DonorProfession" id="DonorProfession" placeholder="Profession" class="form-control" required />
                        
                        </select>
				
				</div>
				
				<div class="form-group col-lg-3">
				 <label>Religion</label>
                        
                        <select class="form-control select2" id="DonorReligion" style="width: 100%;">
                        <?php
                                echo '<option vaue="">Select Religion</option>';
                                if(!empty($Religion)){ foreach($Religion as $res){
                                                       echo "<option value='".$res['ReligionId']."'>".$res['ReligionName']."</option>";

                                }}
                                else{
                                    echo '<option vaue="">No Religion</option>';
                                }
                        ?>
                        </select>
				
				</div>
				
				<div class="form-group col-lg-3">
				    <label>Occupation</label>
                        <input type="text"  name="DonorOccupation" id="DonorOccupation" placeholder="Occupation" class="form-control" required />
				
				</div>
				
				<div class="form-group col-lg-3">
				       <label>Share Location</label>
                        <input type="text"  name="DonorShareLocation" id="DonorShareLocation" placeholder="Share Location" class="form-control" required />
				
				</div>
				
				<!-- -->
			</div>
			<div class="col-md-12">  		
				<div class="form-group col-lg-3">
				
					 <label>Verify PAN 
						 <input type="checkbox" name="verifycheck" id="verifycheck"/> 
						 </label>
                        <input type="text"  name="IsPanVerified" id="IsPanVerified" placeholder=" " class="form-control" required />
				
				</div>
				<div class="form-group col-lg-3">
					<label>Phone 1</label>
                        <input type="text"  name="DonorPhoneNo1" id="DonorPhoneNo1" placeholder=" " class="form-control" required />
				
				</div>
				<div class="form-group col-lg-3">
						<label>Phone 2</label>
                        <input type="text"  name="DonorPhoneNo2" id="DonorPhoneNo2" placeholder=" " class="form-control" required />
				
				</div>
				<div class="form-group col-lg-3">
						<label>Phone 3</label>
                        <input type="text"  name="DonorPhoneNo3" id="DonorPhoneNo3" placeholder=" " class="form-control" required />
				
				</div>
			</div>
			<div class="col-md-12">  		
				<!-- -->
				<div class="form-group col-lg-3">
					<label>Phone 4</label>
                        <input type="text"  name="DonorPhoneNo4" id="DonorPhoneNo4" placeholder=" " class="form-control" required />
				</div>
				<div class="form-group col-lg-3">
					 <label>Email Address</label>
                        <input type="text"  name="emailaddress" id="emailaddress" placeholder=" " class="form-control" required />
				</div>
				<div class="form-group col-lg-3">
							 <label>Password</label>
                        <input type="password"  name="txtpassword" id="txtpassword" placeholder=" " class="form-control" required />
						
				</div>
				<div class="form-group col-lg-3">
					   <label>Address</label>
                        <textarea class="form-control" id="DonorAddress"></textarea>
				</div>
			</div>
			<div class="col-md-12">  		
				
				
				<!-- -->
				<div class="form-group col-lg-3">

				<label>Country</label>

				<select class="form-control select2" id="DonorCountryId" name="DonorCountryId" style="width: 100%;">
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
				<div class="form-group col-lg-3">
						 <label>State</label>
						 <div id="stateview"></div>

<select class="form-control select2" id="DonorStateId" name="DonorStateId" style="width: 100%;">
	<option value="">No State</option>

</select>
				</div>				
				<div class="form-group col-lg-3">
					 <label>City</label>

<select class="form-control select2" id="DonorCityId" name="DonorCityId" style="width: 100%;">
	<option value="">No City</option>

</select>
				</div>


				<div class="form-group col-lg-3">
							 <label>Langmark</label>
                        <input type="text"  name="DonorLandmark" id="DonorLandmark" placeholder=" " class="form-control" required />
				</div>
			</div> <!-- col-md-12 -->
			
			
			<div class="col-md-12" style="border-bottom: 2px solid silver">
				<h3 style="font-size: 16px; color:green;">Amount Donation <input type="checkbox" name="amountdonation" id="amountdonation"  value=""/>	</h3>
			
			
			</div>
			<div class="col-md-12 fromamountdonaton" style="border: 2px solid white;">
					<div class="form-group col-lg-6">		
						<label>Donation Type</label>
						</br>
                      
						
                        <input type="radio" name="DonorDonationType" id="DonorDonationType" value="1 month"/> 1 month
						 <input type="radio" name="DonorDonationType" id="DonorDonationType" value="2 month"/> 2 month 
						 <input type="radio" name="DonorDonationType" id="DonorDonationType" value="3 month"/> 3 month
						
						 
					</div>
					<div class="form-group col-lg-6">	
							<label>Date of Collection</label>
							</br>
                        <input type="checkbox" name="d1" id="d1" value="0"/> 1st week
						<input type="hidden" name="DateofCollectionForFirstWeek" id="DateofCollectionForFirstWeek" value=""/>
						
						 <input type="checkbox" name="d2" id="d2"  value="0"/> 2nd week 
						 <input type="hidden" name="DateofCollectionForSecondWeek" id="DateofCollectionForSecondWeek" value=""/>
						 <input type="checkbox" name="d3" id="d3"  value="0"/> 3rd week 
						 <input type="hidden" name="DateofCollectionForThirdWeek" id="DateofCollectionForThirdWeek" value=""/>
					</div>
			</div>
		
			<div class="col-md-12 fromamountdonaton" style="border: 2px solid white;">
				<div class="form-group col-lg-12">
				<label><h3 style="font-size: 16px">Day of Collection</h3></label>
				</br>
				<input type="checkbox" name="Dday1" id="Dday1" value="0"/> Sunday 
				<input type="hidden" name="DayofCollectionForSunday" id="DayofCollectionForSunday" value="0"/>
				
				<input type="checkbox" name="Dday2" id="Dday2"  value="0"/> Monday 
				<input type="hidden" name="DayofCollectionForMonday" id="DayofCollectionForMonday" value="0"/>
				
				<input type="checkbox" name="Dday3" id="Dday3"  value="0"/> Tuesday
<input type="hidden" name="DayofCollectionForTuesday" id="DayofCollectionForTuesday" value="0"/>	
			
				<input type="checkbox" name="Dday4" id="Dday4"  value="0"/> Wednesday 
				<input type="hidden" name="DayofCollectionForWednesday" id="DayofCollectionForWednesday" value="0"/>	
				
				<input type="checkbox" name="Dday5" id="Dday5"  value="0"/> thursday
				<input type="hidden" name="DayofCollectionForThursday" id="DayofCollectionForThursday" value="0"/>	
				
				
				<input type="checkbox" name="Dday6" id="Dday6"  value="0"/> Friday
				<input type="hidden" name="DayofCollectionForFriday" id="DayofCollectionForFriday" value="0"/>	
				
				
				<input type="checkbox" name="Dday7" id="Dday7"  value="0"/> Saturday
				<input type="hidden" name="DayofCollectionForSaturday" id="DayofCollectionForSaturday" value="0"/>	
				</div>
				<div class="form-group col-lg-6">
						<label>Collection Type</label>
						</br>
                        <input type="radio" name="CollectionType" id="CollectionType" value="Collection Location"/> Collection Location
						 <input type="radio" name="CollectionType" id="CollectionType"  value="payonline"/> Pay Online 
				</div>
				<div class="form-group col-lg-6">
					<label>Collection Time</label>
							</br>
                        <input type="text" name="CollectionTime" id="CollectionTime" class="form-control" value=""/> 
				</div>
				
			</div>
				<!-- -->
			<div class="col-md-12" style="border-bottom: 2px solid silver">
				<h3 style="font-size: 16px; color:green;">Blood Donation <input type="checkbox" name="blooddonate" id="blooddonate"  value=""/> </h3>
			</div>
			
		
			
			
			<div class="col-md-12 blooddonateform" style="border: 2px solid white;">
				<div id="blooddonate_from">
					<div class="form-group col-lg-3">
					
						<label>Health Status</label>
						<input type="text" name="DonorHealthStatus" id="DonorHealthStatus" class="form-control" value=""/> 





					</div>	
					<div class="form-group col-lg-3">
						<label>Time From to To</label>
						<input type="text" name="DonorBloodDontionTime" id="DonorBloodDontionTime" class="form-control" value=""/> 
					</div>
					<div class="form-group col-lg-3">
							<label>Blood Group</label>
							
							<select name="DonorBloodGroup" id="DonorBloodGroup" class="form-control">
<option value="">Select One </option>
<option value="A+">A+</option>
<option value="A+">A-</option>

<option value="B+">B+</option>
<option value="B-">B-</option>

<option value="AB+">AB+</option>
<option value="AB-">AB-</option>
<option value="O+">O+</option>
<option value="O-">O-</option>

							</select>
					</div>	
					</div>					
			</div>
			<div class="col-md-12 blooddonateform" style="border: 0px solid white;">
				<div class="form-group col-lg-12">
				<label ><h3 style="font-size: 16px">Day of Collection</h3></label>
				</br>
				
				
				
				<input type="checkbox" name="BC1" id="BC1" value="0"/> Sunday 
				<input type="hidden" name="BloodCollectionOnSunday" id="BloodCollectionOnSunday" value="0"/>
				
				

				<input type="checkbox" name="BC2" id="BC2"  value=""/> Monday 
					<input type="hidden" name="BloodCollectionOnMonday" id="BloodCollectionOnMonday" value="0"/>
					
					
					
				<input type="checkbox" name="BC3" id="BC3"  value=""/> Tuesday 
					<input type="hidden" name="BloodCollectionOnTuesday" id="BloodCollectionOnTuesday" value="0"/>
					
					
				<input type="checkbox" name="BC4" id="BC4"  value=""/> Wednesday 
					<input type="hidden" name="BloodCollectionOnWednesday" id="BloodCollectionOnWednesday" value="0"/>
					
					
				<input type="checkbox" name="BC5" id="BC5"  value=""/> thursday
					<input type="hidden" name="BloodCollectionOnThursday" id="BloodCollectionOnThursday" value="0"/>
					
					
				<input type="checkbox" name="BC6" id="BC6"  value=""/> Friday
					<input type="hidden" name="BloodCollectionOnFriday" id="BloodCollectionOnFriday" value="0"/>
					
					
				<input type="checkbox" name="BC7" id="BC7"  value=""/> Saturday
					<input type="hidden" name="BloodCollectionOnSaturday" id="BloodCollectionOnSaturday" value="0"/>
					
					
				</div>
			</div>

			<div class="col-md-12 blooddonateform" >
				<h3  style="font-size: 16px">KDF Khuddamadine Fund</h3>
			</div>
			<div class="col-md-12 blooddonateform" style="border: 2px solid white;">
					<div class="form-group col-lg-6">		
					
                       	<input type="checkbox" name="KDF1" id="KDF1" value="0"/> Eligble for Loan
						<input type="hidden" name="DonorEleigibleForLoan" class="form-control" id="DonorEleigibleForLoan" value="0"/> 
					</div>
					<div class="form-group col-lg-6">	
						<input type="checkbox" name="KDF2" id="KDF2"  value="0"/> Eligble for Medical Sponsorship 
						<input type="hidden" name="DonorEligibleForMedicalSponsorShip" class="form-control" id="DonorEligibleForMedicalSponsorShip" value="0"/> 
						
					</div>
			</div>
		
				<div class="col-md-12" style="border-bottom: 2px solid silver">
				<h3 style="font-size: 16px; color:green;">Alert <input type="checkbox" name="alertcheckbox" id="alertcheckbox"  value=""/>	</h3>
			
			
			</div>	
			<div class="col-md-12 alertcheckboxfrom">
					<div class="form-group col-lg-3">
<label>Receive Alert from SAFA</label>
</br>
<input type="checkbox" name="SAFA1" id="SAFA1" value="0"/> Call
<input type="hidden" name="AlertCall" class="form-control" id="AlertCall" value="0"/> 
<input type="checkbox" name="SAFA2" id="SAFA2"  value="0"/> SMS
<input type="hidden" name="AlertSMS" class="form-control" id="AlertSMS" value="0"/> 

<input type="checkbox" name="SAFA3" id="SAFA3"  value="0"/> Email	
<input type="hidden" name="AlertEmail" class="form-control" id="AlertEmail" value="0"/> 
				
					</div>	
					<div class="form-group col-lg-3">
<label>WhatApp Alert</label>
</br>
<input type="checkbox" name="wgroup" id="wgroup" value="0"/> Group

<input type="hidden" name="WhatAppGroup" class="form-control" id="WhatAppGroup" value="0"/> 

<input type="checkbox" name="whatappGroup2" id="whatappGroup2"  value="0"/> Personalized
<input type="hidden" name="WhatAppPersonalized" class="form-control" id="WhatAppPersonalized" value="0"/> 
					</div>
					<div class="form-group col-lg-6">
<label>Monthly Magazine</label>
</br>
<input type="checkbox" name="SE" id="SE" value="0"/> soft copy email
<input type="hidden" name="softcopyemail" id="softcopyemail" value="0">
<input type="checkbox" name="HC" id="HC"  value="0"/> Hard Copy(Address)	
<input type="hidden" name="hardcopy" id="hardcopy" value="0">
					</div>							
				
			</div>
			<div class="col-md-12 alertcheckboxfrom">
					<div class="form-group col-lg-6">
<label>Want to be a Volunteer </label>
</br>
<input type="radio" name="DonorWantToBeVolounter" id="DonorWantToBeVolounter" value="1"/> Yes</br>
<input type="radio" name="DonorWantToBeVolounter" id="DonorWantToBeVolounter" value="0"/> No</br>						
					</div>
					<div class="form-group col-lg-6">

<label>Volunteer Availability </label>
</br>
<input type="checkbox" name="VA1" id="VA1" value="0"/> Week Days
<input type="hidden" name="DonorVolounteerAvailabilityOnWeekDays" class="form-control" id="DonorVolounteerAvailabilityOnWeekDays" value="0"/> 


<input type="checkbox" name="VA2" id="VA2" value="0"/> Week Ends
<input type="hidden" name="DonorVolounteerAvailabilityOnWeekEnds" class="form-control" id="DonorVolounteerAvailabilityOnWeekEnds" value="0"/> 
					
					</div>
			</div>
				
			<div class="col-md-12 alertcheckboxfrom">
					<div class="form-group col-lg-6">
<label>Volunteer Type </label>
</br>
<input type="checkbox" name="VT1" id="VT1" value="0"/> Proffessional Work
<input type="hidden" name="DonorVolounteerTypeAsProfessionalWork" class="form-control" id="DonorVolounteerTypeAsProfessionalWork" value="0"/> 



<input type="checkbox" name="VT2" id="VT2" value="0"/> Field Work
<input type="hidden" name="DonorVolounteerTypeAsFieldWork" class="form-control" id="DonorVolounteerTypeAsFieldWork" value="0"/> 
					
					</div>
					<div class="form-group col-lg-6">
<label>Want a donation box</label></br>
<input type="radio" name="DonorWantADonaitonBox" id="DonorWantADonaitonBox" value="1"/> Yes
<input type="radio" name="DonorWantADonaitonBox" id="DonorWantADonaitonBox" value="0"/> No		
					</div>
			</div>	
				
			<div class="col-md-12 alertcheckboxfrom">
					<div class="form-group col-lg-3">
<label>Donation Time</label></br>
<input type="checkbox" name="DoTme1" id="DoTme1" value="0"/> 1 Month
<input type="hidden" name="DonaitonTimeOnOneMonth" class="form-control" id="DonaitonTimeOnOneMonth" value="0"/> 


<input type="checkbox" name="DoTme2" id="DoTme2" value="0"/> 2 Month
<input type="hidden" name="DonaitonTimeOnSecondMonth" class="form-control" id="DonaitonTimeOnSecondMonth" value="0"/> 


<input type="checkbox" name="DoTme3" id="DoTme3" value="0"/> 3 Month	
<input type="hidden" name="DonaitonTimeOnThirdMonth" class="form-control" id="DonaitonTimeOnThirdMonth" value="0"/> 				
					</div>
					<div class="form-group col-lg-3">
<label>Donaiton Box Number</label>
<input type="text" name="DonaitonBoxNumber" class="form-control" id="DonaitonBoxNumber" value=" "/> 
					</div>
					<div class="form-group col-lg-3">
<label>Remarks</label>
<input type="text" name="DonorRemarks" id="DonorRemarks" class="form-control" value=" "/> 					
					</div>
			</div>		
			<div class="col-md-12">
  <label>Action</label><br/>
     <input type="text" id='action_type' name="action_type" value="add" hidden/> 
                        <button type="button" class="btn btn-primary" id="add" name="add">Submit</button>
                        <button type="button" href="javascript:void(0);" class="btn btn-default" id="cancel" name="add" onclick="$('#link-add').slideUp(400);$('#show-add').show(600);">Cancel</button>
			</div>			
          
            </div>
        </div>
        </div>
       <div class="row"  style="margin-right: 74px;">
            <div class="col-md-12">
                <div id="records_content"></div>
                <br>
                <div class="col-md-12" id="table_content">
                </div>
            </div>
        </div>
    </div>
    </div>
<?php
        include_once '../../../includes/layouts/footer.php';
?>
    <script type="text/javascript">
    
    $(document).ready(function(){
$('.fromamountdonaton').hide();
$('.blooddonateform').hide();
$('.alertcheckboxfrom').hide();
$.get("view.php", function(data) {
    $("#table_content").html(data);
});


$('#link-add').hide();

$('#show-add').click(function() {
    $('#link-add').slideDown(500);
    $('#show-add').hide();
   
});

$('#d1').change(function() {
	if(d1.checked)
	{
	$('#DateofCollectionForFirstWeek').val('1');
	}
	else{
		$('#DateofCollectionForFirstWeek').val('0');
	}
});

$('#d2').change(function() {
	if(d2.checked)
	{
	$('#DateofCollectionForSecondWeek').val('1');
	}
	else{
		$('#DateofCollectionForSecondWeek').val('0');
	}
});
$('#d3').change(function() {
	if(d3.checked)
	{
	$('#DateofCollectionForThirdWeek').val('1');
	}
	else{
		$('#DateofCollectionForThirdWeek').val('0');
	}
});
//Day collection day
$('#Dday1').change(function() {
	if(Dday1.checked)
	{
	$('#DayofCollectionForSunday').val('1');
	}
	else{
		$('#DayofCollectionForSunday').val('0');
	}
});
$('#Dday2').change(function() {
	if(Dday2.checked)
	{
	$('#DayofCollectionForMonday').val('1');
	}
	else{
		$('#DayofCollectionForMonday').val('0');
	}
});
$('#Dday3').change(function() {
	if(Dday3.checked)
	{
	$('#DayofCollectionForTuesday').val('1');
	}
	else{
		$('#DayofCollectionForTuesday').val('0');
	}
});
$('#Dday4').change(function() {
	if(Dday4.checked)
	{
	$('#DayofCollectionForWednesday').val('1');
	}
	else{
		$('#DayofCollectionForWednesday').val('0');
	}
});
$('#Dday5').change(function() {
	if(Dday5.checked)
	{
	$('#DayofCollectionForThursday').val('1');
	}
	else{
		$('#DayofCollectionForThursday').val('0');
	}
});
$('#Dday6').change(function() {
	if(Dday6.checked)
	{
	$('#DayofCollectionForFriday').val('1');
	}
	else{
		$('#DayofCollectionForFriday').val('0');
	}
});
$('#Dday7').change(function() {
	if(Dday7.checked)
	{
	$('#DayofCollectionForSaturday').val('1');
	}
	else{
		$('#DayofCollectionForSaturday').val('0');
	}
});
//end day colecton

// blood collection
$('#BC1').change(function() {
	if(BC1.checked)
	{
	$('#BloodCollectionOnSunday').val('1');
	}
	else{
		$('#BloodCollectionOnSunday').val('0');
	}
});
$('#BC2').change(function() {
	if(BC2.checked)
	{
	$('#BloodCollectionOnMonday').val('1');
	}
	else{
		$('#BloodCollectionOnMonday').val('0');
	}
});
$('#BC3').change(function() {
	if(BC3.checked)
	{
	$('#BloodCollectionOnTuesday').val('1');
	}
	else{
		$('#BloodCollectionOnTuesday').val('0');
	}
});
$('#BC4').change(function() {
	if(BC4.checked)
	{
	$('#BloodCollectionOnWednesday').val('1');
	}
	else{
		$('#BloodCollectionOnWednesday').val('0');
	}
});
$('#BC5').change(function() {
	if(BC5.checked)
	{
	$('#BloodCollectionOnThursday').val('1');
	}
	else{
		$('#BloodCollectionOnThursday').val('0');
	}
});
$('#BC6').change(function() {
	if(BC6.checked)
	{
	$('#BloodCollectionOnFriday').val('1');
	}
	else{
		$('#BloodCollectionOnFriday').val('0');
	}
});
$('#BC7').change(function() {
	if(BC7.checked)
	{
	$('#BloodCollectionOnSaturday').val('1');
	}
	else{
		$('#BloodCollectionOnSaturday').val('0');
	}
});
//end blo
$('#SE').change(function() {
	if(SE.checked)
	{
	$('#softcopyemail').val('1');
	}
	else{
		$('#softcopyemail').val('0');
	}
});
$('#HC').change(function() {
	if(HC.checked)
	{
	$('#hardcopy').val('1');
	}
	else{
		$('#hardcopy').val('0');
	}
});

$('#DoTme1').change(function() {
	if(DoTme1.checked)
	{
	$('#DonaitonTimeOnOneMonth').val('1');
	}
	else{
		$('#DonaitonTimeOnOneMonth').val('0');
	}
});
$('#DoTme2').change(function() {
	if(DoTme2.checked)
	{
	$('#DonaitonTimeOnSecondMonth').val('2');
	}
	else{
		$('#DonaitonTimeOnSecondMonth').val('0');
	}
});
$('#DoTme3').change(function() {
	if(DoTme3.checked)
	{
	$('#DonaitonTimeOnThirdMonth').val('3');
	}
	else{
		$('#DonaitonTimeOnThirdMonth').val('0');
	}
});



$('#VA1').change(function() {
	if(VA1.checked)
	{
	$('#DonorVolounteerAvailabilityOnWeekDays').val('1');
	}
	else{
		$('#DonorVolounteerAvailabilityOnWeekDays').val('0');
	}
});

$('#VA2').change(function() {
	if(VA2.checked)
	{
	$('#DonorVolounteerAvailabilityOnWeekEnds').val('1');
	}
	else{
		$('#DonorVolounteerAvailabilityOnWeekEnds').val('0');
	}
});



$('#VT1').change(function() {
	if(VT1.checked)
	{
	$('#DonorVolounteerTypeAsProfessionalWork').val('1');
	}
	else{
		$('#DonorVolounteerTypeAsProfessionalWork').val('0');
	}
});

$('#VT2').change(function() {
	if(VT2.checked)
	{
	$('#DonorVolounteerTypeAsFieldWork').val('1');
	}
	else{
		$('#DonorVolounteerTypeAsFieldWork').val('0');
	}
});


$('#SAFA1').change(function() {
	if(SAFA1.checked)
	{
	$('#AlertCall').val('1');
	}
	else{
		$('#AlertCall').val('0');
	}
});
$('#SAFA2').change(function() {
	if(SAFA2.checked)
	{
	$('#AlertSMS').val('1');
	}
	else{
		$('#AlertSMS').val('0');
	}
});

$('#SAFA3').change(function() {
	if(SAFA3.checked)
	{
	$('#AlertEmail').val('1');
	}
	else{
		$('#AlertEmail').val('0');
	}
});

$('#wgroup').change(function() {
	//alert('dddd');
	if(wgroup.checked)
	{
		//alert('come');
	$('#WhatAppGroup').val('1');
	}
	else{
		$('#WhatAppGroup').val('0');
	}
});
$('#whatappGroup2').change(function() {
	if(whatappGroup2.checked)
	{
	$('#WhatAppPersonalized').val('1');
	}
	else{
		$('#WhatAppPersonalized').val('0'); //$('#WhatAppGroup').val('1');
	}
});
				
$('#KDF1').change(function() {
	if(KDF1.checked)
	{
	$('#DonorEleigibleForLoan').val('1');
	}
	else{
		$('#DonorEleigibleForLoan').val('0');
	}
});
$('#KDF2').change(function() {
	if(KDF2.checked)
	{
	$('#DonorEligibleForMedicalSponsorShip').val('1');
	}
	else{
		$('#DonorEligibleForMedicalSponsorShip').val('0');
	}
});
//amountdonation	fromamountdonaton
$('#amountdonation').change(function() {
	if(amountdonation.checked)
	{
	$('.fromamountdonaton').show();
	}
	else{
		$('.fromamountdonaton').hide();
	}
});
//blooddonate	blooddonateform 
$('#blooddonate').change(function() {
	if(blooddonate.checked)
	{
	$('.blooddonateform').show();
	}
	else{
		$('.blooddonateform').hide();
	}
});
//alertcheckboxfrom
$('#alertcheckbox').change(function() {
	if(alertcheckbox.checked)
	{
	$('.alertcheckboxfrom').show();
	}
	else{
		$('.alertcheckboxfrom').hide();
	}
});
//DonorCountryId
$('#DonorCountryId').change(function() {
	var DonorCountryId = $('#DonorCountryId').val();
	//alert(DonorCountryId);
	
	 $.ajax({
        url: "state.php",
        type: "POST",
        data: { DonorCountryId : DonorCountryId},

        success: function(data, status, xhr) {

          
                $('#DonorStateId').html(data);
         
            
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

//DonorCountryId



$('#add').click(function() {

    var DonorName = $('#DonorName').val();
    var RoleId = $("#RoleId option:selected").val();
    var DonorMemberType = $("#DonorMemberType option:selected").val();
    var BranchId = $("#BranchId option:selected").val();
    var DonorAge = $('#DonorAge').val();
    var DonorIdProofType = $('#DonorIdProofType').val();
    var DonorIdProofNumber = $('#DonorIdProofNumber').val();
    var DonorProfession = $('#DonorProfession').val();
    var DonorReligion = $('#DonorReligion').val();
    var DonorOccupation = $('#DonorOccupation').val();
    var DonorShareLocation = $('#DonorShareLocation').val();
    var IsPanVerified = $('#IsPanVerified').val();
    var DonorPhoneNo1 = $('#DonorPhoneNo1').val();
    var  DonorPhoneNo2 = $('#DonorPhoneNo2').val();
    var  DonorPhoneNo3 = $('#DonorPhoneNo3').val();
    var  DonorPhoneNo4 = $('#DonorPhoneNo4').val();
    var  DonorCityId = $('#DonorCityId').val();
    var  DonorStateId = $('#DonorStateId').val();
    var  DonorCountryId = $('#DonorCountryId').val();
    var  DonorLandmark = $('#DonorLandmark').val();
    var  DonorAddress = $('#DonorAddress').val();
    //var  DonorDonationType = $('#DonorDonationType').val();
    var  DonorDonationType = $("#DonorDonationType:checked").val();
    var  emailaddress = $("#emailaddress").val();
    var  txtpassword = $("#txtpassword").val();
    var  DonorBloodGroup = $("#DonorBloodGroup").val();
	
    var  DayofCollectionForSunday = $('#DayofCollectionForSunday').val();
    var  DayofCollectionForMonday = $('#DayofCollectionForMonday').val();
    var  DayofCollectionForTuesday = $('#DayofCollectionForTuesday').val();
    var  DayofCollectionForWednesday = $('#DayofCollectionForWednesday').val();
    var  DayofCollectionForThursday = $('#DayofCollectionForThursday').val();
    var  DayofCollectionForFriday = $('#DayofCollectionForFriday').val();
    var  DayofCollectionForSaturday = $('#DayofCollectionForSaturday').val();
	
    var  DonorIdProofNumber = $('#DonorIdProofNumber').val();
    var  CollectionType = $("#CollectionType:checked").val();
    var  CollectionTime = $('#CollectionTime').val();
    var  DonorHealthStatus = $('#DonorHealthStatus').val();
    var  DonorBloodDontionTime = $('#DonorBloodDontionTime').val();
	
	
	
	
    var  BloodCollectionOnSunday = $('#BloodCollectionOnSunday').val();
    var  BloodCollectionOnMonday = $('#BloodCollectionOnMonday').val();
    var  BloodCollectionOnTuesday = $('#BloodCollectionOnTuesday').val();
    var  BloodCollectionOnWednesday = $('#BloodCollectionOnWednesday').val();
    var  BloodCollectionOnThursday = $('#BloodCollectionOnThursday').val();
    var  BloodCollectionOnFriday = $('#BloodCollectionOnFriday').val();
    var  BloodCollectionOnSaturday = $('#BloodCollectionOnSaturday').val();
    var  DonorEleigibleForLoan = $('#DonorEleigibleForLoan').val();
    var  DonorEligibleForMedicalSponsorShip = $('#DonorEligibleForMedicalSponsorShip').val();
    var  DonorWantToBeVolounter = $('#DonorWantToBeVolounter:checked').val();
    var  DonorVolounteerAvailabilityOnWeekDays = $('#DonorVolounteerAvailabilityOnWeekDays').val();
    var  DonorVolounteerAvailabilityOnWeekEnds = $('#DonorVolounteerAvailabilityOnWeekEnds').val();
    var  DonorVolounteerTypeAsProfessionalWork = $('#DonorVolounteerTypeAsProfessionalWork').val();
    var  DonorVolounteerTypeAsFieldWork = $('#DonorVolounteerTypeAsFieldWork').val();
    var  DonorWantADonaitonBox = $('#DonorWantADonaitonBox:checked').val();
    var  DonaitonBoxNumber = $('#DonaitonBoxNumber').val();
    var  DonorRemarks = $('#DonorRemarks').val();
    var  DonaitonTimeOnOneMonth = $('#DonaitonTimeOnOneMonth').val();
    var  DonaitonTimeOnSecondMonth = $('#DonaitonTimeOnSecondMonth').val();
    var  DonaitonTimeOnThirdMonth = $('#DonaitonTimeOnThirdMonth').val();
	
	
    var  hardcopy = $('#hardcopy').val();
    var  softcopyemail = $('#softcopyemail').val();
	
    var  AlertCall = $('#AlertCall').val();
    var  AlertSMS = $('#AlertSMS').val();
    var  AlertEmail = $('#AlertEmail').val();
    var  WhatAppPersonalized = $('#WhatAppPersonalized').val();
    var  WhatAppGroup = $('#WhatAppGroup').val();
	
    var action_type = $('#action_type').val();
    var DonorIdProofDoccumentImageUrl = $('#preview').attr('src');
    //var DonorIdProofDoccumentImageUrl = $('#DonorIdProofDoccumentImageUrl').val();
    
	
	var DateofCollectionForFirstWeek = $('#DateofCollectionForFirstWeek').val();
	var DateofCollectionForSecondWeek = $('#DateofCollectionForSecondWeek').val();
	var DateofCollectionForThirdWeek = $('#DateofCollectionForThirdWeek').val();
	

    $.ajax({
        url: "add.php",
        type: "POST",
        data: { DonorName : DonorName, RoleId : RoleId,DonorMemberType: DonorMemberType,BranchId:BranchId,action_type : action_type, DonorAge : DonorAge, DonorIdProofType:DonorIdProofType, DonorIdProofNumber : DonorIdProofNumber, DonorProfession:DonorProfession,DonorReligion:DonorReligion,DonorOccupation:DonorOccupation,DonorShareLocation:DonorShareLocation,IsPanVerified:IsPanVerified,DonorPhoneNo1:DonorPhoneNo1, DonorPhoneNo2: DonorPhoneNo2,DonorPhoneNo3: DonorPhoneNo3,DonorPhoneNo4:DonorPhoneNo4,DonorAddress:DonorAddress,DonorCityId:DonorCityId,DonorStateId:DonorStateId,DonorCountryId:DonorCountryId,DonorLandmark:DonorLandmark,DonorDonationType:DonorDonationType,DateofCollectionForFirstWeek:DateofCollectionForFirstWeek,DateofCollectionForSecondWeek:DateofCollectionForSecondWeek,DateofCollectionForThirdWeek:DateofCollectionForThirdWeek,DayofCollectionForSunday:DayofCollectionForSunday,DayofCollectionForMonday:DayofCollectionForMonday,DayofCollectionForTuesday:DayofCollectionForTuesday,DayofCollectionForWednesday:DayofCollectionForWednesday,DayofCollectionForThursday:DayofCollectionForThursday,DayofCollectionForFriday:DayofCollectionForFriday,DayofCollectionForSaturday:DayofCollectionForSaturday,DonorIdProofNumber:DonorIdProofNumber,CollectionType:CollectionType,CollectionTime:CollectionTime,DonorHealthStatus:DonorHealthStatus,DonorBloodDontionTime:DonorBloodDontionTime,BloodCollectionOnSunday:BloodCollectionOnSunday,BloodCollectionOnMonday:BloodCollectionOnMonday,BloodCollectionOnTuesday:BloodCollectionOnTuesday,BloodCollectionOnWednesday:BloodCollectionOnWednesday,BloodCollectionOnThursday:BloodCollectionOnThursday,BloodCollectionOnFriday:BloodCollectionOnFriday,BloodCollectionOnSaturday:BloodCollectionOnSaturday,DonorEleigibleForLoan:DonorEleigibleForLoan,DonorEligibleForMedicalSponsorShip:DonorEligibleForMedicalSponsorShip,DonorWantToBeVolounter:DonorWantToBeVolounter,DonorVolounteerAvailabilityOnWeekDays:DonorVolounteerAvailabilityOnWeekDays,DonorVolounteerAvailabilityOnWeekEnds:DonorVolounteerAvailabilityOnWeekEnds,DonorVolounteerTypeAsProfessionalWork:DonorVolounteerTypeAsProfessionalWork,DonorVolounteerTypeAsFieldWork:DonorVolounteerTypeAsFieldWork,DonorWantADonaitonBox:DonorWantADonaitonBox,DonaitonBoxNumber:DonaitonBoxNumber,DonorRemarks:DonorRemarks,DonaitonTimeOnOneMonth:DonaitonTimeOnOneMonth,DonaitonTimeOnSecondMonth:DonaitonTimeOnSecondMonth,DonaitonTimeOnThirdMonth:DonaitonTimeOnThirdMonth,DonorIdProofDoccumentImageUrl:DonorIdProofDoccumentImageUrl,softcopyemail:softcopyemail,hardcopy:hardcopy,AlertCall:AlertCall,AlertSMS:AlertSMS,AlertEmail:AlertEmail,WhatAppGroup:WhatAppGroup,WhatAppPersonalized:WhatAppPersonalized,emailaddress:emailaddress,txtpassword:txtpassword,DonorBloodGroup:DonorBloodGroup},
        //processData: false,
        //contentType: false,
        success: function(data, status, xhr) {
           // alert(data);
           // $('#BranchName').val('');
          // $('#EmployeeName').val('');
           // $("#BranchRoleId option:selected").val('');
           
           // $('#preview').attr('src');
            //alert(data);
           if(data == 'success'){
			   
			   alert('Successfully');
                $.get("view.php", function(data) {
                        $("#table_content").html(data);
                    });
                $('#records_content').fadeOut(1100).html(data);
           }else{
            $('#records_content').fadeIn(3000).html('<div class="text-center">error here</div>');
           }
            
        },
        error: function() {
            $('#records_content').fadeIn(3000).html('<div class="text-center">error here</div>');
        },
        beforeSend: function() {
            $('#records_content').fadeOut(700).html('<div class="text-center">Loading...</div>');
        },
        complete: function() {
            $('#link-add').hide();
            $('#link-update').hide();
            $('#show-add').show(700);
        }
    });
}); // add close


});


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

