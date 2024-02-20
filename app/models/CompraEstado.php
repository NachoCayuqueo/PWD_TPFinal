<?php
class CompraEstado
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
        $this->idCompraEstado = '';
        $this->cefechaini = '';
        $this->cefechaifin = '';
        $this->objetoCompra = '';
        $this->objetoCompraEstadoTipo = '';
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
}
