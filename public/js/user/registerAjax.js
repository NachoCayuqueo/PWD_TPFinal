$(document).ready(function () {
  $("#formulario-registro-usuario").submit(function (event) {
    event.preventDefault();
    if (validarFormularioRegistro(event)) {
      registro();
    }
  });
});

function registro() {
  const user = $("#user").val();
  const password = $("#password").val();
  const encryptedPassword = hex_md5(password);
  const email = $("#email").val();

  $.ajax({
    url: "../../views/register/actions/registerAction.php",
    type: "POST",
    data: {
      user,
      password: encryptedPassword,
      email,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.title === "EXITO") {
        const href = "../../../app/views/login";
        mostrarAlerta(response, null, href);
      } else {
        mostrarAlerta(response);
      }
    },
    error: function (xhr, status, error) {
      // Maneja los errores de la solicitud AJAX
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
