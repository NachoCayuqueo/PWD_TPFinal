<?php
class Usuario
{
    private $idUsuario;
    private $usDeshabilitado;
    private $usMail;
    private $usNombre;
    private $usPass;
    private $mensajeOperacion;

    public function __construct()
    {
        $this->idUsuario = "";
        $this->usDeshabilitado = "";
        $this->usMail = "";
        $this->usNombre = "";
        $this->usPass = "";
        $this->mensajeOperacion = "";
    }

    /**
     * Get the value of idUsuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Get the value of usDeshabilitado
     */
    public function getUsDeshabilitado()
    {
        return $this->usDeshabilitado;
    }

    /**
     * Get the value of usMail
     */
    public function getUsMail()
    {
        return $this->usMail;
    }

    /**
     * Get the value of usNombre
     */
    public function getUsNombre()
    {
        return $this->usNombre;
    }

    /**
     * Get the value of usPass
     */
    public function getUsPass()
    {
        return $this->usPass;
    }

    /**
     * Get the value of mensajeOperacion
     */
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    /**
     * Set the value of idUsuario
     *
     * @return  self
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Set the value of usDeshabilitado
     *
     * @return  self
     */
    public function setUsDeshabilitado($usDeshabilitado)
    {
        $this->usDeshabilitado = $usDeshabilitado;

        return $this;
    }

    /**
     * Set the value of usMail
     *
     * @return  self
     */
    public function setUsMail($usMail)
    {
        $this->usMail = $usMail;

        return $this;
    }

    /**
     * Set the value of usNombre
     *
     * @return  self
     */
    public function setUsNombre($usNombre)
    {
        $this->usNombre = $usNombre;

        return $this;
    }

    /**
     * Set the value of usPass
     *
     * @return  self
     */
    public function setUsPass($usPass)
    {
        $this->usPass = $usPass;

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
