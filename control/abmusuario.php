<?php
class abmusuario
{
    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idusuario'])) {
                $where .= " and idusuario =" . $param['idusuario'];
            }

            if (isset($param['usnombre'])) {
                $where .= " and usnombre ='" . $param['usnombre'] . "'";
            }

            if (isset($param['uspass'])) {
                $where .= " and uspass ='" . $param['uspass'] . "'";
            }

            if (isset($param['usmail'])) {
                $where .= " and usmail ='" . $param['usmail'] . "'";
            }
            if (isset($param['usdeshabilitado'])) {
                $where .= " and usdeshabilitado ='" . $param['usdeshabilitado'] . "'";
            }
        }
        $arreglo = usuario::listar($where);
        return $arreglo;
    }

    private function cargarObjeto($param)
    {
        $objUs = null;
        if (array_key_exists('usnombre', $param) && array_key_exists('usmail', $param) && array_key_exists('uspass', $param)) {
            $objUs = new usuario();
            $objUs->setear(
                '',
                $param['usnombre'],
                $param['uspass'],
                $param['usmail'],
                ''
            );
        }
        return $objUs;
    }

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idusuario'])) {
            $resp = true;
        }
        return $resp;
    }

    private function cargarObjetoConClave($param)
    {
        $objUs = null;

        if (isset($param['idusuario'])) {
            $objUs = new usuario();
            $objUs->setear($param['idusuario'], null, null, null, null);
        }
        return $objUs;
    }

    public function modificacion($param)
    {
        $resp = false;
        $objUs = new usuario();
        $objUs->setear($param['idusuario'], $param['usnombre'], $param['uspass'], $param['usmail'], $param['usdeshabilitado']);
        if ($objUs->modificar()) {
            $resp = true;
        }
        return $resp;
    }


    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objUsuario = $this->cargarObjetoConClave($param);
            if ($objUsuario != null and $objUsuario->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $objUsuario = $this->cargarObjeto($param);

        if ($objUsuario->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    //Hace un borrado logico del usuario. 
    //En caso de que ya estuviese deshabilitado, lo vuelve a habilitar.
    public function deshabilitarUsuario($param)
    {
        $resp = false;
        $objUsuario = $this->cargarObjetoConClave($param);
        $listadoProductos = $objUsuario->listar("idusuario=" . $param['idusuario']);
        if (count($listadoProductos) > 0) {
            // print_r($listadoProductos[0]);
            $estadoUsuario = $listadoProductos[0]->getUsdeshabilitado();
            if ($estadoUsuario == '0000-00-00 00:00:00') {
                if ($objUsuario->estado(date("Y-m-d H:i:s"))) {
                    $resp = true;
                }
            } else {
                if ($objUsuario->estado()) {
                    $resp = true;
                }
            }
        }
        return $resp;
    }
}
