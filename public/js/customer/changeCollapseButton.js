$(document).ready(function () {
  // Evento que se dispara cuando se muestra la tabla colapsable
  $(".collapse").on("shown.bs.collapse", function () {
    // Obtener el ID de la tabla colapsable
    const idCompra = $(this).attr("id").replace("collapseCompras", "");

    // Cambiar la imagen del botón a chevron-compact-down
    $("#toggleIcon_" + idCompra).attr(
      "src",
      "../../../public/lib/bootstrap/bootstrap-icons/icons/chevron-compact-down.svg"
    );
  });

  // Evento que se dispara cuando se oculta la tabla colapsable
  $(".collapse").on("hidden.bs.collapse", function () {
    // Obtener el ID de la tabla colapsable
    const idCompra = $(this).attr("id").replace("collapseCompras", "");
    // Cambiar la imagen del botón a chevron-compact-right
    $("#toggleIcon_" + idCompra).attr(
      "src",
      "../../../public/lib/bootstrap/bootstrap-icons/icons/chevron-compact-right.svg"
    );
  });
});
