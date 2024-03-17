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
    //si carga la imagen hago todo el resto
    if ($respuesta) {

        $descripcion = $datos['titulo'];
        $masInfo = $datos['masInfo'];
        //armo el json 
        $json = array(
            "descripcion" => $descripcion,
            "masInfo" => $masInfo,
            "imagen" => $nombreImagen
        );
        $json_final = json_encode($json);


        $modificarParams = [
            "proNombre" => $datos['nombre'],
            "proDetalle" => $json_final,
            "proCantStock" => $stockModificado,
            "proTipo" => $datos['tipo'],
            "proPrecio" => $datos['precio'],
            "esProDestacado" => $datos['esPopular'],
            "esProNuevo" => $datos['esNuevo'],
            "idProducto" => $idProducto,

        ];

        $modificacionExitosa = $objProducto->modificacion($modificarParams);
        if ($modificacionExitosa)
            $response = array('title' => 'EXITO', 'message' => 'Modificacion exitosa con el id: ' . $data['idProducto']);
        else
            $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al editar el producto con id: ' . $data['idProducto']);
    }
} else {
    $response = array('title' => 'NO PRODUCTO', 'message' => 'Producto no encontrado');
}
