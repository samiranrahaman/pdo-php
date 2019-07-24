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

$cty = $db->getRows('city',array('order_by'=>'CityId DESC'));
$country = $db->getRows('country',array('order_by'=>'CountryId DESC'));
$state = $db->getRows('state',array('order_by'=>'StateId DESC'));

$charitablefundtype = $db->getRows('charitablefundtype',array('order_by'=>'CharitableFundTypeId DESC'));
$religiousfundtypeview = $db->getRows('religiousfundtype',array('order_by'=>'ReligiousFundTypeId DESC'));

?>
			



<style>
.content {
    min-height: 250px;
  
   
}
.h3 {
	font-size: 15px;
}

.form-group {
    margin-bottom: 8px;
}
</style>
 <div class="container-fluid" style="padding: 0px; margin: 0px;">
        <div class="row">
            <h3 class="text-center"> </h3>
			
			
			
			
        </div>
    </div>
    <div class="container">
<div class="box box-warning" style="border-top:3px solid #3c8dbc">
				<div class="box-header with-border">
					<h3 class="box-title">Add New Benefciary</h3>
				</div>

<!--<form id="user_form" method="post" enctype="multipart/form-data">-->  
        <div class="row"  style="margin-right: 74px;">
            <div class="col-md-12">
				<div id="link-update" >
                </div>
            
                <div id="link-add" >
            <div class="col-md-12">  
                <div class="form-group col-lg-6">
<label>Applicaton Type</label>
<input type="radio" name="BeneficiaryApplicaitonTypeId" id="BeneficiaryApplicaitonTypeId" value="0" required /> Applicaton For AID 
<input type="radio" name="BeneficiaryApplicaitonTypeId" id="BeneficiaryApplicaitonTypeId" value="1" checked  required /> 
 New Applicaton For AID
					 </div>
				<div class="form-group col-lg-6">
<label>Benefciary Related To</label>
<input type="radio" name="ben_related_to"  class="ben_related_to" value="Safa Educational Charitable Trust" checked>Safa Educational Charitable Trust
<input type="radio" name="ben_related_to"  class="ben_related_to" value="Safa Baitual Maal Religious Trust">Safa Baitual Maal Religious Trust

				</div>
				<div class="form-group col-lg-3">
					 <label><div id="chartytype">	 </div></label>
                        
                        <select class="form-control select2" id="CharitablleFundTypeId" name="CharitablleFundTypeId" style="width: 100%;"  required >
                        <?php
                                echo '<option vaue="">Charitable Fund Type
</option>';
                                if(!empty($charitablefundtype)){ foreach($charitablefundtype as $res){
                                                       echo "<option value='".$res['CharitableFundTypeId']."'>".$res['CharitableFundTypeName']."</option>";

                                }}
                                else{
                                    echo '<option vaue="">No Charitable Fund Type
</option>';
                                }
                        ?>
                        </select>
						
<select class="form-control select2" id="religiousfundtype" name="religiousfundtype" style="width: 100%;"  required >
		<?php
			echo '<option vaue="">Religious Fund Type
		</option>';
			if(!empty($religiousfundtypeview)){ foreach($religiousfundtypeview as $res){
								   echo "<option value='".$res['ReligiousFundTypeId']."'>".$res['ReligiousFundTypeName']."</option>";

			}}
			else{
				echo '<option vaue="">No Religious Fund Type
		</option>';
			}
		?>
