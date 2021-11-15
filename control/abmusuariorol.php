<?php
class abmusuariorol
{

    public function buscar($param)
    {
        $where = " true ";

        if ($param != null) {
            if (isset($param['idusuario'])) {
                $where .= " and idusuario ='" . $param['idusuario'] . "'";
            }

            if (isset($param['idrol'])) {
                $where .= " and idrol ='" . $param['idrol'] . "'";
            }
        }

        $arreglo = usuariorol::listar($where);

        return $arreglo;
    }

    public function modificacion($param)
    {
        $resp = false;
        $objUsRol = new usuariorol();
        $abmRol = new abmrol();
        $listaRol = $abmRol->buscar(['idrol' => $param['idrol']]);
        $abmUsuario = new abmusuario();
        $listaUsuario = $abmUsuario->buscar(['idusuario' => $param['idusuario']]);
        $objUsRol->setear($listaUsuario[0], $listaRol[0]);
        if ($objUsRol->modificar()) {
            $resp = true;
        }
        return $resp;
    }

    public function baja($param)
    {
        $resp = false;
        $objRel = new usuariorol();
        $abmUs = new abmusuario();
        $arrayUs = $abmUs->buscar(['idusuario' => $param['idusuario']]);
        $abmRol = new abmrol();
        $objRol = $abmRol->buscar(['idrol' => $param['idrol']]);
        $objRel->setear($arrayUs[0], $objRol[0]);

        if ($objRel->eliminar()) {
            $resp = true;
        }

        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $objUsuarioRol = new usuariorol();
        $abmUs = new abmusuario();
        $arrayUs = $abmUs->buscar(['idusuario' => $param['idusuario']]);
        $abmRol = new abmrol();
        $objRol = $abmRol->buscar(['idrol' => $param['idrol']]);
        var_dump($objRol);
        $objUsuarioRol->setear($arrayUs[0], $objRol[0]);

        if ($objUsuarioRol->insertar()) {
            $resp = true;
        }
        return $resp;
    }
}
