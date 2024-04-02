<?php
include_once '../../../../config/configuration.php';

$datos = data_submitted();
// viewStructure($datos);

$objetoProducto = new AbmProducto();
$idAEliminar = $datos['idProducto'];

//echo "id a eliminar: $idAEliminar <br/>";

$param = ['idProducto' => $idAEliminar];

//echo "delete 1<br/>";
$listarProductos = $objetoProducto->buscar($param);
//echo "delete 2<br/>";
$eliminarExito = $objetoProducto->baja($param);
// echo "delete 3<br/>";
if ($eliminarExito) {
    $response = array('title' => 'EXITO', 'message' => 'Se elimino el producto con el id: ' . $idAEliminar);
} else {
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al dar de baja el producto con id: ' . $idAEliminar);
}

echo json_encode($response);
