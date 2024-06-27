<?php
include_once "../../controllers/validaciones.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Principal";
    include_once "../structures/head.php";
    ?>
</head>

<body>
    <?php
    include_once '../structures/navbar.php';
    include_once '../structures/cards.php';
    ?>

    <div class="container-fluid banner-color banner-text-color">
        <div class="row py-3">
            <div class="col-md-8">
                <h2 class="welcome-title text-center">Bienvenidos a</h2>
                <h1 class="welcome-title text-center">Doggy Friends</h1>
                <p class="text mt-3 mb-auto p-2">¡Bienvenidos a Doggys Friends, tu destino número uno para mimar a tus fieles compañeros de cuatro patas! En Doggys Friends, nos enorgullece ofrecerte
                    una amplia gama de productos diseñados para el bienestar y la felicidad de tus adorables amigos peludos. Desde juguetes irresistibles hasta las últimas
                    tendencias en moda canina, estamos aquí para satisfacer todas las necesidades de tus perros con estilo y calidad. <br />
                </p>
                <p class="text p-2">
                    En Doggys Friends, sabemos que cada perro es único, por eso nos esforzamos por ofrecerte una experiencia de compra personalizada y amigable.Nuestro equipo de
                    expertos está aquí para brindarte asesoramiento y recomendaciones para que encuentres los productos perfectos que se adapten a las necesidades y personalidad
                    de tu peludo amigo.
                </p>
            </div>
            <div class="col-md-4">
                <div class="image-container">
                    <img src="<?php echo $IMAGES ?>/welcome1.png" alt="welcome" class="img-fluid" style="width: 600px;">
                </div>
            </div>
        </div>
    </div>
    <!-- populars products  -->
    <div id="container-favorite-products"></div>

    <!-- new products -->
    <div id="container-new-products"></div>
    <script>
        const productInfo = [{
                type: "favorite",
                idContainer: "container-favorite-products",
                showRandomProducts: true
            },
            {
                type: "new",
                idContainer: "container-new-products",
                showRandomProducts: true
            }
        ]
    </script>
    <script src="<?php echo $PUBLIC_JS ?>/customer/getProductsAjax.js"></script>
    <script src="<?php echo $PUBLIC_JS ?>/moreProductInfo.js"></script>
    <?php include_once "../structures/footer.php"; ?>
</body>

</html>