<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
$db = new Crud();
$tblName = "SMSSettings";
$id = $_POST['id'];


if($_REQUEST['action_type'] == 'delete'){
    if(!empty($id )){
        $condition = array('SMSSettingsId' => $id);
        $delete = $db->delete($tblName,$condition);
        //$statusMsg = $delete?'User data has been deleted successfully.':'Some problem occurred, please try again.';
        //$_SESSION['statusMsg'] = $statusMsg;
       // header("Location:index.php");

       if($delete ){
            echo 'success';
       }else{
        echo 'error';
       }
    }
}
?>