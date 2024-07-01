<?php
include_once "../../controllers/validaciones.php";
//TODO: revisar SESSION: recuperarMenuActual()

$data = data_submitted();
$idProducto = $data['idProducto'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Comprar";
    include_once "../structures/head.php";
    include_once "./strucures/modals.php";
    ?>
</head>

<body>
    <?php
    include_once '../structures/navbar.php';
    include_once '../structures/cards.php';
    ?>
    <script>
        const idProducto = "<?php echo $idProducto; ?>";
    </script>
    <script src="<?php echo $PUBLIC_JS ?>/customer/buyProductAjax.js"></script>

    <div class="container p-2">
        <div class="row">
            <div class="col-8">
                <div id="container-image" class="container p-2">
                    <!-- image product -->
                </div>
            </div>
            <div id="product-info" class="col-4">
                <div class="mt-3">
                    <h1 id="product-name" class="title text-center">
                        <!-- name product -->
                    </h1>
                </div>
                <hr class="my-1" style="border-width: 2px; color: #2d3f50;">

                <div class="rating-container">
                    <div class="rating">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                    </div>
                    <div class="reviews text">
                        <div id="container-promedio-hidden">
                            <!-- hidden average -->
                        </div>
                        <div id="count-reviews">
                            <!-- reviews -->
                        </div>
                        <div id="container-modal-reviews">
                            <!-- modal reviews -->
                        </div>
                    </div>
                </div>

                <div id="container-description" class="mt-3">
                    <!-- description -->
                    <!-- more info -->
                </div>
                <div id="price" class="mt-4">
                    <!-- price -->
                </div>
                <div class="mt-3">
                    <p id="stock-control">
                        <!-- stock control -->
                    </p>
                    <div id="container-buttons" class="d-flex">
                        <!-- buttons -->
                    </div>
                    <p id="stock">
                        <!-- stock -->
                    </p>
                </div>
            </div>
        </div>
        <div id="container-similar-products" class="container mb-4">
            <!-- similar products -->

            <!-- button similar products -->

        </div>
    </div>
    <script src="<?php echo $PUBLIC_JS ?>/moreProductInfo.js"></script>
    <?php include_once "../structures/footer.php"; ?>
</body>

</html>