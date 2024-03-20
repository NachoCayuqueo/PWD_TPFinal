<?php

/**
 * Genera una tarjeta HTML de producto con la información proporcionada.
 *
 * @param string $cardId        El ID único de la tarjeta de producto.
 * @param string $urlImagen     La URL de la imagen del producto.
 * @param string $title         El título del producto.
 * @param string $description   La descripción del producto.
 * @param string $moreInfo      Un string con información adicional sobre el producto separada por '.'.
 * @param string $price         El precio del producto.
 * @param string $hrefComprar   El enlace para comprar el producto.
 * @return void
 */
function productsCard($cardId, $urlImagen, $title, $description, $moreInfo, $price, $hrefComprar)
{
    // Convertir el string $moreInfo en un arreglo usando explode
    $moreInfoArray = explode('.', $moreInfo);
    echo '
        <div class="card card-container p-2" style="height: 100%;">
            <img src="' . $urlImagen . '" class="image card-img-top" alt="' . $title . '">
            <div class="card-body">
                <h5 class="mt-2 text-center">' . $title . '</h5>
                <p class="card-text">' . $description . '</p>
                <h3 class="text-center">$' . $price . '</h3>
            </div>
            <div class="text-center mb-3">
                <a href="' . $hrefComprar . '" class="btn btn-color rounded-pill me-2">Comprar</a>
                <a id="btn-more-info-' . $cardId . '" class="btn btn-color rounded-pill" onclick="moreProductInfo(' . $cardId . ')">
                    Mas info
                </a>
            </div>
            <div id="mas-info-' . $cardId . '" class="p-2" style="display: none;" >';

    foreach ($moreInfoArray as $content) {
        echo '<p class="card-text">' . $content . '</p>';
    }
    echo '
            </div> 
        </div>';

    //* script para mostrar u ocultar la información adicional
    echo ' <script src="' . $GLOBALS['PUBLIC_JS'] . '/moreProductInfo.js"></script>';
}
