<?php

include_once "../../config/configuration.php";

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

include_once "../../vendor/autoload.php";

$session = new Session();
$objetoUsuarioRol = new AbmUsuarioRol();
if ($session->validar()) {
    $usuario = $session->getUsuario();
    $idUsuario = $usuario->getIdUsuario();
    $rol = $objetoUsuarioRol->obtenerRolActivo($idUsuario);
    $nombreRolActivo = $rol->getRoDescripcion();
}

if (!is_null($nombreRolActivo) && $nombreRolActivo !== 'cliente') {
    $locacion = getHomePage($nombreRolActivo);
    header('Location: ' . $VISTAS . "/" . $locacion);
}


$objetoProducto = new AbmProducto();
$productosDestacados = $objetoProducto->obtenerProductosSimilares('favorite');
$productosNuevos = $objetoProducto->obtenerProductosSimilares('new');

$existenProductosDestacados = false;
if ($productosDestacados) {
    $existenProductosDestacados = true;
}
$existenProductosNuevos = false;
if (!empty($productosNuevos)) {
    $existenProductosNuevos = true;
}

//incluimos la clase PHPMailer
include_once('../../vendor/phpmailer/phpmailer/src/PHPMailer.php');


// $mail = new PHPMailer(true);

// try {
//     // Configuración del servidor SMTP de Gmail
//     $mail->isSMTP();
//     $mail->Host = 'smtp.office365.com';
//     $mail->SMTPAuth = true;
//     $mail->Username = $_ENV['ADM_EMAIL']; // Tu dirección de correo electrónico completa
//     $mail->Password = $_ENV['ADM_PASSWORD']; // Tu contraseña de Gmail
//     $mail->SMTPSecure = 'tls'; // TLS
//     $mail->Port = 587; // Puerto SMTP

//     // Configuración del remitente y destinatario
//     $mail->setFrom($_ENV['ADM_EMAIL'], $_ENV['ADM_NOMBRE']);
//     $mail->addAddress('pabloaldana.cipo@gmail.com', 'Nombre del Destinatario');

//     // Contenido del correo
//     $mail->isHTML(true);
//     $mail->Subject = 'Prueba de correo SMTP';
//     $mail->Body    = 'Este es un correo de prueba enviado desde PHPMailer con SMTP';

//     // Envío del correo
//     $mail->send();
//     echo 'El correo fue enviado correctamente.';
// } catch (Exception $e) {
//     echo 'Error al enviar el correo: ', $mail->ErrorInfo;
// }
// //envío el mensaje, comprobando si se envió correctamente
// if (!$mail->Send()) {
//     echo "Error al enviar el mensaje: " . $mail->ErrorInfo;
// } else {
//     echo "Mensaje enviado!!";
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Quienes Somos";
    include_once "./structures/head.php";
    ?>
</head>

<body>
    <?php
    include_once './structures/navbar.php';
    include_once './structures/cards.php';
    ?>
    <div class="container-fluid m-5">
        <div class="row">
            <div class="col">
                <div class="card mb-3" style="max-width: 800px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo $IMAGES ?>/nacho.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3" style="max-width: 800px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo $IMAGES ?>/pablo.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php include_once "./structures/footer.php"; ?>
</body>

</html>