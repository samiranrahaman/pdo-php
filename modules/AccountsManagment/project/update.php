<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
include_once $serverRoot.'/SBM/includes/logics/Validation.php';
$db = new Crud();
$validation = new Validation();
$tblName = "Employee";
$EmployeeName = $_POST['EmployeeName'];
$Password = md5($_POST['Password']);
$UserName = $_POST['UserName'];
$RoleId = $_POST['RoleId'];
$BranchId = $_POST['BranchId'];
$EmployeeImageUrl = $_POST['EmployeeImageUrl'];
 $UpdatedBy = $_SESSION['id'];


	if($_REQUEST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $userData = array(
                'EmployeeName' => $EmployeeName,
                'RoleId' => $RoleId,
                'BranchId' => $BranchId,
                'UserName' => $UserName,
                'Password' => $Password,
                'EmployeeImageUrl' => $EmployeeImageUrl,
                'UpdatedBy' => $UpdatedBy
            );
            $condition = array('BranchId' => $_POST['id']);

            $msq = $validation->check_empty($_POST,array('uBranchCode','uBranchName','uBranchTrustTypeId','uBranchLogoImageUrl'));
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