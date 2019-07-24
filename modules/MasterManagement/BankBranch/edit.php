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

	$result = $db->getRows('BankBranch',array('where'=>array('BankId'=>$id),'return_type'=>'single'));

	if(!empty($result)){ 
        
       
            ?>
        <?php
		?>
		<div class="form-inline" id="edit-data">

        
        <div class="form-group col-lg-3">
                        
        </div>
                    <div class="form-group col-lg-6">
                    <label>Bank  Name</label>
                        <input type="text" style="width: 100%" name="uBankName" id="uBankName" value="<?php echo $result['BankName'];?>" class="form-control" required />
                   
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
            <input type="text" id='uaction_type' name="uaction_type" value="edit" hidden/> 
            <label>Action</label><br/>
			<button type="button" class="btn btn-primary update" id="<?php echo $result['BankId']; ?>" name="update">Update Record</button>
			<button type="button" href="javascript:void(0);" class="btn btn-default" id="cancel" name="add" onclick="$('#link-update').slideUp(400);$('#show-add').show(700);">Cancel</button>
		</div>
	<?php
    
}
	?>

<script type="text/javascript">
	$('.update').click(function() {
		var id = $(this).attr('id');
        
        var BankName = $('#uBankName').val();
        var BranchId = $("#uBranchName option:selected").val();
        var action_type = $('#uaction_type').val();
        //var password = $('#password').val();
       // console.log(BankName);
        $.ajax({
            url: "update.php",
            type: "POST",
            data: { id: id,BankName:BankName,BranchId:BranchId, action_type : action_type},
            success: function(data, status, xhr) {
                $('#UBankName').val('');
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