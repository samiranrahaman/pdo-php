<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
 $db = new Crud();
 $tblName = "City";
 $CityName = $_POST['CityName'];
 $StateId = $_POST['StateId'];
 $CountryId = $_POST['CountryId'];
 $CreatedBy = $_SESSION['id'];
 $UpdatedBy = 0;


if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){

    if($_REQUEST['action_type'] == 'add'){
        $userData = array(
            'CityName' => $CityName,
            'StateId' => $StateId,
            'CountryId' => $CountryId,
            'CreatedBy' => $CreatedBy,
            'UpdatedBy' => $UpdatedBy
            
        );
        $insert = $db->insert($tblName,$userData);
        //$statusMsg = $insert?'User data has been inserted successfully.':'Some problem occurred, please try again.';
        //$_SESSION['statusMsg'] = $statusMsg;
        if($insert){
            
            
            echo 'success';
            
        
        }else{echo 'Error!';}
        
}

}

?>