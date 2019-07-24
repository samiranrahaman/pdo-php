<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
include_once $serverRoot.'/SBM/includes/logics/Validation.php';
$db = new Crud();
$validation = new Validation();
 $tblName = "EmailTemplate";

 $EmailTemplateName = $_POST['EmailTemplateName'];
 $EmailTemplateSubject = $_POST['EmailTemplateSubject'];
 $EmailTemplateDescription = $_POST['EmailTemplateDescription'];

 $UpdatedBy = $_SESSION['id'];


	if($_REQUEST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $userData = array(
                'EmailTemplateName' => $EmailTemplateName,
                'EmailTemplateSubject' => $EmailTemplateSubject,
                'EmailTemplateDescription' => $EmailTemplateDescription,
                'UpdatedBy' => $UpdatedBy
            );
            $condition = array('EmailTemplateId' => $_POST['id']);

            $msq = $validation->check_empty($_POST,array('uEmailTemplateName','uEmailTemplateSubject','uEmailTemplateDescription'));
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