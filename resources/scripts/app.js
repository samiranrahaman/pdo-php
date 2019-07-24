$(document).ready(function() {


   
    
    
   $('#login').click(function() {
    var email = $('#email').val();
    //var username = $('#username').val();
    var password = $('#password').val();

    $.ajax({
        url: "modules/Login/login.php",
        type: "POST",
        data: { email: email, password: password },
        success: function(data, status, xhr) {
            $('#email').val('');
            //$('#username').val('');
            $('#password').val('');
            if(data == 'success'){
                window.location.href="modules/Dashboard/index";
            }else{
                $('#records_content').fadeIn(3000).html('<div class="text-center">error here</div>');
                //alert("Error");
            }
            //
            //alert(data);
        },
        error: function() {
            $('#records_content').fadeIn(3000).html('<div class="text-center">error here</div>');
        },
        beforeSend: function() {
            $('#records_content').fadeOut(700).html('<div class="text-center">Loading...</div>');
        },
        complete: function() {
            //$('#link-add').hide();
           // $('#show-add').show(700);
        }
    });
}); // add close

}); // document ready close
