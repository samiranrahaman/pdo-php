<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
session_start();

include_once $serverRoot.'/SBM/includes/logics/Crud.php';
$db = new Crud();
$id = $_POST['id'];
//$BranchName = $db->getRows('BranchLocation',array('order_by'=>'BranchId DESC'));

	if(empty($id))
	{
		?><div class="text-center">no records found under this selection <a href="#" onclick="$('#link-update').hide();$('#show-add').show(700);">Hide this</a></div>
		<?php
		die();
	}

	$result = $db->getRows('SMSSettings',array('where'=>array('SMSSettingsId'=>$id),'return_type'=>'single'));

	if(!empty($result)){ 
        
       
            ?>
        <?php
		?>
		<div class="form-inline" id="edit-data">

        
        
        <div class="form-group col-lg-3">
                <label>Mail Server</label>
                        <input type="text"  name="uMailServer" id="uMailServer" value="<?php echo $result['MailServer']; ?>" class="form-control" required />
                   
                <label>SMS From</label>
                        <input type="nubmer"  name="uSMSFrom" id="uSMSFrom" value="<?php echo $result['SMSFrom']; ?>" class="form-control" required />
                      
                    
                    </div>
                    <div class="form-group col-lg-3">
                    
                    <label>User Name</label>
                        <input type="text"  name="uUserName" id="uUserName" value="<?php echo $result['UserName']; ?>" class="form-control" required />
                    
                    <label>Password</label>
                        <input type="password"  name="uPassword" id="uPassword" value="<?php echo $result['Password']; ?>" class="form-control" required />
                    
                    </div>
                    <div class="form-group col-lg-3">
                   
                    <label>Port</label>
                        <input type="text"  name="uPort" id="uPort" value="<?php echo $result['Port']; ?>" class="form-control" required />
                   
                    </div>
                      
			
			<div class="form-group col-lg-3">
            <input type="text" id='uaction_type' name="uaction_type" value="edit" hidden/> 
            <label>Action</label><br/>
			<button type="button" class="btn btn-primary update" id="<?php echo $result['SMSSettingsId']; ?>" name="update">Update SMS Settings</button>
			<button type="button" href="javascript:void(0);" class="btn btn-default" id="cancel" name="add" onclick="$('#link-update').slideUp(400);$('#show-add').show(700);">Cancel</button>
		</div>
	<?php
    
}
	?>

<script type="text/javascript">
	$('.update').click(function() {
		var id = $(this).attr('id');
        
        var MailServer = $('#uMailServer').val();

        var SMSFrom = $('#uSMSFrom').val();
        var UserName = $('#uUserName').val();
        var Password = $('#uPassword').val();
        var Port = $('#uPort').val();
        var action_type = $('#uaction_type').val();
        //var password = $('#password').val();
       // console.log(SMSSettingsName);
        $.ajax({
            url: "update.php",
            type: "POST",
            data: { id: id,MailServer:MailServer,SMSFrom:SMSFrom,UserName:UserName,Password:Password,Port:Port, action_type : action_type},
            success: function(data, status, xhr) {
                $('#uMailServer').val('');
                $('#uSMSFrom').val('');
                $('#uUserName').val('');
                $('#uPassword').val('');
                $('#uPort').val('');
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