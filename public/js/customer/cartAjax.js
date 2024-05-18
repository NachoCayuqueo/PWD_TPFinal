$(document).ready(function () {
  $("#btn-cart").click(function () {
    const quantityValue = $("#quantity").val();
    const idProducto = $("#product-info").data("id-product");
    const idUsuario = $("#product-info").data("id-user");

    $.ajax({
      url: "../../views/customer/actions/cartAction.php",
      type: "POST",
      data: {
        idUsuario,
        idProducto,
        cantProducto: quantityValue,
      },
      success: function (response) {
        response = JSON.parse(response);
        if (response.title === "EXITO") {
          const href = "../../../app/views/home";
          mostrarAlerta(response, null, href);
        } else {
          mostrarAlerta(response);
        }
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
