$(document).ready(function () {
  $("#form-modificar-producto").submit(function (event) {
    event.preventDefault();

    if (validarFormulario(event)) {
    }
  });
  $("#form-nuevo-producto").submit(function (event) {
    event.preventDefault();
    validarFormularioNuevo(event);
  });
});

function validarFormulario(event) {
  "use strict";
  const form = $("#form-modificar-producto")[0];
  let isValid = true;

  if (!form.checkValidity()) {
    event.preventDefault();
    event.stopPropagation();
    form.classList.add("was-validated");
    isValid = false;
  }

  const precio = $("#precio").val();
  const stock = $("#stock").val();

  if (precio <= 0) {
    $("#error-precio").text("El precio debe ser mayor que cero.").show().css({
      color: "#dc3545",
      "font-size": "0.875rem",
    });
    isValid = false;
  } else {
    $("#error-precio").text("").hide();
  }

  if (stock !== "") {
    const stockValue = Number(stock); // Convertir stock a número

    if (stockValue < 0) {
      $("#error-stock")
        .text("El stock debe ser mayor o igual a cero.")
        .show()
        .css({
          color: "#dc3545",
          "font-size": "0.875rem",
        });
      isValid = false;
    } else {
      $("#error-stock").text("").hide();
    }
  } else {
    $("#error-stock").text("").hide();
  }

  return isValid;
}

function validarFormularioNuevo(event) {
  ("use strict");
  const form = $("#form-nuevo-producto")[0];
  let isValid = true;

  if (!form.checkValidity()) {
    event.preventDefault();
    event.stopPropagation();
    form.classList.add("was-validated");
    isValid = false;
  }

  const precio = $("#precio").val();
  const stock = $("#stock").val();

  if (precio <= 0) {
    $("#error-precio").text("El precio debe ser mayor que cero.").show().css({
      color: "#dc3545",
      "font-size": "0.875rem",
    });
    isValid = false;
  } else {
    $("#error-precio").text("").hide();
  }

  if (stock <= 0) {
    $("#error-stock").text("El stock debe ser mayor que cero.").show().css({
      color: "#dc3545",
      "font-size": "0.875rem",
    });
    isValid = false;
  } else {
    $("#error-stock").text("").hide();
  }
  //--------------- VALIDACIONES DE CHECKBOX -------------------//
  const checkBoxTipo = document.querySelector('input[name="tipo"]:checked');
  const checkBoxEsPopular = document.querySelector(
    'input[name="esPopular"]:checked'
  );
  const checkBoxEsNuevo = document.querySelector(
    'input[name="esNuevo"]:checked'
  );

  if (!checkBoxTipo) {
    $(".invalid-tipo").show().css({
      color: "#dc3545",
      "font-size": "0.875rem",
    });
    isValid = false;
  } else {
    $(".invalid-tipo").hide();
  }
  if (!checkBoxEsPopular) {
    $(".invalid-esPopular").show().css({
      color: "#dc3545",
      "font-size": "0.875rem",
    });
    isValid = false;
  } else {
    $(".invalid-esPopular").hide();
  }
  if (!checkBoxEsNuevo) {
    $(".invalid-esNuevo").show().css({
      color: "#dc3545",
      "font-size": "0.875rem",
    });
    isValid = false;
  } else {
    $(".invalid-esNuevo").hide();
  }

  return isValid;
}
