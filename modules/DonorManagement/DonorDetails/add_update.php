<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();
include_once $serverRoot.'/SBM/includes/logics/Crud.php';
include_once $serverRoot.'/SBM/includes/logics/Validation.php';
 $db = new Crud();
 $validation = new Validation();
 error_reporting(0);
 $tblName = "donor";
 $DonorName = $_POST['DonorName'];
 $RoleId = $_POST['RoleId'];
 $DonorMemberType = $_POST['DonorMemberType'];
 $BranchId = $_POST['BranchId'];
 $DonorAge = $_POST['DonorAge'];
 $DonorIdProofType = $_POST['DonorIdProofType'];
 $DonorIdProofNumber = $_POST['DonorIdProofNumber'];
 $DonorProfession = $_POST['DonorProfession'];
 $DonorReligion = $_POST['DonorReligion'];
 $DonorOccupation = $_POST['DonorOccupation'];
 $DonorShareLocation = $_POST['DonorShareLocation'];
 $DonorBloodGroup = $_POST['DonorBloodGroup'];
 
 
 $emailaddress = $_POST['emailaddress'];
 $txtpassword = $_POST['txtpassword'];
 

 $IsPanVerified = $_POST['IsPanVerified'];
 $DonorPhoneNo1 = $_POST['DonorPhoneNo1'];
 $DonorPhoneNo2 = $_POST['DonorPhoneNo2'];
 $DonorPhoneNo3 = $_POST['DonorPhoneNo3'];
 $DonorPhoneNo4 = $_POST['DonorPhoneNo4'];
 $DonorAddress = $_POST['DonorAddress'];
 $DonorCityId = $_POST['DonorCityId'];
 $DonorStateId = $_POST['DonorStateId'];
 $DonorCountryId = $_POST['DonorCountryId'];
 $DonorIdProofDoccumentImageUrl  = $_POST['DonorIdProofDoccumentImageUrl'];
 //$DonorIdProofDoccumentImageUrl  = "";
 
 $DonorLandmark = $_POST['DonorLandmark'];
