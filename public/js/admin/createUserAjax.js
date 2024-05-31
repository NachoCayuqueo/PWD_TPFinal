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
  const encryptedPassword = hex_md5(password);

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

  const btnMailer = $("#btn-send");
  // Mostrar el spinner al enviar el formulario
  btnMailer.find(".spinner-border").removeClass("d-none");
  btnMailer.prop("disabled", true);

  $.ajax({
    url: "../../views/admin/actions/createUserAction.php",
    type: "POST",
    data: {
      nombre,
      email,
      password: encryptedPassword,
      activarUsuario,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.title === "EXITO") {
        crearUsuarioRol(
          idsCheckboxesSeleccionados,
          email,
          password,
          activarUsuario,
          btnMailer
        );
      } else {
        btnMailer.find(".spinner-border").addClass("d-none");
        btnMailer.prop("disabled", false);

        Swal.fire({
          icon: "error",
          title: "Error",
          text: response.message,
        });
      }
    },
    error: function (xhr, status, error) {
      btnMailer.find(".spinner-border").addClass("d-none");
      btnMailer.prop("disabled", false);
      console.error("error", error);
      const datosAlerta = {
        title: "Error",
        message:
          "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
      };
      mostrarAlerta(datosAlerta);
    },
  });
}

//TODO: creo que lo mejor es crear una funcion generica para mailer asi
//TODO: se desligan las demas de enviar el email
function crearUsuarioRol(
  idRoles,
  usuarioMail,
  password,
  activarUsuario,
  btnMailer
) {
  $.ajax({
    url: "../../views/admin/actions/createUserRolAction.php",
    type: "POST",
    data: {
      idRoles,
      usuarioMail,
      password,
      activarUsuario,
    },
    success: function (response) {
      btnMailer.find(".spinner-border").addClass("d-none");
      btnMailer.prop("disabled", false);

      response = JSON.parse(response);
      if (response.title === "EXITO") {
        const href = "../../../app/views/home";
        mostrarAlerta(response, null, href);
      } else {
        mostrarAlerta(response);
      }
    },
    error: function (xhr, status, error) {
      btnMailer.find(".spinner-border").addClass("d-none");
      btnMailer.prop("disabled", false);
      console.error("error", error);
      const datosAlerta = {
        title: "Error",
        message:
          "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
      };
      mostrarAlerta(datosAlerta);
    },
  });
}
