<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();
include_once $serverRoot.'/SBM/includes/logics/Crud.php';
include_once $serverRoot.'/SBM/includes/logics/Validation.php';
 $db = new Crud();
 $validation = new Validation();
 $tblName = "SurveyConclusionCategory";
 $SurveyConclusionCategoryName = $_POST['SurveyConclusionCategoryName'];
 $CreatedBy = $_SESSION['id'];
 $UpdatedBy = 0;

 

if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){

    if($_REQUEST['action_type'] == 'add'){
        $userData = array(
            'SurveyConclusionCategoryName' => $SurveyConclusionCategoryName,
            'CreatedBy' => $CreatedBy,
            'UpdatedBy' => $UpdatedBy
            
        );
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