$DonorDonationType = $_POST['DonorDonationType'];
 //$DonorDonationType2 = $_POST['DonorDonationType2'];
 //$DonorDonationType3 = $_POST['DonorDonationType3'];
 
 
 $DateofCollectionForFirstWeek = $_POST['DateofCollectionForFirstWeek'];
 $DateofCollectionForSecondWeek = $_POST['DateofCollectionForSecondWeek'];
 $DateofCollectionForThirdWeek = $_POST['DateofCollectionForThirdWeek'];
 
 
 $DayofCollectionForSunday = $_POST['DayofCollectionForSunday'];
 $DayofCollectionForMonday = $_POST['DayofCollectionForMonday'];
 $DayofCollectionForTuesday = $_POST['DayofCollectionForTuesday'];
 $DayofCollectionForWednesday = $_POST['DayofCollectionForWednesday'];
 $DayofCollectionForThursday = $_POST['DayofCollectionForThursday'];
 $DayofCollectionForFriday = $_POST['DayofCollectionForFriday'];
 $DayofCollectionForSaturday = $_POST['DayofCollectionForSaturday'];
 
 
 
 //$DonorIdProofDoccumentImageUrl = $_POST['DonorIdProofDoccumentImageUrl'];
 
  $DonorIdProofNumber = $_POST['DonorIdProofNumber'];
  
  
  $CollectionType = $_POST['CollectionType'];
  $CollectionTime = $_POST['CollectionTime'];
  
  $DonorHealthStatus = $_POST['DonorHealthStatus'];
  $DonorBloodDontionTime = $_POST['DonorBloodDontionTime'];
  

  
  $BloodCollectionOnSunday = $_POST['BloodCollectionOnSunday'];
  $BloodCollectionOnMonday = $_POST['BloodCollectionOnMonday'];
  $BloodCollectionOnTuesday = $_POST['BloodCollectionOnTuesday'];
  $BloodCollectionOnWednesday = $_POST['BloodCollectionOnWednesday'];
  $BloodCollectionOnThursday = $_POST['BloodCollectionOnThursday'];
  $BloodCollectionOnFriday = $_POST['BloodCollectionOnFriday'];
  $BloodCollectionOnSaturday = $_POST['BloodCollectionOnSaturday'];
  
  $DonorEleigibleForLoan = $_POST['DonorEleigibleForLoan'];
  $DonorEligibleForMedicalSponsorShip = $_POST['DonorEligibleForMedicalSponsorShip'];
  
   $DonorWantToBeVolounter = $_POST['DonorWantToBeVolounter'];
 $DonorVolounteerAvailabilityOnWeekDays = $_POST['DonorVolounteerAvailabilityOnWeekDays'];
 $DonorVolounteerAvailabilityOnWeekEnds = $_POST['DonorVolounteerAvailabilityOnWeekEnds'];


 
 $DonorVolounteerTypeAsProfessionalWork = $_POST['DonorVolounteerTypeAsProfessionalWork'];
 $DonorVolounteerTypeAsFieldWork = $_POST['DonorVolounteerTypeAsFieldWork'];
 $DonorWantADonaitonBox = $_POST['DonorWantADonaitonBox'];
 $DonaitonBoxNumber = $_POST['DonaitonBoxNumber']; //DonaitonBoxNumber
 $DonorRemarks = $_POST['DonorRemarks'];
 
 
 $DonaitonTimeOnOneMonth = $_POST['DonaitonTimeOnOneMonth'];
 $DonaitonTimeOnSecondMonth = $_POST['DonaitonTimeOnSecondMonth'];
 $DonaitonTimeOnThirdMonth = $_POST['DonaitonTimeOnThirdMonth'];
 
 
 $AlertCall = $_POST['AlertCall'];
 $AlertSMS = $_POST['AlertSMS'];
 $AlertEmail = $_POST['AlertEmail'];
 $WhatAppGroup = $_POST['WhatAppGroup'];
 $WhatAppPersonalized = $_POST['WhatAppPersonalized'];
 
 
 $softcopyemail = $_POST['softcopyemail'];
 $hardcopy = $_POST['hardcopy'];
 


 
//$UserName = $_POST['UserName'];

 

 
 
 $CreatedBy = $_SESSION['id'];
 $UpdatedBy = 0;

 

