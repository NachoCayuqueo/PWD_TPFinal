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

$arregloProductos = [];
$idUsuario = 0;
$precioFinal = 0;
$existeCompraCarrito = false;
foreach ($listaCompras as $compra) {
    $estadoCompra = $compra['estadoCompra'];
    if ($estadoCompra === 1) {
        $existeCompraCarrito = true;
        $idUsuario = $compra['idUsuario'];
        $idCompra = $compra['idCompra'];
        $arregloProductos = $compra['compraItem'];
        break;
    }
}

echo '
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Carrito de Compras</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>';
if ($existeCompraCarrito) {
    echo '
            <div class="offcanvas-body">
            <form id="formulario-compra_' . $idCompra . '" name="formulario-compra" class="formulario-compra" data-idusuario="' . $idUsuario . '">';
    foreach ($arregloProductos as $producto) {
        //viewStructure($arregloProductos);
        $idProducto = $producto['idProducto'];
        $nombreProducto = $producto['nombreProducto'];
        $cantidadProducto = $producto['cantidadProducto'];
        $stockDisponile = $producto['stockDisponible'];

        $precioUnitario = $producto['precioUnitarioProducto'];
        $urlImagen = $producto['urlImagen'];
        $precioProductoTotal = $cantidadProducto *  $precioUnitario;
        $precioFinal += $precioProductoTotal;

        echo '
            <div id="card-compra" class="card mb-2">
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
                            <img src="' . $urlImagen . '" alt="imagen" class="img-product" width="100">
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="input-group me-3" style="width: 120px;">
                                <button class="btn btn-outline-secondary border-color-custom" type="button" id="button-minus_' . $idProducto . '" data-iduser="' . $idUsuario . '">
                                    -
                                </button>
                                <input readonly type="number" class="form-control text-center border-color-custom" placeholder="1" id="quantity_' . $idProducto . '" value="' . $cantidadProducto . '" data-cantidad="' . $cantidadProducto . '" data-stock="' . $stockDisponile . '">
                                <button class="btn btn-outline-secondary border-color-custom" type="button" id="button-plus_' . $idProducto . '" data-iduser="' . $idUsuario . '">
                                    +
                                </button>
                            </div>
                            <div>
                                <p class="card-text"> $' . $precioProductoTotal . '</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="card-text text-center">' . ($stockDisponile === 0 ? "¡Ultimo Producto!" : "") . '</p>
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
                    <button class="btn btn-outline-primary btn-text" type="submit">Comprar</button>
                </div>
            </form>
        </div>';
} else {
    echo '
            <div class="m-2">
                <hr style="color: black;">
            </div>
            <p class="text-center text">No se agregaron productos al carrito</p>
    ';
}
echo
'</div>';

echo '<script src="https://js.stripe.com/v3/"></script>';
echo '<script src="' . $PUBLIC_JS . '/customer/handleQuantityCartAjax.js"></script>';
echo '<script src="' . $PUBLIC_JS . '/customer/checkoutAjax.js"></script>';
