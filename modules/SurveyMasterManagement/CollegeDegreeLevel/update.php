<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
include_once $serverRoot.'/SBM/includes/logics/Validation.php';
$db = new Crud();
$validation = new Validation();
 $tblName = "CollegeDegreeLevel";

 $UpdatedBy = $_SESSION['id'];


	if($_REQUEST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $userData = array(
                'CollegeDegreeLevelName' => $_POST['UCollegeDegreeLevelName'],
                'UpdatedBy' => $UpdatedBy
            );
            $condition = array('CollegeDegreeLevelId' => $_POST['id']);

            $msq = $validation->check_empty($_POST,array('CollegeDegreeLevelName'));
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