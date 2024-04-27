<?php
// header('Access-Control-Allow-Origin: *');
require_once "../../../../vendor/autoload.php";
include_once '../../../../config/configuration.php';

// Obtener los datos del formulario enviados por AJAX
$data = data_submitted();
$idCompra = $data['idCompra'];
$idUsuario = $data['idUsuario'];
$productos = $data['productos'];

$stripe_secret_key = $_ENV['STRIPE_SECRET_KEY'];
\Stripe\Stripe::setApiKey($stripe_secret_key);


// Establecer el tipo de contenido de la respuesta
header("Content-Type: application/json");

// Crear los items para la sesión de pago de Stripe
$lineItems = [];
foreach ($productos as $producto) {
    $lineItems[] = [
        "price_data" => [
            "currency" => "ARS",
            "unit_amount" => str_replace('$', '', $producto['price']) * 100, // Convertir el precio a centavos
            "product_data" => [
                "name" => $producto['name'],
                // "images" => [$producto['image']]
            ],
        ],
        "quantity" => $producto['quantity']
    ];
}

// Crear la sesión de pago de Stripe
$checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'mode' => 'payment',
    'shipping_address_collection' => ['allowed_countries' => ['AR']],
    'success_url' => 'http://localhost/PWD_TPFinal/app/views/customer/success.php?idCompra=' . $idCompra . '&idUsuario=' . $idUsuario,
    'cancel_url' => 'http://localhost/PWD_TPFinal/app/views/customer/cancel.php',
    "line_items" => $lineItems,
]);


// Redirigir al cliente a la página de pago de Stripe
// header("HTTP/1.1 303 See Other");
// header("Location: " . $checkout_session->url);
echo json_encode(['id' => $checkout_session->id]);
