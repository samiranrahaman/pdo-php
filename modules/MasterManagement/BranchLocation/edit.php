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

	$result = $db->getRows('BranchLocation',array('where'=>array('BranchId'=>$id),'return_type'=>'single'));

	if(!empty($result)){ 
        
        $TrustTypeName = $db->getRows('TrustType',array('order_by'=>'TrustTypeId DESC'));
            ?>
        <?php
		?>
		<div class="form-inline" id="edit-data">
        <div class="form-group col-lg-3">
                      <img id="upreview" class="img-thumbnail" style="width:90%" src="<?php echo $result['BranchLogoImageUrl'] ?>" />
                       
                     </div>
                <div class="form-group col-lg-3">
                <label>Branch Code</label>
                        <input type="text"  name="uBranchCode" id="uBranchCode" value="<?php echo  $result['BranchCode'];?>" class="form-control" required />
                    
                    <label>Branch Name</label>
                        <input type="text"  name="uBranchName" id="uBranchName" value="<?php echo $result['BranchName'];?>" class="form-control" required />
                    
                    </div>
                    <div class="form-group col-lg-3">
                    <label>Trust Type</label>
                        
                        <select class="form-control select2" id="uBranchTrustTypeId" style="width: 100%;">
                        <?php

                                if(!empty($TrustTypeName) && !empty($result['BranchTrustTypeId'])){ 
                                    foreach($TrustTypeName as $res){
                                                    if($res['TrustTypeId'] == $result['BranchTrustTypeId']){
                                                        echo "<option value='".$res['TrustTypeId']."' selected>".$res['TrustTypeName']."</option>";
                                                    }else{
                                                        echo "<option value='".$res['TrustTypeId']."'>".$res['TrustTypeName']."</option>";
                                                    }
                                                       

                                }
                            }
                                else{
                                    echo '<option vaue="">No Trust Name</option>';
                                }
                        ?>
                        </select>
                    <label>Branch Logo</label>
                        <input type="file" onchange="showMyImage(this,'upreview')" name="uBranchLogoImageUrl" id="uBranchLogoImageUrl" class="form-control" required />
                    
                    </div>
                   
                    <input type="text" id='uaction_type' name="uaction_type" value="edit" hidden/> 
                   
                    <div class="form-group col-lg-3">
                   
                    <label>Action</label><br/>
			<button type="button" class="btn btn-primary update" id="<?php echo $result['BranchId']; ?>" name="update">Update Record</button>
			<button type="button" href="javascript:void(0);" class="btn btn-default" id="cancel" name="add" onclick="$('#link-update').slideUp(400);$('#show-add').show(700);">Cancel</button>
		
        </div>
	<?php
    
}
	?>

<script type="text/javascript">
	$('.update').click(function() {
		var id = $(this).attr('id');
        var BranchName = $('#uBranchName').val();
        var BranchCode = $('#uBranchCode').val();
        var BranchTrustTypeId = $("#uBranchTrustTypeId option:selected").val();
        var action_type = $('#uaction_type').val();
        var BranchLogoImageUrl = $('#upreview').attr('src');
        //var password = $('#password').val();
        //console.log(UTrustTypeName);
        $.ajax({
            url: "update.php",
            type: "POST",
            data: { id: id, BranchCode: BranchCode,BranchName:BranchName,BranchTrustTypeId:BranchTrustTypeId,BranchLogoImageUrl:BranchLogoImageUrl, action_type: action_type },
            success: function(data, status, xhr) {
                $('#uBranchName').val('');
                $('#uBranchCode').val('');
                $("#uBranchTrustTypeId option:selected").val('');
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