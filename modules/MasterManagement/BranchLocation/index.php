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
$TrustTypeName = $db->getRows('TrustType',array('order_by'=>'TrustTypeId DESC'));
?>
 <div class="container-fluid" style="padding: 0px; margin: 0px;">
        <div class="">
            <h1 class="text-center">Branch Location Management </h1>
        </div>
    </div>
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
            <div id="link-update" >
                </div>
                <div class="pull-right">
                    <button class="btn btn-success" id="show-add">Add New Record</button>
                </div>
            
                <div id="link-add" >
                <div class="form-group col-lg-3">
                      <img id="preview" style="width:90%" src="../../../resources/images/BranchImages/noimage.png" />
                       
                     </div>
                <div class="form-group col-lg-3">
                <label>Branch Code</label>
                        <input type="text"  name="BranchCode" id="BranchCode" placeholder="Branch Code" class="form-control" required />
                    
                    <label>Branch Name</label>
                        <input type="text"  name="BranchName" id="BranchName" placeholder="Branch Name" class="form-control" required />
                    
                    </div>
                    <div class="form-group col-lg-3">
                    <label>Trust Type</label>
                        
                        <select class="form-control select2" id="BranchTrustTypeId" style="width: 100%;">
                        <?php

                                if(!empty($TrustTypeName)){ foreach($TrustTypeName as $res){
                                                       echo "<option value='".$res['TrustTypeId']."'>".$res['TrustTypeName']."</option>";

                                }}
                                else{
                                    echo '<option vaue="">No Trust Name</option>';
                                }
                        ?>
                        </select>
                    <label>Branch Logo</label>
                        <input type="file" onchange="showMyImage(this,'preview')" name="BranchLogoImageUrl" id="BranchLogoImageUrl" class="form-control" required />
                    
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
    var BranchName = $('#BranchName').val();
    var BranchCode = $('#BranchCode').val();
    var BranchTrustTypeId = $("#BranchTrustTypeId option:selected").val();
    var action_type = $('#action_type').val();
    var BranchLogoImageUrl = $('#preview').attr('src');
  //  alert(BranchLogoImageUrl);
   // console.log(BranchLogoImageUrl);
    $.ajax({
        url: "add.php",
        type: "POST",
        data: { BranchCode : BranchCode, BranchName: BranchName, BranchTrustTypeId : BranchTrustTypeId,BranchLogoImageUrl:BranchLogoImageUrl, action_type : action_type},
        //processData: false,
        //contentType: false,
        success: function(data, status, xhr) {
           // alert(data);
            $('#BranchName').val('');
            $('#BranchCode').val('');
           // $("#BranchTrustTypeId option:selected").val('');
           
           // $('#preview').attr('src');
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
function showMyImage(fileInput,id) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            }           
            var img=document.getElementById(""+id);            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }
    </script>

