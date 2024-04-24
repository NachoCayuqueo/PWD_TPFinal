$(document).ready(function () {
  $("#button-minus").on("click", function () {
    const inputValue = $("#quantity").val();
    const newValue = parseInt(inputValue) - 1;
    if (newValue > 0) {
      $("#quantity").val(newValue);
      actualizarCantidadDisponible();
    }
  });

  $("#button-plus").on("click", function () {
    const stock = $("#stock").data("cantstock");
    const inputValue = $("#quantity").val();
    const newValue = parseInt(inputValue) + 1;

    if (newValue <= stock) {
      $("#quantity").val(newValue);
      actualizarCantidadDisponible();
    }
  });
});

// Función para actualizar el texto de cantidad disponible
function actualizarCantidadDisponible() {
  const stock = $("#stock").data("cantstock");

  const cantidadSeleccionada = parseInt($("#quantity").val());
  const cantidadDisponible = stock - cantidadSeleccionada;

  $("#stock").text("cantidad disponible: " + cantidadDisponible + "/" + stock);
}
