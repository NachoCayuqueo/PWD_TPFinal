<?php
class CompraItem extends DataBase
{
    private $idCompraItem;
    private $cicantidad;
    private $objetoCompra;
    private $objetoProducto;
    private $mensajeOperacion;

    public function __construct()
    {
        parent::__construct();
        $this->idCompraItem = "";
        $this->cicantidad = "";
        $this->objetoCompra = new Compra();
        $this->objetoProducto = new Producto();
        $this->mensajeOperacion = "";
    }

    /**
     * Get the value of idCompraItem
     */
    public function getIdCompraItem()
    {
        return $this->idCompraItem;
    }

    /**
     * Get the value of cicantidad
     */
    public function getCicantidad()
    {
        return $this->cicantidad;
    }

    /**
     * Get the value of objetoCompra
     */
    public function getObjetoCompra()
    {
        return $this->objetoCompra;
    }

    /**
     * Get the value of objetoProducto
     */
    public function getObjetoProducto()
    {
        return $this->objetoProducto;
    }

    /**
     * Get the value of mensajeOperacion
     */
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    /**
     * Set the value of idCompraItem
     *
     * @return  self
     */
    public function setIdCompraItem($idCompraItem)
    {
        $this->idCompraItem = $idCompraItem;

        return $this;
    }

    /**
     * Set the value of cicantidad
     *
     * @return  self
     */
    public function setCicantidad($cicantidad)
    {
        $this->cicantidad = $cicantidad;

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
     * Set the value of objetoProducto
     *
     * @return  self
     */
    public function setObjetoProducto($objetoProducto)
    {
        $this->objetoProducto = $objetoProducto;

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

    public function setear($id, $cantidad, $objCompra, $objProducto)
    {
        $this->setIdCompraItem($id);
        $this->setCicantidad($cantidad);
        $this->setObjetoCompra($objCompra);
        $this->setObjetoProducto($objProducto);
    }

    public function cargar()
    {
        $resp = false;
        $query = "SELECT * FROM compraitem WHERE idcompraitem = " . $this->getIdCompraItem();
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($query);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $this->Registro();

                    $objetoCompra = new Compra();
                    $objetoCompra->setIdCompra($row['idcompra']);
                    $objetoCompra->cargar();

                    $objetoProducto = new Producto();
                    $objetoProducto->setIdProducto($row['idproducto']);
                    $objetoProducto->cargar();

                    $this->setear($row['idcompraitem'], $row['cicantidad'], $objetoCompra, $objetoProducto);
                }
            }
        } else {
            $this->setMensajeoperacion("ERROR::Compra Item->cargar: " . $this->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $idCompra = $this->getObjetoCompra()->getIdCompra();
        $idProducto = $this->getObjetoProducto()->getIdProducto();

        $query = "INSERT INTO compraitem(cicantidad,idcompra,idproducto)  
              VALUES('"
            . $this->getCicantidad() . "', '"
            . $idCompra . "', '"
            . $idProducto . "'
        );";

        if ($this->Iniciar()) {
            if ($id = $this->Ejecutar($query)) {
                $this->setIdCompraItem($id);
                $resp = true;
            } else {
                $this->setmensajeoperacion("ERROR::Compra Item->insertar ejecutar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::Compra Item->insertar iniciar: " . $this->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $idCompra = $this->getObjetoCompra()->getIdCompra();
        $idProducto = $this->getObjetoProducto()->getIdProducto();

        $query = "UPDATE compraitem SET 
            cicantidad='" . $this->getCicantidad() . "',   
            idcompra='" . $idCompra . "',   
            idproducto='" . $idProducto . "'" .
            " WHERE idcompraitem=" . $this->getIdCompraItem();

        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Compra Item => modificar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Compra Item => modificar insertar: " . $this->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;

        $query = "DELETE FROM compraitem WHERE idcompraitem=" . $this->getIdCompraItem();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Compra Item => eliminar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Compra Item => eliminar insertar: " . $this->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();

        $query = "SELECT * FROM compraitem ";
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

                    $objetoProducto = new Producto();
                    $objetoProducto->setIdProducto($row['idproducto']);
                    $objetoProducto->cargar();

                    $obj = new CompraItem();
                    $obj->setear($row['idcompraitem'], $row['cicantidad'], $objetoCompra, $objetoProducto);

                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setmensajeoperacion("ERROR::Compra Item=> listar: " . $this->getError());
        }
        //}
        return $arreglo;
    }
}
