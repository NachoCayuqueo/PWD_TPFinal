function validarFormulario() {
  "use strict";
  const form = $("#form-nuevo-usuario");
  let isValid = true;

  const password = $("#password").val();
  const repeatPassword = $("#repeat-password").val();

  if (password !== repeatPassword) {
    $("#repeat-password")
      .addClass("is-invalid")
      .css({ "border-color": "#dc3545" });
    form.addClass("was-validated");
    // return false;
    isValid = false;
  } else {
    $("#repeat-password").removeClass("is-invalid").css({ "border-color": "" });
  }

  const mailInput = $("#email").val();
  //* email validation: valid email
  if (mailInput) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!regex.test(mailInput)) {
      $("#email").addClass("is-invalid").css({ "border-color": "#dc3545" });
      form.addClass("was-validated");
      // return false;
      isValid = false;
    } else {
      $("#email").removeClass("is-invalid").css({ "border-color": "" });
    }
  }

  //* verify checks
  const checkboxes = form.find('input[type="checkbox"]');
  if (checkboxes.length > 1) {
    const isChecked = checkboxes.is(":checked");

    checkboxes.toggleClass("is-invalid", !isChecked);
    checkboxes.next("label").toggleClass("text-danger", !isChecked);

    if (!isChecked) {
      $(".errorCheck").text("Debe seleccionar al menos una opción.").css({
        color: "#dc3545",
        "font-size": "14px",
      });
      form.addClass("was-validated");
      // return false;
      isValid = false;
    } else {
      $(".errorCheck").text("");
    }
  }

  if (!form[0].checkValidity()) {
    form.addClass("was-validated");
    return false;
  }

  // Agregar la clase was-validated si el formulario es válido
  if (isValid) {
    form.addClass("was-validated");
  } else {
    form.removeClass("was-validated");
  }
  return isValid;
  //form.addClass("was-validated");
  // return true;
}
