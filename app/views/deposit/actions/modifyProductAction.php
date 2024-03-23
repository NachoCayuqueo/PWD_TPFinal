<?php
include_once '../../../../config/configuration.php';

$objArchivo = new SubirArchivos();
$objProducto = new AbmProducto();
$datos = data_submitted();

$idProducto = $datos['idProducto'];
$param = ["idProducto" => $idProducto];
$producto = $objProducto->buscar($param);


$stockActual = $producto[0]->getProCantStock();
$stockModificado = $stockActual + $datos['stock'];


if (!empty($producto)) {

    if ($_FILES['miArchivo']['error'] <= 0) {
        $nombreImagen = $_FILES["miArchivo"]["name"];
        $rutaTemporal = $_FILES["miArchivo"]["tmp_name"];
        $respuesta = $objArchivo->SubirImagen($nombreImagen, $rutaTemporal, $datos['tipo']);
    }

    if (!$respuesta)
        $nombreImagen = $datos['nombreImagen'];

    $descripcion = $datos['titulo'];
    $masInfo = array($datos['masInfo']);


    $modificarParams = [
        "idProducto" => $datos['idProducto'],
        "proNombre" => $datos['nombre'],
        "proPrecio" => $datos['precio'],
        "proTipo" => $datos['tipo'],
        "proDescripcion" => $datos['titulo'],
        "proMasInfo" => $datos['masInfo'],
        "proImagen" => $nombreImagen,
        "proCantStock" => $datos['stock'],
        "esprodestacado" => $datos['esPopular'],
        "espronuevo" => $datos['esNuevo'],

    ];

    $modificacionExitosa = $objProducto->modificacion($modificarParams);

    if ($modificacionExitosa)
        $response = array('title' => 'EXITO', 'message' => 'Modificacion exitosa con el id: ' . $data['idProducto']);
    else
        $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al editar el producto con id: ' . $data['idProducto']);
} else {
    $response = array('title' => 'NO PRODUCTO', 'message' => 'Producto no encontrado');
}
