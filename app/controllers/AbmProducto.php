<?php
class AbmProducto
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
            if (isset($param['idproducto']))
                $where[] = " idproducto = '" . $param['idproducto'] . "'";
            if (isset($param['pronombre']))
                $where[] = " pronombre = '" . $param['pronombre'] . "'";
            if (isset($param['prodetalle']))
                $where[] = " prodetalle = '" . $param['prodetalle'] . "'";
            if (isset($param['procantstock']))
                $where[] = " procantstock = '" . $param['procantstock'] . "'";
        }
        $whereClause = implode(" AND ", $where);
        $objetoProducto = new Producto();
        $arreglo = $objetoProducto->listar($whereClause);
        return $arreglo;
    }
}
