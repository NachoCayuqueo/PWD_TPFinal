$(document).ready(function () {
  $("#btn-cart").click(function () {
    //const quantityId = $("#quantity").attr("id");
    const quantityValue = $("#quantity").val();
    const idProducto = $("#product-info").data("id-product");
    const idUsuario = $("#product-info").data("id-user");

    // console.log({ quantityValue, idProducto, idUsuario });
    // Aquí puedes utilizar quantityId en tu función AJAX
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
