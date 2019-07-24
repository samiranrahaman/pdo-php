<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
$db = new Crud();
 $tblName = "State";

 $UpdatedBy = $_SESSION['id'];


	if($_REQUEST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $userData = array(
                'StateName' => $_POST['StateName'],
                'CountryId' => $_POST['CountryId'],
                'UpdatedBy' => $UpdatedBy
            );
            $condition = array('StateId' => $_POST['id']);
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