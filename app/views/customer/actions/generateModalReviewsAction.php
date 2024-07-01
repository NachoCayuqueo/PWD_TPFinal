<?php
include_once '../../../../config/configuration.php';
$data = data_submitted();
$valoraciones = $data['valoraciones'];

$objetoValoracion = new AbmValoracionProducto();

$modalReview = $objetoValoracion->generateModalReviews($valoraciones);

echo json_encode($modalReview);
