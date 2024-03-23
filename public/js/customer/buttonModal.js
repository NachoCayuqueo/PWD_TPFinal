$("#modalReviews").on("shown.bs.modal", function () {
  $(".card").each(function () {
    const cardId = $(this).attr("id");
    if (cardId) {
      const partesId = cardId.split("_");
      const id = partesId[partesId.length - 1];

      const promedio = parseFloat($("#promedio_" + id).val());
      // Obtiene la parte entera del promedio
      const parteEntera = Math.floor(promedio);

      // Obtiene la parte decimal del promedio
      const parteDecimal = promedio - parteEntera;

      // Busca las estrellas específicamente dentro de la tarjeta actual
      const stars = $(this).find(".rating .star");

      // Pinta las estrellas completas según la parte entera
      stars.slice(0, parteEntera).addClass("filled");

      // Pinta la media estrella según la parte decimal
      if (parteDecimal > 0) {
        stars.eq(parteEntera).addClass("fraction");
      }
    }
  });
});
