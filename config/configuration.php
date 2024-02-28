<?php

//* set time zone
date_default_timezone_set('America/Buenos_Aires');

$GLOBALS['ROOT'] = $_SERVER['DOCUMENT_ROOT'];

//* proyect name
$PROYECT = 'PWD_TPFinal';

//* store the project directory
$ROOT = $_SERVER['DOCUMENT_ROOT'] . "/$PROYECT/";

//* direction to principal
$PRINCIPAL = "http://" . $_SERVER['HTTP_HOST'] . "/$PROYECT";

//* direction to js files
$PUBLIC_JS = $PRINCIPAL . "/public/js";

//* direction to views
$VISTAS = $PRINCIPAL . "/app/views";

//* direction to router
$ROUTER = $PRINCIPAL . "/router";

//* direction to Bootstrap icons
$BOOTSTRAP_ICONS = $PRINCIPAL . "/public/lib/bootstrap/bootstrap-icons/icons";

//* direction to Logos
$LOGOS = $PRINCIPAL . "/assets/logos";

//* direction to Images
$IMAGES = $PRINCIPAL . "/assets/images";

//* .env configuration with phpdotenv
require $ROOT . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable($GLOBALS['PRINCIPAL']);
$dotenv->load();


include_once($ROOT . 'utils/functions.php');

$_SESSION['ROOT'] = $ROOT;
