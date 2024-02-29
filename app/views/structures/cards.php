<?php

/**
 * Genera una tarjeta HTML de producto con la información proporcionada.
 *
 * @param string $cardId        El ID único de la tarjeta de producto.
 * @param string $urlImagen     La URL de la imagen del producto.
 * @param string $title         El título del producto.
 * @param string $description   La descripción del producto.
 * @param array  $moreInfo      Un arreglo con información adicional sobre el producto.
 * @param string $price         El precio del producto.
 * @param string $hrefComprar   El enlace para comprar el producto.
 * @return void
 */
function productsCard($cardId, $urlImagen, $title, $description, $moreInfo, $price, $hrefComprar)
{
    echo '
        <div class="card card-container p-2" style="height: 100%;">
            <img src="' . $urlImagen . '" class="image card-img-top" alt="' . $title . '">
            <div class="card-body">
                <h5 class="mt-2 text-center">' . $title . '</h5>
                <p class="card-text">' . $description . '</p>
                <h3 class="text-center">$' . $price . '</h3>
            </div>
            <div class="text-center mb-3">
                <a href="' . $hrefComprar . '" class="btn btn-primary rounded-pill me-2">comprar</a>
                <a id="btn-more-info-' . $cardId . '" class="btn btn-primary rounded-pill" onclick="moreProductInfo(' . $cardId . ')">
                    Mas info
                </a>
            </div>
            <div id="mas-info-' . $cardId . '" class="p-2" style="display: none;" >';

    foreach ($moreInfo as $content) {
        echo '<p class="card-text">' . $content . '</p>';
    }
    echo '
            </div> 
        </div>';

    //* script para mostrar u ocultar la información adicional
    echo ' <script src="' . $GLOBALS['PUBLIC_JS'] . '/moreProductInfo.js"></script>';
}




// function productsCard($urlImagen, $title, $descriptions, $price, $hrefComprar, $hrefMasInfo)
// {
//     echo '
//         <div class="card p-2" style="height: 100%;">
//             <img src="' . $urlImagen . '" class="card-img-top" alt="' . $title . '">
//             <div class="card-body">
//                 <h5 class="mt-2 text-center">' . $title . '</h5>';

//     foreach ($descriptions as $content) {
//         if (is_array($content)) {
//             echo '<p class="card-text">' . $content . '</p>';
//         }
//     }
//     echo '        <h3 class="text-center">$' . $price . '</h3>
//                 <div class="text-center">
//                     <a href="' . $hrefComprar . '" class="btn btn-primary rounded-pill me-2">comprar</a>
//                     <a href="' . $hrefMasInfo . '" class="btn btn-primary rounded-pill">mas info</a>
//                 </div>
//             </div>
//         </div>';
// }