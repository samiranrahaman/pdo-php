<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
include_once $serverRoot.'/SBM/includes/logics/Validation.php';
$db = new Crud();
$validation = new Validation();
 $tblName = "SurveyConclusionQuestion";

 $SurveyConclusionQuestionName = $_POST['SurveyConclusionQuestionName'];
 $BranchId = $_POST['BranchId'];
 $option1 = $_POST['option1'];
 $option2 = $_POST['option2'];
 $option3 = $_POST['option3'];
 $option4 = $_POST['option4'];
 $UpdatedBy = $_SESSION['id'];


	if($_REQUEST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $userData = array(
                'SurveyConclusionQuestionName' => $SurveyConclusionQuestionName,
                'option1' => $option1,
                'option2' => $option2,
                'option3' => $option3,
                'option4' => $option4,
                'BranchId' => $BranchId,
                'UpdatedBy' => $UpdatedBy
            );
            $condition = array('SurveyConclusionQuestionId' => $_POST['id']);

            $msq = $validation->check_empty($_POST,array('uSurveyConclusionQuestionName','uBranchId'));
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