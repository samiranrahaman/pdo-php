<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
$db = new Crud();
 $tblName = "Role";

 $UpdatedBy = $_SESSION['id'];


	if($_REQUEST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $userData = array(
                'RoleName' => $_POST['RoleName'],
                'Description' => $_POST['Description'],
                'UpdatedBy' => $UpdatedBy
            );
            $condition = array('RoleId' => $_POST['id']);
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