if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){

    if($_REQUEST['action_type'] == 'add'){
       $userData = array(
'DonorName' => $DonorName,
'RoleId' => $RoleId,
'DonorMemberType' => $DonorMemberType,
'BranchId' => $BranchId,
'DonorAge' => $DonorAge,
'DonorIdProofType' => $DonorIdProofType,
'DonorIdProofNumber' => $DonorIdProofNumber,
'DonorProfession' => $DonorProfession,
'DonorReligion' => $DonorReligion,
'DonorOccupation' => $DonorOccupation,
'DonorShareLocation' => $DonorShareLocation,
 'DayofCollectionForSunday' =>  $DayofCollectionForSunday,
 'DayofCollectionForMonday' =>  $DayofCollectionForMonday,
 'DayofCollectionForTuesday' =>  $DayofCollectionForTuesday,
 'DayofCollectionForWednesday' =>  $DayofCollectionForWednesday,
 'DayofCollectionForThursday' =>  $DayofCollectionForThursday,
 'DayofCollectionForFriday' =>  $DayofCollectionForFriday,
 'DayofCollectionForSaturday' =>  $DayofCollectionForSaturday,
 'DonorIdProofNumber' =>  $DonorIdProofNumber,
 'CollectionType' =>  $CollectionType,
 'CollectionTime' =>  $CollectionTime,
 'DonorHealthStatus' =>  $DonorHealthStatus,
 'DonorBloodDontionTime' =>  $DonorBloodDontionTime,
 'BloodCollectionOnSunday' =>  $BloodCollectionOnSunday,
  'BloodCollectionOnMonday' =>  $BloodCollectionOnMonday,
  'BloodCollectionOnTuesday' =>  $BloodCollectionOnTuesday,
  'BloodCollectionOnWednesday' =>  $BloodCollectionOnWednesday,
  'BloodCollectionOnThursday' =>  $BloodCollectionOnThursday,
  'BloodCollectionOnFriday' =>  $BloodCollectionOnFriday,
  'BloodCollectionOnSaturday' =>  $BloodCollectionOnSaturday,
  'DonorEleigibleForLoan' =>  $DonorEleigibleForLoan,
  'DonorEligibleForMedicalSponsorShip' =>  $DonorEligibleForMedicalSponsorShip,
  'DonorWantToBeVolounter' =>  $DonorWantToBeVolounter,
  'DonorVolounteerAvailabilityOnWeekDays' =>  $DonorVolounteerAvailabilityOnWeekDays,
  'DonorVolounteerAvailabilityOnWeekEnds' =>  $DonorVolounteerAvailabilityOnWeekEnds,
  'DonorVolounteerTypeAsProfessionalWork' =>  $DonorVolounteerTypeAsProfessionalWork,
  'DonorVolounteerTypeAsFieldWork' =>  $DonorVolounteerTypeAsFieldWork,
  'DonorWantADonaitonBox' =>  $DonorWantADonaitonBox,
  'DonaitonBoxNumber' =>  $DonaitonBoxNumber,
  'DonorRemarks' =>  $DonorRemarks,
  'DonaitonTimeOnOneMonth' =>  $DonaitonTimeOnOneMonth,
  'DonaitonTimeOnSecondMonth' =>  $DonaitonTimeOnSecondMonth,
  'DonaitonTimeOnThirdMonth' =>  $DonaitonTimeOnThirdMonth,
  'softcopyemail' =>  $softcopyemail, 
  'AlertCall' =>  $AlertCall, 
  'AlertSMS' =>  $AlertSMS, 
  'AlertEmail' =>  $AlertEmail, 
  'WhatAppGroup' =>  $WhatAppGroup, 
  'WhatAppPersonalized' =>  $WhatAppPersonalized, 
   'hardcopy' =>  $hardcopy, 
   'DonorDonationType' =>  $DonorDonationType, 
   'DonorIdProofDoccumentImageUrl' =>  $DonorIdProofDoccumentImageUrl, 
   'DonorEmail' =>  $emailaddress, 
   'DonorPassword' => $txtpassword, 
   'DonorPhoneNo1' => $DonorPhoneNo1, 
   'DonorPhoneNo2' => $DonorPhoneNo2, 
   'DonorPhoneNo3' => $DonorPhoneNo3, 
   'DonorPhoneNo4' => $DonorPhoneNo4, 
   'DonorCityId' => $DonorCityId, 
   'DonorStateId' => $DonorStateId, 
   'DonorCountryId' => $DonorCountryId, 
   'DonorLandmark' => $DonorLandmark, 
   'DonorAddress' => $DonorAddress, 
   'DonorBloodGroup' => $DonorBloodGroup, 
'CreatedBy' => $CreatedBy,
'UpdatedBy' => $UpdatedBy

);

//print_r($userData);
 $condition = array('DonorId' => $_POST['DonorId']);
        $msg = $validation->check_empty($_POST,$userData);
        if($msg!= null){
           // $insert = $db->insert($tblName,$userData);
			  $insert = $db->update($tblName,$userData,$condition);
            //$statusMsg = $insert?'User data has been inserted successfully.':'Some problem occurred, please try again.';
            //$_SESSION['statusMsg'] = $statusMsg;
            if($insert){
                
                
                echo 'success';
                
            
            }else{echo 'Error!';}

        }else{
            echo $msg;
        }
        
        
}

}

?>
