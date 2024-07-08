<?php
include_once '../../../../config/configuration.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    $data = data_submitted();
    $list = $data['list'];

    switch ($action) {
        case 'crearTablaResumenCompra':
            $result = crearTablaResumenCompra($list);
            break;
        case 'crearTablaComprasCanceladas':
            $result = crearTablaComprasCanceladas($list);
            break;
        default:
            $result = 'Acción no encontrada';
            break;
    }

    echo json_encode(['result' => $result]);
}

/**
 * Crea la tabla de resumen de compras.
 * @param array $listaCompras - Lista de compras.
 * @return int - Número de compras encontradas.
 */
function crearTablaResumenCompra($listaCompras)
{
    $existeCompra = false;
    $html = '
    <table class="table table-striped table-bordered">
    <thead>
    <tr class="text-center card-title">
        <th scope="col"></th>
        <th scope="col">ID Compra</th>
        <th scope="col">Cantidad de Productos</th>
        <th scope="col">Fecha de Compra</th>
        <th scope="col">Total</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody class="table-group-divider text card-text">
    ';

    foreach ($listaCompras as $compra) {
        $idCompra = $compra['idCompra'];
        $estadoCompra = $compra['estadoCompra'];
        $fechaCompra = $compra['fechaCompra'];
        $fechaCompra = dateFormat($fechaCompra);
        $cantidadCompra = $compra['cantidadItems'];
        $precioTotal = $compra['precioTotal'];
        if ($estadoCompra == 3 || $estadoCompra == 4) {
            $existeCompra = true;
            //crear tabla
            $tieneValoracion = $compra['tieneValoracion'];
            $html .= "<tr>";
            $html .= "<td><a class='btn btn-link' data-bs-toggle='collapse' href='#collapseCompras" . $idCompra . "' role='button' aria-expanded='false' aria-controls='collapseCompras" . $idCompra . "'>
                    <img id='toggleIcon_" . $idCompra . "' src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/chevron-compact-right.svg' alt='right'></a>
             </td>";
            $html .= "<td class='card-title'>" . $idCompra . "</td>";
            $html .= "<td>" . $cantidadCompra . "</td>";
            $html .= "<td>" . $fechaCompra . "</td>";
            $html .= "<td>" . $precioTotal . "</td>";
            $html .= "<td class='text-center'>"
                . (!$tieneValoracion
                    ? " <a href='#' class='btn btn-outline-success edit-btn' data-bs-toggle='modal' data-bs-target='#modalEdit_" . $idCompra . "' type='button' data-bs-tooltip='tooltip' data-bs-placement='left' data-bs-title='comentar'>
                        <img src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/pen.svg' alt='edit'>
                    </a>"
                    : " <a href='#' class='btn btn-outline-success' data-bs-toggle='modal' data-bs-target='#modalSeeReview_" . $idCompra . "' type='button' data-bs-tooltip='tooltip' data-bs-placement='right' data-bs-title='ver tu opinion'>
                        <img src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/eye.svg' alt='see_review'>
                    </a>") .
                "</td>";
            $html .= "</tr>";

            // Función que muestra el área de colapso
            $listaProductos = $compra['compraItem'];
            $html .= collapseProducto($idCompra, $listaProductos);

            $idUsuario = $compra['idUsuario'];
            if (!$tieneValoracion) {
                $idModal = 'modalEdit_' . $idCompra;
                $html .= modalRankearCompra($idModal, $idUsuario, $listaProductos);
            } else {
                $idModal = 'modalSeeReview_' . $idCompra;
                $html .= modalVerValoracion($idModal, $idUsuario, $listaProductos);
            }
        }
    }

    $html .= '</tbody>

    </table>';

    return $html;
}

function crearTablaComprasCanceladas($listaCompras)
{
    $comprasCanceladas = [];
    $existeCompra = false;
    $fechaCancelacion = '';

    foreach ($listaCompras as $compra) {
        $estadoCompra = $compra['estadoCompra'];
        if ($estadoCompra === 5) {
            $comprasCanceladas[] = $compra;
            $existeCompra = true;
        }
    }

    if (!$existeCompra) {
        return '
            <div class="contaier p-4">
                <h5 class="text">No se encontraron compras canceladas.</h5>
            </div>';
    }

    $html = '
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">ID</th>
                <th scope="col">Cantidad Productos</th>
                <th scope="col">Total</th>
                <th scope="col">Fecha Compra</th>
                <th scope="col">Fecha Cancelación</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($comprasCanceladas as $compra) {
        $idCompra = $compra['idCompra'];
        $cantidadCompra = $compra['cantidadItems'];
        $totalCompra = $compra['precioTotal'];
        $fechaCompra = $compra['fechaCompra'];
        $fechaCompra = dateFormat($fechaCompra);
        $fechaCancelacion = $compra['fechaFin'];
        $fechaCancelacion = dateFormat($fechaCancelacion);

        // Concatenar el HTML de cada fila de la tabla
        $html .= "<tr>
            <td>
                <a class='btn btn-link' data-bs-toggle='collapse' href='#collapseCompras" . $idCompra . "' role='button' aria-expanded='false' aria-controls='collapseCompras" . $idCompra . "'>
                    <img id='toggleIcon_" . $idCompra . "' src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/chevron-compact-right.svg' alt='right'>
                </a>
            </td>
            <td class='card-title'>" . $idCompra . "</td>
            <td>" . $cantidadCompra . "</td>
            <td>" . $totalCompra . "</td>
            <td>" . $fechaCompra . "</td>
            <td>" . $fechaCancelacion . "</td>
        </tr>";

        // Función que muestra el área de colapso
        $listaProductos = $compra['compraItem'];
        $html .= collapseProducto($idCompra, $listaProductos);
    }

    $html .= '</tbody>
    </table>';

    return $html;
}

function collapseProducto($idCompra, $listaProductos)
{
    $html = '
        <tr class="collapse" id="collapseCompras' . $idCompra . '">
            <td colspan="4">
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
    ';

    foreach ($listaProductos as $producto) {
        $idProducto = $producto['idProducto'];
        $nombreProducto = $producto['nombreProducto'];
        $cantidadProducto = $producto['cantidadProducto'];
        $precioUnitario = $producto['precioUnitarioProducto'];
        //crear tabla
        $html .= "<tr>";
        $html .= "<td class='card-title'>" . $idProducto . "</td>";
        $html .= "<td>" . $nombreProducto . "</td>";
        $html .= "<td>" . $cantidadProducto . "</td>";
        $html .= "<td>" . $precioUnitario . "</td>";
        $html .= "</tr>";
    }

    $html .= '
                    </tbody>
                </table>
            </td>
        </tr>
    ';

    return $html;
}


function modalRankearCompra($idModal, $idUsuario, $productos)
{
    $html = '
    <div class="modal fade modal-ranking-compra" id="' . $idModal . '" tabindex="-1" aria-labelledby="modalReviewsLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Comentarios</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">';

    foreach ($productos as $producto) {
        $idProducto = $producto['idProducto'];
        $nombreProducto = $producto['nombreProducto'];
        $urlImagen = $producto['urlImagen'];

        $html .= '<div id="card_' . $idModal . '_' . $idProducto . '" class="card card-container p-2 mb-3" data-idusuario="' . $idUsuario . '">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <img src="' . $urlImagen . '" alt="imagen" class="img-product" width="50">
                <h5 class="card-title ms-2">' . $nombreProducto . '</h5>
            </div>
            <div class="rating">
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
            </div>
            <div class="form-floating mt-2">
                <textarea class="form-control" placeholder="Deja un comentario aquí" id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Deja un comentario</label>
            </div>
        </div>
      </div>';
    }

    $html .= '
          </div>
          <div class="modal-footer">
            <button id="btn-save_' . $idModal . '" type="button" class="btn btn-text btn-color btn-save" data-bs-dismiss="modal">Guardar</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>';

    return $html;
}

function modalVerValoracion($idModal, $idUsuario, $productos)
{
    $html = '
    <div class="modal fade modal-ver-valoracion" id="' . $idModal . '" tabindex="-1" aria-labelledby="modalReviewsLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Comentarios</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">';

    foreach ($productos as $producto) {
        $idProducto = $producto['idProducto'];
        $nombreProducto = $producto['nombreProducto'];
        $urlImagen = $producto['urlImagen'];
        $valoracion = $producto['valoracion'];

        $html .= '<div id="card_' . $idModal . '_' . $idProducto . '" class="card card-container p-2 mb-3" data-idusuario="' . $idUsuario . '">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <img src="' . $urlImagen . '" alt="imagen" class="img-product" width="50">
                <h5 class="card-title ms-2">' . $nombreProducto . '</h5>
            </div>
            <input type="hidden" id="promedio_' . $idProducto . '" value="' . $valoracion['ranking'] . '">
            <div id="rating_' . $idProducto . '" class="rating">
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
            </div>
            <p class="card-text">' . $valoracion['descripcion'] . '</p>
        </div>
      </div>';
    }

    $html .= '
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
          </div>
        </div>
      </div>
    </div>';

    return $html;
}
