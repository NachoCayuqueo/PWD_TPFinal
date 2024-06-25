<?php
include_once "../../controllers/validaciones.php";

$objetoCompra = new AbmCompra();
$compras = $objetoCompra->obtenerDetallesCompras();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Panel Admin";
    include_once "../structures/head.php";
    include_once "./structures/shoppingTable.php";
    ?>
</head>

<body>
    <?php
    include_once '../structures/navbar.php';
    ?>
    <div class="mt-3">
        <h1 class="title text-center">Panel Administrador</h1>
    </div>
    <div class="container-sm p-4">
        <?php
        if ($compras) {
            echo '
         <div class="text">
             <ul class="nav nav-tabs" id="myTab" role="tablist">
                 <li class="nav-item" role="presentation">
                   <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Autorizar Nuevas Compras</button>
                 </li>
               
                 <li class="nav-item" role="presentation">
                   <button class="nav-link" id="authorized-shopping-tab" data-bs-toggle="tab" data-bs-target="#authorized-shopping-tab-pane" type="button" role="tab" aria-controls="authorized-shopping-pane" aria-selected="false">Compras Autorizadas</button>
                 </li>

                 <li class="nav-item" role="presentation">
                   <button class="nav-link" id="cancel-shopping-tab" data-bs-toggle="tab" data-bs-target="#cancel-shopping-tab-pane" type="button" role="tab" aria-controls="cancel-shopping-tab-pane" aria-selected="false">Compras Canceladas</button>
                 </li>
             </ul>
             <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">';
            if (crearTablaNuevasCompras($compras) === 0) {
                echo "<p>No se encontraron compras nuevas.</p>";
            }
            echo '</div>
               <div class="tab-pane fade" id="authorized-shopping-tab-pane" role="tabpanel" aria-labelledby="authorized-shopping-tab" tabindex="0">';
            if (crearTablaComprasAutorizadas($compras) === 0) {
                echo "<p>No se encontraron compras autorizadas.</p>";
            }
            echo '</div>
               <div class="tab-pane fade" id="cancel-shopping-tab-pane" role="tabpanel" aria-labelledby="cancel-shopping-tab" tabindex="0">';
            if (crearTablaComprasCanceladas($compras) === 0) {
                echo "<p>No se encontraron compras que hayan sido canceladas.</p>";
            }
            echo '</div>
             </div>
         </div>
         ';
        }
        ?>
    </div>

    <?php include_once "../structures/footer.php"; ?>
</body>

</html>