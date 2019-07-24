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

$CountryName = $db->getRows('Country',array('order_by'=>'CountryId DESC'));
?>
 <div class="container-fluid" style="padding: 0px; margin: 0px;">
        <div class="">
            <h1 class="text-center">State Management </h1>
        </div>
    </div>
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    <button class="btn btn-success" id="show-add">Add New Record</button>
                </div>
                <div id="link-update" >
                </div>
                <div id="link-add" >

                <div class="form-group col-lg-3">
                </div>
                <div class="form-group col-lg-3">
                    <div class="form-group">
                        <label>Country</label>
                      

                        <select class="form-control select2" id="CountryName" style="width: 100%;">
                        <?php

                                if(!empty($CountryName)){ foreach($CountryName as $res){
                                                       echo "<option value='".$res['CountryId']."'>".$res['CountryName']."</option>";

                                }}
                                else{
                                    echo '<option vaue="">No Country</option>';
                                }
                        ?>
                        </select>
                    </div>
                    </div>
                    <div class="form-group col-lg-3">
                    <label>State Name</label>
                        <input type="text"  name="StateName" id="StateName" placeholder="State Name" class="form-control" required />
                    </div>
                   
                   
                    <div class="form-group col-lg-3">
                    <label>Action</label><br/>
                    <input type="text" id='action_type' name="action_type" value="add" hidden/> 
                        <button type="button" class="btn btn-primary" id="add" name="add">Add Record</button>
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
        include_once $serverRoot.'/SBM/includes/layouts/footer.php';
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
    var StateName = $('#StateName').val();
    var CountryId = $(".select2 option:selected").val();
    var action_type = $('#action_type').val();
   // alert(CountryName);

    $.ajax({
        url: "add.php",
        type: "POST",
        data: { StateName : StateName, CountryId : CountryId, action_type : action_type},
        //processData: false,
        //contentType: false,
        success: function(data, status, xhr) {
           // alert(data);
            $('#StateName').val('');
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
