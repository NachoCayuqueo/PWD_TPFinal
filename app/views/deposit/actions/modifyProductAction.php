<?php

use function PHPSTORM_META\elementType;

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
$tipoNuevo = $datos['tipo'];
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

    if ($cambiarImagenDeLugar && $modificacionExitosa) {
        $objSubirArchivos = new SubirArchivos();
        $nombreImagen = $datos['nombreImagen'];
        $imagenMovida = $objSubirArchivos->cambiarImagenDeLugar($nombreImagen, $tipoActual, $tipoNuevo);
        $response = array('title' => 'EXITO', 'message' => 'Fue modificado con exito el produto: ' . $datos['idProducto']);
    } else
        $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al editar el producto con id: ' . $datos['idProducto']);
} else {
    $response = array('title' => 'NO PRODUCTO', 'message' => 'Producto no encontrado');
}
// viewStructure($responde);
// Convertir el array a formato JSON
echo json_encode($response);
