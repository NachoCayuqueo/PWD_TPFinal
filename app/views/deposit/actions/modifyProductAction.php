<?php
include_once '../../../../config/configuration.php';

$objProducto = new AbmProducto();
$datos = data_submitted();

$idProducto = $datos['idProducto'];
$param = ["idProducto" => $idProducto];
$producto = $objProducto->buscar($param);

//! MODIFIACION PARA EVITAR SIEMPRE INGRESAR STOCK
$stockActual = $producto[0]->getProCantStock();
$stockIngresado = $datos['stock'];
if (!$stockIngresado) {
    $stockModificado = $stockActual + $datos['stock'];
} else {
    $stockModificado = $stockActual + 0;
}

//! MODIFICACION PARA CONTROLAR SI SE CAMBIA EL TIPO, CAMBIO LA FOTO DE LUGAR 
$tipoActual = $producto[0]->getProTipo();
$tipoIngresado = $datps['tipo'];
$cambiarImagenDeLugar = false;
if ($tipoIngresado != $tipoActual) {
    $cambiarImagenDeLugar = true;
}



if (!empty($producto)) {
    $modificarParams = [
        "idProducto" => $datos['idProducto'],
        "proNombre" => $datos['nombre'],
        "proPrecio" => $datos['precio'],
        "proTipo" => $datos['tipo'],
        "proDescripcion" => $datos['titulo'],
        "proMasInfo" => $datos['masInfo'],
        "proImagen" => $datos['nombreImagen'],
        "proCantStock" => $stockModificado,
        "esprodestacado" => $datos['esPopular'],
        "espronuevo" => $datos['esNuevo'],

    ];

    $modificacionExitosa = $objProducto->modificacion($modificarParams);

    if (!$cambiarImagenDeLugar) {
    }

    if ($modificacionExitosa)
        $response = array('title' => 'EXITO', 'message' => 'Modificacion exitosa con el id: ' . $datos['idProducto']);
    else
        $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al editar el producto con id: ' . $datos['idProducto']);
} else {
    $response = array('title' => 'NO PRODUCTO', 'message' => 'Producto no encontrado');
}
// Convertir el array a formato JSON
echo json_encode($response);
