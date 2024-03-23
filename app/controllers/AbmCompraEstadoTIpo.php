<?php
class AbmCompraEstadoTipo
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return CompraEstadoTipo
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idCompraEstadoTipo', $param)  &&
            array_key_exists('cetDescripcion', $param) &&
            array_key_exists('cetDetalle', $param)
        ) {
            $obj = new Compra();
            $obj->setear(
                $param['idCompraEstadoTipo'],
                $param['cetDescripcion'],
                $param['cetDetalle']
            );
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return CompraEstadoTipo
     */

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idCompraEstadoTipo'])) {
            $obj = new Compra();
            $obj->setear($param['idCompraEstadoTipo'], null, null);
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
        if (isset($param['idCompraEstadoTipo']))
            $resp = true;
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idCompraEstadoTipo'] = null;

        $objetoCompraEstadoTipo = $this->cargarObjeto($param);
        if ($objetoCompraEstadoTipo != null and $objetoCompraEstadoTipo->insertar()) {
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
            $objetoCompraEstadoTipo = $this->cargarObjeto($param);
            if ($objetoCompraEstadoTipo != null and $objetoCompraEstadoTipo->modificar()) {
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
            $objetoCompraEstadoTipo = $this->cargarObjetoConClave($param);
            if ($objetoCompraEstadoTipo != null and $objetoCompraEstadoTipo->eliminar()) {
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
            if (isset($param['idCompraEstadoTipo']))
                $where[] = " idcompraestadotipo = '" . $param['idCompraEstadoTipo'] . "'";
            if (isset($param['cetDescripcion']))
                $where[] = " cetdescripcion = '" . $param['cetDescripcion'] . "'";
            if (isset($param['cetDetalle']))
                $where[] = " cetdetalle = '" . $param['cetDetalle'] . "'";
        }
        $whereClause = implode(" AND ", $where);
        $objetoUsuario = new CompraEstadoTipo();
        $arreglo = $objetoUsuario->listar($whereClause);
        return $arreglo;
    }
}
