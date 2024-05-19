$(document).ready(function () {
  // Controlador de eventos para el botón de "-"
  $("[id^='button-minus_']").click(function () {
    const idBtnMinus = $(this).attr("id");
    const partesId = idBtnMinus.split("_");
    const id = partesId[partesId.length - 1];

    const idUsuario = $("#button-minus_" + id).data("iduser");
    const valorActual = $("#quantity_" + id).val(); // Obtener el valor actual del input
    const cantidadActual = $("#quantity_" + id).data("cantidad");
    const nuevoValor = parseInt(valorActual) - 1; // Incrementar el valor

    let cantProducto = 0;

    if (nuevoValor >= 1) {
      $("#quantity_" + id).val(nuevoValor); // Actualizar el valor del input
      cantProducto = -1 * (cantidadActual - nuevoValor);
      console.log({ cantProducto });
      actualizarCantidadDisponible(idUsuario, id, cantProducto);
    }
  });

  // Controlador de eventos para el botón de "+"
  $("[id^='button-plus_']").click(function () {
    const idBtnPlus = $(this).attr("id");
    const partesId = idBtnPlus.split("_");
    const id = partesId[partesId.length - 1];

    const idUsuario = $("#button-plus_" + id).data("iduser");
    const valorActual = $("#quantity_" + id).val(); // Obtener el valor actual del input
    const cantidadActual = $("#quantity_" + id).data("cantidad");
    const nuevoValor = parseInt(valorActual) + 1; // Incrementar el valor

    const stockDisponible = $("#quantity_" + id).data("stock");

    if (stockDisponible > cantidadActual) {
      $("#quantity_" + id).val(nuevoValor);
      const cantProducto = nuevoValor - cantidadActual;
      actualizarCantidadDisponible(idUsuario, id, cantProducto);
    }
  });

  // Btn Borrar
  $("[id^='button-trash_']").click(function () {
    const idBtnTrash = $(this).attr("id");
    const partesId = idBtnTrash.split("_");
    const id = partesId[partesId.length - 1];
    const idCompra = $("#button-trash_" + id).data("idcompra");

    const cantidadItemProducto = $("#quantity_" + id).data("cantidad");

    //AJAX
    $.ajax({
      url: "../../views/customer/actions/deleteProductAction.php",
      type: "POST",
      data: {
        idCompra,
        idProducto: id,
        cantidadItemProducto,
      },
      success: function (response) {
        response = JSON.parse(response);
        mostrarAlerta(response);
      },
      error: function (xhr, status, error) {
        // Maneja los errores de la solicitud AJAX
        console.error("error", error);
        const datosAlerta = {
          title: "Error",
          message:
            "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        };
        mostrarAlerta(datosAlerta);
      },
    });
  });
});

function actualizarCantidadDisponible(idUsuario, idProducto, cantProducto) {
  $.ajax({
    url: "../../views/customer/actions/cartAction.php",
    type: "POST",
    data: {
      idUsuario,
      idProducto,
      cantProducto,
    },
    success: function (response) {
      response = JSON.parse(response);
      mostrarAlerta(response);
    },
    error: function (xhr, status, error) {
      // Maneja los errores de la solicitud AJAX
      console.error("error", error);
      const datosAlerta = {
        title: "Error",
        message:
          "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
      };
      mostrarAlerta(datosAlerta);
    },
  });
}
