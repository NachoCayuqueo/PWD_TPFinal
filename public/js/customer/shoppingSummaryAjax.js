$(document).ready(function () {
  $.ajax({
    url: "../../views/customer/actions/shoppingSummaryAction.php",
    type: "POST",
    data: {
      productType: "product.type",
    },
    success: function (response) {
      response = JSON.parse(response);
      createSummary(response);
    },
    error: function (xhr, status, error) {
      console.log({ error });
      const datosAlerta = {
        title: "Error",
        message:
          "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
      };
      mostrarAlerta(datosAlerta);
    },
  });
});

function createSummary(list) {
  list = list.shoppingList;

  $.ajax({
    url: "../../views/customer/strucures/summaryTable.php",
    type: "POST",
    data: {
      action: "crearTablaResumenCompra",
      list,
    },
    success: function (response) {
      response = JSON.parse(response);
      $("#container-crear-tabla-resumen-compra").html(response.result);
    },
    error: function (xhr, status, error) {
      console.log({ error, status });
      const datosAlerta = {
        title: "Error",
        message:
          "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
      };
      mostrarAlerta(datosAlerta);
    },
  });

  $.ajax({
    url: "../../views/customer/strucures/summaryTable.php",
    type: "POST",
    data: {
      action: "crearTablaComprasCanceladas",
      list,
    },
    success: function (response) {
      response = JSON.parse(response);
      $("#container-crear-tabla-compras-canceladas").html(response.result);
    },
    error: function (xhr, status, error) {
      console.log({ error, status });
      const datosAlerta = {
        title: "Error",
        message:
          "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
      };
      mostrarAlerta(datosAlerta);
    },
  });

  // Agregar el script ranking.js
  $.getScript("../../../public/js/customer/changeCollapseButton.js")
    .done(function (script, textStatus) {
      console.log("Script changeCollapseButton.js cargado correctamente");
      // Aquí puedes cargar los otros scripts una vez que ranking.js haya sido cargado
      loadAdditionalScripts();
    })
    .fail(function (jqxhr, settings, exception) {
      console.error("Error al cargar el script ranking.js:", exception);
    });

  function loadAdditionalScripts() {
    $.getScript("../../../public/js/customer/classifyProductAjax.js")
      .done(function (script, textStatus) {
        console.log("Script classifyProductAjax.js cargado correctamente");
      })
      .fail(function (jqxhr, settings, exception) {
        console.error(
          "Error al cargar el script handleQuantityButtonClick.js:",
          exception
        );
      });
  }
}
