<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
include_once $serverRoot.'/SBM/includes/logics/Validation.php';
$db = new Crud();
$validation = new Validation();
 $tblName = "HouseType";

 $UpdatedBy = $_SESSION['id'];


	if($_REQUEST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $userData = array(
                'HouseTypeName' => $_POST['UHouseTypeName'],
                'UpdatedBy' => $UpdatedBy
            );
            $condition = array('HouseTypeId' => $_POST['id']);

            $msq = $validation->check_empty($_POST,array('HouseTypeName'));
            if($msq != null){
                $update = $db->update($tblName,$userData,$condition);
                //$statusMsg = $update?'User data has been updated successfully.':'Some problem occurred, please try again.';
                //$_SESSION['statusMsg'] = $statusMsg;
               // header("Location:index.php");
    
               if($update){
                    echo 'success';
               }else{
                    echo 'error!';
               }
            }else{
                echo $msg;
            }
           
        }
    }