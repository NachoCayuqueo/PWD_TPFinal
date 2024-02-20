<?php
class Rol
{
    private $idRol;
    private $roDescripcion;
    private $mensajeOperacion;

    public function __construct()
    {
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
}
