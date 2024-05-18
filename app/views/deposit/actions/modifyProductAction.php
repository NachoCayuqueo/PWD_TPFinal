<?php
include_once '../../../../config/configuration.php';

$objProducto = new AbmProducto();
$datos = data_submitted();

$idProducto = $datos['idProducto'];
$param = ["idProducto" => $idProducto];
$producto = $objProducto->buscar($param);

$stockActual = $producto[0]->getProCantStock();

$stockIngresado = $datos['stock'];
if (!$stockIngresado) {
    $stockModificado = $stockActual + $datos['stock'];
} else {
    $stockModificado = $stockActual + 0;
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

    if ($modificacionExitosa)
        $response = array('title' => 'EXITO', 'message' => 'Modificacion exitosa con el id: ' . $datos['idProducto']);
    else
        $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al editar el producto con id: ' . $datos['idProducto']);
} else {
    $response = array('title' => 'NO PRODUCTO', 'message' => 'Producto no encontrado');
}
// Convertir el array a formato JSON
echo json_encode($response);
