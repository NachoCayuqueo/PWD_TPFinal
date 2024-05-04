$(document).ready(function () {
  const stripe = Stripe(
    "pk_test_51Mgu3rDt1CbGvoYeFb2fmn3hNhnnYMC6fkzz03WgCypsAVx0GKXAUx1w2YcS6QTTAc3KeHwLOIbegnrpkxLzTMID00Pegyz4jV"
  );
  $(".formulario-compra").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);
    const idForm = obtenerId(formulario);
    const idUsuario = $("#formulario-compra_" + idForm).data("idusuario");
    // Recolectar la información de cada producto y el precio final
    const productos = [];
    // Seleccionar todas las tarjetas dentro del formulario (busca todos los descendientes)
    const tarjetas = $("#formulario-compra_" + idForm + " .card");

    // Iterar sobre cada tarjeta
    tarjetas.each(function (index, elemento) {
      const titulo = $(elemento).find(".card-title").text();
      const cantidad = $(elemento).find(".form-control").val();
      const precio = $(elemento).find(".card-text").text();
      const imagen = $(elemento).find(".img-product").attr("src");

      productos.push({
        name: titulo,
        quantity: cantidad,
        price: precio,
        image: imagen,
      });
    });

    const botonCompra = formulario.find('button[type="submit"]');
    botonCompra.prop("disabled", true);
    console.log(formulario.find(".spinner-border"));
    formulario.find(".spinner-border").removeClass("d-none");

    $.ajax({
      url: "../../views/customer/actions/checkout.php",
      method: "POST",
      data: {
        idCompra: idForm,
        idUsuario,
        productos,
      },
      success: function (session) {
        formulario.find(".spinner-border").hide();
        stripe.redirectToCheckout({
          sessionId: session.id,
        });
        // Manejar la respuesta si es necesaria
      },
      error: function (xhr, status, error) {
        formulario.find(".spinner-border").hide();
        // Manejar errores si es necesario
        console.log(xhr);
        console.log("error:" + error);
      },
    });
  });
});

function obtenerId(formulario) {
  const idCompleto = formulario.attr("id");
  const partesId = idCompleto.split("_");
  return partesId[partesId.length - 1];
}
