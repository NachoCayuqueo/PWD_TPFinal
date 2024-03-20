<?php
class AbmProducto
{
    /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = [];
        if ($param !== NULL) {
            if (isset($param['idProducto']))
                $where[] = " idproducto = '" . $param['idProducto'] . "'";
            if (isset($param['proNombre']))
                $where[] = " pronombre = '" . $param['proNombre'] . "'";
            if (isset($param['proDescripcion']))
                $where[] = " prodescripcion = '" . $param['proDescripcion'] . "'";
            if (isset($param['proMasInfo']))
                $where[] = " promasinfo = '" . $param['proMasInfo'] . "'";
            if (isset($param['proImagen']))
                $where[] = " proimagen = '" . $param['proImagen'] . "'";
            if (isset($param['proCantStock']))
                $where[] = " procantstock = '" . $param['proCantStock'] . "'";
            if (isset($param['proTipo']))
                $where[] = " protipo = '" . $param['proTipo'] . "'";
        }
        $whereClause = implode(" AND ", $where);
        $objetoProducto = new Producto();
        $arreglo = $objetoProducto->listar($whereClause);
        return $arreglo;
    }

    public function obtenerDatosProductos($idProducto)
    {
        $arregloProducto = [];
        $producto = $this->buscar(['idProducto' => $idProducto]);

        if (!empty($producto)) {
            $masInfo = $producto[0]->getProMasInfo();


            $nombreImagen = $producto[0]->getProImagen();
            $tipo = $producto[0]->getProTipo();
            $urlImagen =  $GLOBALS['IMAGES'] . "/products/" . $tipo . "/" . $nombreImagen;

            //* se buscan las valoraciones del producto
            $arregloValoracion = $this->obtenerValoracion($idProducto);

            //* se buscan los productos similares por el tipo
            $productosSimilares = $this->obtenerProductosSimilares($tipo);

            $arregloProducto = [
                'id' => $producto[0]->getIdProducto(),
                'nombre' => $producto[0]->getProNombre(),
                'descripcion' => $producto[0]->getProDescripcion(),
                'masInfo' => explode('.', $masInfo), // se genera un arreglo
                'precio' => $producto[0]->getProPrecio(),
                'stock' => $producto[0]->getProCantStock(),
                'urlImagen' => $urlImagen,
                'datosValoraciones' => $arregloValoracion,
                'productosSimilares' => $productosSimilares,
            ];
        }
        return $arregloProducto;
    }

    private function obtenerValoracion($idProducto)
    {
        $arregloValoracion = [];
        $objetoValoracion = new AbmValoracionProducto();
        $valoraciones =  $objetoValoracion->buscar(['idProducto' => $idProducto]);
        if (!empty($valoraciones)) {
            $arregloValoracion = [];
            $sumaValoraciones = 0;
            foreach ($valoraciones as $valoracion) {
                $sumaValoraciones += $valoracion->getRanking();
            }
            $cantidad = count($valoraciones);
            $arregloValoracion = [
                'valoraciones' => $valoraciones,
                'cantidadValoraciones' => $cantidad,
                'promedio' => $sumaValoraciones / $cantidad,
            ];
        }
        return $arregloValoracion;
    }

    private function obtenerProductosSimilares($tipoProducto)
    {
        return $this->buscar(['proTipo' => $tipoProducto]);
    }
}
