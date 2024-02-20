<?php
class UsuarioRol
{
    private $objetoRol;
    private $objetoUsuario;
    private $mensajeOperacion;

    public function __construct()
    {
        $this->objetoRol = "";
        $this->objetoUsuario = "";
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
}
