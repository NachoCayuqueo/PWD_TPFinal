<?php
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
