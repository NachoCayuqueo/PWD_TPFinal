function validarFormularioConfiguracion(event) {
  const form = $("#formulario-datos-personales")[0];
  const isValid = form.checkValidity();

  if (!isValid) {
    event.preventDefault();
    event.stopPropagation();
    form.classList.add("was-validated");
    return false;
  }

  const nombreInput = $("#name").val().trim(); // Elimina espacios en blanco al principio y al final
  if (nombreInput === "") {
    $("#name").addClass("is-invalid");
    return false;
  } else {
    $("#name").removeClass("is-invalid");
  }

  const mailInput = $("#email").val();
  if (mailInput) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!regex.test(mailInput)) {
      $("#email").addClass("is-invalid");
      return false;
    } else {
      $("#email").removeClass("is-invalid");
    }
  }

  return true;
}

function validarPasswords(event) {
  const form = $("#formulario-cambio-password")[0];
  const isValid = form.checkValidity();

  if (!isValid) {
    event.preventDefault();
    event.stopPropagation();
    form.classList.add("was-validated");
    return false;
  }

  const password = $("#new-password").val();
  const repeatPassword = $("#repeat-password").val();

  if (password !== repeatPassword) {
    $("#repeat-password")
      .addClass("is-invalid")
      .css({ "border-color": "#dc3545" });
    return false;
  } else {
    $("#repeat-password").removeClass("is-invalid").css({ "border-color": "" });
  }
  return true;
}
