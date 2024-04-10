$(document).ready(function () {
  $("#rolesTable input[type=checkbox]").change(function () {
    const idUsuario = $(this).closest(".collapse").data("idusuario"); //obtengo el ID por ancestro
    const idRol = $(this).data("idrol");
    const descripcionRol = $(this).val();
    const isChecked = $(this).prop("checked");

    // console.log(
    //   "El checkbox con valor " +
    //     descripcionRol +
    //     " ha cambiado: " +
    //     isChecked +
    //     " para el usuario con ID " +
    //     idUsuario
    // );

    $.ajax({
      url: "../../views/admin/actions/updateRoleAction.php",
      type: "POST",
      dataType: "json",
      data: {
        idUsuario,
        idRol,
        descripcionRol,
        isChecked,
      },
      success: function (response) {
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
        console.error({ xhr: xhr.responseText });
        console.error("Error:", error);
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
