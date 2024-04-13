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
        //viewStructure($arreglo);
        return $arreglo;
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
}
