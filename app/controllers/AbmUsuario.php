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
     * @return Usuario
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
     * @return Usuario
     */

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idUsuario'])) {
            $obj = new Usuario();
            $obj->setear($param['idUsuario'], null, null, null, null, null);
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
        $param['usActivo'] = $param['usActivo'] ? $param['usActivo'] : "0";

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
        if (isset($param['idUsuario']) && isset($param['idRol'])) {
            $objetoUsuarioRol = new UsuarioRol();
            $objetoUsuarioRol->setearConClave($param['idUsuario'], $param['idRol']);
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
            if (isset($param['usPass']))
                $where[] = " uspass = '" . $param['usPass'] . "'";
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

    public function deshabilitar($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $personObject = $this->cargarObjetoConClave($param);
            if ($personObject != null and $personObject->deshabilitar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Almacena un nuevo usuario en la base de datos
     * @param array $param: user,password,email
     * @return bool
     */
    public function registrarNuevoUsuario($param)
    {
        $response = "";
        $buscarPersona = array('usMail' => $param['email']);
        $persona = $this->buscar($buscarPersona);
        if (empty($persona)) {
            $darDeAlta = array(
                "usNombre" => $param['user'],
                "usPass" => $param['password'],
                "usMail" => $param['email']
            );
            $cargaExitosa = $this->alta($darDeAlta);
            if ($cargaExitosa) {
                $persona = $this->buscar($buscarPersona);

                $objetoUsuarioRol = new AbmUsuarioRol();
                $altaUsuarioRol = [
                    'rolActivo' => true, //* true o 1?
                    'idUsuario' => $persona[0]->getIdUsuario(),
                    'idRol' => 3 //* verificar esto
                ];
                $cargaExitosa = $objetoUsuarioRol->alta($altaUsuarioRol);
                if ($cargaExitosa) {
                    $response = array('title' => 'EXITO', 'message' => 'Su cuenta fue registrada. Recibira un email cuando la cuenta se haya activado');
                } else {
                    $response = array('title' => 'ERROR', 'message' => 'Error al asignarle rol');
                }
            } else {
                $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar registrar al usuario');
            }
        } else {
            $response = array('title' => 'ERROR', 'message' => 'El usuario se encuentra registrado');
        }

        return $response;
    }

    /**
     * verifica si un usuario tiene permiso de un admin para ingresar al sitio
     * @param string email
     * @return bool
     */
    public function esUsuarioActivo($email)
    {
        $usuario = $this->buscar(['usMail' => $email]);

        if (!empty($usuario)) {
            $usuario = $usuario[0];
            $esUsuarioActivo = $usuario->getUsActivo();
            if ($esUsuarioActivo) {
                return true;
            } else {
                $session = new Session();
                $session->cerrar();
                return false;
            }
        }

        return false;
    }

    /**
     * modifica la contraseña actual de un usuario
     * @param array $param: idUsuario, passwordActual,passwordNueva
     * @return bool
     */
    public function modificarPassword($param)
    {
        $idUsuario = ['idUsuario' => $param['idUsuario']];
        $usuario = $this->buscar($idUsuario);
        if (!empty($usuario)) {
            $usuario = $usuario[0];
            $passwordDB = $usuario->getUsPass();
            $passwordActual = $param['passwordActual'];
            $passwordNueva = $param['passwordNueva'];

            if ($passwordDB === $passwordActual) {
                $modificarParams = [
                    "idUsuario" => $usuario->getIdUsuario(),
                    "usNombre" => $usuario->getUsNombre(),
                    "usPass" => $passwordNueva,
                    "usMail" => $usuario->getUsMail(),
                    "usDeshabilitado" => $usuario->getUsDeshabilitado(),
                    "usActivo" => $usuario->getUsActivo() ? '1' : '0'
                ];
                return $this->modificacion($modificarParams);
            }
        }
        return false;
    }

    /**
     * da a acceso a un usuario con una cuenta registrada
     * @param string idusuario
     * @return bool
     */
    public function activarUsuario($idUsuario)
    {
        $usuario = $this->buscar(['idUsuario' => $idUsuario]);
        if (!empty($usuario)) {
            $usuario = $usuario[0];
            $modificarParams = [
                "idUsuario" => $usuario->getIdUsuario(),
                "usNombre" => $usuario->getUsNombre(),
                "usPass" => $usuario->getUsPass(),
                "usMail" => $usuario->getUsMail(),
                "usDeshabilitado" => $usuario->getUsDeshabilitado(),
                "usActivo" => 1
            ];
            return $this->modificacion($modificarParams);
        }
        return false;
    }

    public function habilitarUsuario($idUsuario)
    {
        $usuario = $this->buscar(['idUsuario' => $idUsuario]);
        if (!empty($usuario)) {
            $usuario = $usuario[0];
            $modificarParams = [
                "idUsuario" => $usuario->getIdUsuario(),
                "usNombre" => $usuario->getUsNombre(),
                "usPass" => $usuario->getUsPass(),
                "usMail" => $usuario->getUsMail(),
                "usDeshabilitado" => null,
                "usActivo" => 1
            ];
            return $this->modificacion($modificarParams);
        }
        return false;
    }

    public function cambiarEmail($idUsuario, $nombre, $email)
    {
        $existenCambios = false;
        $respuesta = [];

        $usuario = $this->buscar(['idUsuario' => $idUsuario]);

        if ($nombre !== $usuario[0]->getUsNombre())
            $existenCambios = true;

        if ($email !== $usuario[0]->getUsMail()) {
            if ($this->existeMail($email)) {
                return array('title' => 'ERROR', 'message' => 'El Email que intenta ingresar ya existe. Por favor, ingrese otro');
            }
            $existenCambios = true;
        }

        if ($existenCambios) {
            $modificarParams = [
                "idUsuario" => $idUsuario,
                "usNombre" => $nombre,
                "usPass" => $usuario[0]->getUsPass(),
                "usMail" => $email,
                "usDeshabilitado" => $usuario[0]->getUsDeshabilitado(),
                "usActivo" => $usuario[0]->getUsActivo() ? '1' : '0'
            ];
            $modificacionExitosa = $this->modificacion($modificarParams);
            if ($modificacionExitosa) {
                $respuesta = array('title' => 'EXITO', 'message' => 'Los datos fueron modificados exitosamente');
            } else {
                $respuesta = array('title' => 'ERROR', 'message' => 'No se realizaron los cambios. Contacte con un administrador');
            }
        } else {
            $respuesta = array('title' => 'INFO', 'message' => 'Se mantuvieron los cambios actuales');
        }
        return $respuesta;
    }

    private function existeMail($email)
    {
        $usuario = $this->buscar(['usMail' => $email]);
        if (!empty($usuario)) {
            return true;
        }
        return false;
    }
}
