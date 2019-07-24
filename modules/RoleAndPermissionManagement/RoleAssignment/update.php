<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
$db = new Crud();
 $tblName = "RoleAssignment";

 $UpdatedBy = $_SESSION['id'];


	if($_REQUEST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
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
                'UpdatedBy' => $UpdatedBy
            );
            $condition = array('Id' => $_POST['id']);
            $update = $db->update($tblName,$userData,$condition);
            //$statusMsg = $update?'User data has been updated successfully.':'Some problem occurred, please try again.';
            //$_SESSION['statusMsg'] = $statusMsg;
           // header("Location:index.php");

           if($update){
                echo 'success';
           }else{
                echo 'error!';
           }
        }
    }