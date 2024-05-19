$(document).ready(function () {
  $("#rolesTable input[type=checkbox]").change(function () {
    const idUsuario = $(this).closest(".collapse").data("idusuario"); //obtengo el ID por ancestro
    const idRol = $(this).data("idrol");
    const descripcionRol = $(this).val();
    const isChecked = $(this).prop("checked");

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
        mostrarAlerta(response);
      },
      error: function (xhr, status, error) {
        console.error("error: " + error);
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
