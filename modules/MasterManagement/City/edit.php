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

	$result = $db->getRows('City',array('where'=>array('CityId'=>$id),'return_type'=>'single'));

	if(!empty($result)){ 
        
       
            ?>
        <?php
		?>
		<div id="edit-data">

                <div class="form-group col-lg-3">
                    <div class="form-group">
                        <label>City</label>
                      

                        <select class="form-control select2" id="uCountryName" style="width: 100%;">
                        <?php
                        
                        $CountryName = $db->getRows('Country',array('order_by'=>'CountryId DESC'));

                                if(!empty($CountryName) && !empty($result['CountryId'])){ foreach($CountryName as $res){
                                        if($res['CountryId'] == $result['CountryId']){
                                            echo "<option value='".$res['CountryId']."' selected>".$res['CountryName']."</option>";
                                        }else{
                                            echo "<option value='".$res['CountryId']."'>".$res['CountryName']."</option>";
                                        }
                                        

                                }}
                                else{
                                    echo '<option vaue="">No Country</option>';
                                }
                        ?>
                        </select>
                    </div>
                    </div>
                    <div class="form-group col-lg-3">
                    <div class="form-group">
                        <label>State Name</label>
                      

                        <select class="form-control select2" id="uStateName" style="width: 100%;">
                        <?php
                        
                        $StateName = $db->getRows('State',array('order_by'=>'StateId DESC'));

                                if(!empty($StateName) && !empty($result['StateId'])){ foreach($StateName as $res){
                                        if($res['StateId'] == $result['StateId']){
                                            echo "<option value='".$res['StateId']."' selected>".$res['StateName']."</option>";
                                        }else{
                                            echo "<option value='".$res['StateId']."'>".$res['StateName']."</option>";
                                        }
                                        

                                }}
                                else{
                                    echo '<option vaue="">No State</option>';
                                }
                        ?>
                        </select>

                    </div>
                    </div>
                    <div class="form-group col-lg-3">
                    <label>City Name</label>
				<input type="text" name="uCityName" id="uCityName" value="<?php echo $result['CityName']; ?>" class="form-control" required />
			</div>
			
			<div class="form-group col-lg-3">
            <input type="text" id='uaction_type' name="uaction_type" value="edit" hidden/> 
            <label>Action</label><br/>
			<button type="button" class="btn btn-primary update" id="<?php echo $result['CityId']; ?>" name="update">Update Record</button>
			<button type="button" href="javascript:void(0);" class="btn btn-default" id="cancel" name="add" onclick="$('#link-update').slideUp(400);$('#show-add').show(700);">Cancel</button>
		</div>
	<?php
    
}

	?>

<script type="text/javascript">
	$('.update').click(function() {
		var id = $(this).attr('id');
        var CountryId = $("#uCountryName option:selected").val();
        var StateId = $("#uStateName option:selected").val();
        var CityName = $('#uCityName').val();
        var action_type = $('#uaction_type').val();
        //var password = $('#password').val();

        $.ajax({
            url: "update.php",
            type: "POST",
            data: { id: id, CountryId : CountryId,StateId:StateId, CityName: CityName, action_type: action_type },
            success: function(data, status, xhr) {
                $('#uCityName').val('');
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
    var action_type = 'add';
   // alert(CountryId);

    $.ajax({
        url: "getState.php",
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
        }
    });
}); // add close

/*
    //var StateName = $('#StateName').val();
    var CountryId = $("#CountryName option:selected").val();
    var action_type = $('#action_type').val();
   // alert(CountryId);

    $.ajax({
        url: "getState.php",
        type: "POST",
        data: { id : CountryId, action_type : action_type},
        //processData: false,
        //contentType: false,
        success: function(data, status, xhr) {
            console.log(data);
            alert(data);
           // $('#StateName').val('');
           //$.each(data, function(index) {
            //console.log(data[index].StateId);
             //   console.log(data[index].StateId);
                //alert(data[index].TEST2);
        // });
        
          //  $('#StateName').html(data);
        }
    });
 // add close*/

</script>