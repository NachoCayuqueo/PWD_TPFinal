<?php
class UsuarioRol extends DataBase
{
    private $objetoRol;
    private $objetoUsuario;
    private $mensajeOperacion;

    public function __construct()
    {
        parent::__construct();
        $this->objetoRol = null;
        $this->objetoUsuario = null;
        $this->mensajeOperacion = "";
    }

    /**
     * Get the value of objetoRol
     */
    public function getObjetoRol()
    {
        return $this->objetoRol;
    }

    /**
     * Get the value of objetoUsuario
     */
    public function getObjetoUsuario()
    {
        return $this->objetoUsuario;
    }

    /**
     * Get the value of mensajeOperacion
     */
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    /**
     * Set the value of objetoRol
     *
     * @return  self
     */
    public function setObjetoRol($objetoRol)
    {
        $this->objetoRol = $objetoRol;

        return $this;
    }

    /**
     * Set the value of objetoUsuario
     *
     * @return  self
     */
    public function setObjetoUsuario($objetoUsuario)
    {
        $this->objetoUsuario = $objetoUsuario;

        return $this;
    }

    /**
     * Set the value of mensajeOperacion
     *
     * @return  self
     */
    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;

        return $this;
    }

    public function setear($objusuario, $objrol)
    {
        $this->setObjetoUsuario($objusuario);
        $this->setObjetoRol($objrol);
    }

    public function setearConClave($idusuario, $idjrol)
    {
        $this->getObjetoRol()->setIdRol($idjrol);
        $this->getObjetoUsuario()->setIdUsuario($idusuario);
    }

    public function cargar()
    {
        $resp = false;
        $sql = "SELECT * FROM usuariorol WHERE idrol = " . $this->getObjetoRol()->getIdRol() . " AND idusuario = " . $this->getObjetoUsuario()->getIdUsuario() . ";";
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $this->Registro();

                    $objetoUsuario = new Usuario();
                    $objetoUsuario->setIdUsuario($row['idusuario']);
                    $objetoUsuario->cargar();

                    $objetoRol = new Rol();
                    $objetoRol->setIdRol($row['idrol']);
                    $objetoRol->cargar();

                    $this->setear($objetoUsuario, $objetoRol);
                }
            }
        } else {
            $this->setmensajeoperacion("ERROR::UsuarioRol => cargar: " . $this->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $idRol = $this->getObjetoRol()->getIdRol();
        $idUsuario = $this->getObjetoUsuario()->getIdUsuario();

        $sql = "INSERT INTO usuariorol(idrol,idusuario)  VALUES(" . $idRol . "," . $idUsuario . ");";
        if ($this->Iniciar()) {
            if ($id = $this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("ERROR::UsuarioRol => insertar ejecutar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::UsuarioRol => insertar iniciar: " . $this->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        return false;
    }

    public function eliminar()
    {
        $resp = false;
        $idRol = $this->getObjetoRol()->getIdRol();
        $idUsuario = $this->getObjetoUsuario()->getIdUsuario();

        $sql = "DELETE FROM usuariorol WHERE idrol=" . $idRol . " AND idusuario =" . $idUsuario . ";";
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("ERROR::UsuarioRol => eliminar ejecutar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::UsuarioRol => eliminar iniciar: " . $this->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();
        $sql = "SELECT * FROM usuariorol ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }

        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    while ($row = $this->Registro()) {
                        $objetoUsuario = null;
                        $objetoRol = null;

                        $idUsuario = $row['idusuario'];
                        if ($idUsuario) {
                            $objetoUsuario = new Usuario();
                            $objetoUsuario->setIdUsuario($idUsuario);
                            $objetoUsuario->cargar();
                        }

                        $idRol = $row['idrol'];
                        if ($idRol) {
                            $objetoRol = new Rol();
                            $objetoRol->setIdRol($idRol);
                            $objetoRol->cargar();
                        }

                        $objetoUsuarioRol = new UsuarioRol();
                        $objetoUsuarioRol->setear($objetoUsuario, $objetoRol);
                        array_push($arreglo, $objetoUsuarioRol);
                    }
                }
            } else {
                $this->setmensajeoperacion("ERROR:: UsuarioRol => listar: " . $this->getError());
            }
        }
        return $arreglo;
    }
}
