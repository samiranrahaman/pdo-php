<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
include_once $serverRoot.'/SBM/includes/logics/Validation.php';
$db = new Crud();
$validation = new Validation();
 $tblName = "Employee";

 //$EmployeeName = $_POST['EmployeeName'];
 //$EmployeeSubject = $_POST['EmployeeSubject'];
 $IsActive = $_POST['IsActive'];

 $UpdatedBy = $_SESSION['id'];
//echo  $IsActive ;

	if($_REQUEST['action_type'] == 'edit'){
       
        if(!empty($_POST['id'])){
          //  echo  $IsActive ;
            $userData = array(
                'IsActive' => $IsActive,
                'UpdatedBy' => $UpdatedBy
            );
            $condition = array('EmployeeId' => $_POST['id']);

            
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