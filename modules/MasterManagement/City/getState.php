<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
$db = new Crud();
$id = $_POST['id'];

	if(empty($id))
	{
		?><div class="text-center">no records found under this selection <a href="#" onclick="$('#link-update').hide();$('#show-add').show(700);">Hide this</a></div>
		<?php
		die();
	}
if($_REQUEST['action_type'] == 'add'){
		$result = $db->getRows('State',array('where'=>array('CountryId'=>$id)));
		//$City = $db->getRows('City',array('order_by'=>'CityId DESC'));
		//echo $result;
		//print_r($result);
		echo '<option vaue="">Select State</option>';
		if(!empty($result)){ foreach($result as $res){

				//echo '<option value="'.$res['StateId'].'">'.$res['StateName'].'</option>';
				echo "<option value='".$res['StateId']."'>".$res['StateName']."</option>";
			}
		}else{
			echo '<option vaue="">No State</option>';
		}
	}
    
?>