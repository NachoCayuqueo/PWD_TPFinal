$(document).ready(function () {
  $("#editRoleForm").on("submit", function (event) {
    event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario

    const idRol = $("#idRol").val();
    const nombreRol = $("#nombreRol").val();

    $.ajax({
      url: "views/admin/actions/editRolDataAction.php",
      type: "POST",
      data: {
        idRol,
        nombreRol,
      },
      success: function (response) {
        response = JSON.parse(response);
        mostrarAlertaPropio(response);
      },
      error: function (xhr, status, error) {
        console.error({ xhr });
        console.error("status: " + status);
        console.error("error: " + error);
        const datosAlerta = {
          title: "Error",
          message:
            "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        };
        mostrarAlerta(datosAlerta);
        //!ver el tema de la redireccion porq quedo del modal y no me redirecciona al dashboard
      },
    });
  });

  // Función para mostrar alertas propias del botón
  function mostrarAlertaPropio(alerta) {
    const icon = obtenerIcono(alerta.title);
    Swal.fire({
      icon,
      title: alerta.title,
      text: alerta.message,
    }).then(() => {
      window.location.href = "roleList.php"; // Redireccionar a la lista de roles
    });
  }

  // Función para obtener el icono según el título
  function obtenerIcono(title) {
    return title.toLowerCase() === "exito" ? "success" : "error";
  }
});
