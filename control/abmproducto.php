<?php
class abmproducto
{
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idproducto', $param) && array_key_exists('proprecio', $param) && array_key_exists('prodescuento', $param) && array_key_exists('pronombre', $param) && array_key_exists('prodetalle', $param) && array_key_exists('procantstock', $param)) {
            $obj = new producto();
            $obj->setear(
                $param['idproducto'],
                $param['proprecio'],
                $param['prodescuento'],
                $param['pronombre'],
                $param['prodetalle'],
                $param['procantventas'],
                $param['procantstock'],
                ''
            );
        }

        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;

        if (isset($param['idproducto'])) {
            $obj = new producto();
            $obj->setear($param['idproducto'], null, null, null, null, null, null, null);
        }
        return $obj;
    }

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idproducto'])) {
            $resp = true;
        }
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;

        $elObjtProducto = $this->cargarObjeto($param);

        if ($elObjtProducto != null and $elObjtProducto->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtProducto = $this->cargarObjetoConClave($param);
            if ($elObjtProducto != null and $elObjtProducto->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtProducto = $this->cargarObjeto($param);
            if ($elObjtProducto != null and $elObjtProducto->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function deshabilitarProd($param)
    {
        $resp = false;
        $objProducto = $this->cargarObjetoConClave($param);
        $listadoProductos = $objProducto->listar("idproducto='" . $param['idproducto'] . "'");
        if (count($listadoProductos) > 0) {
            $estadoProducto = $listadoProductos[0]->getProDeshabilitado();
            if ($estadoProducto == '0000-00-00 00:00:00') {
                if ($objProducto->estado(date("Y-m-d H:i:s"))) {
                    $resp = true;
                }
            } else {
                if ($objProducto->estado()) {
                    $resp = true;
                }
            }
        }
        return $resp;
    }

    public function buscar($param)
    {
        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idproducto']))
                $where .= " and idproducto ='" . $param['idproducto'] . "'";
            if (isset($param['proprecio']))
                $where .= " and proprecio =" . $param['proprecio'];
            if (isset($param['prodescuento']))
                $where .= " and prodescuento =" . $param['prodescuento'];
            if (isset($param['pronombre']))
                $where .= " and pronombre ='" . $param['pronombre'] . "'";
            if (isset($param['prodetalle']))
                $where .= " and prodetalle ='" . $param['prodetalle'] . "'";
            if (isset($param['procantventas']))
                $where .= " and procantcompras >=" . $param['procantcompras'];
            if (isset($param['procantstock']))
                $where .= " and procantstock >=" . $param['procantstock'];
            if (isset($param['tipoproducto'])) {
                switch ($param['tipoproducto']) {
                    case 'aros':
                        $where .= " and idproducto like '%A%'";
                        break;
                    case 'pulseras':
                        $where .= " and idproducto like '%P%'";
                        break;
                    case 'cadenitas':
                        $where .= " and idproducto like '%C%'";
                        break;
                    case 'relojes':
                        $where .= " and idproducto like '%R%'";
                        break;
                }
            }
            if (isset($param['habilitado']))
                $where .= " and prodeshabilitado = '0000-00-00 00:00:00'";
            if (isset($param['campoorden']))
                $where .= "order by " . $param['campoorden'] . " " . $param['ordenado'];
        }
        $arreglo = producto::listar($where);
        return $arreglo;
    }

    // public function buscarHabilitados()
    // {
    //     $arreglo = producto::listarProdHabilitado();
    //     return $arreglo;
    // }

    // public function buscarMasVendidos()
    // {
    //     $arreglo = producto::listarMasVendido();
    //     return $arreglo;
    // }
}
