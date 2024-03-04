<?php
class AbmUsuarioRol
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return UsuarioRol
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            isset($param['idUsuario']) &&
            isset($param['idRol'])
        ) {
            $objUsuario = new Usuario();
            $objUsuario->setIdUsuario($param['idUsuario']);

            $objetoRol = new Rol();
            $objetoRol->setIdRol($param['idrol']);

            $obj = new usuarioRol();
            $obj->setear($objUsuario, $objetoRol);
        }

        return $obj;
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
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = [];
        if ($param !== NULL) {
            if (isset($param['idUsuario']))
                $where[] = " idusuario = '" . $param['idUsuario'] . "'";
            if (isset($param['idRol']))
                $where[] = " idrol = '" . $param['idRol'] . "'";
        }
        $whereClause = implode(" AND ", $where);
        $objetoUsuarioRol = new UsuarioRol();
        $arreglo = $objetoUsuarioRol->listar($whereClause);
        return $arreglo;
    }
}
