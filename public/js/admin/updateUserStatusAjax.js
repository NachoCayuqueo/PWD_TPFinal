$(document).ready(function () {
  $("#statusTable input[type=checkbox]").change(function () {
    const idUsuario = $(this).closest(".collapse").data("idusuario"); //obtengo el ID por ancestro
    const isChecked = $(this).prop("checked");

    // console.log(
    //   "A cambiado: " + isChecked + " para el usuario con ID " + idUsuario
    // );

    $.ajax({
      url: "../../views/admin/actions/updateStatus.php",
      type: "POST",
      dataType: "json",
      data: {
        idUsuario,
        isChecked,
      },
      success: function (data) {
        console.log(data); // Manejar la respuesta del servidor
      },
      error: function (xhr, status, error) {
        console.error({ xhr: xhr.responseText });
        console.error("Error:", error);
      },
    });
  });
});
