<?php
class abmcompraitem
{
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idcompraitem', $param) && array_key_exists('idproducto', $param) && array_key_exists('idcompra', $param) && array_key_exists('cicantidad', $param)) {
            $objProducto = new producto();
            $objProducto->setIdProducto($param['idproducto']);
            $objProducto->cargar();

            $objCompra = new compra();
            $objCompra->setIdCompra($param['idcompra']);
            $objCompra->cargar();

            $obj = new compraitem();
            $obj->setear($param['idcompraitem'], $objProducto, $objCompra, $param['cicantidad']);
        }

        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idcompraitem'])) {
            $obj = new compraitem();
            $obj->setear($param['idcompraitem'], null, null, null);
        }

        return $obj;
    }

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idcompraitem'])) {
            $resp = true;
        }

        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idcompraitem'] = null;
        $elObjtArchivoE = $this->cargarObjeto($param);
        //print_r($elObjtArchivoE);
        if ($elObjtArchivoE != null and $elObjtArchivoE->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /* public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtArchivoE = $this->cargarObjetoConClave($param);
            if ($elObjtArchivoE!=null and $elObjtArchivoE->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    } */

    public function modificacion($param)
    {
        //echo "Estoy en modificacion";
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtArchivoE = $this->cargarObjeto($param);
            if ($elObjtArchivoE != null and $elObjtArchivoE->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param)
    {
        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idcompraitem']))
                $where .= " and idcompraitem =" . $param['idcompraitem'];
            if (isset($param['idproducto']))
                $where .= " and idproducto =" . $param['idproducto'];
            if (isset($param['idcompra']))
                $where .= " and idcompra ='" . $param['idcompra'] . "'";
            if (isset($param['cicantidad']))
                $where .= " and cicantidad ='" . $param['cicantidad'] . "'";
        }
        $arreglo = compraitem::listar($where);
        return $arreglo;
    }
}