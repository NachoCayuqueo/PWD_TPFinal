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

    if (nuevoValor > 0) {
      $("#quantity_" + id).val(nuevoValor); // Actualizar el valor del input
      cantProducto = -1 * (cantidadActual - nuevoValor);
    }

    //AJAX
    $.ajax({
      url: "../../views/customer/actions/cartAction.php",
      type: "POST",
      data: {
        idUsuario,
        idProducto: id,
        cantProducto,
      },
      success: function (response) {
        response = JSON.parse(response);
        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: response.message,
          }).then(() => {
            location.reload();
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message,
          });
        }
      },
      error: function (xhr, status, error) {
        // Maneja los errores de la solicitud AJAX
        console.error(error);
        console.error(xhr.responseText);
        // Muestra una alerta de error
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        });
      },
    });
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

    console.log({ cantidadActual, valorActual, nuevoValor });

    $("#quantity_" + id).val(nuevoValor); // Actualizar el valor del input

    //AJAX
    $.ajax({
      url: "../../views/customer/actions/cartAction.php",
      type: "POST",
      data: {
        idUsuario,
        idProducto: id,
        cantProducto: nuevoValor - cantidadActual,
      },
      success: function (response) {
        response = JSON.parse(response);
        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: response.message,
          }).then(() => {
            location.reload();
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message,
          });
        }
      },
      error: function (xhr, status, error) {
        // Maneja los errores de la solicitud AJAX
        console.error(error);
        console.error(xhr.responseText);
        // Muestra una alerta de error
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        });
      },
    });
  });

  // Btn Borrar
  $("[id^='button-trash_']").click(function () {
    const idBtnTrash = $(this).attr("id");
    const partesId = idBtnTrash.split("_");
    const id = partesId[partesId.length - 1];

    const idCompra = $("#button-trash_" + id).data("idcompra");
    console.log({ id, idCompra });
    //AJAX
    $.ajax({
      url: "../../views/customer/actions/deleteProductAction.php",
      type: "POST",
      data: {
        idCompra,
        idProducto: id,
      },
      success: function (response) {
        response = JSON.parse(response);
        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: response.message,
          }).then(() => {
            location.reload();
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message,
          });
        }
      },
      error: function (xhr, status, error) {
        // Maneja los errores de la solicitud AJAX
        console.error(error);
        console.error(xhr.responseText);
        // Muestra una alerta de error
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        });
      },
    });
  });
});
