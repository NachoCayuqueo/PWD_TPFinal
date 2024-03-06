$(document).ready(function () {
  $(".formulario-editar").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);

    const idCompleto = formulario.attr("id"); // Recuperar el id completo del formulario actual
    const partesId = idCompleto.split("_"); // Dividir el id completo para obtener solo el idUsuario
    const id = partesId[partesId.length - 1]; // Obtener el último elemento

    const idUsuario = $("#idUsuario_" + id).val();
    const nombre = $("#usNombre_" + id).val();
    const email = $("#usMail_" + id).val();

    $.ajax({
      url: "../../views/admin/actions/editUserData.php",
      type: "POST",
      data: {
        idUsuario,
        nombre,
        email,
      },
      success: function (response) {
        // Si la respuesta contiene 'Modificacion exitosa', muestra la alerta exitosa
        response = JSON.parse(response);

        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: "Los datos fueron modificados correctamente.",
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#exampleModal_" + id).modal("hide");
            location.reload();
          });
        }
        if (response.title === "SIN CAMBIOS") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: "No se realizaron cambios",
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#exampleModal_" + id).modal("hide");
            location.reload();
          });
        }
      },
      error: function (xhr, status, error) {
        // Maneja los errores de la solicitud AJAX
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

  //TODO: btn eliminar usuario
  $(".formulario-borrar").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);

    const idCompleto = formulario.attr("id"); // Recuperar el id completo del formulario actual
    const partesId = idCompleto.split("_"); // Dividir el id completo para obtener solo el idUsuario
    const id = partesId[partesId.length - 1]; // Obtener el último elemento

    const nombre = formulario.data("name");

    $.ajax({
      url: "../../views/admin/actions/deleteUser.php",
      type: "POST",
      data: {
        idUsuario: id,
      },
      success: function (response) {
        response = JSON.parse(response);

        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: "El usuario " + nombre + " ha sido eliminado correctamente.",
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#exampleModal_" + id).modal("hide");
            location.reload();
          });
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
        console.error("status: " + status);
        console.error("error: " + error);
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
