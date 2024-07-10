// $(document).ready(function () {

//   $(".formulario-nuevo-rol").submit(function (event) {
//     event.preventDefault();

//     // Obtener el valor del input #nombreRol y convertirlo a minúsculas
//     const nombreRol = $("#nombreRol").val().toLowerCase();

//     $.ajax({
//       url: "../../views/admin/actions/addRolAction.php",
//       type: "POST",
//       data: {
//         nombreRol,
//       },
//       success: function (response) {
//         response = JSON.parse(response);
//         const idModal = "modalAddRole";
//         mostrarAlerta(response, idModal);
//       },
//       error: function (xhr, status, error) {
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
// });
$(document).ready(function () {
  // console.log("lee el documento");

  $("#editRoleForm").on("submit", function (event) {
    event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario

    const idRol = $("#idRol").val();
    const nombreRol = $("#nombreRol").val();

    $.ajax({
      url: "../../views/admin/actions/editRolDataAction.php",
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

  // $("#deleteRolForm").on("submit", function (event) {
  //   event.preventDefault();
  //   const formulario = $(this);

  //   const idCompleto = formulario.attr("id"); // Recuperar el id completo del formulario actual
  //   const partesId = idCompleto.split("_"); // Dividir el id completo para obtener solo el idRol
  //   const id = partesId[partesId.length - 1]; // Obtener el último elemento

  //   $.ajax({
  //     url: "../../views/admin/actions/deleteRolAction.php",
  //     type: "POST",
  //     data: {
  //       idRol: id,
  //     },
  //     success: function (response) {
  //       response = JSON.parse(response);
  //       const idModal = "modalDelete_" + id;
  //       mostrarAlertaPropio(response);
  //     },
  //     error: function (xhr, status, error) {
  //       console.error("error: " + error);
  //       const datosAlerta = {
  //         title: "Error",
  //         message:
  //           "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
  //       };
  //       mostrarAlertaPropio(datosAlerta);
  //     },
  //   });
  // });
});

function mostrarAlertaPropio(alerta) {
  const icon = obtenerIcono(alerta.title);
  Swal.fire({
    icon,
    title: alerta.title,
    text: alerta.message,
  }).then(() => {
    window.location.href = "roleList.php";
  });
}
