<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
$db = new Crud();
$id = $_POST['id'];
$BranchName = $db->getRows('BranchLocation',array('order_by'=>'BranchId DESC'));
$CountryName = $db->getRows('Country',array('order_by'=>'CountryId DESC'));
$StateName = $db->getRows('State',array('order_by'=>'StateId DESC'));
$CityName = $db->getRows('City',array('order_by'=>'CityId DESC'));
	if(empty($id))
	{
		?><div class="text-center">no records found under this selection <a href="#" onclick="$('#link-update').hide();$('#show-add').show(700);">Hide this</a></div>
		<?php
		die();
	}

	$result = $db->getRows('SurveyAreaCode',array('where'=>array('SurveyAreaCodeId'=>$id),'return_type'=>'single'));

	if(!empty($result)){ 
        
       
            ?>
        <?php
		?>
		<div class="form-inline" id="edit-data">
        <div class="form-group col-lg-3">
                <label>Survey Area Code </label>
                        <input type="text"  name="uSurveyAreaCode" id="uSurveyAreaCode" value="<?php echo $result['SurveyAreaCode'];?>" class="form-control" required />
                    <label>Survey Area  Name</label>
                        <input type="text"  name="uSurveyAreaName" id="uSurveyAreaName" value="<?php echo $result['SurveyAreaName'];?>" class="form-control" required />
                   
                    </div>
                    <div class="form-group col-lg-3">
                    <label>Branch Name</label>
                    <select class="form-control select2" id="uBranchName" style="width: 100%;">
                        <?php
                                echo '<option vaue="">Select Branch</option>';
                                if(!empty($BranchName)){ foreach($BranchName as $res){

                                    if($res['BranchId'] == $result['BranchId']){

                                        echo "<option value='".$res['BranchId']."' selected>".$res['BranchName']."</option>";

                                    }else{

                                        echo "<option value='".$res['BranchId']."'>".$res['BranchName']."</option>";

                                    }
                                                    
                                }}
                                else{
                                    echo '<option vaue="">No Branch</option>';
                                }
                        ?>
                        </select>
                    <label>Country Name</label>
                    <select class="form-control select2" id="uCountryName" style="width: 100%;">
                        <?php
                                echo '<option vaue="">Select Country</option>';
                                if(!empty($CountryName)){ foreach($CountryName as $res){
                                    if($res['CountryId'] == $result['CountryId']){
                                        echo "<option value='".$res['CountryId']."' selected>".$res['CountryName']."</option>";

                                    }else{

                                        echo "<option value='".$res['CountryId']."'>".$res['CountryName']."</option>";

                                    }

                                                       
                                }
                            
                            }
                                else{
                                    echo '<option vaue="">No Country</option>';
                                }
                        ?>
                        </select>
                       
                    </div>
                    <div class="form-group col-lg-3">
                    <label>State</label>
                      

                      <select class="form-control select2" id="uStateName" style="width: 100%;">
                      
                      <?php
                                echo '<option vaue="">Select State</option>';
                                if(!empty($StateName)){ foreach($StateName as $res){
                                    if($res['StateId'] == $result['StateId']){
                                        echo "<option value='".$res['StateId']."' selected>".$res['StateName']."</option>";

                                    }else{

                                        echo "<option value='".$res['StateId']."'>".$res['StateName']."</option>";

                                    }

                                                       
                                }
                            
                            }
                                else{
                                    echo '<option vaue="">No State</option>';
                                }
                        ?>
                              
                      </select>
                      <label>City</label>
                      

                      <select class="form-control select2" id="uCityName" style="width: 100%;">
                      
                      <?php
                                echo '<option vaue="">Select StatCitye</option>';
                                if(!empty($CityName)){ foreach($CityName as $res){
                                    if($res['CityId'] == $result['CityId']){
                                        echo "<option value='".$res['CityId']."' selected>".$res['CityName']."</option>";

                                    }else{

                                        echo "<option value='".$res['CityId']."'>".$res['CityName']."</option>";

                                    }

                                                       
                                }
                            
                            }
                                else{
                                    echo '<option vaue="">No City</option>';
                                }
                        ?>
                              
                      </select>
                       </div>
			
			<div class="form-group col-lg-3">
            <input type="text" id='uaction_type' name="uaction_type" value="edit" hidden/> 
            <label>Action</label><br/>
			<button type="button" class="btn btn-primary update" id="<?php echo $result['SurveyAreaCodeId']; ?>" name="update">Update Record</button>
			<button type="button" href="javascript:void(0);" class="btn btn-default" id="cancel" name="add" onclick="$('#link-update').slideUp(400);$('#show-add').show(700);">Cancel</button>
		</div>
	<?php
    
}
	?>

