$(document).ready(function () {
  $.ajax({
    url: "../../views/customer/actions/buyProductAction.php",
    type: "POST",
    data: {
      idProducto,
    },
    success: function (response) {
      response = JSON.parse(response);

      createViewHTML(response);
    },
    error: function (xhr, status, error) {
      console.log({ error });
      const datosAlerta = {
        title: "Error",
        message:
          "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
      };
      mostrarAlerta(datosAlerta);
    },
  });

  // Agregar el script ranking.js
  $.getScript("../../../public/js/customer/ranking.js")
    .done(function (script, textStatus) {
      console.log("Script ranking.js cargado correctamente");
      // Aquí puedes cargar los otros scripts una vez que ranking.js haya sido cargado
      loadAdditionalScripts();
    })
    .fail(function (jqxhr, settings, exception) {
      console.error("Error al cargar el script ranking.js:", exception);
    });

  function loadAdditionalScripts() {
    // Agregar el script handleQuantityButtonClick.js
    $.getScript("../../../public/js/customer/handleQuantityButtonClick.js")
      .done(function (script, textStatus) {
        console.log(
          "Script handleQuantityButtonClick.js cargado correctamente"
        );
        // Aquí puedes cargar el siguiente script
        $.getScript("../../../public/js/customer/buttonModal.js")
          .done(function (script, textStatus) {
            console.log("Script buttonModal.js cargado correctamente");
            // Aquí puedes cargar el siguiente script
            $.getScript("../../../public/js/customer/cartAjax.js")
              .done(function (script, textStatus) {
                console.log("Script cartAjax.js cargado correctamente");
              })
              .fail(function (jqxhr, settings, exception) {
                console.error(
                  "Error al cargar el script cartAjax.js:",
                  exception
                );
              });
          })
          .fail(function (jqxhr, settings, exception) {
            console.error(
              "Error al cargar el script buttonModal.js:",
              exception
            );
          });
      })
      .fail(function (jqxhr, settings, exception) {
        console.error(
          "Error al cargar el script handleQuantityButtonClick.js:",
          exception
        );
      });
  }
});

function createViewHTML(productInfo) {
  const { title, message, productData, idUsuario } = productInfo;
  const {
    id,
    nombre,
    descripcion,
    precio,
    stock,
    urlImagen,
    masInfo,
    datosValoraciones,
    productosSimilares,
  } = productData;
  const { valoraciones, cantidadValoraciones, promedio } = datosValoraciones;

  uploadImageHTML(urlImagen, nombre);
  updateProductInfo(
    id,
    idUsuario,
    nombre,
    promedio,
    cantidadValoraciones,
    descripcion,
    masInfo,
    precio,
    stock,
    valoraciones
  );
  updateSimilarProductsHTML(productosSimilares);
}

function uploadImageHTML(urlImage, name) {
  const img = $("<img>", {
    src: urlImage,
    alt: name,
    class: "image img-fluid",
    width: "90%",
  });
  $("#container-image").html(img);
}

function updateProductInfo(
  idProducto,
  idUsuarioActivo,
  name,
  average,
  countReviews,
  description,
  additionalInfo,
  price,
  stock,
  ratings
) {
  $("#product-info").attr("data-id-product", idProducto);
  $("#product-info").attr("data-id-user", idUsuarioActivo);
  productNameHTML(name);
  ratingAverageHTML(average);
  updateReviewCountHTML(countReviews);
  updateDescriptionHTML(description, additionalInfo);
  updatePriceHTML(price);
  updateContainerButtonsHTML(stock);
  updateStockControlHTML(stock);
  updateStockHTML(stock);
  updateModalReviewsHTML(ratings);
}

function productNameHTML(name) {
  $("#product-name").text(name);
}

function ratingAverageHTML(average) {
  $("#container-promedio-hidden").html(`
    <input id="promedio" type="hidden" value="${average}">
  `);
}

function updateReviewCountHTML(countReviews) {
  $("#count-reviews").html(`
    <a href="#" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalReviews">
      ${countReviews > 0 ? countReviews : "0"} reviews
    </a>
  `);
}

function updateDescriptionHTML(description, additionalInfo) {
  let descriptionHTML = `
    <h5 class="text">${description}</h5>
  `;

  additionalInfo.forEach((info) => {
    descriptionHTML += `<p class="ms-3 text"> - ${info}</p>`;
  });

  $("#container-description").html(descriptionHTML);
}

function updatePriceHTML(price) {
  $("#price").html(`
    <h3 class="title">$ ${price}</h3>
  `);
}

function updateStockControlHTML(stock) {
  $("#stock-control").html(stock <= 1 ? "Apresúrate, es el último!" : "");
}

function updateContainerButtonsHTML(stock) {
  $("#container-buttons").html(`
    <div class="input-group mb-3" style="width: 150px;">
      <button class="btn btn-outline-secondary border-color-custom ${
        stock === 1 ? "disabled" : ""
      }" type="button" id="button-minus">
        <img src="../../../public/lib/bootstrap/bootstrap-icons/icons/dash.svg" alt="minus">
      </button>
      <input type="number" class="form-control text-center border-color-custom" placeholder="1" id="quantity" value="1" readonly>
      <button class="btn btn-outline-secondary border-color-custom ${
        stock === 1 ? "disabled" : ""
      }" type="button" id="button-plus">
        <img src="../../../public/lib/bootstrap/bootstrap-icons/icons/plus.svg" alt="plus">
      </button>
    </div>
    <div class="ms-2 btn-text">
      <button class="btn btn-color" id="btn-cart">AGREGAR AL CARRITO</button>
    </div>
  `);
}

