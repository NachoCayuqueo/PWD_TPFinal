<?php
class CompraEstado extends DataBase
{
    private $idCompraEstado;
    private $cefechaini;
    private $cefechaifin;
    private $objetoCompra;
    private $objetoCompraEstadoTipo;
    private $mensajeOperacion;

    //TODO: ver contructores de fechas
    public function __construct()
    {
        parent::__construct();
        $this->idCompraEstado = '';
        $this->cefechaini = '';
        $this->cefechaifin = '';
        $this->objetoCompra = new Compra();
        $this->objetoCompraEstadoTipo = new CompraEstadoTipo();
        $this->mensajeOperacion = '';
    }

    /**
     * Get the value of idCompraEstado
     */
    public function getIdCompraEstado()
    {
        return $this->idCompraEstado;
    }

    /**
     * Get the value of cefechaini
     */
    public function getCefechaini()
    {
        return $this->cefechaini;
    }

    /**
     * Get the value of cefechaifin
     */
    public function getCefechaifin()
    {
        return $this->cefechaifin;
    }

    /**
     * Get the value of objetoCompra
     */
    public function getObjetoCompra()
    {
        return $this->objetoCompra;
    }

    /**
     * Get the value of objetoCompraEstadoTipo
     */
    public function getObjetoCompraEstadoTipo()
    {
        return $this->objetoCompraEstadoTipo;
    }

    /**
     * Get the value of mensajeOperacion
     */
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    /**
     * Set the value of idCompraEstado
     *
     * @return  self
     */
    public function setIdCompraEstado($idCompraEstado)
    {
        $this->idCompraEstado = $idCompraEstado;

        return $this;
    }

    /**
     * Set the value of cefechaini
     *
     * @return  self
     */
    public function setCefechaini($cefechaini)
    {
        $this->cefechaini = $cefechaini;

        return $this;
    }

    /**
     * Set the value of cefechaifin
     *
     * @return  self
     */
    public function setCefechaifin($cefechaifin)
    {
        $this->cefechaifin = $cefechaifin;

        return $this;
    }

    /**
     * Set the value of objetoCompra
     *
     * @return  self
     */
    public function setObjetoCompra($objetoCompra)
    {
        $this->objetoCompra = $objetoCompra;

        return $this;
    }

    /**
     * Set the value of objetoCompraEstadoTipo
     *
     * @return  self
     */
    public function setObjetoCompraEstadoTipo($objetoCompraEstadoTipo)
    {
        $this->objetoCompraEstadoTipo = $objetoCompraEstadoTipo;

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

    public function setear($id, $fechaInicio, $fechaFin, $objCompra, $objCompraET)
    {
        $this->setIdCompraEstado($id);
        $this->setCefechaini($fechaInicio);
        $this->setCefechaifin($fechaFin);
        $this->setObjetoCompra($objCompra);
        $this->setObjetoCompraEstadoTipo($objCompraET);
    }

    public function cargar()
    {
        $resp = false;
        $query = "SELECT * FROM compraestado WHERE idcompraestado = " . $this->getIdCompraEstado();
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($query);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $this->Registro();
                    $objetoCompra = new Compra();
                    $objetoCompra->setIdCompra($row['idcompra']);
                    $objetoCompra->cargar();

                    $objetoCompraEstadoTipo = new CompraEstadoTipo();
                    $objetoCompraEstadoTipo->setIdCompraEstadoTipo($row['idcompraestadotipo']);
                    $objetoCompraEstadoTipo->cargar();

                    $this->setear($row['idcompraestado'], $row['cefechaini'], $row['cefechafin'], $row['fechacreacion'], $objetoCompra, $objetoCompraEstadoTipo);
                }
            }
        } else {
            $this->setMensajeoperacion("ERROR::Compra Estado->cargar: " . $this->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $idCompra = $this->getObjetoCompra()->getIdCompra();
        $idCompraEstadoTipo = $this->getObjetoCompraEstadoTipo()->getIdCompraEstadoTipo();
        $query = "INSERT INTO compraestado(idcompra,idcompraestadotipo,cefechaini,cefechafin)  
              VALUES('"
            . $idCompra . "', '"
            . $idCompraEstadoTipo . "', '"
            . $this->getCefechaini() . "', '"
            . $this->getCefechaifin() . "'
        );";
        if ($this->Iniciar()) {
            if ($id = $this->Ejecutar($query)) {
                $this->setIdCompraEstado($id);
                $resp = true;
            } else {
                $this->setmensajeoperacion("ERROR::Compra Estado->insertar ejecutar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::Compra Estado->insertar iniciar: " . $this->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $idCompra = $this->getObjetoCompra()->getIdCompra();
        $idCompraEstadoTipo = $this->getObjetoCompraEstadoTipo()->getIdCompraEstadoTipo();

        $query = "UPDATE compraestado SET 
            idcompra='" . $idCompra . "', 
            idcompraestadotipo='" . $idCompraEstadoTipo . "', 
            cefechaini='" . $this->getCefechaini() . "',
            cefechafin='" . $this->getCefechaifin() . "'" .
            " WHERE idcompraestado=" . $this->getIdCompraEstado();

        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Compra Estado => modificar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Compra Estado => modificar insertar: " . $this->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;

        $query = "DELETE FROM compraestado WHERE idcompraestado=" . $this->getIdCompraEstado();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Compra Estado => eliminar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Compra Estado => eliminar insertar: " . $this->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();

        $query = "SELECT * FROM compraestado ";
        if ($parametro != "") {
            $query .= 'WHERE ' . $parametro;
        }
        // if ($this->Iniciar()) {
        $res = $this->Ejecutar($query);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $this->Registro()) {

                    $objetoCompra = new Compra();
                    $objetoCompra->setIdCompra($row['idcompra']);
                    $objetoCompra->cargar();

                    $objetoCompraEstadoTipo = new CompraEstadoTipo();
                    $objetoCompraEstadoTipo->setIdCompraEstadoTipo($row['idcompraestadotipo']);
                    $objetoCompraEstadoTipo->cargar();

                    $obj = new CompraEstado();
                    $obj->setear($row['idcompraestado'], $row['cefechaini'], $row['cefechafin'], $objetoCompra, $objetoCompraEstadoTipo);

                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setmensajeoperacion("ERROR::Compra Estado => listar: " . $this->getError());
        }
        //}
        return $arreglo;
    }
}
