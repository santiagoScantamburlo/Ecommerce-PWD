<?php
class abmcompraestado
{
    private function cargarObjeto($param)
    {
        //print_r ($param);
        $obj = null;
        if (
            array_key_exists('idcompraestado', $param) and array_key_exists('idcompra', $param)
            and array_key_exists('idcompraestadotipo', $param) and array_key_exists('cefechaini', $param)
            and array_key_exists('cefechafin', $param)
        ) {

            //creo objeto estadotipos
            $objProducto = new compra();
            $objProducto->getIdCompra($param['idcompra']);
            $objProducto->cargar();

            //creo objeto usuario
            $objCompra = new compraestadotipo();
            $objCompra->setIdCompraEstadoTipo($param['idcompraestadotipo']);
            $objCompra->cargar();

            //agregarle los otros objetos
            $obj = new compraestado();
            $obj->setear($param['idcompraestado'], $objProducto, $objCompra, $param['cefechaini'], $param['cefechafin']);
        }
        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idcompraestado'])) {
            $obj = new compraestado();
            $obj->setear($param['idcompraestado'], null, null, null, null);
        }
        return $obj;
    }

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idcompraestado'])) {
            $resp = true;
        }

        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idcompraestado'] = null;
        $elObjtArchivoE = $this->cargarObjeto($param);
        //print_r($elObjtArchivoE);
        if ($elObjtArchivoE != null && $elObjtArchivoE->insertar()) {
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
        if ($param != null) {
            if (isset($param['idcompraestado'])) {
                $where .= " and idcompraestado =" . $param['idcompraestado'];
            }

            if (isset($param['idcompra'])) {
                $where .= " and idcompra =" . $param['idcompra'];
            }

            if (isset($param['idcompraestadotipo'])) {
                $where .= " and idcompraestadotipo ='" . $param['idcompraestadotipo'] . "'";
            }

            if (isset($param['cefechaini'])) {
                $where .= " and cefechaini ='" . $param['cefechaini'] . "'";
            }

            if (isset($param['cefechafin'])) {
                $where .= " and cefechafin ='" . $param['cefechafin'] . "'";
            }

        }
        $arreglo = compraestado::listar($where);
        return $arreglo;
    }
}
