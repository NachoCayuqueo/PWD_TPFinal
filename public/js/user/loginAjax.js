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
        Swal.fire({
          icon: "success",
          title: "Éxito",
          text: response.message,
        }).then((result) => {
          window.location.href = "../../../app/views/home";
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: response.message,
        }).then((result) => {
          location.reload();
          // window.location.href = "../../../app/views/home";
        });
      }
    },
    error: function (xhr, status, error) {
      // Maneja los errores de la solicitud AJAX
      console.error(error);
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
