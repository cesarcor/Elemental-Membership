jQuery(document).ready(function($) {
  $(".em-user-registration-form, .em-user-login-form, .em-change-password-form, .em-edit-profile-form").on("submit", function(e) {
    e.preventDefault();
    var form = $(this);

    $.ajax({
      url: em_ajax.ajax_url,
      method: "POST",
      data: form.serialize(),
      dataType: 'JSON',
      success: (response) => {
        //window.location.href = response.data.form_redirect;
        console.log(response);
        if(!response.success){
          $('.em-form-error').append('<small>' + response.data + '</small>');
        }
      },
      error: (xhr, status, error, response) => {
        console.log(xhr.responseText);
        console.log("status: " + status);
        console.log(error, status);
      }
    });
    
  });
});
