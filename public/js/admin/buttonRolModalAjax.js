$(document).ready(function () {
  //! se debe realizar la validacion en el formulario de campos validos
  //! revisar ajax -> createUserAjax
  $(".formulario-editar-rol").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);

    const idCompleto = formulario.attr("id"); // Recuperar el id completo del formulario actual
    const partesId = idCompleto.split("_"); // Dividir el id completo para obtener solo el idUsuario
    const id = partesId[partesId.length - 1]; // Obtener el último elemento

    const idRol = $("#idRol_" + id).val();
    const nombreRol = $("#descripcionRol_" + id).val();

    $.ajax({
      url: "../../views/admin/actions/editRolDataAction.php",
      type: "POST",
      data: {
        idRol,
        nombreRol,
      },
      success: function (response) {
        response = JSON.parse(response);

        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: response.message,
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#modalEdit_" + id).modal("hide");
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

  $(".formulario-borrar-rol").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);

    const idCompleto = formulario.attr("id"); // Recuperar el id completo del formulario actual
    const partesId = idCompleto.split("_"); // Dividir el id completo para obtener solo el idUsuario
    const id = partesId[partesId.length - 1]; // Obtener el último elemento

    $.ajax({
      url: "../../views/admin/actions/deleteRolAction.php",
      type: "POST",
      data: {
        idRol: id,
      },
      success: function (response) {
        response = JSON.parse(response);

        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: response.message,
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#modalDelete_" + id).modal("hide");
            location.reload();
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message,
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#modalDelete_" + id).modal("hide");
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

  $(".formulario-nuevo-rol").submit(function (event) {
    event.preventDefault();

    // Obtener el valor del input #nombreRol y convertirlo a minúsculas
    const nombreRol = $("#nombreRol").val().toLowerCase();

    $.ajax({
      url: "../../views/admin/actions/addRolAction.php",
      type: "POST",
      data: {
        nombreRol,
      },
      success: function (response) {
        response = JSON.parse(response);

        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: response.message,
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#modalAddRole").modal("hide");
            location.reload();
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message,
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#modalAddRole").modal("hide");
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
