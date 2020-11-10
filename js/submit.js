$(document).ready(function () {

    $('#formSubmit').submit(function (e) { 
        e.preventDefault();
        let fullname = $('#nameForm').val().trim();
        let subject = $('#subjForm').val().trim();
        let email = $('#emailForm').val().trim();
        let message = $('#textForm').val().trim();
        let new_form = new FormData();
        new_form.append('fullname', fullname);
        new_form.append('subject', subject);
        new_form.append('emailFrom', email);
        new_form.append('message', message);
            
        $.ajax({
            type: "POST",
            url: "php/submitform.php",
            data: new_form,
            contentType: false,
            processData: false,
            cache: false,
            success: function () {
                $('#newSuccess').append('<div class="alert alert-success text-center alert-dismissible fade show" role="alert"><strong>Submitted successfully! Thank you.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                $('.alert-success').fadeOut(15000);
                $('#formSubmit')[0].reset();
            }
        });
    });

});
   
 
