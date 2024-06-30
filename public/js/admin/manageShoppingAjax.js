$(document).ready(function () {
  $.ajax({
    url: "../../views/admin/actions/manageShoppingAction.php",
    type: "POST",
    data: {},
    success: function (response) {
      response = JSON.parse(response);
      createTableCompras(response.listaCompras);
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
//************************************* */
function inicializarEventosBotones() {
  $(".formulario-autorizar-compra")
    .off("submit")
    .on("submit", function (event) {
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
          btnMailer.find(".spinner-border").addClass("d-none");
          btnMailer.prop("disabled", false);

          console.error("Error: " + error);
          const datosAlerta = {
            title: "Error",
            message:
              "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
          };
          mostrarAlerta(datosAlerta);
        },
      });
    });

  $(".formulario-cancelar-compra")
    .off("submit")
    .on("submit", function (event) {
      event.preventDefault();
      const formulario = $(this);
      const idForm = obtenerId(formulario);

      const btnMailer = $("#btnCancelarCompra_" + idForm);
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
          const idModal = "modalCancelar_" + idForm;
          mostrarAlerta(response, idModal);
        },
        error: function (xhr, status, error) {
          btnMailer.find(".spinner-border").addClass("d-none");
          btnMailer.prop("disabled", false);

          console.error("Error: " + error);
          const datosAlerta = {
            title: "Error",
            message:
              "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
          };
          mostrarAlerta(datosAlerta);
        },
      });
    });
}

//************************************* */
function createTableCompras(listaCompras) {
  var content = `
        <div class="text">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Autorizar Nuevas Compras</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="authorized-shopping-tab" data-bs-toggle="tab" data-bs-target="#authorized-shopping-tab-pane" type="button" role="tab" aria-controls="authorized-shopping-pane" aria-selected="false">Compras Autorizadas</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cancel-shopping-tab" data-bs-toggle="tab" data-bs-target="#cancel-shopping-tab-pane" type="button" role="tab" aria-controls="cancel-shopping-tab-pane" aria-selected="false">Compras Canceladas</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    ${
                      crearTablaNuevasCompras(listaCompras) === 0
                        ? "<p>No se encontraron compras nuevas.</p>"
                        : crearTablaNuevasCompras(listaCompras)
                    }
                </div>
                <div class="tab-pane fade" id="authorized-shopping-tab-pane" role="tabpanel" aria-labelledby="authorized-shopping-tab" tabindex="0">
                    ${
                      crearTablaComprasAutorizadas(listaCompras) === 0
                        ? "<p>No se encontraron compras autorizadas.</p>"
                        : crearTablaComprasAutorizadas(listaCompras)
                    }
                </div>
                <div class="tab-pane fade" id="cancel-shopping-tab-pane" role="tabpanel" aria-labelledby="cancel-shopping-tab" tabindex="0">
                    ${
                      crearTablaComprasCanceladas(listaCompras) === 0
                        ? "<p>No se encontraron compras que hayan sido canceladas.</p>"
                        : crearTablaComprasCanceladas(listaCompras)
                    }
                </div>
            </div>
        </div>
    `;

  $("#manageShopping").html(content);
}

function dateFormat(dateString) {
  // Función para formatear la fecha
  var options = { year: "numeric", month: "long", day: "numeric" };
  return new Date(dateString).toLocaleDateString(undefined, options);
}

