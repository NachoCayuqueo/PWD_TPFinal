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
            echo $ubicacion . "<br/>";
            // echo $carpetaTemporal . "<br/>";
            if (move_uploaded_file($carpetaTemporal, $ubicacion)) {
                $exito = true;
                $resp =  "Archivo guardado con éxito";
            } else {

                $resp = "ERROR al guardar el archivo";
            }
        } else {
            $resp = "ERROR: El formato del archivo no es el permitido";
        }

        return $exito;
    }
}

//! FALTA PONER EL NOMBRE DE LA IMAGEN EN EL JSON PARA PODER RECUPEARLA, Y MOSTRAR EL LA IMAGEN AL COSTADO DEL CARGAR ARCHIVO EN LA VISTA PARA PREVISUALIZARLA