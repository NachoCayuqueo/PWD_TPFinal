$(document).ready(function () {
  // Evento que se dispara cuando se muestra la tabla colapsable
  $(".collapse").on("shown.bs.collapse", function () {
    // Obtener el ID de la tabla colapsable
    const idUsuario = $(this).attr("id").replace("collapseUsuario", "");

    // Cambiar la imagen del botón a chevron-compact-down
    //$('#toggleIcon_' + idUsuario).attr('src', '<?php echo $GLOBALS['BOOTSTRAP_ICONS']; ?>/chevron-compact-down.svg');
    $("#toggleIcon_" + idUsuario).attr(
      "src",
      "../../../public/lib/bootstrap/bootstrap-icons/icons/chevron-compact-down.svg"
    );
  });

  // Evento que se dispara cuando se oculta la tabla colapsable
  $(".collapse").on("hidden.bs.collapse", function () {
    // Obtener el ID de la tabla colapsable
    const idUsuario = $(this).attr("id").replace("collapseUsuario", "");
    // Cambiar la imagen del botón a chevron-compact-right
    //$('#toggleIcon_' + idUsuario).attr('src', '<?php echo $GLOBALS['BOOTSTRAP_ICONS']; ?>/chevron-compact-right.svg');
    $("#toggleIcon_" + idUsuario).attr(
      "src",
      "../../../public/lib/bootstrap/bootstrap-icons/icons/chevron-compact-right.svg"
    );
  });
});
