$(document).ready(function () {
  // Esta parte se ejecutará una vez que el DOM esté completamente cargado
  // Aquí se agregará el código para manejar el envío del formulario

  $("#form-modificar-producto").submit(function (event) {
    // Evitar el envío del formulario si la validación no pasa
    if (!validarFormulario()) {
      event.preventDefault();
    }
  });
});

function validarFormulario() {
  console.log("Estoy en validar formulario de producto");
  ("use strict");
  const form = $("#form-modificar-producto");
  let isValid = true;

  const nombre = $("#nombre").val(); // Cambio aquí, añadir # para seleccionar por id
  const precio = $("#precio").val();
  const stock = $("#stock").val();
  const tipoSeleccionado = $('input[name="tipo"]:checked').val();
  const esPopular = $('input[name="esPopular"]:checked').val();
  const valorEsNuevoSeleccionado = $('input[name="esNuevo"]:checked').val();
  //idProducto no lo necesito porque no tiene que hacerle nada
  const titulo = $("#titulo").val(); // Cambio aquí, añadir # para seleccionar por id
  const contenidoMasInfo = $("#masInfo").val();

  if (nombre === "") {
    $("#error-nombre").text("Por favor, ingrese un nombre válido.").show();
    isValid = false;
  }
  if (precio === "") {
    $("#error-precio").text("Por favor, ingrese un precio.").show();
    isValid = false;
  } else if (precio <= 0) {
    $("#error-precio").text("El precio debe ser mayor que cero.").show();
    isValid = false;
  }
  if (stock === "") {
    $("#error-stock").text("Por favor, ingrese un stock.").show();
    isValid = false;
  } else if (stock <= 0) {
    $("#error-stock").text("El stock debe ser mayor que cero.").show();
    isValid = false;
  }

  if (titulo === "") {
    $("#error-titulo").text("Por favor, ingrese un titulo válido.").show();
    isValid = false;
  }
  if (contenidoMasInfo.trim() === "") {
    $("#error-masInfo")
      .text("Por favor, ingrese información adicional.")
      .show();
    isValid = false;
  }

  return isValid;
}
