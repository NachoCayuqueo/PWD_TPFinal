<?php
class Usuario extends DataBase
{
    private $idUsuario;
    private $usDeshabilitado;
    private $usMail;
    private $usNombre;
    private $usPass;
    private $usActivo;
    private $mensajeOperacion;

    public function __construct()
    {
        parent::__construct();

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
     * Get the value of usActivo
     */
    public function getUsActivo()
    {
        return $this->usActivo;
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
     * Set the value of usActivo
     *
     * @return  self
     */
    public function setUsActivo($usActivo)
    {
        $this->usActivo = $usActivo;

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

    public function setear($id, $nombre, $pass, $mail, $deshabilitado, $esUsuarioActivo)
    {
        $this->setIdUsuario($id);
        $this->setUsNombre($nombre);
        $this->setUsPass($pass);
        $this->setUsMail($mail);
        $this->setUsDeshabilitado($deshabilitado);
        $this->setUsActivo($esUsuarioActivo);
    }

    public function cargar()
    {
        $resp = false;
        $query = "SELECT * FROM usuario WHERE idusuario = " . $this->getIdUsuario();
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($query);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $this->Registro();
                    $this->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usmail'], $row['usdeshabilitado'], $row['usactivo']);
                }
            }
        } else {
            $this->setMensajeoperacion("ERROR::Usuario->cargar: " . $this->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;

        // Obtener el valor de usdeshabilitado
        $usDeshabilitado = $this->getUsDeshabilitado();

        // Construir la consulta SQL
        $query = "INSERT INTO usuario (usnombre, uspass, usmail, usdeshabilitado, usactivo) VALUES ('"
            . $this->getUsNombre() . "', '"
            . $this->getUsPass() . "', '"
            . $this->getUsMail() . "', ";

        // Verificar si usdeshabilitado es NULL o no
        if ($usDeshabilitado === null) {
            $query .= "NULL,";
        } else {
            $query .= "'" . $usDeshabilitado . "',";
        }

        // Obtener el valor de usActivo y lo agrego a la consulta
        $usActivo = $this->getUsActivo();
        $query .= ($usActivo ? '1' : '0') . ")";

        // Ejecutar la consulta
        if ($this->Iniciar()) {
            if ($id = $this->Ejecutar($query)) {
                $this->setIdUsuario($id);
                $resp = true;
            } else {
                $this->setmensajeoperacion("ERROR::Usuario->insertar ejecutar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::Usuario->insertar iniciar: " . $this->getError());
        }

        return $resp;
    }

    public function modificar()
    {
        $resp = false;

        $query = "UPDATE usuario SET 
            usnombre='" . $this->getUsNombre() . "', 
            uspass='" . $this->getUsPass() . "', 
            usmail='" . $this->getUsMail() . "'";

        $usDeshabilitado = $this->getUsDeshabilitado();

        if ($usDeshabilitado !== null) {
            $query .= ", usdeshabilitado='" . $usDeshabilitado . "'";
        }
        // Agregar la columna usActivo
        $usActivo = $this->getUsActivo();
        $query .= ", usactivo=" . ($usActivo ? 1 : 0);

        $query .= " WHERE idusuario=" . $this->getIdUsuario();

        // echo $query;

        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Usuario => modificar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Usuario => modificar insertar: " . $this->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;

        $query = "DELETE FROM usuario WHERE idusuario=" . $this->getIdUsuario();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Usuario => eliminar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Usuario => eliminar insertar: " . $this->getError());
        }
        return $resp;
    }

    public function deshabilitar()
    {
        $resp = false;
        $newDate = date('Y-m-d H:i:s');
        $query = "UPDATE usuario SET 
                    usDeshabilitado='" . $newDate . "', 
                    usactivo=0 WHERE idUsuario=" . $this->getIdUsuario();


        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Usuario => deshabilitar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Usuario => deshabilitar insertar: " . $this->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();
        $sql = "SELECT * FROM usuario ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    while ($row = $this->Registro()) {
                        $obj = new Usuario();
                        $obj->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usmail'], $row['usdeshabilitado'], $row['usactivo']);
                        array_push($arreglo, $obj);
                    }
                }
            } else {
                $this->setmensajeoperacion("ERROR::Usuario => listar: " . $this->getError());
            }
        }
        return $arreglo;
    }
}
