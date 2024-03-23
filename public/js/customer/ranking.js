$(document).ready(function () {
  // Calcula el promedio de las valoraciones (reemplaza esto con tu lógica para obtener el promedio)
  const promedio = parseFloat($("#promedio").val());
  // Obtiene la parte entera del promedio
  const parteEntera = Math.floor(promedio);

  // Obtiene la parte decimal del promedio
  const parteDecimal = promedio - parteEntera;

  // Pinta las estrellas completas según la parte entera
  $(".rating").find(".star").slice(0, parteEntera).addClass("filled");

  // Pinta la media estrella según la parte decimal
  if (parteDecimal > 0) {
    $(".rating").find(".star").eq(parteEntera).addClass("fraction");
  }
});