function updateStockHTML(stock) {
  $("#stock")
    .attr("data-cantStock", stock)
    .html(`cantidad disponible: ${stock}/${stock}`);
}

function updateModalReviewsHTML(ratings) {
  modalReviews(ratings, function (modalReviewsHtml) {
    $("#container-modal-reviews").html(modalReviewsHtml);
  });
}

function modalReviews(valoraciones, callback) {
  $.ajax({
    url: "../../views/customer/actions/generateModalReviewsAction.php",
    type: "POST",
    data: {
      valoraciones,
    },
    success: function (response) {
      response = JSON.parse(response);
      const modalReviewsHtml = response;
      callback(modalReviewsHtml); // callback con el HTML del modal
    },
    error: function (xhr, status, error) {
      console.log({ error });
      const datosAlerta = {
        title: "Error",
        message:
          "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
      };
      mostrarAlerta(datosAlerta);
    },
  });
}

function updateSimilarProductsHTML(similarProducts) {
  updateTitleHTML();
  const productInfo = [
    {
      type: similarProducts[0].proTipo,
      idContainer: "container-similar-products",
      showRandomProducts: true,
    },
  ];
  getProducts(productInfo, similarProducts[0].proTipo);
}

function updateTitleHTML() {
  $("#container-similar-title").html(
    '<h1 class="title">Productos Similares</h1>'
  );
}

function getProducts(productInfo, type) {
  productInfo.forEach((product) => {
    $.ajax({
      url: "../../views/home/actions/getProductsAction.php",
      type: "POST",
      data: {
        productType: product.type,
      },
      success: function (response) {
        response = JSON.parse(response);
        createProductsCard(
          response,
          product.idContainer,
          product.showRandomProducts,
          type
        );
      },
      error: function (xhr, status, error) {
        console.log({ error });
        const datosAlerta = {
          title: "Error",
          message:
            "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        };
        mostrarAlerta(datosAlerta);
      },
    });
  });
}

function createProductsCard(
  productData,
  idContainer,
  showRandomProducts,
  type
) {
  let productsContainer = "";

  //TODO: esta parte no es de jquery creo, cambiar aqui
  productsContainer = document.getElementById(idContainer);

  if (productData.title === "EXITO") {
    products = productData.products;
    let selectedProducts = products;
    if (showRandomProducts) {
      const shuffledProducts = products.sort(() => 0.5 - Math.random());
      selectedProducts = shuffledProducts.slice(0, 3);
    }

    let htmlContent = `
        <div class="title-with-line">
          <h1 class="title text-center">${productData.typeName}</h1>
        </div>
        <div>
          <div class="container-sm p-4">
            <div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">
      `;
    selectedProducts.forEach((product) => {
      const botonComprar = `../customer/buyProduct.php?idProducto=${product.idProducto}`;
      htmlContent += `
          <div class="col">
            ${createProductCardHTML(product, botonComprar)}
          </div>
        `;
    });
    htmlContent += `
    </div>
  </div>
  <div id="similarProductsButton" class="text-center">
                <a href="similarProducts.php?type=${type}" class="btn btn-text btn-color">Mas Productos similares</a>
            </div>
</div>
`;

    productsContainer.innerHTML = htmlContent;
  } else {
    productsContainer.innerHTML =
      "<div class='container text-center'>" + products.message + "</div>";
  }
}

function createProductCardHTML(product, botonComprar) {
  const moreInfoArray = product.proMasInfo.split(".");
  const nombreImagen = product.proImagen;
  const tipo = product.proTipo;
  const stock = product.proCantStock;
  const urlImagen = `../../../assets/images/products/${tipo}/${nombreImagen}`;

  return `
      <div class="card card-container card-container-height p-2 h-100">
        ${stockControl(stock)}
         <img src="${urlImagen}" class="image card-img-top" alt="${
    product.proNombre
  }">
        <div class="card-body">
            <h5 class="mt-2 title text-center">${product.proNombre}</h5>
            <p class="card-text text">${product.proDescripcion}</p>
            <h3 class="text-center text">$${product.proPrecio}</h3>
        </div>
        <div class="text-center mb-3 btn-text">
            <a href="${botonComprar}" class="btn${
    stock === 0 ? " btn-secondary disabled" : " btn-color"
  } rounded-pill me-2">Comprar</a>
            <a id="btn-more-info-${
              product.idProducto
            }" class="btn btn-color rounded-pill" onclick="moreProductInfo(${
    product.idProducto
  })">
              Más info
            </a>
        </div>
 <div id="mas-info-${product.idProducto}" class="p-2" style="display: none;">
        ${generateArrayMoreInfo(moreInfoArray)}
      </div>
      </div>
    `;
}

function stockControl(stock) {
  let ribbonHtml = "";
  if (stock === 0) {
    ribbonHtml = `
          <div class="ribbon">
            <span class="text">Sin Stock</span>
          </div>`;
  }
  return ribbonHtml;
}

function generateArrayMoreInfo(moreInfoArray) {
  let moreInfoHtml = "";
  moreInfoArray.forEach((content) => {
    moreInfoHtml += `<p class="text card-text">${content}</p>`;
  });
  return moreInfoHtml;
}
