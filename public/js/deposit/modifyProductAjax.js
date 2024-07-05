document.addEventListener("DOMContentLoaded", function () {
  // console.log("Datos del producto:", datosProducto);
  document.getElementById("nombre").value = datosProducto.nombre;
  document.getElementById("precio").value = datosProducto.precio;
  document.getElementById("stock").value = datosProducto.stock;
  document.getElementById("titulo").value = datosProducto.nombreCompleto;
  document.getElementById("masInfo").value = datosProducto.descripcionCompleta;
  document.getElementById("idProducto").value = datosProducto.idProducto;
  document.getElementById("nombreImagen").value = datosProducto.nombreImagen;

  document.getElementById("stockActual").textContent =
    "Stock actual: " + datosProducto.stock;

  document.getElementById("imagen").src =
    "../../../assets/images/products/" +
    datosProducto.tipo +
    "/" +
    datosProducto.nombreImagen;

  var radiosTipo = document.getElementsByName("tipo");
  for (var i = 0; i < radiosTipo.length; i++) {
    if (radiosTipo[i].value === datosProducto.tipo) {
      radiosTipo[i].checked = true;
    }
  }

  var radiosEsPopular = document.getElementsByName("esPopular");
  for (var i = 0; i < radiosEsPopular.length; i++) {
    if (radiosEsPopular[i].value === datosProducto.esPopular) {
      radiosEsPopular[i].checked = true;
    }
  }

  var radiosEsNuevo = document.getElementsByName("esNuevo");
  for (var i = 0; i < radiosEsNuevo.length; i++) {
    if (radiosEsNuevo[i].value === datosProducto.esNuevo) {
      radiosEsNuevo[i].checked = true;
    }
  }
});
