<?php
include_once '../../../config/configuration.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Panel Deposito";
    include_once "../structures/head.php";
    include_once "../structures/cards.php";
    ?>
</head>

<body>
    <?php
    include_once '../structures/navbar.php';
    ?>

    <div class="mt-3">
        <h1 class="title text-center">Panel Deposito</h1>
    </div>
    <div class="container-sm">
        <div class="row row-cols-1 row-cols-md-3 p-4 mb-4 row-gap-4 text-center d-flex justify-content-center" id="menuDeposito">
        </div>
    </div>
    <script src="<?php echo $PUBLIC_JS ?>/deposit/indexAjax.js"> </script>
    <?php include_once "../structures/footer.php"; ?>
</body>

</html>