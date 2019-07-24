<?php
//error_reporting(0);
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();
include_once $serverRoot.'/SBM/includes/logics/Crud.php';
include_once $serverRoot.'/SBM/includes/logics/Validation.php';
 $db = new Crud();
 $validation = new Validation();
 
 error_reporting(0);
 
 $tblName = "vendor";

 $autoid = $_POST['autoid'];
 $vendor_id = $_POST['vendor_id'];
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
 
 $CreatedBy = $_SESSION['id'];
 $UpdatedBy = 0;
//BeneficiaryProblemDoccumentImageUrl1:BeneficiaryProblemDoccumentImageUrl1,BeneficiaryProblemDoccumentImageUrl2:BeneficiaryProblemDoccumentImageUrl2,BeneficiaryProblemDoccumentImageUrl3:BeneficiaryProblemDoccumentImageUrl3
 //echo "here..........";

if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){

    if($_REQUEST['action_type'] == 'add'){
	//echo "sdfdsfdsfd";	
		
       $userData = array(
'BranchId' => $BeneficiaryBranchId,
'VendorName' => $name,
'VendorOccupation' => $occupation,
'VendorPhoneNo' => $phone1,
'VendorEmail' => $email,
'VendorAddress' => $address,
'VendorCity' => $BeneficiaryCityId,
'VendorState' => $BeneficiaryStateId,
'VendorCountry' => $country,
'VendorLandMark' => $landmark,
'VendorRemarks' => $remarks,
'VendorAccountDetails' => $account_details,
'VendorId' => $vendor_id,
'IsActive' => '1',
'CreatedBy' => $CreatedBy,
'UpdatedBy' => $UpdatedBy

);


//print_r($userData);


 $condition = array('Id' => $_POST['autoid']);
 
 
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
