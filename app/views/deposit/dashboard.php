<?php
include_once "../../controllers/validaciones.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Panel Deposito";
    include_once "../structures/head.php";
    include_once "./structures/usersTable.php";
    ?>
</head>

<body>
    <?php
    include_once '../structures/navbar.php';
    ?>
    <div class="mt-3">
        <h1 class="title text-center">Panel Deposito</h1>
    </div>
    <div class="container-sm p-4" id="dashboardDeposit">
    </div>
    <script src="<?php echo $PUBLIC_JS ?>/deposit/deleteProduct.js"></script>
    <script src="<?php echo $PUBLIC_JS ?>/deposit/dashboardAjax.js"></script>
    <?php include_once "../structures/footer.php"; ?>
</body>

</html>