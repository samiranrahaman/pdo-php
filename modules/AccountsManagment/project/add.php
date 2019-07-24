<?php
//error_reporting(0);
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();
include_once $serverRoot.'/SBM/includes/logics/Crud.php';
include_once $serverRoot.'/SBM/includes/logics/Validation.php';
 $db = new Crud();
 $validation = new Validation();
 $tblName = "projects";
 //$BeneficiaryApplicaitonTypeId = $_POST['BeneficiaryApplicaitonTypeId'];

 $name = $_POST['name'];
 $occupation = $_POST['occupation'];
 $phone1 = $_POST['phone1'];
 $email = $_POST['email'];
 $address = $_POST['address'];
 $country = $_POST['country'];
 $BeneficiaryStateId = $_POST['BeneficiaryStateId'];
 $landmark = $_POST['landmark'];
 $BeneficiaryCityId = $_POST['BeneficiaryCityId'];
 $account_details = $_POST['account_details'];
 $BeneficiaryBranchId = $_POST['BeneficiaryBranchId'];
 $remarks = $_POST['remarks'];
 
 
 $projectname = $_POST['projectname'];
 $ProjectBudget = $_POST['ProjectBudget'];
 $ProjectDetails = $_POST['ProjectDetails'];
 $ProjectLink1 = $_POST['ProjectLink1'];
 $ProjectResponsiblePerson = $_POST['ProjectResponsiblePerson'];
 
 
 $CreatedBy = $_SESSION['id'];
 $UpdatedBy = 0;
//BeneficiaryProblemDoccumentImageUrl1:BeneficiaryProblemDoccumentImageUrl1,BeneficiaryProblemDoccumentImageUrl2:BeneficiaryProblemDoccumentImageUrl2,BeneficiaryProblemDoccumentImageUrl3:BeneficiaryProblemDoccumentImageUrl3
 //echo "here..........";

if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){

    if($_REQUEST['action_type'] == 'add'){
		
       $userData = array(
'BranchId' => $BeneficiaryBranchId,
'Name' => $name,
'Occupation' => $occupation,
'PhoneNumber' => $phone1,
'Email' => $email,
'ProjectAddress' => $address,
'ProjectCity' => $BeneficiaryCityId,
'ProjectState' => $BeneficiaryStateId,
'ProjectCountry' => $country,
'ProjectLandMark' => $landmark,
'ProjectRemarks' => $remarks,
'ProjectAccountDetails' => $account_details,
'ProjectName' => $projectname,
'ProjectBudget' => $ProjectBudget,
'ProjectDetails' => $ProjectDetails,
'ProjectLink1' => $ProjectLink1,
'ProjectResponsiblePerson' => $ProjectResponsiblePerson,
'IsActive' => '1',
'CreatedBy' => $CreatedBy,
'UpdatedBy' => $UpdatedBy

);


//print_r($userData);
        $msg = $validation->check_empty($_POST,$userData);
        if($msg!= null){
            $insert = $db->insert($tblName,$userData);
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
