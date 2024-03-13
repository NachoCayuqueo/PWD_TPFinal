<?php
class AbmValoracionProducto
{
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
}
