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
$BranchName = $db->getRows('BranchLocation',array('order_by'=>'BranchId DESC'));

?>
 <div class="container-fluid" style="padding: 0px; margin: 0px;">
        <div class="">
            <h1 class="text-center">Survey Area Code Management </h1>
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
                <label>Survey Area Code </label>
                        <input type="text"  name="SurveyAreaCode" id="SurveyAreaCode" placeholder="Survey Area Code" class="form-control" required />
                    <label>Survey Area  Name</label>
                        <input type="text"  name="SurveyAreaName" id="SurveyAreaName" placeholder="Survey Area Name" class="form-control" required />
                   
                    </div>
                    <div class="form-group col-lg-3">
                    <label>Branch Name</label>
                    <select class="form-control select2" id="BranchName" style="width: 100%;">
                        <?php
                                echo '<option vaue="">Select Branch</option>';
                                if(!empty($BranchName)){ foreach($BranchName as $res){
                                                       echo "<option value='".$res['BranchId']."'>".$res['BranchName']."</option>";

                                }}
                                else{
                                    echo '<option vaue="">No Branch</option>';
                                }
                        ?>
                        </select>
                    <label>Country Name</label>
                    <select class="form-control select2" id="CountryName" style="width: 100%;">
                        <?php
                                echo '<option vaue="">Select Country</option>';
                                if(!empty($CountryName)){ foreach($CountryName as $res){
                                                       echo "<option value='".$res['CountryId']."'>".$res['CountryName']."</option>";

                                }}
                                else{
                                    echo '<option vaue="">No Country</option>';
                                }
                        ?>
                        </select>
                       
                    </div>
                    <div class="form-group col-lg-3">
                    <label>State</label>
                      

                      <select class="form-control select2" id="StateName" style="width: 100%;">
                      
                                 <option value="">No State</option>
                              
                      </select>
                      <label>City</label>
                      

                      <select class="form-control select2" id="CityName" style="width: 100%;">
                      
                                 <option value="">No City</option>
                              
                      </select>
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
    var SurveyAreaCode = $('#SurveyAreaCode').val();
    var SurveyAreaName = $('#SurveyAreaName').val();
    var BranchId = $("#BranchName option:selected").val();
    var CountryId = $("#CountryName option:selected").val();
    var StateId = $("#StateName option:selected").val();
    var CityId = $("#CityName option:selected").val();
    
    var action_type = $('#action_type').val();
   // alert(CountryName);
   // console.log(PaymentTypeName);
    $.ajax({
        url: "add.php",
        type: "POST",
        data: { SurveyAreaCode: SurveyAreaCode,SurveyAreaName:SurveyAreaName,BranchId:BranchId,CountryId:CountryId,StateId:StateId,CityId:CityId, action_type : action_type},
        //processData: false,
        //contentType: false,
        success: function(data, status, xhr) {
           // alert(data);
           $('#SurveyAreaCode').val('');
           $('#SurveyAreaName').val('');
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

$('#CountryName').on('change',function() {
    //var StateName = $('#StateName').val();
    var CountryId = $("#CountryName option:selected").val();
    var action_type = $('#action_type').val();
   // alert(CountryId);

    $.ajax({
        url: "../../MasterManagement/City/getState.php",
        type: "POST",
        data: { id : CountryId, action_type : action_type},
        //processData: false,
        //contentType: false,
        success: function(data, status, xhr) {
           // console.log(data);
           // $('#StateName').val('');
           //$.each(data, function(index) {
            //console.log(data[index].StateId);
             //   console.log(data[index].StateId);
                //alert(data[index].TEST2);
        // });
        
        $('#StateName').html(data);
        }
    });
}); // add close

$('#StateName').on('change',function() {
    //var StateName = $('#StateName').val();
    var StateId = $("#StateName option:selected").val();
    var action_type = $('#action_type').val();
   // alert(CountryId);

    $.ajax({
        url: "getCity.php",
        type: "POST",
        data: { id : StateId, action_type : action_type},
        //processData: false,
        //contentType: false,
        success: function(data, status, xhr) {
           // console.log(data);
           // $('#StateName').val('');
           //$.each(data, function(index) {
            //console.log(data[index].StateId);
             //   console.log(data[index].StateId);
                //alert(data[index].TEST2);
        // });
        
        $('#CityName').html(data);
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

