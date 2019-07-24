<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
include_once $serverRoot.'/SBM/includes/logics/Validation.php';
$db = new Crud();
$validation = new Validation();
 $tblName = "SMSSettings";

 $MailServer = $_POST['MailServer'];
 $SMSFrom = $_POST['SMSFrom'];
 $UserName = $_POST['UserName'];
 $Password = $_POST['Password'];
 $Port = $_POST['Port'];
 $UpdatedBy = $_SESSION['id'];


	if($_REQUEST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $userData = array(
                'MailServer' => $MailServer,
                'SMSFrom' => $SMSFrom,
                'UserName' => $UserName,
                'Password' => $Password,
                'Port' => $Port,
                'UpdatedBy' => $UpdatedBy
            );
            $condition = array('SMSSettingsId' => $_POST['id']);

            $msq = $validation->check_empty($_POST,array('uSMSSettingsName','SMSFrom','UserName',''));
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
                echo "Error Out";
            }
           
        }
    }