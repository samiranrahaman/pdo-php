<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
$projectPath = "http://localhost/SBM/";
session_start();
// Check to see if the session user email exists.
if(!isset($_SESSION['email'])) {

    header("Location: ../../../index"); // Since the session userid doesn't exist, redirect them back to the login page.
  die(); // Ignore anything after this. Redundant, but trying to be safe here.

}
include_once $serverRoot.'/SBM/includes/layouts/header.php';
include_once $serverRoot.'/SBM/includes/layouts/navbar.php';
include_once $serverRoot.'/SBM/includes/logics/Crud.php';
    $db = new Crud();

    $RoleName = $db->getRows('Role',array('order_by'=>'RoleId DESC'));
    $ModuleName = $db->getRows('Module',array('order_by'=>'ModuleId DESC'));
?>
 <div class="container-fluid" style="padding: 0px; margin: 0px;">
        <div class="">
            <h1 class="text-center">Role Assignment Management </h1>
        </div>
    </div>
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
            <div id="link-update" >
                </div>
                <div class="pull-right">
                    <button class="btn btn-success" id="show-add">Assign New Role</button>
                </div>
            
                <div id="link-add" >
                <div class="form-group col-lg-3">
                <label>Role</label>
                      

                      <select class="form-control select2" id="RoleName" style="width: 100%;">
                      <?php
                                 echo '<option vaue="">Select Role</option>';
                              if(!empty($RoleName)){ foreach($RoleName as $res){
                                                     echo "<option value='".$res['RoleId']."'>".$res['RoleName']."</option>";

                              }}
                              else{
                                  echo '<option vaue="">No Role</option>';
                              }
                      ?>
                      </select>
                      <label>Module</label>
                      

                        <select class="form-control select2" id="ModuleName" style="width: 100%;">
                        <?php
                                 echo '<option vaue="">Select Module</option>';
                                if(!empty($ModuleName)){ foreach($ModuleName as $res){
                                                       echo "<option value='".$res['ModuleId']."'>".$res['ModuleTitle']."</option>";

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
                            <input name="IsAdd" id="IsAdd" type="checkbox"> IsAdd
                            </label>
                        </div>  
                        <div class="checkbox icheck">
                            <label>
                            <input name="IsEdit" id="IsEdit" type="checkbox"> IsEdit
                            </label>
                        </div>  
                        <div class="checkbox icheck">
                            <label>
                            <input name="IsDelete" id="IsDelete" type="checkbox"> IsDelete
                            </label>
                        </div>  
                        <div class="checkbox icheck">
                            <label>
                            <input name="IsView" id="IsView" type="checkbox"> IsView
                            </label>
                        </div>  
                    </div>


                    <div class="form-group col-lg-3">
                   
                        <div class="checkbox icheck">
                            <label>
                            <input name="IsPrint" id="IsPrint" type="checkbox"> IsPrint
                            </label>
                        </div>  
                        <div class="checkbox icheck">
                            <label>
                            <input name="IsDownload" id="IsDownload" type="checkbox"> IsDownload
                            </label>
                        </div>  
                        <div class="checkbox icheck">
                            <label>
                            <input name="IsShare" id="IsShare" type="checkbox"> IsShare
                            </label>
                        </div>  
                                </div>
                    <input type="text" id='action_type' name="action_type" value="add" hidden/> 
                   
                    <div class="form-group col-lg-3">
                    <label>Action</label><br/>
                        <button type="button" class="btn btn-primary" id="add" name="add">Assign Role</button>
                        <button type="button" href="javascript:void(0);" class="btn btn-default" id="cancel" name="add" onclick="$('#link-add').slideUp(400);$('#show-add').show(600);">Cancel</button>
                    </div>
                </div>
          
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="records_content"></div>
                <br>
                <div class="col-md-12" id="table_content">
                </div>
            </div>
        </div>
    </div>
<?php
        include_once '../../../includes/layouts/footer.php';
?>
    <script type="text/javascript">
    
    $(document).ready(function(){

$.get("view.php", function(data) {
    $("#table_content").html(data);
});


$('#link-add').hide();

$('#show-add').click(function() {
    $('#link-add').slideDown(500);
    $('#show-add').hide();
});

$('#add').click(function() {
    var RoleId = $('#RoleName').val();
    var ModuleId = $('#ModuleName').val();
    var IsAdd = $('#IsAdd').prop('checked')? 1: 0;
    var IsEdit = $('#IsEdit').prop('checked')? 1: 0;
    var IsDelete = $('#IsDelete').prop('checked')? 1: 0;
    var IsView = $('#IsView').prop('checked')? 1: 0;
    var IsPrint = $('#IsPrint').prop('checked')? 1: 0;
    var IsDownload = $('#IsDownload').prop('checked')? 1: 0;
    var IsShare = $('#IsShare').prop('checked')? 1: 0;
    var action_type = $('#action_type').val();
  // alert(IsAdd);

    $.ajax({
        url: "add.php",
        type: "POST",
        data: { RoleId: RoleId,ModuleId:ModuleId,IsAdd:IsAdd,IsEdit:IsEdit,IsDelete:IsDelete,IsView:IsView,IsPrint:IsPrint,IsDownload:IsDownload,IsShare:IsShare, action_type : action_type},
        //processData: false,
        //contentType: false,
        success: function(data, status, xhr) {
          // alert(data);
            $('#RoleName').val('');
            $('#ModuleName').val('');
           // alert(data);
           if(data == 'success'){
                $.get("view.php", function(data) {
                        $("#table_content").html(data);
                    });
                $('#records_content').fadeOut(1100).html(data);
           }else{
            $('#records_content').fadeIn(3000).html('<div class="text-center">error here</div>');
           }
            
        },
        error: function() {
            //$('#records_content').fadeIn(3000).html('<div class="text-center">error here</div>');
        },
        beforeSend: function() {
            $('#records_content').fadeOut(700).html('<div class="text-center">Loading...</div>');
        },
        complete: function() {
            $('#link-add').hide();
            $('#show-add').show(700);
        }
    });
}); // add close

});

$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
   /* $('.select2').on('change', function() {
      var data = $(".select2 option:selected").val();
      console.log(data);
    })*/
  })
    </script>

