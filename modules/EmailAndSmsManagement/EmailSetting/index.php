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
//$CountryName = $db->getRows('Country',array('order_by'=>'CountryId DESC'));
$BranchName = $db->getRows('EmailSettings',array('order_by'=>'EmailSettingsId DESC'));

?>
 <div class="container-fluid" style="padding: 0px; margin: 0px;">
        <div class="">
            <h1 class="text-center">Email Settings Management </h1>
        </div>
    </div>
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
            <div id="link-update" >
                </div>
                <div class="pull-right">
                    <button class="btn btn-success" id="show-add">Add New Email Settings</button>
                </div>
            
                <div id="link-add" >
                <div class="form-group col-lg-3">
                <label>Mail Server</label>
                        <input type="text"  name="MailServer" id="MailServer" placeholder="Mail Server" class="form-control" required />
                   
                <label>Email From</label>
                        <input type="email"  name="EmailFrom" id="EmailFrom" placeholder="Email From" class="form-control" required />
                      
                    
                    </div>
                    <div class="form-group col-lg-3">
                    
                    <label>User Name</label>
                        <input type="text"  name="UserName" id="UserName" placeholder="Username" class="form-control" required />
                    
                    <label>Password</label>
                        <input type="password"  name="Password" id="Password" placeholder="Password" class="form-control" required />
                    
                    </div>
                    <div class="form-group col-lg-3">
                   
                    <label>Port</label>
                        <input type="text"  name="Port" id="Port" placeholder="Port" class="form-control" required />
                   
                    </div>
                    <input type="text" id='action_type' name="action_type" value="add" hidden/> 
                   
                    <div class="form-group col-lg-3">
                    <label>Action</label><br/>
                        <button type="button" class="btn btn-primary" id="add" name="add">Add Email Settings</button>
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
 
    var MailServer = $('#MailServer').val();

    var EmailFrom = $('#EmailFrom').val();
    var UserName = $('#UserName').val();
    var Password = $('#Password').val();
    var Port = $('#Port').val();
    
    var action_type = $('#action_type').val();
   // alert(CountryName);
   // console.log(PaymentTypeName);
    $.ajax({
        url: "add.php",
        type: "POST",
        data: { MailServer:MailServer,EmailFrom:EmailFrom,UserName:UserName,Password:Password,Port:Port, action_type : action_type},
        //processData: false,
        //contentType: false,
        success: function(data, status, xhr) {
           // alert(data);
           
            $('#MailServer').val('');
            $('#EmailFrom').val('');
            $('#UserName').val('');
            $('#Password').val('');
            $('#Port').val('');
           //$("#BranchName").val();
            //alert(data);
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
            $('#link-update').hide();
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

