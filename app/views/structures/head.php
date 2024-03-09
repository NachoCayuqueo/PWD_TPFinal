<?php
include_once "../../../config/configuration.php";
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo $title ?></title>

<!-- STYLES -->
<link rel="shortcut icon" href="<?php echo $PRINCIPAL ?>/assets/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href='<?php echo $PRINCIPAL ?>/public/lib/bootstrap/bootstrap.min.css'>
<link rel="stylesheet" href='<?php echo $PRINCIPAL ?>/public/css/globalStyles.css'>

<!-- SWEETALERT2 -->
<link rel="stylesheet" href="<?php echo $PRINCIPAL ?>/public/lib/sweetalert2/sweetalert2.min.css">
<script src="<?php echo $PRINCIPAL ?>/public/lib/sweetalert2/sweetalert2.all.min.js"></script>

<!-- SCRIPT -->
<script type="text/javascript" src='<?php echo $PRINCIPAL ?>/public/lib/bootstrap/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src='<?php echo $PRINCIPAL ?>/public/lib/jquery-3.7.1.min.js'></script>
<script type="text/javascript" src='<?php echo $PRINCIPAL ?>/public/js/modalAction.js'></script>
<script type="text/javascript" src='<?php echo $PRINCIPAL ?>/public/js/tooltipScript.js'></script>