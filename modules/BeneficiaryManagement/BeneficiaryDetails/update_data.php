<?php
//error_reporting(0);
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();
include_once $serverRoot.'/SBM/includes/logics/Crud.php';
include_once $serverRoot.'/SBM/includes/logics/Validation.php';
 $db = new Crud();
 $validation = new Validation();
 
 error_reporting(0);
 
 $tblName = "beneficiarydetail";
 //$BeneficiaryApplicaitonTypeId = $_POST['BeneficiaryApplicaitonTypeId'];
 $BeneficiaryApplicaitonTypeId = $_POST['BeneficiaryApplicaitonTypeId'];
 $BeneficiaryRelatedTo = $_POST['ben_related_to']; //BeneficiaryRelatedTo ben_related_to
 $CharitablleFundTypeId = $_POST['CharitablleFundTypeId'];
 $BeneficiaryBranchId = $_POST['BeneficiaryBranchId'];
 //$RoleId = $_POST['RoleId'];
 $BeneficiaryIdProofTypeId = $_POST['BeneficiaryIdProofTypeId'];
 $BeneficiaryName = $_POST['BeneficiaryName'];
 $BeneficiaryOccupation = $_POST['BeneficiaryOccupation'];
 $BeneficiaryPhoneNo1 = $_POST['BeneficiaryPhoneNo1'];

 $BeneficiaryProblem = $_POST['BeneficiaryProblem'];
 $BeneficiaryMonthlyIncome = $_POST['BeneficiaryMonthlyIncome'];
 $BeneficiaryMonthlyExpences = $_POST['BeneficiaryMonthlyExpences'];
 $BeneficiaryAddress = $_POST['BeneficiaryAddress'];
 $BeneficiaryCityId = $_POST['BeneficiaryCityId'];
 $BeneficiaryStateId = $_POST['BeneficiaryStateId'];
 $BeneficiaryCountryId = $_POST['BeneficiaryCountryId'];
 $BeneficiaryLandmark = $_POST['BeneficiaryLandmark'];
 $BeneficiaryRemarks = $_POST['BeneficiaryRemarks'];
 $BeneficiaryIdProofDoccumentImageUrl1 = $_POST['EmployeeImageUrl'];
 
 
 $BeneficiaryProblemDoccumentImageUrl1 = $_POST['BeneficiaryProblemDoccumentImageUrl1'];
 $BeneficiaryProblemDoccumentImageUrl2 = $_POST['BeneficiaryProblemDoccumentImageUrl2'];
 $BeneficiaryProblemDoccumentImageUrl3 = $_POST['BeneficiaryProblemDoccumentImageUrl3'];
 
 $CreatedBy = $_SESSION['id'];
 $UpdatedBy = 0;
//BeneficiaryProblemDoccumentImageUrl1:BeneficiaryProblemDoccumentImageUrl1,BeneficiaryProblemDoccumentImageUrl2:BeneficiaryProblemDoccumentImageUrl2,BeneficiaryProblemDoccumentImageUrl3:BeneficiaryProblemDoccumentImageUrl3
 //echo "here..........";

if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){

    if($_REQUEST['action_type'] == 'add'){
	//echo "sdfdsfdsfd";	
		
       $userData = array(
'BeneficiaryApplicaitonTypeId' => $BeneficiaryApplicaitonTypeId,
'CharitablleFundTypeId' => $CharitablleFundTypeId,
'BeneficiaryRelatedTo' => $BeneficiaryRelatedTo,
'BeneficiaryName' => $BeneficiaryName,
'BeneficiaryOccupation' => $BeneficiaryOccupation,
'BeneficiaryPhoneNo1' => $BeneficiaryPhoneNo1,
'BeneficiaryIdProofTypeId' => $BeneficiaryIdProofTypeId,
'BeneficiaryProblem' => $BeneficiaryProblem,
'BeneficiaryMonthlyIncome' => $BeneficiaryMonthlyIncome,
'BeneficiaryMonthlyExpences' => $BeneficiaryMonthlyExpences,
'BeneficiaryAddress' => $BeneficiaryAddress,
'BeneficiaryCityId' => $BeneficiaryCityId,BeneficiaryProblemDoccumentImageUrl1
'BeneficiaryStateId' => $BeneficiaryStateId,
'BeneficiaryCountryId' => $BeneficiaryCountryId,
'BeneficiaryLandmark' => $BeneficiaryLandmark,
'BeneficiaryRemarks' => $BeneficiaryRemarks,
'BeneficiaryBranchId' => $BeneficiaryBranchId,
'BeneficiaryIdProofDoccumentImageUrl1' => $BeneficiaryIdProofDoccumentImageUrl1,
'BeneficiaryProblemDoccumentImageUrl1' => $BeneficiaryProblemDoccumentImageUrl1,
'BeneficiaryProblemDoccumentImageUrl2' => $BeneficiaryProblemDoccumentImageUrl2,
'BeneficiaryProblemDoccumentImageUrl3' => $BeneficiaryProblemDoccumentImageUrl3,
'CreatedBy' => $CreatedBy,
'UpdatedBy' => $UpdatedBy

);


//print_r($userData);


 $condition = array('BeneficiaryDetailId' => $_POST['BeneficiaryDetailId']);
 
 
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
