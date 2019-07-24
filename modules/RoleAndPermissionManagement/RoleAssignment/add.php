<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
$db = new Crud();
 $tblName = "RoleAssignment";

/*
 $RoleName = $_POST['RoleName'];
 $ModuleName = $_POST['ModuleName'];
 $IsAdd = $_POST['IsAdd'];
 $IsEdit =$_POST['IsEdit'];
 $IsDelete =$_POST['ModuleName'];
 $IsView = $_POST['IsView'];
 $IsPrint =$_POST['IsPrint'];
 $IsDownload = $_POST['IsDownload'];
 $IsShare =$_POST['IsShare'];
*/

 $CreatedBy = $_SESSION['id'];
 $UpdatedBy = 0;

 

if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){

    if($_REQUEST['action_type'] == 'add'){
        $userData = array(
            'RoleId' => $_POST['RoleId'],
            'ModuleId' => $_POST['ModuleId'],
            'IsAdd' => $_POST['IsAdd'],
            'IsEdit' => $_POST['IsEdit'],
            'IsDelete' => $_POST['IsDelete'],
            'IsView' => $_POST['IsView'],
            'IsPrint' => $_POST['IsPrint'],
            'IsDownload' => $_POST['IsDownload'],
            'IsShare' => $_POST['IsShare'],
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
