<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
$db = new Crud();
 $tblName = "TrustType";

 $UpdatedBy = $_SESSION['id'];


	if($_REQUEST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $userData = array(
                'TrustTypeName' => $_POST['UTrustTypeName'],
                'UpdatedBy' => $UpdatedBy
            );
            $condition = array('TrustTypeId' => $_POST['id']);
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