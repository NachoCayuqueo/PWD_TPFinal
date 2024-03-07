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
