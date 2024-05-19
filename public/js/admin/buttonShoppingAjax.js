$(document).ready(function () {
  $(".formulario-autorizar-compra").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);
    const idForm = obtenerId(formulario);

    const btnMailer = $("#btn-activar_" + idForm);
    btnMailer.prop("disabled", true);
    btnMailer.find(".spinner-border").removeClass("d-none");

    $.ajax({
      url: "../../views/admin/actions/authorizeCustomerBuy.php",
      type: "POST",
      data: {
        idCompra: idForm,
      },
      success: function (response) {
        btnMailer.find(".spinner-border").addClass("d-none");
        btnMailer.prop("disabled", false);

        response = JSON.parse(response);
        const idModal = "modalAutorizar_" + idForm;
        mostrarAlerta(response, idModal);
      },
      error: function (xhr, status, error) {
        // Ocultar el spinner en caso de error
        btnMailer.find(".spinner-border").addClass("d-none");
        // Habilitar el botón nuevamente en caso de error
        btnMailer.prop("disabled", false);

        // Maneja los errores de la solicitud AJAX
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

  $(".formulario-cancelar-compra").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);
    const idForm = obtenerId(formulario);

    const btnMailer = $("#btnCancelarCompra_" + idForm);
    // Mostrar el spinner al enviar el formulario
    btnMailer.find(".spinner-border").removeClass("d-none");
    btnMailer.prop("disabled", true);

    $.ajax({
      url: "../../views/admin/actions/cancelCustomerBuy.php",
      type: "POST",
      data: {
        idCompra: idForm,
      },
      success: function (response) {
        btnMailer.find(".spinner-border").addClass("d-none");
        btnMailer.prop("disabled", false);

        response = JSON.parse(response);
        const idModal = "modalAutorizar_" + idForm;
        mostrarAlerta(response, idModal);
      },
      error: function (xhr, status, error) {
        btnMailer.find(".spinner-border").addClass("d-none");
        btnMailer.prop("disabled", false);
        // Maneja los errores de la solicitud AJAX
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

function obtenerId(formulario) {
  const idCompleto = formulario.attr("id");
  const partesId = idCompleto.split("_");
  return partesId[partesId.length - 1];
}
