<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
$db = new Crud();
 $tblName = "Module";
 $ModuleTitle = $_POST['ModuleTitle'];
 $Description = $_POST['Description'];
 $CreatedBy = $_SESSION['id'];
 $UpdatedBy = 0;

 

if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){

    if($_REQUEST['action_type'] == 'add'){
        $userData = array(
            'ModuleTitle' => $ModuleTitle,
            'Description' => $Description,
            'CreatedBy' => $CreatedBy,
            'UpdatedBy' => $UpdatedBy
            
        );
        $insert = $db->insert($tblName,$userData);
        //$statusMsg = $insert?'User data has been inserted successfully.':'Some problem occurred, please try again.';
        //$_SESSION['statusMsg'] = $statusMsg;
        if($insert){
            
            
            echo 'success';
            
        
        }else{echo 'Error!';}
        
}

}

?>