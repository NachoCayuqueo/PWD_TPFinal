<?php
class UsuarioRol extends DataBase
{
    private $objetoRol;
    private $objetoUsuario;
    private $rolActivo;
    private $mensajeOperacion;

    public function __construct()
    {
        parent::__construct();
        $this->objetoRol = new Rol();
        $this->objetoUsuario = new Usuario();
        $this->rolActivo = false;
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
     * Get the value of rolActivo
     */
    public function getRolActivo()
    {
        return $this->rolActivo;
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
     * Set the value of rolActivo
     *
     * @return  self
     */
    public function setRolActivo($rolActivo)
    {
        $this->rolActivo = $rolActivo;

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

    public function setear($rolActivo, $objusuario, $objrol)
    {
        $this->setRolActivo($rolActivo);
        $this->setObjetoUsuario($objusuario);
        $this->setObjetoRol($objrol);
    }

    //TODO: ver si se utiliza, sino borrar
    public function setearConClave($idusuario, $idrol)
    {
        $this->getObjetoRol()->setIdRol($idrol);
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

                    $this->setear($row['rolactivo'], $objetoUsuario, $objetoRol);
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

        $sql = "INSERT INTO usuariorol(rolactivo,idrol,idusuario)  
            VALUES("
            . $this->getRolActivo() . ","
            . $idRol . ","
            . $idUsuario . ");";
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
        $resp = false;
        $idUsuario = $this->getObjetoUsuario()->getIdUsuario();
        $idRol = $this->getObjetoRol()->getIdRol();

        $query = "UPDATE usuariorol SET 
            idusuario='" . $idUsuario . "', 
            idrol='" . $idRol . "', 
            rolactivo='" . $this->getRolActivo() . "'" .
            " WHERE idusuario=" . $idUsuario . " AND idrol=" . $idRol;

        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::UsuarioRol => modificar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::UsuarioRol => modificar insertar: " . $this->getError());
        }
        return $resp;
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
                        $objetoUsuarioRol->setear($row['rolactivo'], $objetoUsuario, $objetoRol);
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
