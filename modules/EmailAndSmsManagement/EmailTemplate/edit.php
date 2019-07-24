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

	$result = $db->getRows('EmailTemplate',array('where'=>array('EmailTemplateId'=>$id),'return_type'=>'single'));

	if(!empty($result)){ 
        
       
            ?>
        <?php
		?>
		<div class="form-inline" id="edit-data">

        
        <div class="form-group col-lg-3">
        
                 
        </div>
                    <div class="form-group col-lg-6">
                    <label>Email Template  Name</label>
                        <input type="text" style="width: 100%" name="uEmailTemplateName" id="uEmailTemplateName" value="<?php echo $result['EmailTemplateName'];?>" class="form-control" required />
                   
                    <label>Email Subject</label>
                        <input type="text" style="width: 100%" name="uEmailTemplateSubject" id="uEmailTemplateSubject" value="<?php echo $result['EmailTemplateSubject'];?>" class="form-control" required />
                    
                    <label>Email Description</label>
                  <div class="box box-info">
            <div class="box-header">
             
              <!-- tools box 
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <form>
                    <textarea name="uEmailTemplateDescription" id="uEmailTemplateDescription" rows="10" cols="80" >
                    <?php echo $result['EmailTemplateDescription'];?>             
                    </textarea>
              </form>
            </div>
          </div>
                    </div>
                  
                      
			
			<div class="form-group col-lg-3">
            <input type="text" id='uaction_type' name="uaction_type" value="edit" hidden/> 
            <label>Action</label><br/>
			<button type="button" class="btn btn-primary update" id="<?php echo $result['EmailTemplateId']; ?>" name="update">Update Email Template</button>
			<button type="button" href="javascript:void(0);" class="btn btn-default" id="cancel" name="add" onclick="$('#link-update').slideUp(400);$('#show-add').show(700);">Cancel</button>
		</div>
	<?php
    
}
	?>

<script type="text/javascript">
	$('.update').click(function() {
		var id = $(this).attr('id');
        
        var EmailTemplateName = $('#uEmailTemplateName').val();
        var EmailTemplateSubject = $('#uEmailTemplateSubject').val();
        var EmailTemplateDescription = CKEDITOR.instances["uEmailTemplateDescription"].getData();
        
        var action_type = $('#uaction_type').val();
        //var password = $('#password').val();
       // console.log(EmailTemplateName);
        $.ajax({
            url: "update.php",
            type: "POST",
            data: { id: id,EmailTemplateName:EmailTemplateName,EmailTemplateSubject:EmailTemplateSubject,EmailTemplateDescription:EmailTemplateDescription, action_type : action_type},
            success: function(data, status, xhr) {
                $('#uEmailTemplateName').val('');
                $('#uEmailTemplateSubject').val('');
               // $('#uEmailTemplateDescription').val('');
               CKEDITOR.instances["uEmailTemplateDescription"].setData("");
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
    CKEDITOR.replace('uEmailTemplateDescription')
  })

</script>