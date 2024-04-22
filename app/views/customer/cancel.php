<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Compra Cancelado";
    include_once "../structures/head.php";
    ?>
</head>

<body>
    <div class="container mt-5">
        <div id="card-exito" class="card card-container p-2 mb-3">
            <div class="card-body">
                <h5 class="card-title text-center">¡Compra Cancelada!</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">
                    Lo sentimos, tu pago no se ha procesado
                </h6>
                <p class="card-text">Tu pedido no se ha podido completar debido a que el pago ha sido cancelado. Por favor, intenta nuevamente o ponte en contacto con nuestro equipo de soporte si necesitas ayuda.</p>
                <div class="text-center">
                    <a href="../home/" class="btn btn-primary">Volver a la tienda</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>