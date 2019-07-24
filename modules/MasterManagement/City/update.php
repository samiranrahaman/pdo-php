<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
$db = new Crud();
 $tblName = "City";

 $UpdatedBy = $_SESSION['id'];


	if($_REQUEST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $userData = array(
                'CityName' => $_POST['CityName'],
                'StateId' => $_POST['StateId'],
                'CountryId' => $_POST['CountryId'],
                'UpdatedBy' => $UpdatedBy
            );
            $condition = array('CityId' => $_POST['id']);
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