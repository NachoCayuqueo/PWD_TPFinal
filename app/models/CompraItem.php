<?php
class CompraItem
{
    private $idCompraItem;
    private $cicantidad;
    private $objetoCompra;
    private $objetoProducto;
    private $mensajeOperacion;

    public function __construct()
    {
        $this->idCompraItem = "";
        $this->cicantidad = "";
        $this->objetoCompra = "";
        $this->objetoProducto = "";
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
}
