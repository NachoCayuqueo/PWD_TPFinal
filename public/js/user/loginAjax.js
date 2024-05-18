$(document).ready(function () {
  $("#formulario-login").submit(function (event) {
    event.preventDefault();
    if (validarFormularioLogin(event)) {
      login();
    }
  });
});

function login() {
  const email = $("#email").val();
  const password = $("#password").val();
  const encryptedPassword = hex_md5(password);

  $.ajax({
    url: "../../views/login/actions/loginAction.php",
    type: "POST",
    data: {
      email,
      password: encryptedPassword,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.title === "EXITO") {
        const href = "../../../app/views/home";
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
