<?php
class AbmUsuario
{

    public function abm($datos)
    {
        $resp = false;
        if ($datos['accion'] == 'editar') {
            if ($this->modificacion($datos)) {
                $resp = true;
            }
        }
        if ($datos['accion'] == 'borrar') {
            if ($this->baja($datos)) {
                $resp = true;
            }
        }
        if ($datos['accion'] == 'nuevo') {
            if ($this->alta($datos)) {
                $resp = true;
            }
        }
        if ($datos['accion'] == 'borrar_rol') {
            if ($this->borrar_rol($datos)) {
                $resp = true;
            }
        }
        if ($datos['accion'] == 'nuevo_rol') {
            if ($this->alta_rol($datos)) {
                $resp = true;
            }
        }
        return $resp;
    }
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Tabla
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idUsuario', $param)  &&
            array_key_exists('usNombre', $param) &&
            array_key_exists('usPass', $param) &&
            array_key_exists('usMail', $param) &&
            array_key_exists('usDeshabilitado', $param) &&
            array_key_exists('usActivo', $param)
        ) {
            $obj = new Usuario();
            $obj->setear(
                $param['idUsuario'],
                $param['usNombre'],
                $param['usPass'],
                $param['usMail'],
                $param['usDeshabilitado'],
                $param['usActivo']
            );
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Tabla
     */

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idusuario'])) {
            $obj = new Usuario();
            $obj->setear($param['idusuario'], null, null, null, null, null);
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
        if (isset($param['idUsuario']))
            $resp = true;
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idUsuario'] = null;
        $param['usDeshabilitado'] = null;
        $param['usActivo'] = false;
        $objetoUsuario = $this->cargarObjeto($param);
        if ($objetoUsuario != null and $objetoUsuario->insertar()) {
            $resp = true;
        }
        return $resp;
    }


    public function borrar_rol($param)
    {
        $resp = false;
        if (isset($param['idusuario']) && isset($param['idrol'])) {
            $objetoUsuarioRol = new UsuarioRol();
            $objetoUsuarioRol->setearConClave($param['idusuario'], $param['idrol']);
            $resp = $objetoUsuarioRol->eliminar();
        }

        return $resp;
    }

    public function alta_rol($param)
    {
        $resp = false;
        if (isset($param['idUsuario']) && isset($param['idrol'])) {
            $objetoUsuarioRol = new UsuarioRol();
            $objetoUsuarioRol->setearConClave($param['idusuario'], $param['idrol']);
            $resp = $objetoUsuarioRol->insertar();
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
            $objetoUsuario = $this->cargarObjeto($param);
            if ($objetoUsuario != null and $objetoUsuario->modificar()) {
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
            $objetoUsuario = $this->cargarObjetoConClave($param);
            if ($objetoUsuario != null and $objetoUsuario->eliminar()) {
                $resp = true;
            }
        }

        return $resp;
    }

    public function darRoles($param)
    {
        $where = [];
        if ($param !== NULL) {
            if (isset($param['idUsuario']))
                $where[] = " idusuario =" . $param['idUsuario'];
            if (isset($param['idRol']))
                $where[] = " idrol ='" . $param['idRol'] . "'";
        }
        $whereClause = implode(" AND ", $where);

        $objetoUsuarioRol = new UsuarioRol();
        $arreglo = $objetoUsuarioRol->listar($whereClause);
        return $arreglo;
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
            if (isset($param['usNombre']))
                $where[] = " usnombre = '" . $param['usNombre'] . "'";
            if (isset($param['uspass']))
                $where[] = " usPass = '" . $param['usPass'] . "'";
            if (isset($param['usMail']))
                $where[] = " usmail = '" . $param['usMail'] . "'";
            if (isset($param['usDeshabilitado']))
                $where[] = " usdeshabilitado = '" . $param['usDeshabilitado'] . "'";
        }
        $whereClause = implode(" AND ", $where);
        $objetoUsuario = new Usuario();
        $arreglo = $objetoUsuario->listar($whereClause);
        return $arreglo;
    }
}
