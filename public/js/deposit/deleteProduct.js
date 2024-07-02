$(document).ready(function () {
  $(document).on("click", "[id^='deleteButton-']", function (event) {
    event.preventDefault();
    const idBtnMinus = $(this).attr("id");
    const partesId = idBtnMinus.split("-");
    const idProducto = partesId[partesId.length - 1];

    $.ajax({
      url: "../../views/deposit/actions/deleteProductAction.php",
      type: "POST",
      data: { idProducto },
      success: function (response) {
        response = JSON.parse(response);
        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: response.message,
          }).then((result) => {
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
        console.error(xhr);
        console.error("error: " + error);
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        });
      },
    });
  });
  $(document).on("click", "[id^='editButton-']", function (event) {
    event.preventDefault();
    const idBtnEdit = $(this).attr("id");
    const partesId = idBtnEdit.split("-");
    const idProducto = partesId[partesId.length - 1];
    window.location.href = `modifyProduct.php?idProducto=${idProducto}`;
  });
});
