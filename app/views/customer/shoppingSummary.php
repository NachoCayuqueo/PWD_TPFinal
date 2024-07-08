<?php
include_once "../../controllers/validaciones.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Panel Usuario";
    include_once "../structures/head.php";
    include_once "./strucures/summaryTable.php";
    ?>
</head>


<body>
    <?php
    include_once '../structures/navbar.php';
    ?>
    <script src="<?php echo $PUBLIC_JS ?>/customer/shoppingSummaryAjax.js"></script>
    <div class="mt-3">
        <h1 class="title text-center">Mis Compras</h1>
    </div>
    <div class="container-sm p-4">

        <?php
        if (true) {
            echo '
            <div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Compras Realizadas</button>
                    </li>
                  
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Compras Canceladas</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    <div id="container-crear-tabla-resumen-compra"></div>';
            echo '</div>
                  <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                    <div id="container-crear-tabla-compras-canceladas"></div>';
            echo '</div>
                </div>
            </div>
            ';
        } else {
            echo '
                    <div class="container d-flex justify-content-center">
                        <p class="card-text">Aun no has realizado ninguna compra en nuestra tienda</p>
                    </div>';
        }
        ?>
    </div>

    <?php include_once "../structures/footer.php"; ?>
</body>

</html>