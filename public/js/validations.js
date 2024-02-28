$(document).ready(function () {
  "use strict";

  const forms = $("#form");
  forms.on("submit", function (event) {
    if (!this.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
    }

    const password = $("#password").val();
    const repeatPassword = $("#repeat-password").val();

    if (password && repeatPassword) {
      if (password !== repeatPassword) {
        event.preventDefault();
        event.stopPropagation();
        $("#repeat-password").addClass("is-invalid");
        $("#repeat-password").css({ "border-color": "#dc3545" });
      } else {
        $("#repeat-password").removeClass("is-invalid");
        $("#repeat-password").css({ "border-color": "" });
      }
    }

    const mailInput = $("#email").val();
    //* email validation: valid email
    if (mailInput) {
      const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
      if (!regex.test(mailInput)) {
        event.preventDefault();
        event.stopPropagation();
        $("#email").addClass("is-invalid");
      } else {
        $("#email").removeClass("is-invalid");
      }
    }

    $(this).addClass("was-validated");
  });
});
