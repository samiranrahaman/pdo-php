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

	$result = $db->getRows('Role',array('where'=>array('RoleId'=>$id),'return_type'=>'single'));

	if(!empty($result)){ 
        
       
            ?>
        <?php
		?>
		<div class="form-inline" id="edit-data">
        <div class="form-group col-lg-3">
				
                </div>
			<div class="form-group col-lg-6">
            <label>Role Name</label><br/>
				<input type="text" style="width: 90%;" name="uRoleName" id="uRoleName" value="<?php echo $result['RoleName']; ?>" class="form-control" required />
                <label>Description</label><br/>
				<input type="text" style="width: 90%;" name="uDescription" id="uDescription" value="<?php echo $result['Description']; ?>" class="form-control" required />
			
            </div>
			
			<div class="form-group col-lg-3">
            <input type="text" id='uaction_type' name="uaction_type" value="edit" hidden/> 
            <label>Action</label><br/>
			<button type="button" class="btn btn-primary update" id="<?php echo $result['RoleId']; ?>" name="update">Update Role</button>
			<button type="button" href="javascript:void(0);" class="btn btn-default" id="cancel" name="add" onclick="$('#link-update').slideUp(400);$('#show-add').show(700);">Cancel</button>
		</div>
	<?php
    
}
	?>

<script type="text/javascript">
	$('.update').click(function() {
		var id = $(this).attr('id');
        var RoleName = $('#uRoleName').val();
        var Description = $('#uDescription').val();
        var action_type = $('#uaction_type').val();
        //var password = $('#password').val();

        $.ajax({
            url: "update.php",
            type: "POST",
            data: { id: id, RoleName: RoleName,Description:Description, action_type: action_type },
            success: function(data, status, xhr) {
                $('#uRoleName').val('');
                $('#uDescription').val('');
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
</script>