function mostrarDatosTabla(
  idCompra,
  idUsuario,
  nombreUsuario,
  emailUsuario,
  estadoCompra,
  fechaCompra,
  precioTotalCompra,
  arregloCompraItems,
  mostrarBotones = false
) {
  let fila = `
      <tr>
        <td>
          <a class='btn btn-link' data-bs-toggle='collapse' href='#collapseDatosTabla${idCompra}' role='button' aria-expanded='false' aria-controls='collapseDatosTabla${idCompra}'>
            <img id='toggleIcon_${idCompra}' src='../../../public/lib/bootstrap/bootstrap-icons/icons/chevron-compact-right.svg' alt='right'>
          </a>
        </td>
        <td class='card-title'>${idCompra}</td>
        <td class='card-title'>${idUsuario}</td>
        <td>${nombreUsuario}</td>
        <td>${emailUsuario}</td>
        <td>${fechaCompra}</td>
        <td>${precioTotalCompra}</td>`;

  if (mostrarBotones) {
    fila += `
        <td class='text-center d-flex gap-2'>
          <button type='button' class='btn btn-text btn-color' data-bs-toggle='modal' data-bs-target='#modalAutorizar_${idCompra}'>
            Autorizar
          </button>
          <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modalCancelar_${idCompra}'>
            Cancelar
          </button>
        </td>
      </tr>`;

    // Generar los modales en HTML
    fila += modalAutorizarCompra(idCompra);
    fila += modalCancelarCompra(idCompra);
  } else {
    fila += `</tr>`;
  }

  fila += mostrarCollapseProductos(idCompra, arregloCompraItems);
  return fila;
}

function modalAutorizarCompra(idCompra) {
  return `
      <div class='modal fade' id='modalAutorizar_${idCompra}' tabindex='-1' aria-labelledby='modalAutorizarLabel_${idCompra}' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title' id='modalAutorizarLabel_${idCompra}'>Autorizar Compra</h5>
              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
              ¿Está seguro de que desea autorizar esta compra?
            </div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
              <button type='button' class='btn btn-primary' onclick='autorizarCompra(${idCompra})'>Autorizar</button>
            </div>
          </div>
        </div>
      </div>`;
}

function modalCancelarCompra(idCompra) {
  return `
      <div class='modal fade' id='modalCancelar_${idCompra}' tabindex='-1' aria-labelledby='modalCancelarLabel_${idCompra}' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title' id='modalCancelarLabel_${idCompra}'>Cancelar Compra</h5>
              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
              ¿Está seguro de que desea cancelar esta compra?
            </div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
              <button type='button' class='btn btn-danger' onclick='cancelarCompra(${idCompra})'>Cancelar</button>
            </div>
          </div>
        </div>
      </div>`;
}

function crearTablaNuevasCompras(compras) {
  var itemsEncontrados = 0;
  var tabla = `
      <table class="table table-striped table-bordered">
        <thead>
          <tr class="text-center card-title">
            <th scope="col"></th>
            <th scope="col">Id Compra</th>
            <th scope="col">Id Usuario</th>
            <th scope="col">Nombre Usuario</th>
            <th scope="col">Email Usuario</th>
            <th scope="col">Fecha Compra</th>
            <th scope="col">Total Compras</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
    `;

  compras.forEach((compraUsuario) => {
    compraUsuario.forEach((compra) => {
      if (compra.estadoCompra === 2) {
        itemsEncontrados++;
        let fila = `
            <tr>
              <td>
                <a class='btn btn-link' data-bs-toggle='collapse' href='#collapseDatosTabla${
                  compra.idCompra
                }' role='button' aria-expanded='false' aria-controls='collapseDatosTabla${
          compra.idCompra
        }'>
                  <img id='toggleIcon_${
                    compra.idCompra
                  }' src='../../../public/lib/bootstrap/bootstrap-icons/icons/chevron-compact-right.svg' alt='right'>
                </a>
              </td>
              <td>${compra.idCompra}</td>
              <td>${compra.idUsuario}</td>
              <td>${compra.nombreUsuario}</td>
              <td>${compra.emailUsuario}</td>
              <td>${compra.fechaCompra}</td>
              <td>${compra.precioTotal}</td>
              <td>
                <button type='button' class='btn btn-text btn-color' data-bs-toggle='modal' data-bs-target='#modalAutorizar_${
                  compra.idCompra
                }'>
                  Autorizar
                </button>
                <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modalCancelar_${
                  compra.idCompra
                }'>
                  Cancelar
                </button>
              </td>
            </tr>
            ${mostrarCollapseProductos(compra.idCompra, compra.compraItem)}
            ${modalAutorizarCompra(compra.idCompra)}
            ${modalCancelarCompra(compra.idCompra)}
          `;
        tabla += fila;
      }
    });
  });
  tabla += `
        </tbody>
      </table>
    `;

  if (itemsEncontrados === 0) {
    tabla = "<p>No se encontraron compras nuevas.</p>";
  }

  console.log(tabla); // Verifica la estructura generada
  return tabla;
}

