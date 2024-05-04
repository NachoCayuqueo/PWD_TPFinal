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
        response = JSON.parse(response);
        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: response.message,
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#modalAutorizar_" + idForm).modal("hide");
            location.reload();
          });
        } else {
          // Ocultar el spinner en caso de error
          btnMailer.find(".spinner-border").addClass("d-none");
          // Habilitar el botón nuevamente en caso de error
          btnMailer.prop("disabled", false);

          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message,
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#modalAutorizar_" + idForm).modal("hide");
            location.reload();
          });
        }
      },
      error: function (xhr, status, error) {
        // Ocultar el spinner en caso de error
        btnMailer.find(".spinner-border").addClass("d-none");
        // Habilitar el botón nuevamente en caso de error
        btnMailer.prop("disabled", false);

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

  $(".formulario-cancelar-compra").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);
    const idForm = obtenerId(formulario);

    $.ajax({
      url: "../../views/admin/actions/cancelCustomerBuy.php",
      type: "POST",
      data: {
        idCompra: idForm,
      },
      success: function (response) {
        response = JSON.parse(response);
        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: response.message,
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#modalAutorizar_" + idForm).modal("hide");
            location.reload();
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message,
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#modalAutorizar_" + idForm).modal("hide");
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
  });
});

function obtenerId(formulario) {
  const idCompleto = formulario.attr("id");
  const partesId = idCompleto.split("_");
  return partesId[partesId.length - 1];
}
