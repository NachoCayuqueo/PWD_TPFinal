$(document).ready(function () {
  $("#form-nuevo-usuario").submit(function (event) {
    event.preventDefault();
    if (validarFormularioCrearUsuario(event)) {
      enviarFormularioDeCreacion();
    }
  });
});

function enviarFormularioDeCreacion() {
  const nombre = $("#name").val();
  const email = $("#email").val();
  const password = $("#password").val();

  // Array para almacenar los IDs de los checkboxes seleccionados
  const idsCheckboxesSeleccionados = [];

  // Iterar sobre todos los checkboxes marcados y almacenar sus IDs
  $("input.btn-check-roles:checked").each(function () {
    const idCheckboxSeleccionado = $(this).attr("id");
    const partesIdCheckbox = idCheckboxSeleccionado.split("-");
    const idRol = partesIdCheckbox[partesIdCheckbox.length - 1];
    idsCheckboxesSeleccionados.push(idRol);
  });

  const activarUsuarioLabel = $("input[name='options-base']:checked")
    .next("label")
    .text();

  const activarUsuario = activarUsuarioLabel === "SI" ? "1" : "0";

  $.ajax({
    url: "../../views/admin/actions/createUserAction.php",
    type: "POST",
    data: {
      nombre,
      email,
      password,
      activarUsuario,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.title === "EXITO") {
        $.ajax({
          url: "../../views/admin/actions/createUserRolAction.php",
          type: "POST",
          data: {
            usuarioMail: email,
            idRoles: idsCheckboxesSeleccionados,
          },
          success: function (response) {
            response = JSON.parse(response);
            if (response.title === "EXITO") {
              Swal.fire({
                icon: "success",
                title: "Éxito",
                text: "El usuario fue creado correctamente.",
              }).then((result) => {
                if (result.isConfirmed) {
                  // Limpiar el formulario después de mostrar el modal de éxito
                  $("#form-nuevo-usuario")[0].reset();
                  // Eliminar la clase 'was-validated' para evitar que se activen las validaciones
                  $("#form-nuevo-usuario").removeClass("was-validated");
                }
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
            console.error(xhr.responseText);
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Hubo un error al procesar la segunda solicitud. Por favor, inténtalo de nuevo.",
            });
          },
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
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Hubo un error al procesar la primer solicitud. Por favor, inténtalo de nuevo.",
      });
    },
  });
}
