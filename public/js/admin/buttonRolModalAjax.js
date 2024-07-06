// $(document).ready(function () {
//   $(".formulario-editar-rol").submit(function (event) {
//     event.preventDefault();
//     const formulario = $(this);

//     const idCompleto = formulario.attr("id"); // Recuperar el id completo del formulario actual
//     const partesId = idCompleto.split("_"); // Dividir el id completo para obtener solo el idUsuario
//     const id = partesId[partesId.length - 1]; // Obtener el último elemento

//     const idRol = $("#idRol_" + id).val();
//     const nombreRol = $("#descripcionRol_" + id).val();

//     $.ajax({
//       url: "../../views/admin/actions/editRolDataAction.php",
//       type: "POST",
//       data: {
//         idRol,
//         nombreRol,
//       },
//       success: function (response) {
//         response = JSON.parse(response);
//         const idModal = "modalEdit_" + id;
//         mostrarAlerta(response, idModal);
//       },
//       error: function (xhr, status, error) {
//         // Maneja los errores de la solicitud AJAX
//         console.error({ xhr });
//         console.error("status: " + status);
//         console.error("error: " + error);
//         const datosAlerta = {
//           title: "Error",
//           message:
//             "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
//         };
//         mostrarAlerta(datosAlerta);
//       },
//     });
//   });

$(document).ready(function () {
  $(document).on("click", "[id^='deleteRolButton-']", function (event) {
    event.preventDefault();
    const formulario = $(this);

    const idCompleto = formulario.attr("id"); // Recuperar el id completo del formulario actual
    const partesId = idCompleto.split("_"); // Dividir el id completo para obtener solo el idUsuario
    const id = partesId[partesId.length - 1]; // Obtener el último elemento

    const idRol = $("#idRol_" + id).val();
    const nombreRol = $("#descripcionRol_" + id).val();

    $.ajax({
      url: "../../views/admin/actions/deleteRolAction.php",
      type: "POST",
      data: {
        idRol,
        nombreRol,
      },
      success: function (response) {
        response = JSON.parse(response);
        const idModal = "modalEdit_" + id;
        mostrarAlerta(response, idModal);
      },
      error: function (xhr, status, error) {
        // Maneja los errores de la solicitud AJAX
        console.error({ xhr });
        console.error("status: " + status);
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
        const idModal = "modalDelete_" + id;
        mostrarAlerta(response, idModal);
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
        const idModal = "modalAddRole";
        mostrarAlerta(response, idModal);
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
