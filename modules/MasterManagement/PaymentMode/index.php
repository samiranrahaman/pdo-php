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


?>
 <div class="container-fluid" style="padding: 0px; margin: 0px;">
        <div class="">
            <h1 class="text-center">Payment Mode Management </h1>
        </div>
    </div>
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
            <div id="records_content"></div>
            <div id="link-update" >
                </div>
                <div class="pull-right">
                    <button class="btn btn-success" id="show-add">Add New Record</button>
                </div>
            
                <div id="link-add" >
                <div class="form-group col-lg-3">
                        
                    </div>
                    <div class="form-group col-lg-6">
                    <label>Payment Mode Name</label>
                        <input type="text"  name="PaymentModeName" id="PaymentModeName" placeholder="Payment Mode Name" class="form-control" required />
                    </div>
                    <input type="text" id='action_type' name="action_type" value="add" hidden/> 
                   
                    <div class="form-group col-lg-3">
                    <label>Action</label><br/>
                        <button type="button" class="btn btn-primary" id="add" name="add">Add Record</button>
                        <button type="button" href="javascript:void(0);" class="btn btn-default" id="cancel" name="add" onclick="$('#link-add').slideUp(400);$('#show-add').show(600);">Cancel</button>
                    </div>
                </div>
          
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                
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
    var PaymentModeName = $('#PaymentModeName').val();
    var action_type = $('#action_type').val();
   // alert(CountryName);
   //console.log(PaymentModeName);
    $.ajax({
        url: "add.php",
        type: "POST",
        data: { PaymentModeName: PaymentModeName, action_type : action_type},
        //processData: false,
        //contentType: false,
        success: function(data, status, xhr) {
           // alert(data);
            $('#PaymentModeName').val('');
            //alert(data);
           if(data == 'success'){
                $.get("view.php", function(data) {
                        $("#table_content").html(data);
                    });
                $('#records_content').fadeOut(3000).html("<div class='callout callout-success' ><span>Data Successfully Added!</span></div>");
               
           }else{
            $('#records_content').fadeIn(3000).html("<div class='callout callout-danger' ><span>Error Occured!</span></div>");
           }
            
        },
        error: function() {
            //$('#records_content').fadeIn(3000).html('<div class="text-center">error here</div>');
            $('#records_content').fadeIn(3000).html("<div class='callout callout-danger' ><span>Error Occured!</span></div>");
        },
        beforeSend: function() {
            $('#records_content').fadeOut(700).html("<div class='overlay'><i class='fa fa-refresh fa-spin'></i> </div>");
        },
        complete: function() {
            $('#link-add').hide();
            $('#link-update').hide();
            $('#show-add').show(700);
        }
    });
}); // add close

});
    </script>

