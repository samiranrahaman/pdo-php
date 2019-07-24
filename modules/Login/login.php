<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
include_once $serverRoot.'/SBM/includes/logics/Crud.php';
session_start();
$db = new Crud();

 $email = $_POST['email'];
 $pass = $_POST['password'];
 
 $password = md5($pass);
  
 $login = $db->getRows('Administrator',array('where'=>array('AdminEmailId'=>$email,'Password'=>$password),'return_type'=>'single'));

if(!empty($login)){ 
    $_SESSION["id"] = $login['AdminId'];
    $_SESSION["email"] = $login['AdminEmailId'];
    echo "success";
}else{
    echo "error";
}

?>