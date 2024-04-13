<?php
class Session
{

    public function __construct()
    {
        if (!session_start()) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Actualiza las variables de sesión con los valores ingresados.
     */
    public function iniciar($emailUsuario, $psw)
    {
        $resp = false;
        $obj = new AbmUsuario();
        $param['usMail'] = $emailUsuario;
        $param['usPass'] = $psw;
        $resultado = $obj->buscar($param);

        if (count($resultado) > 0) {
            $usuario = $resultado[0];
            $dateDisabled = $usuario->getUsDeshabilitado();
            if (is_null($dateDisabled)) {
                $_SESSION['idusuario'] = $usuario->getIdUsuario();
                $resp = true;
            }
        } else {
            $this->cerrar();
        }
        return $resp;
    }

    /**
     * Valida si la sesión actual tiene usuario y psw válidos. Devuelve true o false.
     */
    public function validar()
    {
        $resp = false;
        if ($this->activa() && isset($_SESSION['idusuario']))
            $resp = true;
        return $resp;
    }

    /**
     *Devuelve true o false si la sesión está activa o no.
     */
    public function activa()
    {
        $resp = false;
        if (php_sapi_name() !== 'cli') {
            if (version_compare(phpversion(), '5.4.0', '>=')) {
                $resp = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else {
                $resp = session_id() === '' ? FALSE : TRUE;
            }
        }
        return $resp;
    }

    /**
     * Devuelve el usuario logeado.
     */
    public function getUsuario()
    {
        $usuario = null;
        if ($this->validar()) {
            $obj = new AbmUsuario();
            $param['idUsuario'] = $_SESSION['idusuario'];
            $resultado = $obj->buscar($param);
            if (count($resultado) > 0) {
                $usuario = $resultado[0];
            }
        }
        return $usuario;
    }

    /**
     * Devuelve el rol del usuario logeado.
     */
    public function getRol()
    {

        $list_rol = null;
        if ($this->validar()) {
            $obj = new AbmUsuario();
            $param['idUsuario'] = $_SESSION['idusuario'];
            $resultado = $obj->darRoles($param);
            if (count($resultado) > 0) {
                $list_rol = $resultado;
            }
        }
        return $list_rol;
    }

    public function validarUsuarioPorRol($nombreRol)
    {
        $objetoUsuarioRol = new AbmUsuarioRol();
        $esUsuarioValido = false;
        if ($this->validar()) {
            $usuario = $this->getUsuario();
            if (!is_null($usuario)) {
                $rol = $objetoUsuarioRol->obtenerRolActivo($usuario->getIdUsuario());
                $descripcionRol = $rol->getRoDescripcion();
                if ($descripcionRol === $nombreRol) {
                    $esUsuarioValido = true;
                }
            }
        }
        return $esUsuarioValido;
    }


    //* valida que el usuario tenga permiso para ingresar a una pagina especifica
    public function validarUsuario()
    {
        $datosMenuActual = $this->recuperarMenuActual();
        $objetoUsuarioRol = new AbmUsuarioRol();
        $esUsuarioValido = false;
        if ($this->validar()) {
            $usuario = $this->getUsuario();
            if (!is_null($usuario)) {
                $rol = $objetoUsuarioRol->obtenerRolActivo($usuario->getIdUsuario());
                $idRol = $rol->getIdRol();
                if ($idRol === $datosMenuActual['idRol']) {
                    $esUsuarioValido = true;
                }
            }
        }
        return $esUsuarioValido;
    }

    private function recuperarMenuActual()
    {
        // Obtener la URI de la solicitud actual
        $requestUri = $_SERVER['REQUEST_URI'];

        // Dividir la URI en partes utilizando la barra inclinada como delimitador
        $uriParts = explode('/', $requestUri);

        // Eliminar elementos vacíos del arreglo resultante
        $uriParts = array_filter($uriParts);
        $tamaño_arreglo = count($uriParts);
        $ultimo_elemento = $uriParts[$tamaño_arreglo];
        $anteultimo_elemento = $uriParts[$tamaño_arreglo - 1];
        $descripcionMenu = $anteultimo_elemento . "/" . $ultimo_elemento;

        $objetoMenu = new AbmMenu();
        $menu = $objetoMenu->buscar(['meDescripcion' => $descripcionMenu]);

        $idMenuPadre = $menu[0]->getObjetoPadre()->getIdMenu();

        $condicion = false;
        $objetoMenuRol = new AbmMenuRol();
        if ($idMenuPadre >= 1 && $idMenuPadre <= 3) {
            $menuRol = $objetoMenuRol->buscar(['idMenu' => $idMenuPadre]);
            $condicion = true;
        }
        //TODO: deberia tener un maximo de repeticiones por las dudas
        while (!$condicion) {
            $menu = $objetoMenu->buscar(['idMenu' => $idMenuPadre]);
            $idMenuPadre = $menu[0]->getObjetoPadre()->getIdMenu();
            if ($idMenuPadre >= 1 && $idMenuPadre <= 3) {
                $menuRol = $objetoMenuRol->buscar(['idMenu' => $idMenuPadre]);
                $condicion = true;
            }
        }
        $idrol = $menuRol[0]->getObjetoRol()->getIdRol();
        return ['idMenu' => $idMenuPadre, 'idRol' => $idrol];
    }

    public function esUsuarioNoLogueado()
    {
        if (!$this->validar()) {
            return true;
        }
        return false;
    }

    /**
     *Cierra la sesión actual.
     */
    public function cerrar()
    {
        session_unset();
        session_destroy();
    }
}
