<?php
class AbmMenu
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Menu
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idMenu', $param)  &&
            array_key_exists('meNombre', $param) &&
            array_key_exists('meDescripcion', $param) &&
            array_key_exists('meDeshabilitado', $param) &&
            array_key_exists('idPadre', $param)
        ) {
            $objetoMenu = new Menu();
            $objetoMenu->setIdMenu($param['idPadre']);

            $obj = new Menu();
            $obj->setear(
                $param['idMenu'],
                $param['meNombre'],
                $param['meDescripcion'],
                $param['meDeshabilitado'],
                $objetoMenu
            );
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Menu
     */

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idMenu'])) {
            $obj = new Menu();
            $obj->setear($param['idMenu'], null, null, null, null);
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
        if (isset($param['idMenu']))
            $resp = true;
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idMenu'] = null;

        $objetoCompraEstado = $this->cargarObjeto($param);
        if ($objetoCompraEstado != null and $objetoCompraEstado->insertar()) {
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
            $objetoCompraEstado = $this->cargarObjeto($param);
            if ($objetoCompraEstado != null and $objetoCompraEstado->modificar()) {
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
            $objetoCompraEstado = $this->cargarObjetoConClave($param);
            if ($objetoCompraEstado != null and $objetoCompraEstado->eliminar()) {
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
            if (isset($param['idMenu']))
                $where[] = " idmenu = '" . $param['idMenu'] . "'";
            if (isset($param['meNombre']))
                $where[] = " menombre = '" . $param['meNombre'] . "'";
            if (isset($param['meDescripcion']))
                $where[] = " medescripcion = '" . $param['meDescripcion'] . "'";
            if (isset($param['meDeshabilitado']))
                $where[] = " medeshabilitado = '" . $param['meDeshabilitado'] . "'";
            if (isset($param['idPadre']))
                $where[] = " idpadre = '" . $param['idPadre'] . "'";
        }
        $whereClause = implode(" AND ", $where);
        $objetoMenu = new Menu();
        $arreglo = $objetoMenu->listar($whereClause);
        return $arreglo;
    }
}
