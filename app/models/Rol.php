<?php
class Rol extends DataBase
{
    private $idRol;
    private $roDescripcion;
    private $mensajeOperacion;

    public function __construct()
    {
        parent::__construct();

        $this->idRol = "";
        $this->roDescripcion = "";
        $this->mensajeOperacion = "";
    }


    /**
     * Get the value of idRol
     */
    public function getIdRol()
    {
        return $this->idRol;
    }

    /**
     * Get the value of roDescripcion
     */
    public function getRoDescripcion()
    {
        return $this->roDescripcion;
    }

    /**
     * Get the value of mensajeOperacion
     */
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    /**
     * Set the value of idRol
     *
     * @return  self
     */
    public function setIdRol($idRol)
    {
        $this->idRol = $idRol;

        return $this;
    }

    /**
     * Set the value of roDescripcion
     *
     * @return  self
     */
    public function setRoDescripcion($roDescripcion)
    {
        $this->roDescripcion = $roDescripcion;

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

    public function setear($idrol, $rodescripcion)
    {
        $this->setIdRol($idrol);
        $this->setRoDescripcion($rodescripcion);
    }

    public function cargar()
    {
        $resp = false;
        $sql = "SELECT * FROM rol WHERE idrol = " . $this->getIdRol();
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $this->Registro();
                    $this->setear($row['idrol'], $row['rodescripcion']);
                }
            }
        } else {
            $this->setmensajeoperacion("ERROR::Rol => cargar: " . $this->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $sql = "INSERT INTO rol(idrol,rodescripcion)  
            VALUES('" . $this->getIdRol() . "','" . $this->getRoDescripcion() . "');";
        if ($this->Iniciar()) {
            if ($id = $this->Ejecutar($sql)) {
                $this->setIdRol($id);
                $resp = true;
            } else {
                $this->setmensajeoperacion("ERROR::Rol => insertar iniciar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::Rol => insertar ejecutar: " . $this->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $sql = "UPDATE rol SET rodescripcion='" . $this->getRoDescripcion() . "' " .
            " WHERE idrol=" . $this->getIdRol();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("ERROR::Rol => modificar ejecutar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::Rol => modificar iniciar: " . $this->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $sql = "DELETE FROM rol WHERE idrol=" . $this->getIdRol();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("ERROR::Rol => eliminar ejecutar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::Rol => eliminar ejecutar: " . $this->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();
        $sql = "SELECT * FROM rol ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    while ($row = $this->Registro()) {
                        $objetoRol = new Rol();
                        $objetoRol->setear($row['idrol'], $row['rodescripcion']);

                        array_push($arreglo, $objetoRol);
                    }
                }
            } else {
                $this->setmensajeoperacion("ERROR::Rol => listar: " . $this->getError());
            }
        }
        return $arreglo;
    }
}