</select>

				</div>
				<div class="form-group col-lg-3">
						 <label>Branch Name</label>
                        
                        <select class="form-control select2" id="BeneficiaryBranchId" name="BeneficiaryBranchId" style="width: 100%;"  required >
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
				</div>
				<div class="form-group col-lg-3">
					   <label>Beneficiary Name</label>
                        <input type="text"  name="BeneficiaryName" id="BeneficiaryName" placeholder="" class="form-control" required />
				</div>
				
				<div class="form-group col-lg-3">
						  <label>Occupation</label>
                          <input type="text"  name="BeneficiaryOccupation" id="BeneficiaryOccupation" placeholder="" class="form-control" required />
                      
				</div>
			</div>
			<div class="col-md-12">  	
				<!-- -->
				
				<div class="form-group col-lg-3">
						   <label>Phone Number</label>
                        <input type="text"  name="BeneficiaryPhoneNo1" id="BeneficiaryPhoneNo1" placeholder="" class="form-control" required />
				</div>
				<div class="form-group col-lg-3">
						   <label>ID Proof Type</label>
						 <select class="form-control select2" id="BeneficiaryIdProofTypeId" name="BeneficiaryIdProofTypeId" style="width: 100%;"  required >
                        <?php
                                echo '<option vaue="">Select Id Proof Type</option>';
                                if(!empty($IdProofType)){ foreach($IdProofType as $res){
                                                       echo "<option value='".$res['IdProofTypeId']."'>".$res['IdProofTypeName']."</option>";

                                }}
                                else{
                                    echo '<option vaue="">No Id Proof Type</option>';
                                }
                        ?>
                        </select>
                       
				</div>
				<div class="form-group col-lg-3">
						   <label>Id Proof File</label>
						   
                        <input type="file" onchange="showMyImage(this,'preview')" name="EmployeeImageUrl" id="EmployeeImageUrl" class="form-control" required />
                      <!-- <img id="preview" style="width:10%" src="../../../resources/images/BranchImages/noimage.png" />--> 
                     
				</div>
				<div class="form-group col-lg-3">
				  <img id="preview" style="width:10%" src="../../../resources/images/BranchImages/noimage.png" /> 
				</div>
				<!-- -->
			</div>
			<div class="col-md-12">  		
				<div class="form-group col-lg-3">
				 <label>ID Proof Number</label>
                        <input type="text"  name="BeneficiaryIdProofTypeId" id="BeneficiaryIdProofTypeId" placeholder="" class="form-control" required />
                     
				</div>
				
				<div class="form-group col-lg-3">
				 <label>Problem</label>
                        
                       <input type="text"  name="BeneficiaryProblem" id="BeneficiaryProblem" placeholder="" class="form-control" required />
				
				</div>
				
				<div class="form-group col-lg-3">
				    <label>Problem Document 1</label>
						
						<input type="file" onchange="showMyImage1(this,'preview1')" name="BeneficiaryProblemDoccumentImageUrl1" id="BeneficiaryProblemDoccumentImageUrl1" class="form-control" required />
				<img id="preview1" style="width:10%" src="../../../resources/images/BranchImages/noimage.png" /> 
				</div>
				
				<div class="form-group col-lg-3">
				       <label>Problem Document 2</label>

						
				<input type="file" onchange="showMyImage2(this,'preview2')" name="BeneficiaryProblemDoccumentImageUrl2" id="BeneficiaryProblemDoccumentImageUrl2" class="form-control" required />		
						
				<img id="preview2" style="width:10%" src="../../../resources/images/BranchImages/noimage.png" />
				</div>
				
				<!-- -->
			</div>
			<div class="col-md-12">  		
				<div class="form-group col-lg-3">
				
					 <label>Problem Document 3
						
						 </label>

					  
					  	<input type="file" onchange="showMyImage3(this,'preview3')" name="BeneficiaryProblemDoccumentImageUrl3" id="BeneficiaryProblemDoccumentImageUrl3" class="form-control" required />		
						
				<img id="preview3" style="width:10%" src="../../../resources/images/BranchImages/noimage.png" />
				
				
				</div>
				<div class="form-group col-lg-3">
					<label>Income</label>
                        <input type="text"  name="BeneficiaryMonthlyIncome" id="BeneficiaryMonthlyIncome" placeholder=" " class="form-control" required />
				
				</div>
				<div class="form-group col-lg-3">
						<label>Expences</label>
                        <input type="text"  name="BeneficiaryMonthlyExpences" id="BeneficiaryMonthlyExpences" placeholder=" " class="form-control" required />
				
				</div>
				<div class="form-group col-lg-3">
						<label>Address</label>
                        <input type="text"  name="BeneficiaryAddress" id="BeneficiaryAddress" placeholder=" " class="form-control" required />
				
				</div>
			</div>
			<div class="col-md-12">  		
				<!-- -->
				
				
				
				
				
				
				
				
				
				


				<div class="form-group col-lg-3">
							 <label>Country</label>
                       
