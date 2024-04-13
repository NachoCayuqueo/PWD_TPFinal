$(document).ready(function () {
  $("#formulario-datos-personales").submit(function (event) {
    event.preventDefault();
    if (validarFormularioConfiguracion(event)) {
      modificarDatosPersonales();
    }
  });

  $("#formulario-cambio-password").submit(function (event) {
    event.preventDefault();

    if (validarPasswords(event)) {
      modificarPassword();
    }
  });

  $("#formulario-cambio-rol").submit(function (event) {
    event.preventDefault();
    const idUsuario = $(this).data("id");
    const idRolSeleccionado = $("input[name='options-base']:checked").attr(
      "id"
    );
    const partesId = idRolSeleccionado.split("_"); // Dividir el id completo para obtener solo el idUsuario
    const id = partesId[partesId.length - 1]; // Obtener el último elemento

    console.log({ idRol: id, idUsuario });

    //AJAX
    $.ajax({
      url: "../../views/usuario/actions/changeRole.php",
      type: "POST",
      data: {
        idUsuario,
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
});

function modificarDatosPersonales() {
  // const nombre = $("#name").val();
  let nombre = $("#name").val().trim(); // Elimina espacios en blanco al principio y al final
  nombre = nombre.replace(/\s+/g, " "); // Reemplaza múltiples espacios consecutivos por un solo espacio
  const email = $("#email").val();
  const idUsuario = $("#name").data("id");
  //console.log({ idUsuario, nombre, email });
  //AJAX
  $.ajax({
    url: "../../views/admin/actions/editUserDataAction.php",
    type: "POST",
    data: {
      idUsuario,
      nombre,
      email,
    },
    success: function (response) {
      response = JSON.parse(response);

      if (response.title === "EXITO") {
        Swal.fire({
          icon: "success",
          title: "Éxito",
          text: response.message,
        }).then(() => {
          location.reload();
        });
      }
      if (response.title === "SIN CAMBIOS") {
        Swal.fire({
          icon: "success",
          title: "Éxito",
          text: response.message,
        }).then(() => {
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
}

function modificarPassword() {
  const passwordActual = hex_md5($("#password").val());
  const passwordNueva = hex_md5($("#new-password").val());
  const idUsuario = $("#formulario-cambio-password").data("id");

  //AJAX
  $.ajax({
    url: "../../views/usuario/actions/changePasswordAction.php",
    type: "POST",
    data: {
      idUsuario,
      passwordActual,
      passwordNueva,
    },
    success: function (response) {
      response = JSON.parse(response);

      if (response.title === "EXITO") {
        Swal.fire({
          icon: "success",
          title: "Éxito",
          text: response.message,
        }).then(() => {
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
}
