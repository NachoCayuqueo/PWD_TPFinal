<?php

/**
 * Crea la tabla de resumen de compras.
 * @param array $listaCompras - Lista de compras.
 * @return int - Número de compras encontradas.
 */
function crearTablaResumenCompra($listaCompras)
{
    $comprasEncontradas = 0;
    echo '
    <table class="table table-striped table-bordered">
    <thead>
    <tr class="text-center card-title">
        <th scope="col"></th>
        <th scope="col">ID Compra</th>
        <th scope="col">Cantidad de Productos</th>
        <th scope="col">Fecha de Compra</th>
        <th scope="col">Total</th>
    </tr>
    </thead>
    <tbody class="table-group-divider card-text">
    ';
    foreach ($listaCompras as $compra) {
        $idCompra = $compra['idCompra'];
        $estadoCompra = $compra['estadoCompra'];
        $fechaCompra = $compra['fechaCompra'];
        $cantidadCompra = $compra['cantidadItems'];
        $precioTotal = $compra['precioTotal'];
        if ($estadoCompra === 3 || $estadoCompra === 4) {
            //crear tabla
            echo "<tr>";
            echo "<td><a class='btn btn-link' data-bs-toggle='collapse' href='#collapseCompras" . $idCompra . "' role='button' aria-expanded='false' aria-controls='collapseCompras" . $idCompra . "'>
                    <img id='toggleIcon_" . $idCompra . "' src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/chevron-compact-right.svg' alt='right'></a>
             </td>";
            echo "<td class='card-title'>" . $idCompra . "</td>";
            echo "<td>" . $cantidadCompra . "</td>";
            echo "<td>" . $fechaCompra . "</td>";
            echo "<td>" . $precioTotal . "</td>";
            echo "</tr>";

            // Función que muestra el área de colapso
            $listaProductos = $compra['compraItem'];
            collapseProducto($idCompra, $listaProductos);

            $comprasEncontradas++;
        }
    }
    echo '</tbody>
    </table>';

    return $comprasEncontradas;
}

function crearTablaComprasCanceladas($listaCompras)
{
    $comprasCanceladas = [];
    $existeCompra = false;
    $fechaCancelacion = '';
    foreach ($listaCompras as $compra) {
        $estadoCompra = $compra['estadoCompra'];
        if ($estadoCompra === 5) {
            $comprasCanceladas[] = $compra;
            $existeCompra = true;
        }
    }
    echo '
    <table class="table table-striped table-bordered" >
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">ID</th>
                            <th scope="col">Cantidad Productos</th>
                            <th scope="col">Total</th>
                            <th scope="col">Fecha Compra</th>
                            <th scope="col">Fecha Cancelacion</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
    foreach ($comprasCanceladas as $compra) {
        $idCompra = $compra['idCompra'];
        $cantidadCompra = $compra['cantidadItems'];
        $totalCompra = $compra['precioTotal'];
        $fechaCompra = $compra['fechaCompra'];
        $fechaCancelacion = $compra['fechaFin'];
        //crear tabla
        echo "<tr>";
        echo "<td><a class='btn btn-link' data-bs-toggle='collapse' href='#collapseCompras" . $idCompra . "' role='button' aria-expanded='false' aria-controls='collapseCompras" . $idCompra . "'>
                <img id='toggleIcon_" . $idCompra . "' src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/chevron-compact-right.svg' alt='right'></a>
              </td>";
        echo "<td class='card-title'>" . $idCompra . "</td>";
        echo "<td>" . $cantidadCompra . "</td>";
        echo "<td>" . $totalCompra . "</td>";
        echo "<td>" . $fechaCompra . "</td>";
        echo "<td>" . $fechaCancelacion . "</td>";
        echo "</tr>";

        // Función que muestra el área de colapso
        $listaProductos = $compra['compraItem'];
        collapseProducto($idCompra, $listaProductos);
    }
    echo '</tbody>
                </table>  ';

    return $existeCompra;
}

function collapseProducto($idCompra, $listaProductos)
{
    echo '
        <tr class="collapse" id="collapseCompras' . $idCompra . '">
            <td colspan="4">
                <table class="table" >
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio Unitario</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
    foreach ($listaProductos as $producto) {
        $idProducto = $producto['idProducto'];
        $nombreProducto = $producto['nombreProducto'];
        $cantidadProducto = $producto['cantidadProducto'];
        $precioUnitario = $producto['precioUnitarioProducto'];
        //crear tabla
        echo "<tr>";
        echo "<td class='card-title'>" . $idProducto . "</td>";
        echo "<td>" . $nombreProducto . "</td>";
        echo "<td>" . $cantidadProducto . "</td>";
        echo "<td>" . $precioUnitario . "</td>";
        echo "</tr>";
    }
    echo '</tbody>
                </table>    
            </td>
        </tr>';
}

echo '<script src="' . $PUBLIC_JS . '/customer/changeCollapseButton.js"></script>';