<select class="form-control select2" id="BeneficiaryCountryId" name="BeneficiaryCountryId" style="width: 100%;">
<?php
		echo '<option vaue="">Select Country</option>';
	    if(!empty($country)){ foreach($country as $res){
							   echo "<option value='".$res['CountryId']."'>".$res['CountryName']."</option>";

		}}
		else{
			echo '<option vaue="">No Member Type</option>';
		}
?>
</select>							
						
				</div>
				<div class="form-group col-lg-3">
					 <label>State</label>

<select class="form-control select2" id="BeneficiaryStateId" name="BeneficiaryStateId" style="width: 100%;">
<?php
		echo '<option vaue="">Select State</option>';
		
?>
</select>		


				</div>
				<div class="form-group col-lg-3">
				<label>City</label>
				<select class="form-control select2" id="BeneficiaryCityId" name="BeneficiaryCityId" style="width: 100%;">
				<?php
				echo '<option vaue="">Select City</option>';

				?>
				</select>


				</div>
				<div class="form-group col-lg-3">
					   <label>Langmark</label>
                        <input type="text"  name="BeneficiaryLandmark" id="BeneficiaryLandmark" placeholder=" " class="form-control" required />
				</div>
			</div>
			<div class="col-md-12">  		
				
				
				<!-- -->
				
				
				<div class="form-group col-lg-3">
					 <label>Remarks</label>
                        <input type="text"  name="BeneficiaryRemarks" id="BeneficiaryRemarks" placeholder=" " class="form-control" required />
				</div>
				<div class="form-group col-lg-3">
				
     <input type="text" id='action_type' name="action_type" value="add" hidden/> 
                        <button type="button" class="btn btn-primary" id="add" name="add" style="margin-top: 20px">Submit</button>

<a href="<?php echo $GLOBALS['basepath'];?>modules/BeneficiaryManagement/BeneficiaryDetails/index"
		class="btn btn-primary" style="text-align:right; margin-top: 20px;">
		Cancel</a>



				</div>
				
				
				
				
			</div> <!-- col-md-12 -->
			

	
			<div class="col-md-12">
 
  
			</div>			
          
            </div>
        </div>
        </div>


    </div>
    </div>
<?php
        include_once '../../../includes/layouts/footer.php';
?>

<script>

