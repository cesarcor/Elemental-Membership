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
        if(!response.success){
          $('.em-form-error, .em-form-success', this).empty();
          $('.em-form-error', this).append('<small>' + response.data + '</small>');
        }else{
          $(this)[0].reset();
          $('.em-form-success, .em-form-error', this).empty();
          $('.em-form-success', this).append('<small>' + response.data + '</small>');
          if(('form_redirect' in response.data)){
            window.location.href = response.data.form_redirect;
          }
        }
      },
      error: (xhr) => {
        $('.em-form-error').append('<small>' + xhr.responseText + '</small>');
      }
    });
    
  });
});