<script type="text/javascript">
	$('.update').click(function() {
		var id = $(this).attr('id');
        var SurveyAreaCode = $('#uSurveyAreaCode').val();
        var SurveyAreaName = $('#uSurveyAreaName').val();
        var BranchId = $("#uBranchName option:selected").val();
        var CountryId = $("#uCountryName option:selected").val();
        var StateId = $("#uStateName option:selected").val();
        var CityId = $("#uCityName option:selected").val();
        var action_type = $('#uaction_type').val();
        //var password = $('#password').val();
        //console.log(UTrustTypeName);
        $.ajax({
            url: "update.php",
            type: "POST",
            data: { id: id,SurveyAreaCode: SurveyAreaCode,SurveyAreaName:SurveyAreaName,BranchId:BranchId,CountryId:CountryId,StateId:StateId,CityId:CityId, action_type : action_type},
            success: function(data, status, xhr) {
                $('#USurveyAreaCodeName').val('');
                //alert(data);
                if(data == 'success'){
                    $('#records_content').fadeOut(1100).html(data);
                    $.get("view.php", function(html) {
                        $("#table_content").html(html);
                    });
                    $('#records_content').fadeOut(1100).html(data);

                }
               
            },
            complete: function() {
                $('#link-add').hide();
                $('#link-update').hide();
                $('#show-add').show(700);
            }
        });
    }); // update close

    
$('#uCountryName').on('change',function() {
    //var StateName = $('#StateName').val();
    var CountryId = $("#uCountryName option:selected").val();
    var action_type = "add"
   // alert(CountryId);

    $.ajax({
        url: "../../MasterManagement/City/getState.php",
        type: "POST",
        data: { id : CountryId, action_type : action_type},
        //processData: false,
        //contentType: false,
        success: function(data, status, xhr) {
           // console.log(data);
           // $('#StateName').val('');
           //$.each(data, function(index) {
            //console.log(data[index].StateId);
             //   console.log(data[index].StateId);
                //alert(data[index].TEST2);
        // });
        
        $('#uStateName').html(data);
        var StateId = $("#uStateName option:selected").val();
    var action_type = "add";
   // alert(CountryId);

    $.ajax({
        url: "getCity.php",
        type: "POST",
        data: { id : StateId, action_type : action_type},
        //processData: false,
        //contentType: false,
        success: function(data, status, xhr) {
           // console.log(data);
           // $('#StateName').val('');
           //$.each(data, function(index) {
            //console.log(data[index].StateId);
             //   console.log(data[index].StateId);
                //alert(data[index].TEST2);
        // });
        
        $('#uCityName').html(data);
        }
    });
        }
    });
}); // add close

$('#uStateName').on('change',function() {
    //var StateName = $('#StateName').val();
    var StateId = $("#uStateName option:selected").val();
    var action_type = "add";
   // alert(CountryId);

    $.ajax({
        url: "getCity.php",
        type: "POST",
        data: { id : StateId, action_type : action_type},
        //processData: false,
        //contentType: false,
        success: function(data, status, xhr) {
           // console.log(data);
           // $('#StateName').val('');
           //$.each(data, function(index) {
            //console.log(data[index].StateId);
             //   console.log(data[index].StateId);
                //alert(data[index].TEST2);
        // });
        
        $('#uCityName').html(data);
        }
    });
}); // add close

</script>