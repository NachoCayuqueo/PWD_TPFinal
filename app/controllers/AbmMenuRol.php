<?php
class AbmMenuRol
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return MenuRol
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            isset($param['idMenu']) &&
            isset($param['idRol'])
        ) {
            $objetoMenu = new Menu();
            $objetoMenu->setIdMenu($param['idMenu']);

            $objetoRol = new Rol();
            $objetoRol->setIdRol($param['idRol']);

            $obj = new MenuRol();
            $obj->setear($objetoMenu, $objetoRol);
        }

        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return MenuRol
     */

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (
            isset($param['idMenu']) &&
            isset($param['idRol'])
        ) {

            $objMenu = new Menu();
            $objMenu->setear($param['idMenu'], null, null, null, null);

            $objetoRol = new Rol();
            $objetoRol->setear($param['idRol'], null);

            $obj = new MenuRol();
            $obj->setear($objMenu, $objetoRol);
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
        if (
            isset($param['idMenu']) &&
            isset($param['idRol'])
        )
            $resp = true;
        return $resp;
    }

    /**
     * 
     * @param array $param
     */
    public function alta($param)
    {
        $resp = false;
        $objUsuarioRol = $this->cargarObjeto($param);
        if (($objUsuarioRol != null) && ($objUsuarioRol->insertar())) {
            $resp = true;
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
            $objetoUsuario = $this->cargarObjetoConClave($param);
            if ($objetoUsuario != null and $objetoUsuario->eliminar()) {
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
            if (isset($param['idRol']))
                $where[] = " idrol = '" . $param['idRol'] . "'";
        }
        $whereClause = implode(" AND ", $where);
        $objetoUsuarioRol = new MenuRol();
        $arreglo = $objetoUsuarioRol->listar($whereClause);
        return $arreglo;
    }
}
