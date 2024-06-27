$(document).ready(function () {
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
          product.showRandomProducts
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
});

function createProductsCard(productData, idContainer, showRandomProducts) {
  let productsContainer = "";

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
