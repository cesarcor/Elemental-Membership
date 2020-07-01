jQuery(document).ready(function($) {
  $(".em-user-registration-form, .em-user-login-form").on("submit", function(e) {
    e.preventDefault();
    var form = $(this);

    $.ajax({
      url: em_ajax.ajax_url,
      type: "POST",
      data: form.serialize(),
      success: () => {
        console.log("this was successful");
        $(this)[0].reset();
      },

      error: (xhr, status) => {
        console.log(xhr.responseText);
        console.log("status: " + status);
      }
    });
    
  });
});
