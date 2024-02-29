/*
 * funcion que se utiliza en las card genericas de la portada para mostrar/ocultar información adicional
 */
function moreProductInfo(cardId) {
  const infoDiv = $("#mas-info-" + cardId);
  const moreInfoBtn = $("#btn-more-info-" + cardId);

  if (infoDiv.css("display") === "none") {
    infoDiv.css("display", "block");
    moreInfoBtn.text("Menos Info");
  } else {
    infoDiv.css("display", "none");
    moreInfoBtn.text("Mas Info");
  }
}
