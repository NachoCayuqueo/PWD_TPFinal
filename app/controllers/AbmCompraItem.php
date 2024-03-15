<?php
class AbmCompraItem
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return CompraItem
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idCompraItem', $param)  &&
            array_key_exists('ciCantidad', $param) &&
            array_key_exists('idCompra', $param) &&
            array_key_exists('idProducto', $param)
        ) {
            $obj = new CompraItem();
            $obj->setear(
                $param['idCompraItem'],
                $param['ciCantidad'],
                $param['idCompra'],
                $param['idProducto']
            );
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return CompraItem
     */

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idCompraItem'])) {
            $obj = new CompraItem();
            $obj->setear($param['idCompraItem'], null, null, null);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idCompraItem']))
            $resp = true;
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idCompraItem'] = null;

        $objetoCompraItem = $this->cargarObjeto($param);
        if ($objetoCompraItem != null and $objetoCompraItem->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objetoCompraItem = $this->cargarObjeto($param);
            if ($objetoCompraItem != null and $objetoCompraItem->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objetoCompraItem = $this->cargarObjetoConClave($param);
            if ($objetoCompraItem != null and $objetoCompraItem->eliminar()) {
                $resp = true;
            }
        }

        return $resp;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = [];
        if ($param !== NULL) {
            if (isset($param['idCompraItem']))
                $where[] = " idcompraitem = '" . $param['idCompraItem'] . "'";
            if (isset($param['ciCantidad']))
                $where[] = " cicantidad = '" . $param['ciCantidad'] . "'";
            if (isset($param['idCompra']))
                $where[] = " idcompra = '" . $param['idCompra'] . "'";
            if (isset($param['idProducto']))
                $where[] = " idproducto = '" . $param['idProducto'] . "'";
        }
        $whereClause = implode(" AND ", $where);

        $objetoCompra = new CompraItem();
        $arreglo = $objetoCompra->listar($whereClause);
        return $arreglo;
    }
}
