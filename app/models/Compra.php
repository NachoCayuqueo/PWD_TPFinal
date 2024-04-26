<?php
class Compra extends DataBase
{
    private $idCompra;
    private $cofecha;
    private $objetoUsuario;
    private $mensajeOperacion;

    public function __construct()
    {
        parent::__construct();
        $this->idCompra = '';
        $this->cofecha = '';
        $this->objetoUsuario = new Usuario();
        $this->mensajeOperacion = '';
    }

    /**
     * Get the value of idCompra
     */
    public function getIdCompra()
    {
        return $this->idCompra;
    }
    /**
     * Get the value of cofecha
     */
    public function getCofecha()
    {
        return $this->cofecha;
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
     * Set the value of idCompra
     *
     * @return  self
     */
    public function setIdCompra($idCompra)
    {
        $this->idCompra = $idCompra;

        return $this;
    }
    /**
     * Set the value of cofecha
     *
     * @return  self
     */
    public function setCofecha($cofecha)
    {
        $this->cofecha = $cofecha;

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

    public function setear($id, $fecha, $objUsuario)
    {
        $this->setIdCompra($id);
        $this->setCofecha($fecha);
        $this->setObjetoUsuario($objUsuario);
    }

    public function cargar()
    {
        $resp = false;
        $query = "SELECT * FROM compra WHERE idcompra = " . $this->getIdCompra();
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($query);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $this->Registro();
                    $objetoPersona = new Usuario();
                    $objetoPersona->setIdUsuario($row['idusuario']);
                    $objetoPersona->cargar();

                    $this->setear($row['idcompra'], $row['cofecha'], $row['descripcion'], $row['fechacreacion'], $objetoPersona);
                }
            }
        } else {
            $this->setMensajeoperacion("ERROR::Compra->cargar: " . $this->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $idUsuario = $this->getObjetoUsuario()->getIdUsuario();
        $query = "INSERT INTO compra(cofecha, idusuario)  
              VALUES('"
            . $this->getCofecha() . "', '"
            . $idUsuario . "'
        );";
        if ($this->Iniciar()) {
            if ($id = $this->Ejecutar($query)) {
                $this->setIdCompra($id);
                $resp = true;
            } else {
                $this->setmensajeoperacion("ERROR::Compra->insertar ejecutar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::Compra->insertar iniciar: " . $this->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $idUsuario = $this->getObjetoUsuario()->getIdUsuario();

        $query = "UPDATE compra SET 
            cofecha='" . $this->getCofecha() . "',   
            idusuario='" . $idUsuario . "'" .
            " WHERE idcompra=" . $this->getIdCompra();

        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Compra => modificar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Compra => modificar insertar: " . $this->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;

        $query = "DELETE FROM compra WHERE idcompra=" . $this->getIdCompra();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Compra => eliminar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Compra => eliminar insertar: " . $this->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();

        $query = "SELECT * FROM compra ";
        if ($parametro != "") {
            $query .= 'WHERE ' . $parametro;
        }
        // if ($this->Iniciar()) {
        $res = $this->Ejecutar($query);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $this->Registro()) {
                    $objetoUsuario = new Usuario();
                    $objetoUsuario->setIdUsuario($row['idusuario']);
                    $objetoUsuario->cargar();

                    $obj = new Compra();
                    $obj->setear($row['idcompra'], $row['cofecha'], $objetoUsuario);

                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setmensajeoperacion("ERROR::Compra => listar: " . $this->getError());
        }
        //}
        return $arreglo;
    }
}
