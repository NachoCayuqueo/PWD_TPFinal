<?php
class SubirArchivos
{
    private $EXTENSION_IMG = ['jpg', 'png', 'jpeg'];
    private $CARPETA = __DIR__ . '/../../assets/images/products/'; //carpeta donde se


    public function SubirImagen($nombre, $carpetaTemporal, $tipo)
    {
        $inf_archivo = pathinfo($nombre);
        $extensionDeArchivo = $inf_archivo['extension'];
        $exito = false;


        if (in_array($extensionDeArchivo, $this->EXTENSION_IMG)) {
            $ubicacion = $this->CARPETA .  $tipo . '/' . $nombre;
            if (move_uploaded_file($carpetaTemporal, $ubicacion)) {
                $exito = true;
            }
        } else {
            $resp = "ERROR: El formato del archivo no es el permitido";
        }
        return $exito;
    }

    public function cambiarImagenDeLugar($nombre, $tipoActual, $nuevoTipo)
    {
        $ubicacionActual = $this->CARPETA . $tipoActual . '/' . $nombre;
        $nuevaUbicacion = $this->CARPETA . $nuevoTipo . '/' . $nombre;
        $exito = false;

        if (file_exists($ubicacionActual)) {
            if (rename($ubicacionActual, $nuevaUbicacion)) {
                $exito = true;
                $resp = "Archivo movido con éxito";
            } else {
                $resp = "ERROR al mover el archivo";
            }
        } else {
            $resp = "ERROR: El archivo no existe en la ubicación actual";
        }

        return $exito;
    }
}
