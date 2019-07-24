<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
include_once $serverRoot.'/SBM/includes/logics/Validation.php';
$db = new Crud();
$validation = new Validation();
 $tblName = "SurveyAreaCode";
 $SurveyAreaCode = $_POST['SurveyAreaCode'];
 $SurveyAreaName = $_POST['SurveyAreaName'];
 $BranchId = $_POST['BranchId'];
 $CountryId = $_POST['CountryId'];
 $StateId = $_POST['StateId'];
 $CityId = $_POST['CityId'];
 $UpdatedBy = $_SESSION['id'];


	if($_REQUEST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $userData = array(
                'SurveyAreaCode' => $SurveyAreaCode,
                'SurveyAreaName' => $SurveyAreaName,
                'BranchId' => $BranchId,
                'CountryId' => $CountryId,
                'StateId' => $StateId,
                'CityId' => $CityId,
                'UpdatedBy' => $UpdatedBy
            );
            $condition = array('SurveyAreaCodeId' => $_POST['id']);

            $msq = $validation->check_empty($_POST,array('uSurveyAreaCode','uSurveyAreaName','uBranchId','uCountryId','uStateId','uCityId'));
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