<?php
//TODO: ver si esto esta bien asi o crear un ajax 
include_once '../../../config/configuration.php';
$data = data_submitted();
$idCompra = $data['idCompra'];
if ($idCompra) {
    $objetoCompraEstado = new AbmCompraEstado();
    $estadoIniciado = 2;
    $cambioExitodo = $objetoCompraEstado->cambiarEstadoCompra($idCompra, $estadoIniciado);
} else {
    header('Location: ' . $PRINCIPAL);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Compra Exitosa";
    include_once "../structures/head.php";
    ?>
</head>

<body>
    <div class="container mt-5">
        <div id="card-exito" class="card card-container p-2 mb-3">
            <div class="card-body">
                <h5 class="card-title text-center">¡Compra Exitosa!</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">
                    Gracias por tu compra en nuestra tienda de mascotas
                </h6>
                <p class="card-text">Tu pedido ha sido procesado correctamente. Pronto recibirás tu pedido de productos para perros en la dirección proporcionada.</p>
                <div class="text-center">
                    <a href="../home/" class="btn btn-primary">Volver a la tienda</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>