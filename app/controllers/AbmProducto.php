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
            if (isset($param['proDetalle']))
                $where[] = " prodetalle = '" . $param['proDetalle'] . "'";
            if (isset($param['proCantStock']))
                $where[] = " procantstock = '" . $param['proCantStock'] . "'";
            if (isset($param['proTipo']))
                $where[] = " protipo = '" . $param['proTipo'] . "'";
            if (isset($param['proPrecio']))
                $where[] = " proprecio = '" . $param['proPrecio'] . "'";
            if (isset($param['esProDestacado']))
                $where[] = " esprodestacado = '" . $param['esProDestacado'] . "'";
            if (isset($param['esProNuevo']))
                $where[] = " espronuevo = '" . $param['esProNuevo'] . "'";
        }
        $whereClause = implode(" AND ", $where);
        $objetoProducto = new Producto();
        $arreglo = $objetoProducto->listar($whereClause);
        return $arreglo;
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
            array_key_exists('proDetalle', $param) &&
            array_key_exists('proPrecio', $param) &&
            array_key_exists('proTipo', $param) &&
            array_key_exists('proCantStock', $param) &&
            array_key_exists('esProDestacado', $param) &&
            array_key_exists('esProNuevo', $param)
        ) {
            $obj = new Producto();
            $obj->setear(
                $param['idProducto'],
                $param['proNombre'],
                $param['proDetalle'],
                $param['proPrecio'],
                $param['proTipo'],
                $param['proCantStock'],
                $param['esProDestacado'],
                $param['esProNuevo'],
            );
        }
        return $obj;
    }
}
