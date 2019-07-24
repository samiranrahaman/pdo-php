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
 $BeneficiaryDetailId = $_POST['BeneficiaryDetailId'];
 $action_type = $_POST['action_type'];
 $ben_related_to = $_POST['ben_related_to'];
 $ben_type = $_POST['ben_type'];
 $type_of_payment = $_POST['type_of_payment'];
 $pension_charge_type = $_POST['pension_charge_type'];
 $pension_star_date = $_POST['pension_star_date'];
 $pension_end_date = $_POST['pension_end_date'];
 $sanctioned_amount = $_POST['sanctioned_amount'];
 $as_per_sponsored = $_POST['as_per_sponsored'];
 $data_can_share = $_POST['data_can_share'];
 $remarks = $_POST['remarks'];
 
 
 $CreatedBy = $_SESSION['id'];
 $UpdatedBy = 0;
//BeneficiaryProblemDoccumentImageUrl1:BeneficiaryProblemDoccumentImageUrl1,BeneficiaryProblemDoccumentImageUrl2:BeneficiaryProblemDoccumentImageUrl2,BeneficiaryProblemDoccumentImageUrl3:BeneficiaryProblemDoccumentImageUrl3
 //echo "here..........";

if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){

    if($_REQUEST['action_type'] == 'add'){
	//echo "sdfdsfdsfd";	
		
       $userData = array(
'BeneficiaryAidStatusId' => $ben_type,
'BeneficiaryAidStatusId' => $BeneficiaryApplicaitonTypeId,
'BeneficiarySanctionedAmount' => $sanctioned_amount,
'ISBeneficiaryAsPerSponsored' => $as_per_sponsored,
'IsShareBeneficiary' => $data_can_share,
'BeneficiayAidRemarks' => $remarks,
'Beneficiarydetail_pension' => $pension_charge_type,

'UpdatedBy' => $CreatedBy

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
