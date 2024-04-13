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
        Swal.fire({
          icon: "success",
          title: "Éxito",
          text: response.message,
        }).then((result) => {
          window.location.href = "../../../app/views/login";
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