function crearTablaComprasAutorizadas(compras) {
  var itemsEncontrados = 0;
  var tabla = `
      <table class="table table-striped table-bordered">
        <thead>
          <tr class="text-center card-title">
            <th scope="col"></th>
            <th scope="col">ID Compra</th>
            <th scope="col">ID Usuario</th>
            <th scope="col">Nombre Usuario</th>
            <th scope="col">Email Usuario</th>
            <th scope="col">Fecha Compra</th>
            <th scope="col">Total Compra</th>
          </tr>
        </thead>
        <tbody class="table-group-divider card-text">
    `;

  compras.forEach((compraUsuario) => {
    compraUsuario.forEach((compra) => {
      if (compra.estadoCompra === 3 || compra.estadoCompra === 4) {
        itemsEncontrados++;
        var fila = mostrarDatosTabla(
          compra.idCompra,
          compra.idUsuario,
          compra.nombreUsuario,
          compra.emailUsuario,
          compra.estadoCompra,
          dateFormat(compra.fechaCompra),
          compra.precioTotal,
          compra.compraItem
        );
        tabla += fila;
      }
    });
  });

  tabla += `
        </tbody>
      </table>
    `;

  if (itemsEncontrados === 0) {
    tabla = "<p>No se encontraron compras autorizadas.</p>";
  }
  return tabla;
}

function crearTablaComprasCanceladas(compras) {
  var itemsEncontrados = 0;
  var tabla = `
      <table class="table table-striped table-bordered">
        <thead>
          <tr class="text-center card-title">
            <th scope="col"></th>
            <th scope="col">ID Compra</th>
            <th scope="col">ID Usuario</th>
            <th scope="col">Nombre Usuario</th>
            <th scope="col">Email Usuario</th>
            <th scope="col">Fecha Compra</th>
            <th scope="col">Total Compra</th>
          </tr>
        </thead>
        <tbody class="table-group-divider card-text">
    `;

  compras.forEach((compraUsuario) => {
    compraUsuario.forEach((compra) => {
      if (compra.estadoCompra === 5) {
        itemsEncontrados++;
        var fila = mostrarDatosTabla(
          compra.idCompra,
          compra.idUsuario,
          compra.nombreUsuario,
          compra.emailUsuario,
          compra.estadoCompra,
          dateFormat(compra.fechaCompra),
          compra.precioTotal,
          compra.compraItem
        );
        tabla += fila;
      }
    });
  });

  tabla += `
        </tbody>
      </table>
    `;

  if (itemsEncontrados === 0) {
    tabla = "<p>No se encontraron compras canceladas.</p>";
  }
  return tabla;
}

function mostrarCollapseProductos(idCompra, itemsCompra) {
  let collapse = `
      <tr class="collapse" id="collapseDatosTabla${idCompra}">
        <td colspan="8">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio Unitario</th>
              </tr>
            </thead>
            <tbody>
    `;

  itemsCompra.forEach((item) => {
    collapse += `
        <tr>
          <td class='card-title'>${item.idCompraItem}</td>
          <td>${item.nombreProducto}</td>
          <td>${item.cantidadProducto}</td>
          <td>${item.precioUnitarioProducto}</td>
        </tr>
      `;
  });

  collapse += `
            </tbody>
          </table>
        </td>
      </tr>
    `;

  return collapse;
}