$(function() {
	
	//DonorCountryId
$('#BeneficiaryCountryId').change(function() {
	var BeneficiaryCountryId = $('#BeneficiaryCountryId').val();
	//alert(DonorCountryId);
	
	 $.ajax({
        url: "state.php",
        type: "POST",
        data: { BeneficiaryCountryId : BeneficiaryCountryId},

        success: function(data, status, xhr) {

          
                $('#BeneficiaryStateId').html(data);
         
            
        },
        error: function() {
           // $('#records_content').fadeIn(3000).html('<div class="text-center">error here</div>');
        },
        beforeSend: function() {
           // $('#records_content').fadeOut(700).html('<div class="text-center">Loading...</div>');
        },
        complete: function() {
         
        }
    });
	
	
	
});
	$("#chartytype").html('Charitable Fund Type');
	$("#religiousfundtype").hide();
	
$(".ben_related_to").on("click",function(){
		var type=$(this).val();

		if(type=='Safa Baitual Maal Religious Trust'){
			$("#CharitablleFundTypeId").hide();
			$("#religiousfundtype").show();
			//alert('Maal');
			$("#chartytype").html('Religious Fund Type');
		}
		else{
			$(".charitable_fund_type").show();
			$("#chartytype").html('Charitable Fund Type');
			$("#CharitablleFundTypeId").show();
			$("#religiousfundtype").hide();
			//alert('chairty');
			
		}

	});    
 

//BeneficiaryRelatedTo	
	
	
	
   $('#add').click(function() {
    var action_type = $('#action_type').val();
    var BeneficiaryApplicaitonTypeId = $("#BeneficiaryApplicaitonTypeId:checked").val();
	//alert(BeneficiaryApplicaitonTypeId);
    var ben_related_to = $(".ben_related_to:checked").val();
    var BeneficiaryName = $("#BeneficiaryName").val();
    var BeneficiaryOccupation = $("#BeneficiaryOccupation").val();
    var BeneficiaryPhoneNo1 = $("#BeneficiaryPhoneNo1").val();
    var BeneficiaryIdProofTypeId = $("#BeneficiaryIdProofTypeId").val();
    var BeneficiaryProblem = $("#BeneficiaryProblem").val();
    var BeneficiaryMonthlyIncome = $("#BeneficiaryMonthlyIncome").val();
    var BeneficiaryBranchId = $("#BeneficiaryBranchId").val();
    var BeneficiaryAddress = $("#BeneficiaryAddress").val();
    var BeneficiaryCityId = $("#BeneficiaryCityId").val();
    var BeneficiaryStateId = $("#BeneficiaryStateId").val();
    var BeneficiaryCountryId = $("#BeneficiaryCountryId").val();
    var BeneficiaryLandmark = $("#BeneficiaryLandmark").val();
    var BeneficiaryRemarks = $("#BeneficiaryRemarks").val();
    var BeneficiaryMonthlyExpences = $("#BeneficiaryMonthlyExpences").val();
    var CharitablleFundTypeId = $("#CharitablleFundTypeId").val();
    var EmployeeImageUrl = $('#preview').attr('src');
	
	
    var BeneficiaryProblemDoccumentImageUrl1 = $('#preview1').attr('src');
    var BeneficiaryProblemDoccumentImageUrl2 = $('#preview2').attr('src');
    var BeneficiaryProblemDoccumentImageUrl3 = $('#preview3').attr('src');
	
	
	
	
	//alert('ddd');


    $.ajax({
        url: "add.php",
        type: "POST",
        data: {BeneficiaryApplicaitonTypeId:BeneficiaryApplicaitonTypeId,ben_related_to:ben_related_to,BeneficiaryName:BeneficiaryName,BeneficiaryOccupation:BeneficiaryOccupation,BeneficiaryPhoneNo1:BeneficiaryPhoneNo1,BeneficiaryIdProofTypeId:BeneficiaryIdProofTypeId,BeneficiaryProblem:BeneficiaryProblem,BeneficiaryMonthlyIncome:BeneficiaryMonthlyIncome,BeneficiaryMonthlyExpences:BeneficiaryMonthlyExpences,BeneficiaryAddress:BeneficiaryAddress,BeneficiaryCityId:BeneficiaryCityId,BeneficiaryStateId:BeneficiaryStateId,BeneficiaryCountryId:BeneficiaryCountryId,BeneficiaryLandmark:BeneficiaryLandmark,BeneficiaryRemarks:BeneficiaryRemarks,BeneficiaryBranchId:BeneficiaryBranchId,CharitablleFundTypeId:CharitablleFundTypeId,action_type:action_type,EmployeeImageUrl:EmployeeImageUrl,BeneficiaryProblemDoccumentImageUrl1:BeneficiaryProblemDoccumentImageUrl1,BeneficiaryProblemDoccumentImageUrl2:BeneficiaryProblemDoccumentImageUrl2,BeneficiaryProblemDoccumentImageUrl3:BeneficiaryProblemDoccumentImageUrl3},
        //processData: false,
        //contentType: false,,
		//
		
		
        success: function(data, status, xhr) {
            alert(data);
           // $('#BranchName').val('');
          // $('#EmployeeName').val('');
           // $("#BranchRoleId option:selected").val('');
           
           // $('#preview').attr('src');
            //alert(data);
           if(data == 'success'){
			   
			 //  alert('Successfully');

           }else{
             alert('Error');
           }
            
        },
        error: function() {
            alert('Error');
        },
        beforeSend: function() {
              //alert('Error');
        },
        complete: function() {
           // $('#link-add').hide();
           // $('#link-update').hide();
           // $('#show-add').show(700);
		    alert('Successfully');
        }
    });
}); // add close

});


</script>	
	
<script type="text/javascript">
    


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
	function showMyImage1(fileInput,id) {
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
	function showMyImage2(fileInput,id) {
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
	function showMyImage3(fileInput,id) {
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

