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
    // Si no se encontró el rol especificado, buscar el rol "nuevo"
    if ($avatarUsuario === "") {
        foreach ($dataJSON['user'] as $user) {
            if ($user['role'] === 'nuevo') {
                $avatarUsuario = $user['avatar_img'];
                break;
            }
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

/**
 * Envía un correo electrónico utilizando PHPMailer.
 * 
 * @param array $param Parámetros para el envío del correo.
 *  - string $nombreDestinatario: Nombre del destinatario.
 *  - string $emailDestinatario: Correo electrónico del destinatario.
 *  - string $asunto: Tipo de mensaje a enviar (registro, compraAprobada, cambioEmail).
 *  - string $emailAntiguo (opcional): Correo electrónico antiguo en caso de cambio de email.
 * 
 * @return array Resultado del envío del correo.
 *  - string $title: Título del resultado (EXITO o ERROR).
 *  - string $message: Mensaje descriptivo del resultado.
 */
function phpMailer($param)
{
    $nombreDestinatario = $param['nombreDestinatario'];
    $emailDestinatario = $param['emailDestinatario'];

    $mail = new PHPMailer(true);
    $asunto = "";
    $mensaje = "";
    $retorno = "";
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['ADM_EMAIL'];
        $mail->Password = $_ENV['ADM_PASSWORD'];
        $mail->SMTPSecure = 'tls'; // TLS
        $mail->Port = 587; // Puerto SMTP

        list($asunto, $mensaje, $emailDestinatario) = getEmailContent($param);

        // Configuración del remitente y destinatario
        $mail->setFrom($_ENV['ADM_EMAIL'], $_ENV['ADM_NOMBRE']);
        $mail->addAddress($emailDestinatario, $nombreDestinatario);

        // Contenido del correo
        $mail->isHTML(true);

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

function getEmailContent($param)
{
    $nombreDestinatario = $param['nombreDestinatario'];
    $emailDestinatario = $param['emailDestinatario'];
    $tipo = $param['asunto'];

    switch ($tipo) {
        case 'registro':
            $asunto = 'Registro de usuario aprobado';
            $mensaje = 'Hola ' . $nombreDestinatario . ', tu registro en la página de ' . $_ENV['NOMBRE_SITIO'] . ' ha sido aprobado.';
            break;
        case 'compraAprobada':
            $asunto = 'Compra Aprobada';
            $mensaje = 'Hola ' . $nombreDestinatario . ', tu compra en la página de ' . $_ENV['NOMBRE_SITIO'] . ' ha sido aprobada.';
            break;
        case 'cambioDeEmail':
            $asunto = 'Cambio de email';
            // $mensaje = 'Hola ' . $nombreDestinatario . ', tu correo electrónico ha sido modificado. Tu nuevo correo electrónico es: ' . $param['emailDestinatario'] . '.';
            $mensaje = 'Hola ' . $nombreDestinatario . ",<br><br>" .
                "Queremos informarte que tu correo electrónico para ingresar a nuestro sitio web ha sido modificado. A partir de ahora, deberás utilizar el siguiente correo electrónico para acceder a tu cuenta:<br><br>" .
                "Nuevo correo electrónico: " . $param['emailDestinatario'] . "<br><br>" .
                "El correo electrónico anterior (" . $param['emailAntiguo'] . ") ya no podrá ser utilizado para ingresar a nuestro sitio web.<br><br>" .
                "Si no has solicitado este cambio o tienes alguna duda, por favor, ponte en contacto con nuestro soporte lo antes posible.<br><br>" .
                "Gracias por ser parte de " . $_ENV['NOMBRE_SITIO'] . ".<br><br>" .
                "Saludos,<br><br>" .
                "El equipo de " . $_ENV['NOMBRE_SITIO'];
            // $emailDestinatario = $param['emailAntiguo'];
            break;
        case 'altaUsuario':
            $asunto = 'Bienvenido a nuestro sitio';
            $mensaje = "Hola " . $nombreDestinatario . ", ¡Bienvenido a " . $_ENV['NOMBRE_SITIO'] . "!<br><br>" .
                "Tu cuenta ha sido creada exitosamente.<br><br>" .
                "A continuación, encontrarás tus datos de acceso:<br><br>" .
                "Correo electrónico: " . $emailDestinatario . "<br><br>" .
                "Contraseña: " . $param['passwordDestinatario'] . "<br><br>" .
                "Por favor, guarda esta información de manera segura. Puedes cambiar tu contraseña en cualquier momento, iniciando sesión en el sitio y modificándola en la sección de configuraciones.<br><br>" .
                "¡Esperamos que disfrutes tu experiencia en nuestro sitio!";
            break;
        case 'bajaUsuario':
            $asunto = 'Baja de Cuenta';
            $mensaje = 'Hola ' . $nombreDestinatario . ",<br><br>" .
                "Lamentamos informarte que tu cuenta en " . $_ENV['NOMBRE_SITIO'] . " ha sido dada de baja.<br><br>" .
                "Si crees que esto es un error o si tienes alguna pregunta, por favor, ponte en contacto con nuestro soporte.<br><br>" .
                "Saludos,<br>" .
                "El equipo de " . $_ENV['NOMBRE_SITIO'];
            break;
        case 'habilitarUsuario':
            $asunto = 'Habilitacion de Cuenta';
            $mensaje = 'Hola ' . $nombreDestinatario . ', tu cuenta en ' . $_ENV['NOMBRE_SITIO'] . ' ha sido habilitada.';
            break;
        case 'compraCancelada':
            $asunto = 'Compra Cancelada';
            $mensaje = 'Hola ' . $nombreDestinatario . ', tu compra en la página de ' . $_ENV['NOMBRE_SITIO'] . ' fue cancelada.';
            break;
        default:
            throw new Exception('Tipo de mensaje no reconocido.');
    }
    return array($asunto, $mensaje, $emailDestinatario);
}

function dateFormat($originalDate)
{
    if ($originalDate) {
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
    } else {
        return '';
    }
}
