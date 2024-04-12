function validarFormularioLogin(event) {
  const form = $("#formulario-login")[0];
  let isValid = form.checkValidity();

  if (!isValid) {
    event.preventDefault();
    event.stopPropagation();
    form.classList.add("was-validated");
    return false;
  }

  const isValidEmailFormat = validarEmail("#email");

  isValid = isValidEmailFormat;
  if (!isValid) {
    event.preventDefault();
    event.stopPropagation();
    return false;
  }

  return true;
}

function validarFormularioRegistro(event) {
  const form = $("#formulario-registro-usuario")[0];
  let isValid = form.checkValidity();

  if (!isValid) {
    event.preventDefault();
    event.stopPropagation();
    form.classList.add("was-validated");
    return false;
  }

  const isValidPasswordFormat = validarPasswords(
    "#password",
    "#repeat-password"
  );
  const isValidEmailFormat = validarEmail("#email");

  isValid = isValidEmailFormat && isValidPasswordFormat;
  if (!isValid) {
    event.preventDefault();
    event.stopPropagation();
    return false;
  }

  return true;
}

function validarPasswords(selectorPassword, selectorRepeatPassword) {
  const password = $(selectorPassword).val();
  const repeatPassword = $(selectorRepeatPassword).val();
  if (password !== repeatPassword) {
    $("#repeat-password")
      .addClass("is-invalid")
      .css({ "border-color": "#dc3545" });
    return false;
  } else {
    $("#repeat-password").removeClass("is-invalid").css({ "border-color": "" });
    return true;
  }
}

function validarEmail(selector) {
  const email = $(selector).val().trim();
  const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  if (!regex.test(email)) {
    $(selector).addClass("is-invalid");
    return false;
  } else {
    $(selector).removeClass("is-invalid");
    return true;
  }
}
