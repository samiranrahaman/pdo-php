<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
$db = new Crud();
$id = $_POST['id'];
$BranchName = $db->getRows('BranchLocation',array('order_by'=>'BranchId DESC'));

	if(empty($id))
	{
		?><div class="text-center">no records found under this selection <a href="#" onclick="$('#link-update').hide();$('#show-add').show(700);">Hide this</a></div>
		<?php
		die();
	}

	$result = $db->getRows('SurveyConclusionQuestion',array('where'=>array('SurveyConclusionQuestionId'=>$id),'return_type'=>'single'));

	if(!empty($result)){ 
        
       
            ?>
        <?php
		?>
		<div class="form-inline" id="edit-data">

        
        <div class="form-group col-lg-3">
        <label>Survey Conclusion Question  Name</label>
                        <input type="text" style="width: 100%" name="uSurveyConclusionQuestionName" id="uSurveyConclusionQuestionName" value="<?php echo $result['SurveyConclusionQuestionName'];?>" class="form-control" required />
                   
                  <br/>
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
                             
        </div>
                    <div class="form-group col-lg-3">
                    <label>Option1</label>
                        <input type="text" style="width: 100%" name="uoption1" id="uoption1" value="<?php echo $result['option1'];?>" class="form-control" required />
                    
                    <label>Option2</label>
                        <input type="text" style="width: 100%" name="uoption2" id="uoption2" value="<?php echo $result['option2'];?>" class="form-control" required />
                 
                    </div>
                    <div class="form-group col-lg-3">
                    <label>Option3</label>
                        <input type="text" style="width: 100%" name="uoption3" id="uoption3" value="<?php echo $result['option3'];?>" class="form-control" required />
                    
                    <label>Option4</label>
                        <input type="text" style="width: 100%" name="uoption4" id="uoption4" value="<?php echo $result['option4'];?>" class="form-control" required />
                 
                    </div>
                      
			
			<div class="form-group col-lg-3">
            <input type="text" id='uaction_type' name="uaction_type" value="edit" hidden/> 
            <label>Action</label><br/>
			<button type="button" class="btn btn-primary update" id="<?php echo $result['SurveyConclusionQuestionId']; ?>" name="update">Update Record</button>
			<button type="button" href="javascript:void(0);" class="btn btn-default" id="cancel" name="add" onclick="$('#link-update').slideUp(400);$('#show-add').show(700);">Cancel</button>
		</div>
	<?php
    
}
	?>

<script type="text/javascript">
	$('.update').click(function() {
		var id = $(this).attr('id');
        
        var SurveyConclusionQuestionName = $('#uSurveyConclusionQuestionName').val();
        var option1 = $('#uoption1').val();
        var option2 = $('#uoption2').val();
        var option3 = $('#uoption3').val();
        var option4 = $('#uoption4').val();
        var BranchId = $("#uBranchName option:selected").val();
        var action_type = $('#uaction_type').val();
        //var password = $('#password').val();
       // console.log(SurveyConclusionQuestionName);
        $.ajax({
            url: "update.php",
            type: "POST",
            data: { id: id,SurveyConclusionQuestionName:SurveyConclusionQuestionName,option1:option1,option2:option2,option3:option3,option4:option4,BranchId:BranchId, action_type : action_type},
            success: function(data, status, xhr) {
                $('#USurveyConclusionQuestionName').val('');
                $('#uoption1').val('');
                $('#uoption2').val('');
                $('#uoption3').val('');
                $('#uoption4').val('');
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

    
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
   /* $('.select2').on('change', function() {
      var data = $(".select2 option:selected").val();
      console.log(data);
    })*/
  })

</script>