$(document).ready(function () {
  $("#form-modificar-producto").submit(function (event) {
    event.preventDefault();
    //TODO: funciona pero no hace la validacion de los campos ya que falta esa parte
    //! se debe realizar la validacionFormulario
    if (validarFormulario(event)) {
      const archivo = $("#miArchivo")[0].files[0];

      if (archivo) {
        // Si se seleccionó un archivo, llamar a la función guardarImagen() para guardar la imagen
        guardarImagenModif(archivo);
      } else {
        // Si no se seleccionó un archivo, llamar directamente a enviarFormularioDeModificacion() sin pasar un nombre de imagen
        enviarFormularioDeModificacion();
      }
    }
  });
  $("#form-nuevo-producto").submit(function (event) {
    event.preventDefault();
    //TODO: funciona pero no hace la validacion de los campos ya que falta esa parte
    //! se debe realizar la validacionFormulario
    //if (validarFormulario()) {
    const archivo = $("#miArchivo")[0].files[0];
    guardarImagenNuevo(archivo);
  });
});

function guardarImagenModif(archivo) {
  // Crear un objeto FormData
  let formData = new FormData();

  const tipo = $("input[name='tipo']:checked").val();
  // Agregar el archivo seleccionado al objeto FormData
  // const archivo = $("#miArchivo")[0].files[0];
  formData.append("miArchivo", archivo);
  // Agregar el tipo al formData
  formData.append("tipo", tipo);

  // Solicitud AJAX
  $.ajax({
    type: "POST",
    url: "../../views/deposit/actions/saveImageAction.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      response = JSON.parse(response);
      console.log(response); // Manejar la respuesta del servidor
      if (response.title === "EXITO") {
        const nombreImg = archivo.name;
        enviarFormularioDeModificacion(nombreImg);
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: response.message,
        });
      }
    },
    error: function (xhr, status, error) {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Consulte con un administrador",
      });
    },
  });
}
function guardarImagenNuevo(archivo) {
  // Crear un objeto FormData
  let formData = new FormData();

  const tipo = $("input[name='tipo']:checked").val();
  // Agregar el archivo seleccionado al objeto FormData
  // const archivo = $("#miArchivo")[0].files[0];
  formData.append("miArchivo", archivo);
  // Agregar el tipo al formData
  formData.append("tipo", tipo);

  // Solicitud AJAX
  $.ajax({
    type: "POST",
    url: "../../views/deposit/actions/saveImageAction.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      response = JSON.parse(response);
      console.log(response); // Manejar la respuesta del servidor
      if (response.title === "EXITO") {
        const nombreImg = archivo.name;
        enviarFormularioDeCreacion(nombreImg);
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: response.message,
        });
      }
    },
    error: function (xhr, status, error) {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Consulte con un administrador",
      });
    },
  });
}

function enviarFormularioDeModificacion(nombreImg) {
  // Crear un objeto FormData
  const idProducto = $("#idProducto").val();
  const nombre = $("#nombre").val();
  const precio = $("#precio").val();
  const tipo = $("input[name='tipo']:checked").val();
  const titulo = $("#titulo").val();
  const masInfo = $("#masInfo").val();
  const nombreImagen = nombreImg ? nombreImg : $("#nombreImagen").val();
  const stock = $("#stock").val();
  const esPopular = $("input[name='esPopular']:checked").val();
  const esNuevo = $("input[name='esNuevo']:checked").val();
  //AJAX
  $.ajax({
    url: "../../views/deposit/actions/modifyProductAction.php",
    type: "POST",
    data: {
      idProducto,
      nombre,
      precio,
      tipo,
      titulo,
      masInfo,
      nombreImagen,
      stock,
      esPopular,
      esNuevo,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.title === "EXITO") {
        Swal.fire({
          icon: "success",
          title: "Éxito",
          text: response.message,
        }).then((result) => {
          // Redirecciona a la página deseada
          window.location.href = "../../views/deposit/dashboard.php";
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
}

function enviarFormularioDeCreacion(nombreImg) {
  // Crear un objeto FormData
  const nombre = $("#nombre").val();
  const precio = $("#precio").val();
  const tipo = $("input[name='tipo']:checked").val();
  const titulo = $("#titulo").val();
  const masInfo = $("#masInfo").val();
  const stock = $("#stock").val();
  const esPopular = $("input[name='esPopular']:checked").val();
  const esNuevo = $("input[name='esNuevo']:checked").val();

  //AJAX
  $.ajax({
    url: "../../views/deposit/actions/newProductAction.php",
    type: "POST",
    data: {
      nombre,
      precio,
      tipo,
      titulo,
      masInfo,
      stock,
      esPopular,
      esNuevo,
      nombreImg,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.title === "EXITO") {
        Swal.fire({
          icon: "success",
          title: "Éxito",
          text: response.message,
        }).then((result) => {
          // Redirecciona a la página deseada
          window.location.href = "../../views/deposit/dashboard.php";
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
}
