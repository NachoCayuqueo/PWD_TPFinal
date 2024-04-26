$(document).ready(function () {
  $(".rating .star").click(function () {
    const card = $(this).closest(".card-container");
    const estrellas = $(this).index() + 1; // Obtener el índice de la estrella clicada
    // Quitar la clase 'filled' de todas las estrellas dentro de esta card
    card.find(".star").removeClass("filled");
    // Agregar la clase 'filled' a las estrellas clicadas y a todas las estrellas anteriores dentro de esta card
    card.find(".star:lt(" + estrellas + ")").addClass("filled");
  });

  $(".star").hover(
    function () {
      $(".star").removeClass("hovered");
      $(this).addClass("hovered");
      $(this).prevAll().addClass("hovered");
    },
    function () {
      $(".star").removeClass("hovered");
    }
  );

  $(".btn-primary").click(function () {
    datosCards = [];

    // Recorrer cada card
    $(".card-container").each(function () {
      const card = $(this);
      const idProducto = obtenerId(card);
      const idUsuario = card.data("idusuario");
      const estrellas = card.find(".star.filled").length; // Contar las estrellas marcadas
      const comentario = card.find("textarea").val(); // Obtener el comentario

      datosCards.push({
        idUsuario,
        idProducto,
        estrellas: estrellas,
        comentario: comentario,
      });
    });

    //AJAX
    $.ajax({
      url: "../../views/customer/actions/classifyProductAction.php",
      type: "POST",
      data: {
        productosRankeados: datosCards,
      },
      success: function (response) {
        response = JSON.parse(response);
        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: response.message,
          }).then((result) => {
            location.reload();
            // window.location.href = "../../../app/views/home";
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message,
          });
        }
      },
      error: function (xhr, status, error) {
        // Maneja los errores de la solicitud AJAX
        console.error(error);
        console.error(xhr.responseText);
        // Muestra una alerta de error
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        });
      },
    });
  });

  $(".card-container").each(function () {
    const card = $(this);
    const idProducto = obtenerId(card);
    const promedio = parseFloat($("#promedio_" + idProducto).val()); // Obtener el promedio del input oculto
    const parteEntera = Math.floor(promedio); // Obtener la parte entera del promedio
    const parteDecimal = promedio - parteEntera; // Obtener la parte decimal del promedio

    // Pintar las estrellas completas según la parte entera
    card.find(".rating").find(".star").slice(0, parteEntera).addClass("filled");

    // Pintar la media estrella según la parte decimal
    if (parteDecimal > 0) {
      card.find(".rating").find(".star").eq(parteEntera).addClass("fraction");
    }
  });
});

function obtenerId(card) {
  const idCompleto = card.attr("id");
  const partesId = idCompleto.split("_");
  return partesId[partesId.length - 1];
}
