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

    $result = $db->getRows('RoleAssignment',array('where'=>array('Id'=>$id),'return_type'=>'single'));
    $RoleName = $db->getRows('Role',array('order_by'=>'RoleId DESC'));
    $ModuleName = $db->getRows('Module',array('order_by'=>'ModuleId DESC'));

	if(!empty($result)){ 
        
       
            ?>
        <?php
		?>
		<div class="form-inline" id="edit-data">
        <div class="form-group col-lg-3">
                <label>Role</label>
                      

                      <select class="form-control select2" id="uRoleName" style="width: 100%;">
                      <?php
                                 echo '<option vaue="">Select Role</option>';
                              if(!empty($RoleName)){ foreach($RoleName as $res){
                                  if($result['RoleId'] == $res['RoleId']){
                                    echo "<option value='".$res['RoleId']."' selected>".$res['RoleName']."</option>";

                                  }else{
                                    echo "<option value='".$res['RoleId']."'>".$res['RoleName']."</option>";

                                  }
                                                     
                              }}
                              else{
                                  echo '<option vaue="">No Role</option>';
                              }
                      ?>
                      </select>
                      <label>Module</label>
                      

                        <select class="form-control select2" id="uModuleName" style="width: 100%;">
                        <?php
                                 echo '<option vaue="">Select Module</option>';
                                if(!empty($ModuleName)){ foreach($ModuleName as $res){
                                    if($result['ModuleId'] == $res['ModuleId']){
                                        echo "<option value='".$res['ModuleId']."' selected>".$res['ModuleTitle']."</option>";

                                    }else{
                                        echo "<option value='".$res['ModuleId']."'>".$res['ModuleTitle']."</option>";

                                    }
                                                      
                                }}
                                else{
                                    echo '<option vaue="">No Module</option>';
                                }
                        ?>
                        </select>
                        
                    </div>
                    <div class="form-group col-lg-3">
                        <div class="checkbox icheck">
                            <label>
                            <?php if($result['IsAdd'] == 1){?>

                                <input name="uIsAdd" id="uIsAdd" type="checkbox" checked> IsAdd
                                <?php  
                            } else{?>
                            <input name="uIsAdd" id="uIsAdd" type="checkbox"> IsAdd
                            <?php } ?>
                            </label>
                        </div>  <br/>
                        <div class="checkbox icheck">
                            <label>
                            <?php if($result['IsEdit'] == 1){?>

                                <input name="uIsEdit" id="uIsEdit" type="checkbox" checked> IsEdit
                                <?php  
                                } else{?>
                                <input name="uIsEdit" id="uIsEdit" type="checkbox"> IsEdit
                                <?php } ?>
                           
                            </label>
                        </div>  <br/>
                        <div class="checkbox icheck">
                            <label>
                            <?php if($result['IsDelete'] == 1){?>

                                <input name="uIsDelete" id="uIsDelete" type="checkbox" checked> IsDelete
                                <?php  
                                } else{?>
                                <input name="uIsDelete" id="uIsDelete" type="checkbox"> IsDelete
                                <?php } ?>
                           
                            </label>
                        </div>  <br/>
                        <div class="checkbox icheck">
                            <label>
                            <?php if($result['IsDelete'] == 1){?>

                            <input name="uIsView" id="uIsView" type="checkbox" checked> IsView
                            <?php  
                            } else{?>
                            <input name="uIsView" id="uIsView" type="checkbox"> IsView
                            <?php } ?>
                           
                            </label>
                        </div>  
                    </div>


                    <div class="form-group col-lg-3">
                   
                        <div class="checkbox icheck">
                            <label>
                            <?php if($result['IsPrint'] == 1){?>

                            <input name="uIsPrint" id="uIsPrint" type="checkbox" checked> IsPrint
                            <?php  
                            } else{?>
                            <input name="uIsPrint" id="uIsPrint" type="checkbox"> IsPrint
                            <?php } ?>
                           
                            </label>
                        </div>  <br/>
                        <div class="checkbox icheck">
                            <label>
                            <?php if($result['IsDownload'] == 1){?>

                            <input name="uIsDownload" id="uIsDownload" type="checkbox" checked> IsDownload
                            <?php  
                            } else{?>
                            <input name="uIsDownload" id="uIsDownload" type="checkbox"> IsDownload
                            <?php } ?>
                          
                            </label>
                        </div>  <br/>
                        <div class="checkbox icheck">
                            <label>
                            <?php if($result['IsShare'] == 1){?>

                                <input name="uIsShare" id="uIsShare" type="checkbox" checked> IsShare
                                <?php  
                                } else{?>
                                <input name="uIsShare" id="uIsShare" type="checkbox"> IsShare
                                <?php } ?>
                           
                            </label>
                        </div>  
                                </div>
                                <input type="text" id='uaction_type' name="uaction_type" value="edit" hidden/> 
            
			<div class="form-group col-lg-3">
           <label>Action</label><br/>
			<button type="button" class="btn btn-primary update" id="<?php echo $result['Id']; ?>" name="update">Update Role Assignment</button>
			<button type="button" href="javascript:void(0);" class="btn btn-default" id="cancel" name="add" onclick="$('#link-update').slideUp(400);$('#show-add').show(700);">Cancel</button>
		</div>
	<?php
    
}
	?>

<script type="text/javascript">
	$('.update').click(function() {
		var id = $(this).attr('id');
        var RoleId = $('#uRoleName').val();
        var ModuleId = $('#uModuleName').val();
        var IsAdd = $('#uIsAdd').prop('checked')? 1: 0;
        var IsEdit = $('#uIsEdit').prop('checked')? 1: 0;
        var IsDelete = $('#uIsDelete').prop('checked')? 1: 0;
        var IsView = $('#uIsView').prop('checked')? 1: 0;
        var IsPrint = $('#uIsPrint').prop('checked')? 1: 0;
        var IsDownload = $('#uIsDownload').prop('checked')? 1: 0;
        var IsShare = $('#uIsShare').prop('checked')? 1: 0;
       
        var action_type = $('#uaction_type').val();
        //var password = $('#password').val();

        $.ajax({
            url: "update.php",
            type: "POST",
            data: { id: id, RoleId: RoleId,ModuleId:ModuleId,IsAdd:IsAdd,IsEdit:IsEdit,IsDelete:IsDelete,IsView:IsView,IsPrint:IsPrint,IsDownload:IsDownload,IsShare:IsShare, action_type : action_type },
            success: function(data, status, xhr) {
                $('#uRoleName').val('');
                $('#uModuleName').val('');
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