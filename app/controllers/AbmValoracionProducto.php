<?php
class AbmValoracionProducto
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return ValoracionProducto
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idValoracionProducto', $param)  &&
            array_key_exists('ranking', $param) &&
            array_key_exists('descripcion', $param)  &&
            array_key_exists('fechaCreacion', $param) &&
            array_key_exists('idUsuario', $param)  &&
            array_key_exists('idProducto', $param)
        ) {
            $objetoUsuario = new Usuario();
            $objetoUsuario->setIdUsuario($param['idUsuario']);

            $objetoProducto = new Producto();
            $objetoProducto->setIdProducto($param['idProducto']);

            $obj = new ValoracionProducto();
            $obj->setear(
                $param['idValoracion'],
                $param['ranking'],
                $param['descripcion'],
                $param['fechaCreacion'],
                $objetoUsuario,
                $objetoProducto
            );
        }
        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idValoracion'])) {
            $obj = new ValoracionProducto();
            $obj->setear($param['idValoracion'], null, null, null, null, null);
        }
        return $obj;
    }
    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idValoracion']))
            $resp = true;
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idValoracionProducto'] = null;

        $objetoValoracion = $this->cargarObjeto($param);
        if ($objetoValoracion != null and $objetoValoracion->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objetoValoracion = $this->cargarObjeto($param);
            if ($objetoValoracion != null and $objetoValoracion->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objetoProducto = $this->cargarObjetoConClave($param);
            if ($objetoProducto != null and $objetoProducto->eliminar()) {

                $resp = true;
            }
        }

        return $resp;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = [];
        if ($param !== NULL) {
            if (isset($param['idValoracion']))
                $where[] = " idvaloracion = '" . $param['idValoracion'] . "'";
            if (isset($param['idUsuario']))
                $where[] = " idusuario = '" . $param['idUsuario'] . "'";
            if (isset($param['idProducto']))
                $where[] = " idproducto = '" . $param['idProducto'] . "'";
            if (isset($param['ranking']))
                $where[] = " ranking = '" . $param['ranking'] . "'";
            if (isset($param['descripcion']))
                $where[] = " descripcion = '" . $param['descripcion'] . "'";
        }
        $whereClause = implode(" AND ", $where);

        $objetoValoracion = new ValoracionProducto();
        $arreglo = $objetoValoracion->listar($whereClause);
        return $arreglo;
    }

    //param es un arreglo de valoraciones
    public function cargarValoraciones($param)
    {
        $productosRankeados = $param['productosRankeados'];

        foreach ($productosRankeados as $producto) {
            $idUsuario = $producto['idUsuario'];
            $idProducto = $producto['idProducto'];
            $estrellas = $producto['estrellas'];
            $comentario = $producto['comentario'];

            $paramAlta = [
                'ranking' => $estrellas,
                'descripcion' => $comentario,
                'fechaCreacion' => date("Y-m-d H:i:s"),
                'idUsuario' => $idUsuario,
                'idProducto' => $idProducto
            ];

            $altaExitosa = $this->alta($paramAlta);
            if (!$altaExitosa) return false;
        }
        return $altaExitosa;
    }

    public function obtenerValoracionProducto($idUsuario, $idProducto)
    {
        $paramBuscar = [
            'idUsuario' => $idUsuario,
            'idProducto' => $idProducto
        ];
        $valoracionProducto = $this->buscar($paramBuscar);
        if (!empty($valoracionProducto)) {
            $ranking = $valoracionProducto[0]->getRanking();
            $descripcion = $valoracionProducto[0]->getDescripcion();
            $fecha = $valoracionProducto[0]->getFechaCreacion();
            $valoracion = [
                'ranking' => $ranking,
                'descripcion' => $descripcion,
                'fecha' => $fecha
            ];
            return $valoracion;
        } else {
            return [];
        }
    }

    public function toArrayValoraciones($valoraciones)
    {
        $objetoProducto = new AbmProducto();
        $objetoUsuario = new AbmUsuario();
        $arregloValoraciones = [];

        foreach ($valoraciones as $valoracion) {
            $producto = $valoracion->getObjetoProducto();
            $productos = $objetoProducto->toArray([$producto]);

            $usuario = $valoracion->getObjetoUsuario();
            $usuarios = $objetoUsuario->toArray([$usuario]);

            $arrayRatings = [
                'idValoracionProducto' => $valoracion->getIdValoracionProducto(),
                'ranking' => $valoracion->getRanking(),
                'descripcion' => $valoracion->getDescripcion(),
                'fechaCreacion' => $valoracion->getFechaCreacion(),
                'objetoUsuario' => $usuarios,
                'objetoProducto' => $productos,
            ];
            $arregloValoraciones[] = $arrayRatings;
        }
        return $arregloValoraciones;
    }


    public function generateModalReviews($arregloValoraciones)
    {

        $modalContent = '
        <div class="modal fade" id="modalReviews" tabindex="-1" aria-labelledby="modalReviewsLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Reviews</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">';

        foreach ($arregloValoraciones as $valoracion) {
            $usuario = $valoracion['objetoUsuario'];
            $nombreUsuario = $usuario['usNombre'];
            $emailUsuario = $usuario['usMail'];
            $promedio = $valoracion['ranking'];

            $modalContent .= '
            <input type="hidden" id="promedio_' . $valoracion['idValoracionProducto'] . '" value="' . $promedio . '">
            <div id="card_' . $valoracion['idValoracionProducto'] . '" class="card card-container p-2 mb-3">
              <div class="card-body">
                <h5 class="card-title">' . $nombreUsuario . '</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">' . $emailUsuario . '</h6>
                <h6 class="card-subtitle mb-2 text-body-secondary">
                  <div class="rating">
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                  </div>
                </h6>
                <p class="card-text">' . $valoracion['descripcion'] . '</p>
                <p class="card-text">' . dateFormat($valoracion['fechaCreacion']) . '</p>
              </div>
            </div>';
        }

        $modalContent .= '  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>';

        return $modalContent;
    }
}
