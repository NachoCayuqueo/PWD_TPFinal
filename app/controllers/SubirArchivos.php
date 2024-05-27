<?php
class SubirArchivos
{
    private $EXTENSION_IMG = ['jpg', 'png', 'jpeg'];
    private $CARPETA = __DIR__ . '/../../assets/images/products/'; //carpeta donde se

    public function SubirImagen($nombre, $carpetaTemporal, $tipo)
    {
        // Extensiones permitidas
        $extensionesPermitidas = $this->EXTENSION_IMG;

        // Obtener la información del archivo
        $inf_archivo = pathinfo($nombre);
        $extensionDeArchivo = strtolower($inf_archivo['extension']);
        $exito = false;

        // Verificar que la extensión del archivo esté permitida
        if (in_array($extensionDeArchivo, $extensionesPermitidas)) {
            // Construir la ubicación final del archivo
            $ubicacion = $this->CARPETA .  $tipo . '/' . basename($nombre);

            // Verificar que el directorio existe o crearlo
            if (!file_exists(dirname($ubicacion))) {
                mkdir(dirname($ubicacion), 0777, true);
            }

            // Mover el archivo desde la carpeta temporal a la ubicación final
            if (move_uploaded_file($carpetaTemporal, $ubicacion)) {
                $exito = true;
            } else {
                $resp = "ERROR: No se pudo mover el archivo.";
            }
        } else {
            $resp = "ERROR: El formato del archivo no es el permitido.";
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
