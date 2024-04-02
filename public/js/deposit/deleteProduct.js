document
  .getElementById("deleteButton")
  .addEventListener("click", function (event) {
    event.preventDefault();

    const idProducto = this.getAttribute("data-id");
    // console.log(idProducto);

    $.ajax({
      url: "../../views/deposit/actions/deleteProductAction.php",
      type: "POST",
      data: {
        idProducto,
      },
      success: function (response) {
        response = JSON.parse(response);
        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: response.message,
          }).then((result) => {
            // Redirecciona a la página deseada
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
      // error: function (xhr, status, error) {
      //   // Maneja los errores de la solicitud AJAX
      //   console.error(error);
      //   console.error(xhr.responseText);
      //   // Muestra una alerta de error
      //   Swal.fire({
      //     icon: "error",
      //     title: "Error",
      //     text: "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
      //   });
      // },
    });
  });
