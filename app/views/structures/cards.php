<?php

/**
 * Genera una tarjeta HTML de producto con la información proporcionada.
 *
 * @param string $urlImagen     La URL de la imagen del producto.
 * @param string $title         El título del producto.
 * @param string $description   La descripción del producto.
 * @param string $price         El precio del producto.
 * @param string $hrefComprar   El enlace para comprar el producto.
 * @param string $hrefMasInfo   El enlace para obtener más información sobre el producto.
 * @return void
 */
function productsCard($urlImagen, $title, $description, $price, $hrefComprar, $hrefMasInfo)
{
    echo '
        <div class="card p-2" style="height: 100%;">
            <img src="' . $urlImagen . '" class="card-img-top" alt="' . $title . '">
            <div class="card-body">
                <h5 class="mt-2 text-center">' . $title . '</h5>
                <p class="card-text">' . $description . '</p>
                <h3 class="text-center">$' . $price . '</h3>
                </div>
            <div class="text-center">
                <a href="' . $hrefComprar . '" class="btn btn-primary rounded-pill me-2">comprar</a>
                <a href="' . $hrefMasInfo . '" class="btn btn-primary rounded-pill">mas info</a>
            </div>
        </div>';
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