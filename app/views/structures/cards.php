<?php

/**
 * Genera una tarjeta HTML de producto con la información proporcionada.
 *
 * @param Producto  un producto
 * @param string $hrefComprar   El enlace para comprar el producto.
 * @return void
 */
function productsCard($product, $hrefComprar)
{
    // Convertir el string $moreInfo en un arreglo usando explode
    $moreInfoArray = explode('.', $product->getProMasInfo());
    $nombreImagen = $product->getProImagen();
    $tipo = $product->getProTipo();
    $stock = $product->getProCantStock();

    $urlImagen =  $GLOBALS['IMAGES'] . "/products/" . $tipo . "/" . $nombreImagen;

    echo '
        <div class="card card-container card-container-height p-2 h-100">
        ';
    if ($stock === 0) {
        echo '<div class="ribbon">
            <span class="text">Sin Stock</span>
        </div>';
    }

    echo '  
            
            <img src="' . $urlImagen . '" class="image card-img-top" alt="' . $product->getProNombre() . '">
            
            <div class="card-body">
                <h5 class="mt-2 title text-center">' . $product->getProNombre() . '</h5>
                <p class="card-text text">' . $product->getProDescripcion() . '</p>
                <h3 class="text-center text">$' . $product->getProPrecio() . '</h3>
            </div>
            <div class="text-center mb-3 btn-text">
                <a href="' . $hrefComprar . '" class="btn' . ($stock === 0 ? " btn-secondary disabled" : " btn-color") . ' rounded-pill me-2">Comprar</a>
                <a id="btn-more-info-' . $product->getIdProducto() . '" class="btn btn-color rounded-pill" onclick="moreProductInfo(' . $product->getIdProducto() . ')">
                    Mas info
                </a>
            </div>
            <div id="mas-info-' . $product->getIdProducto() . '" class="p-2" style="display: none;" >';

    foreach ($moreInfoArray as $content) {
        echo '<p class="text card-text">' . $content . '</p>';
    }
    echo '
            </div> 
        </div>';

    //* script para mostrar u ocultar la información adicional
    echo ' <script src="' . $GLOBALS['PUBLIC_JS'] . '/moreProductInfo.js"></script>';
}

function buttonCard($href, $text)
{
    $url = $GLOBALS['VISTAS'] . "/" . $href;
    echo '
    <div class="card p-2 shadow border border-0">
        <a href="' .  $url . '" class="btn">
            <div class="card-body">
                <h5 class="card-title title">' . $text . '</h5>
            </div>
        </a>
    </div>
    ';
}
