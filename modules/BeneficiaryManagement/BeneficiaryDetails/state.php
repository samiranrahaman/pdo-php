<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();
include_once $serverRoot.'/SBM/includes/logics/Crud.php';
include_once $serverRoot.'/SBM/includes/logics/Validation.php';
 $db = new Crud();
 $validation = new Validation();
error_reporting(0);
 $tblName = "donor";
$BeneficiaryCountryId = $_POST['BeneficiaryCountryId'];
 
 $CreatedBy = $_SESSION['id'];
 $UpdatedBy = 0;


$state = $db->getRows('state',array('where'=>array('CountryId'=>$BeneficiaryCountryId),'order_by'=>'StateId DESC'));
?>

<?php
echo '<option vaue="">Select State</option>';
	
		if(!empty($state)){ foreach($state as $res){
							   echo "<option value='".$res['StateId']."'>".$res['StateName']."</option>";

		}}
		else{
			echo '<option vaue="">No State Found</option>';
		}
?>


<script>
	
	$(function() {

		$('#BeneficiaryStateId').change(function() {

	var BeneficiaryCountryId = $('#BeneficiaryCountryId').val();
	var BeneficiaryStateId = $('#BeneficiaryStateId').val();
	//alert(DonorStateId);
	
	 $.ajax({
        url: "city.php",
        type: "POST",
        data: { BeneficiaryCountryId : BeneficiaryCountryId,BeneficiaryStateId:BeneficiaryStateId},

        success: function(data, status, xhr) {

          
                $('#BeneficiaryCityId').html(data);
         
            
        },
        error: function() {
           // $('#records_content').fadeIn(3000).html('<div class="text-center">error here</div>');
        },
        beforeSend: function() {
           // $('#records_content').fadeOut(700).html('<div class="text-center">Loading...</div>');
        },
        complete: function() {
         
        }
    });
	
	
	
});
	});
</script>		