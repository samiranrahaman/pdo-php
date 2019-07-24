<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["email"]);  // where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow **session_unset();**
//$_SESSION["email"] = '';
session_destroy();
header("Location: ../../index");
?>
<?php
