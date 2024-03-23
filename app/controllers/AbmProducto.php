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

    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objetoProducto = $this->cargarObjeto($param);
            if ($objetoProducto != null and $objetoProducto->modificar()) {

                $resp = true;
            }
        }

        return $resp;
    }
    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idProducto']))
            $resp = true;
        return $resp;
    }
    private function cargarObjeto($param)
    {

        $obj = null;
        if (
            array_key_exists('idProducto', $param)  &&
            array_key_exists('proNombre', $param) &&
            array_key_exists('proPrecio', $param) &&
            array_key_exists('proTipo', $param) &&
            array_key_exists('proDescripcion', $param) &&
            array_key_exists('proMasInfo', $param) &&
            array_key_exists('proImagen', $param) &&
            array_key_exists('proCantStock', $param) &&
            array_key_exists('esprodestacado', $param) &&
            array_key_exists('espronuevo', $param)
        ) {
            $obj = new Producto();
            $obj->setear(
                $param['idProducto'],
                $param['proNombre'],
                $param['proDescripcion'],
                $param['proMasInfo'],
                $param['proImagen'],
                $param['proPrecio'],
                $param['proTipo'],
                $param['proCantStock'],
                $param['esprodestacado'],
                $param['espronuevo']
            );
        }
        return $obj;
    }
}
