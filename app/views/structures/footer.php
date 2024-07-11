<?php
include_once "./config/configuration.php";

?>
<div class="container-fluid footer footer-color">
    <div class="row p-3">
        <div class="text-center">
            <img src="<?php echo $LOGOS ?>/logo_pet_shop.png" alt="inicio" width="80">
        </div>
        <hr class="mt-3 mb-3" style="color: white;">
        <div class="col-xs-12 col-md-4">
            <h5 class="mb-3 footer-title">Nosotros</h5>
            <div class="mb-2 footer-text">
                <p class="text">Somos Doggy Friends, tu destino para todo lo relacionado con el bienestar y la felicidad de tus amigos de cuatro patas. Nos dedicamos a proporcionarte los mejores productos y servicios para cuidar a tu mascota y hacer que su vida sea aún más emocionante y saludable.</p>
                <a href="<?php echo $VISTAS ?>/nosotros.php" class="btn btn-text fw-bold footer-text">¿Quienes Somos?</a>
            </div>
        </div>
        <div class="col-xs-12 col-md-4 footer-text">
            <h5 class="mb-3 footer-title">Contactános</h5>
            <div class="d-flex mb-2">
                <img class="footer-img" src="<?php echo $BOOTSTRAP_ICONS ?>/whatsapp.svg" alt="whatsapp">
                <p class="text">2995-111-999</p>
            </div>
            <div class="d-flex mb-2">
                <img class="footer-img" src="<?php echo $BOOTSTRAP_ICONS ?>/telephone-fill.svg" alt="telephone">
                <p class="text">764-84377</p>
            </div>
            <div class="d-flex mb-2">
                <img class="footer-img" src="<?php echo $BOOTSTRAP_ICONS ?>/envelope-at-fill.svg" alt="email">
                <p class="text">Doggy.Friends@gmail.com</p>
            </div>
            <div class="d-flex mb-2">
                <img class="footer-img" src="<?php echo $BOOTSTRAP_ICONS ?>/geo-alt-fill.svg" alt="location">
                <p class="text">Avenida Siempreviva 742</p>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <h5 class="mb-3 footer-title">Nuestras Redes sociales</h5>
            <div class="mb-2">
                <a href="https://www.facebook.com" target="_blank"><img class="footer-img" src="<?php echo $BOOTSTRAP_ICONS ?>/facebook.svg" alt="facebook"></a>
                <a href="https://www.instagram.com" target="_blank"><img class="footer-img" src="<?php echo $BOOTSTRAP_ICONS ?>/instagram.svg" alt="instagram"></a>
                <a href="https://twitter.com/?lang=es" target="_blank"><img class="footer-img" src="<?php echo $BOOTSTRAP_ICONS ?>/twitter-x.svg" alt="twitter-x"></a>
            </div>
        </div>
        <hr class="mt-3 mb-3" style="color: white;">
        <div class="col-xs-12">
            <p class=" footer-title text-center">&copy; DOGGY FRIENDS Todos los derechos reservados, 2024</p>
        </div>
    </div>
</div>