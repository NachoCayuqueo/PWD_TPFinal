<?php
include_once('../vendor/phpmailer/phpmailer/src/PHPMailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function data_submitted()
{
    //* Auxiliary function to take the received data regardless of the method used
    $_AAux = array();
    if (!empty($_POST)) {
        $_AAux = $_POST;
    } elseif (!empty($_GET)) {
        $_AAux = $_GET;
    }
    if (count($_AAux)) {
        foreach ($_AAux as $indice => $valor) {
            if ($valor == "") {
                $_AAux[$indice] = 'null';
            }
        }
    }
    return $_AAux;
}

spl_autoload_register(function ($class) {
    $directorys = array(
        $GLOBALS['ROOT'] . 'app/models/',
        $GLOBALS['ROOT'] . 'app/models/conector/',

        $GLOBALS['ROOT'] . 'app/controllers/',

        $_SESSION['ROOT'] . 'app/views/',
    );
    foreach ($directorys as $directory) {
        if (file_exists($directory . $class . '.php')) {
            require_once($directory . $class . '.php');
            return;
        }
    }
});

function viewStructure($param)
{
    echo "<pre>";
    print_r($param);
    echo "</pre>";
}

function getJSONFileUser()
{
    $filePath = $GLOBALS['PRINCIPAL'] . '/utils/userdata.json';
    $string = file_get_contents($filePath);
    $json = json_decode($string, true);

    return $json;
}

function getAvatar($rol)
{
    $avatarUsuario = "";

    $dataJSON = getJSONFileUser();
    foreach ($dataJSON['user'] as $user) {
        if ($user['role'] === $rol) {
            // Encontramos el usuario, ahora puedes acceder a su avatar
            $avatarUsuario = $user['avatar_img'];
            break;
        }
    }
    return $avatarUsuario;
}

function getHomePage($rol)
{
    $homepage = "";

    $dataJSON = getJSONFileUser();
    foreach ($dataJSON['user'] as $user) {
        if ($user['role'] === $rol) {
            $homepage = $user['homepage'];
            break;
        }
    }
    return $homepage;
}


function phpMailer($nombreDestinatario, $emailDestinatario, $tipo)
{

    $mail = new PHPMailer(true);
    $asunto = "";
    $mensaje = "";
    $retorno = "";
    try {
        // Configuración del servidor SMTP de Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['ADM_EMAIL']; // Tu dirección de correo 1electrónico completa
        $mail->Password = $_ENV['ADM_PASSWORD']; // Tu contraseña de Gmail
        $mail->SMTPSecure = 'tls'; // TLS
        $mail->Port = 587; // Puerto SMTP

        // Configuración del remitente y destinatario
        $mail->setFrom($_ENV['ADM_EMAIL'], $_ENV['ADM_NOMBRE']);
        $mail->addAddress($emailDestinatario, $nombreDestinatario);

        // Contenido del correo
        $mail->isHTML(true);

        switch ($tipo) {
            case 'registro':
                $asunto = 'Registro de usuario aprobado';
                $mensaje = 'Hola ' . $nombreDestinatario . ', tu registro en la página de ' . $_ENV['NOMBRE_SITIO'] . ' ha sido aprobado.';
                break;
            case 'compraAprobada':
                $asunto = 'CompraAprobada';
                $mensaje = 'Hola ' . $nombreDestinatario . ', tu compra en la página de ' . $_ENV['NOMBRE_SITIO'] . ' ha sido aprobada.';
                break;
        }
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;

        // Envío del correo
        $mail->send();
        $retorno = array('title' => 'EXITO', 'message' => 'El correo fue enviado correctamente.');
    } catch (Exception $e) {
        $retorno = array('title' => 'ERROR', 'message' => 'Error al enviar el correo: ' . $mail->ErrorInfo);
    }
    return $retorno;
}
function dateFormat($originalDate)
{
    $months = array(
        1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
        5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
        9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
    );

    $timestamp = strtotime($originalDate);
    $day = date('d', $timestamp);
    $monthNumber = date('n', $timestamp);
    $month = $months[$monthNumber];
    $year = date('Y', $timestamp);

    return $day . '-' . $month . '-' . $year;
}
