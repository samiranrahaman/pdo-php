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
$MemberTypeName = $db->getRows('MemberType',array('order_by'=>'MemberTypeId DESC'));
$BranchName = $db->getRows('BranchLocation',array('order_by'=>'BranchId DESC'));
$IdProofType = $db->getRows('IdProofType',array('order_by'=>'IdProofTypeId DESC'));
$Religion = $db->getRows('Religion',array('order_by'=>'ReligionId DESC'));

?>
<style>
.content {
    min-height: 250px;
  
   
}
</style>
 <div class="container-fluid" style="padding: 0px; margin: 0px;">
        <div class="row">
            <h1 class="text-center">Donors Management </h1>
        </div>
    </div>
    <div class="container">
        <div class="row"  style="margin-right: 74px;">
            <div class="col-md-12">
            <div id="link-update" >
                </div>
                <div class="pull-right">
                    <button class="btn btn-success" id="show-add">Add New Donor</button>
                </div>
            
                <div id="link-add" >
              
                <div class="form-group col-lg-3">
     
                     
						
					
						
					
						
						
						
						 
						 
						 	
						
                    </div>
                    <div class="form-group col-lg-3">
                  
                     
                     
                 
                       

                    
                        
                 
					
					
						
						
						
						
						<label><font color="red">Blood Donation</font>
						
						</label>
							</br>

                      
                        
                    </div>
                    <div class="form-group col-lg-3">
                      <img id="preview" style="width:90%" src="../../../resources/images/BranchImages/noimage.png" />
					  
					
						
						
						
						
						
					<label>KDF (Khuddamadine Fund)</label>
					</br>
				/br>
					</br>
			
					<label>Alert</label>
					

















						
                       
                     </div>
                    <input type="text" id='action_type' name="action_type" value="add" hidden/> 
                   
                    <div class="form-group col-lg-3">
                  
                    </div>
                </div>
          
            </div>
        </div>
       <div class="row"  style="margin-right: 74px;">
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
    //var BranchName = $('#BranchName').val();
    var EmployeeName = $('#EmployeeName').val();
    var RoleId = $("#RoleId option:selected").val();
    var BranchId = $("#BranchId option:selected").val();
    var UserName = $('#UserName').val();
    var Password = $('#Password').val();
    var action_type = $('#action_type').val();
    var EmployeeImageUrl = $('#preview').attr('src');
  //  alert(EmployeeImageUrl);
   // console.log(EmployeeImageUrl);
    $.ajax({
        url: "add.php",
        type: "POST",
        data: { EmployeeName : EmployeeName, RoleId : RoleId,BranchId:BranchId,EmployeeImageUrl:EmployeeImageUrl,UserName:UserName,Password:Password, action_type : action_type},
        //processData: false,
        //contentType: false,
        success: function(data, status, xhr) {
           // alert(data);
           // $('#BranchName').val('');
            $('#EmployeeName').val('');
           // $("#BranchRoleId option:selected").val('');
           
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

