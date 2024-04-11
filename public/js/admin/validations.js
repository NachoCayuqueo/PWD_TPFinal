function validarFormularioCrearUsuario(event) {
  "use strict";
  const form = $("#form-nuevo-usuario")[0];
  let isValid = form.checkValidity();

  if (!isValid) {
    event.preventDefault();
    event.stopPropagation();
    form.classList.add("was-validated");
    return false;
  }

  const isValidEmailFormat = validarEmail("#email");
  const isValidPasswordFormat = validarPasswords(
    "#password",
    "#repeat-password"
  );
  const checkboxesValid = validarCheckboxes("#form-nuevo-usuario");

  isValid = isValidEmailFormat && isValidPasswordFormat && checkboxesValid;
  if (!isValid) {
    event.preventDefault();
    event.stopPropagation();
    return false;
  }

  return true;
}

function validarModalEditarUsuario(event, idform) {
  const isValidNombre = validarCampo("#usNombre_" + idform);
  const isValidMail = validarCampo("#usMail_" + idform);
  const isValidEmailFormat = validarEmail("#usMail_" + idform);

  const isValid = isValidNombre && isValidMail && isValidEmailFormat;

  if (!isValid) {
    event.preventDefault();
    event.stopPropagation();
    return false;
  }
  return true;
}

function validarModalEditarMenu(event, idform) {
  const isValid = validarCampo("#nombreItem_" + idform);
  if (!isValid) {
    event.preventDefault();
    event.stopPropagation();
    return false;
  }
  return true;
}

function validarCampo(selector) {
  const input = $(selector).val().trim();
  if (input === "") {
    $(selector).addClass("is-invalid");
    return false;
  } else {
    $(selector).removeClass("is-invalid");
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

function validarCheckboxes(formSelector) {
  const checkboxes = $(formSelector).find('input[type="checkbox"]');
  if (checkboxes.length > 1) {
    const isChecked = checkboxes.is(":checked");

    checkboxes.toggleClass("is-invalid", !isChecked);
    checkboxes.next("label").toggleClass("text-danger", !isChecked);

    if (!isChecked) {
      $(".errorCheck").text("Debe seleccionar al menos una opción.").css({
        color: "#dc3545",
        "font-size": "14px",
      });
      return false;
    } else {
      $(".errorCheck").text("");
      return true;
    }
  }
}
