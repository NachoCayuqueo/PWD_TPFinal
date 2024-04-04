<?php
include_once '../../../../config/configuration.php';

$datos = data_submitted();

$objetoProducto = new AbmProducto();
$idAEliminar = $datos['idProducto'];

// echo $idAEliminar;

$paramProducto = ['idProducto' => $idAEliminar];



$objetoValoracion = new AbmValoracionProducto(); // buscar si esta la valoracion para eliminarla primero antes de eliminar el producto
$listaValoraciones = $objetoValoracion->buscar($paramProducto); //encuentra las valoraciones ahora tengo q eliminarlas segundo el idProducto
$eliminarExito = true;

// viewStructure($listaValoraciones);


if (!empty($listaValoraciones)) { //si es vacia paso porq no tiene validaciones
    // echo "lista de valoraciones no es vacia <br/>";
    foreach ($listaValoraciones as $valoracion) {
        $idValoracion = $valoracion->getIdValoracionProducto();
        $paramValoracion = ['idValoracion' => $idValoracion];
        $eliminarExito = $objetoValoracion->baja($paramValoracion);
    }
}

$objetoCompraItem = new AbmCompraItem();
$comprasDeProducto = $objetoCompraItem->buscar($paramProducto);
//viewStructure($comprasDeProducto);
if (!empty($comprasDeProducto)) { //si encunetra una compra la elimna
    // echo "el producto tiene compras <br/>";
    $idCompraItem =  $comprasDeProducto[0]->getIdCompraItem();
    $paramCompraItem = ['idCompraItem' => $idCompraItem];
    //echo "idcompraItem: $idCompraItem";
    // aca tengo q mandar el id de la compra item para poder eliminarlo
    $bajaCompraExito = $objetoCompraItem->baja($paramCompraItem);
    // if ($bajaCompraExito)
    //     echo "true <br/>";
    // else
    //     echo "false <br/>";
}

if ($eliminarExito) {
    $listarProductos = $objetoProducto->buscar($paramProducto);
    $eliminarProdExito = $objetoProducto->baja($paramProducto);
}


if ($eliminarExito) {
    $response = array('title' => 'EXITO', 'message' => 'Se elimino el producto con el id: ' . $idAEliminar);
} else {
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al dar de baja el producto con id: ' . $idAEliminar);
}

echo json_encode($response);
