$(document).ready(function () {
  $.ajax({
    url: "../../views/deposit/actions/dashboardAction.php",
    type: "POST",
    data: {},
    success: function (response) {
      response = JSON.parse(response);
      mostrarProductos(response.listaProducto);
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

function mostrarProductos(listaProducto) {
  if (listaProducto.length === 0) {
    content = `
            <div class="d-flex justify-content-center">
                <h4 class="text">No se encontraron productos cargados en la base de datos</h4>
            </div>`;
    $("#dashboardDeposit").html(content);
  } else {
    crearTablaProducto(listaProducto);
  }
}

function crearTablaProducto(listaProducto, container) {
  let tablaHTML = `
          <table class="table table-striped table-bordered">
          <thead>
          <tr class="text-center card-title">
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Precio</th>
              <th scope="col">Tipo</th>        
              <th scope="col">Detalles</th>
              <th scope="col">Stock</th>
              <th scope="col">Destacado</th>
              <th scope="col">Nuevo</th>
              <th scope="col"></th>
          </tr>
          </thead>
          <tbody class="table-group-divider card-text text">`;

  listaProducto.forEach((producto) => {
    let id = producto.idProducto;
    let esPopular = producto.esProDestacado;
    let esNuevo = producto.esProNuevo;
    let check = seleccionCheck(esNuevo, esPopular);
    let esNuevito = check[0];
    let esPopu = check[1];
    let descripcionCompleta = producto.proMasInfo;

    tablaHTML += `
          <tr style='text-align: center;'>
              <td style='width: max-content;'>${id}</td>
              <td style="max-width: 200px; width: max-content;">${producto.proNombre}</td>
              <td style='width: max-content;'>${producto.proPrecio}</td>
              <td style='width: max-content;'>${producto.proTipo}</td>
              <td style="width: max-content; margin: 0; padding: 3;">
                  <p style="margin: 0;">
                    <a class="btn btn-text btn-color" data-bs-toggle="collapse" href="#multiCollapseExample${id}" role="button" aria-expanded="false" aria-controls="multiCollapseExample${id}">Mostrar Información</a>
                  </p>
                  <div class="row" style="margin: 0;">
                    <div class="col" style="margin: 0;">
                      <div class="collapse multi-collapse" id="multiCollapseExample${id}" style="margin: ;">
                        <div class="card card-body" style="margin: 0;">
                          ${descripcionCompleta}
                        </div>
                      </div>
                    </div>
                  </div>
              </td>
              <td style='width: max-content;'>${producto.proCantStock}</td>
              <td>${esPopu}</td>
              <td>${esNuevito}</td>
              <td>
                  <form action="modifyProduct.php" method="post">
                      <input type="hidden" name="nombre" value="${producto.proNombre}">
                      <input type="hidden" name="idProducto" value="${id}">
                      <input type="hidden" name="precio" value="${producto.proPrecio}">
                      <input type="hidden" name="tipo" value="${producto.proTipo}">
                      <input type="hidden" name="descripcionCompleta" value="${descripcionCompleta}">
                      <input type="hidden" name="stock" value="${producto.proCantStock}">
                      <input type="hidden" name="esNuevo" value="${esNuevo}">
                      <input type="hidden" name="esPopular" value="${esPopular}">
                      <input type="hidden" name="nombreImagen" value="${producto.proImagen}">
                      <input type="hidden" name="nombreCompleto" value="${producto.proDescripcion}">
                      
                      <button type="submit" class="btn btn-outline-primary">
                          <img src="../../../public/lib/bootstrap/bootstrap-icons/icons/pen.svg" alt="editar">
                      </button>
                      <a href="" class="btn btn-outline-danger deleteButton" id="deleteButton-${id}" data-id="${id}">
                          <img src="../../../public/lib/bootstrap/bootstrap-icons/icons//trash3.svg" alt="eliminar">
                      </a>  
                  </form>
              </td>
          </tr>`;
  });

  tablaHTML += `</tbody></table>`;
  $("#dashboardDeposit").html(tablaHTML);
}

function seleccionCheck(esNuevo, esPopular) {
  let esNuevito =
    esNuevo === 0
      ? '<div class="form-check" style="margin: 0; padding: 0; display: flex; justify-content: center; align-items: center;"><input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled></div>'
      : '<div class="form-check" style="margin: 0; padding: 0; display: flex; justify-content: center; align-items: center;"><input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked disabled></div>';

  let esPopu =
    esPopular === 0
      ? '<div class="form-check" style="margin: 0; padding: 0; display: flex; justify-content: center; align-items: center;"><input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled></div>'
      : '<div class="form-check" style="margin: 0; padding: 0; display: flex; justify-content: center; align-items: center;"><input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked disabled></div>';

  return [esNuevito, esPopu];
}
