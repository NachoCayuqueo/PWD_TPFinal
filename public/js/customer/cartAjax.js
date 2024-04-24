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
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: response.message,
          }).then((result) => {
            // location.reload();
            window.location.href = "../../../app/views/home";
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
