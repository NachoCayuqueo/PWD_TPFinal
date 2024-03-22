<?php
$session = new Session();
$existeSesion = false;
if ($session->validar()) {
    $usuario = $session->getUsuario();
    if (!is_null(($usuario))) {
        $idUsuarioActivo = $usuario->getIdUsuario();
    }
    $objetoCompra = new AbmCompra();
    $param = ['idUsuario' => $idUsuarioActivo];
    $listaCompras = $objetoCompra->obtenerCompras($param);
}

$listaProductos = [];
$idUsuario = 0;
$precioFinal = 0;
foreach ($listaCompras as $compra) {
    $estadoCompra = $compra['estadoCompra'];
    if ($estadoCompra === 1) {
        $idUsuario = $compra['idUsuario'];
        $idCompra = $compra['idCompra'];
        $listaProductos = $compra['compraItem'];
        break;
    }
}

echo '
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Carrito de Compras</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">';
foreach ($listaProductos as $producto) {
    $idProducto = $producto['idProducto'];
    $nombreProducto = $producto['nombreProducto'];
    $cantidadProducto = $producto['cantidadProducto'];
    $precioUnitario = $producto['precioUnitarioProducto'];
    $urlImagen = $producto['urlImagen'];
    $precioProductoTotal = $cantidadProducto *  $precioUnitario;
    $precioFinal += $precioProductoTotal;
    echo '
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-sm-9"> <!-- Para ocupar el 80% del espacio -->
                            <h5 class="card-title title m-0">' . $nombreProducto . '</h5>
                        </div>
                        <div class="col-sm-3 text-end"> <!-- Para ocupar el 20% del espacio -->
                            <button class="btn btn-outline-danger m-0 btn-radius" type="button" id="button-trash_' . $idProducto . '" data-idcompra="' . $idCompra . '">
                                <img src="' . $GLOBALS['BOOTSTRAP_ICONS'] . '/trash3.svg" alt="trash">
                            </button>
                        </div>
                    </div>
            
                  <div class="d-flex">
                    <div class="me-2">
                        <img src="' . $urlImagen . '" alt="imagen" width="100">
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="input-group me-3" style="width: 120px;">
                            <button class="btn btn-outline-secondary border-color-custom" type="button" id="button-minus_' . $idProducto . '" data-iduser="' . $idUsuario . '">
                                -
                            </button>
                            <input type="number" class="form-control text-center border-color-custom" placeholder="1" id="quantity_' . $idProducto . '" value="' . $cantidadProducto . '" data-cantidad="' . $cantidadProducto . '">
                            <button class="btn btn-outline-secondary border-color-custom" type="button" id="button-plus_' . $idProducto . '" data-iduser="' . $idUsuario . '">
                                +
                            </button>
                        </div>
                        <div>
                            <p class="card-text"> $' . $precioProductoTotal . '</p>
                        </div>
                    </div>
                  </div>
                </div>
            </div>';
}
echo '
                <div class="mt-4 mb-4">
                    <hr style="color: black;">
                </div>
                <div class="d-flex justify-content-between">
                    <h3 class="title">Total:</h3>
                    <h3 class="title">$' . $precioFinal . '</h3>
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button class="btn btn-outline-primary btn-text" type="button">Comprar</button>
                </div>
            </div>
                </div>';

echo '<script src="' . $PUBLIC_JS . '/customer/handleQuantityCartAjax.js"></script>';
