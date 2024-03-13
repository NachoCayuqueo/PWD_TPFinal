//TODO: mover a login
<?php
include_once '../../../../config/configuration.php';

$session = new Session();
$session->cerrar();

header('Location: ' . $PRINCIPAL);
