<?php
class abmusuariorol{
    
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
        
        $arreglo = usuariorol::seleccionar($where);
        
        return $arreglo;
    }

    public function baja($param){
        $resp = false;
        $objRel=new usuariorol();
        $abmUs=new abmusuario();
        $arrayUs=$abmUs->buscar(['idusuario'=>$param['idusuario']]);
        $abmRol=new abmrol();
        $objRol=$abmRol->buscar($param['idrol']);
        $objRel->setear($arrayUs[0], $objRol);
        
        if ($objRel->eliminar()){
            $resp=true;
        }
        
        return $resp;
    }

    public function alta($param){
        $resp = false;
        $objRel=new usuariorol();
        $abmUs=new abmusuario();
        $arrayUs=$abmUs->buscar(['idusuario'=>$param['idusuario']]);
        $abmRol=new AbmRol();
        $objRol=$abmRol->buscar(['idrol'=>$param['idrol']]);
        $objRel->setear($arrayUs[0], $objRol[0]);
        
        if ($objRel->insertar()){
            $resp = true;
        }
        return $resp;
        
    }
}
