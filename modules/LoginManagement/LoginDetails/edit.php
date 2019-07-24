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
    $result = $db->getRows('Employee',array('where'=>array('EmployeeId'=>$id),'return_type'=>'single'));

	if(!empty($result)){ 
        
        $RoleName = $db->getRows('Role',array('order_by'=>'RoleId DESC'));
        $BranchName = $db->getRows('BranchLocation',array('order_by'=>'BranchId DESC'));
            ?>
        <?php
		?>
		<div class="form-inline" id="edit-data">
        <div class="form-group col-lg-3">
                      <img id="upreview" class="img-thumbnail" style="width:90%" src="<?php echo $result['EmployeeImageUrl'] ?>" />
                       
        </div>
                <div class="form-group col-lg-3">
                <label>Employee Name</label>
                        <input type="text"  name="uEmployeeName" id="uEmployeeName" value="<?php echo  $result['EmployeeName'];?>" class="form-control" required />
                    
                        <label>Role Name</label>
                        
                        <select class="form-control select2" id="uRoleId" style="width: 100%;">
                        <?php
                                    echo '<option vaue="">No Role</option>';
                                if(!empty($RoleName) && !empty($result['RoleId'])){ 
                                    foreach($RoleName as $res){
                                                    if($res['RoleId'] == $result['RoleId']){
                                                        echo "<option value='".$res['RoleId']."' selected>".$res['RoleName']."</option>";
                                                    }else{
                                                        echo "<option value='".$res['RoleId']."'>".$res['RoleName']."</option>";
                                                    }
                                                       

                                }
                            }
                                else{
                                    echo '<option vaue="">No Role</option>';
                                }
                        ?>
                        </select>
                        </div>
                    <div class="form-group col-lg-3">
                    <label>Branch Type</label>
                        
                        <select class="form-control select2" id="uBranchId" style="width: 100%;">
                        <?php
                            echo '<option vaue="">No Branch Name</option>';
                                if(!empty($BranchName) && !empty($result['BranchId'])){ 
                                    foreach($BranchName as $res){
                                                    if($res['BranchId'] == $result['BranchId']){
                                                        echo "<option value='".$res['BranchId']."' selected>".$res['BranchName']."</option>";
                                                    }else{
                                                        echo "<option value='".$res['BranchId']."'>".$res['BranchName']."</option>";
                                                    }
                                                       

                                }
                            }
                                else{
                                    echo '<option vaue="">No Branch</option>';
                                }
                        ?>
                        </select>
                    <label>Profile Picture</label>
                        <input type="file" onchange="showMyImage(this,'upreview')" name="uEmployeeImageUrl" id="uEmployeeImageUrl" class="form-control" required />
                    
                    </div>
                   
                    <input type="text" id='uaction_type' name="uaction_type" value="edit" hidden/> 
                   
                    <div class="form-group col-lg-3">
                    <label>Action</label><br/>
                    
			<button type="button" class="btn btn-primary update" id="<?php echo $result['BranchId']; ?>" name="update">Update Emplyee</button>
			<button type="button" href="javascript:void(0);" class="btn btn-default" id="cancel" name="add" onclick="$('#link-update').slideUp(400);$('#show-add').show(700);">Cancel</button>
		
        </div>
        </div>
	<?php
    
}
	?>

<script type="text/javascript">
	$('.update').click(function() {
		var id = $(this).attr('id');
        var EmployeeName = $('#uEmployeeName').val();
        var RoleId = $("#uRoleId option:selected").val();
        var BranchId = $("#uBranchId option:selected").val();
    
        var EmployeeImageUrl = $('#upreview').attr('src');
        var action_type = $('#uaction_type').val();
      //  var BranchLogoImageUrl = $('#upreview').attr('src');
        //var password = $('#password').val();
        //console.log(UTrustTypeName);
        $.ajax({
            url: "update.php",
            type: "POST",
            data: { id: id, EmployeeName : EmployeeName, RoleId : RoleId,BranchId:BranchId,EmployeeImageUrl:EmployeeImageUrl, action_type : action_type },
            success: function(data, status, xhr) {
                $('#EmployeeName').val('');
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
</script>