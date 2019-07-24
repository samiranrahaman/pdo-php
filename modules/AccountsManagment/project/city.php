<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();
include_once $serverRoot.'/SBM/includes/logics/Crud.php';
include_once $serverRoot.'/SBM/includes/logics/Validation.php';
 $db = new Crud();
 $validation = new Validation();
error_reporting(0);
 $tblName = "donor";
$DonorCountryId = $_POST['BeneficiaryCountryId'];
$DonorStateId = $_POST['BeneficiaryStateId'];
 

 
 
 $CreatedBy = $_SESSION['id'];
 $UpdatedBy = 0;

$cty = $db->getRows('city',array('where'=>array('CountryId'=>$DonorCountryId,'StateId'=>$DonorStateId),'order_by'=>'StateId DESC'));
?>

<?php
		echo '<option vaue="">Select City</option>';
		if(!empty($cty)){ foreach($cty as $res){
							   echo "<option value='".$res['CityId']."'>".$res['CityName']."</option>";

		}}
		else{
			echo '<option vaue="">No City Found</option>';
		}
?>
	
