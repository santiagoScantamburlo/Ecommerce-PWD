<?php
include_once 'conector/BaseDatos.php';
class menurol
{
    private $objMenu;
    private $objRol;
    private $mensajeOperacion;

    public function __construct()
    {
        $this->objMenu = null;
        $this->objRol = null;
    }

    //OBSERVADORES
    public function getObjMenu()
    {
        return $this->objMenu;
    }

    public function getObjRol()
    {
        return $this->objRol;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    //MODIFICADORES
    public function setObjMenu($objMenu)
    {
        $this->objMenu = $objMenu;
    }

    public function setObjRol($objRol)
    {
        $this->objRol = $objRol;
    }

    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    // Metodos
    public function setear($menu, $rol)
    {
        $this->setObjMenu($menu);
        $this->setObjRol($rol);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $idmenu = $this->getObjMenu()->getIdmenu();
        $idRol = $this->getObjRol()->getIdrol();
        $sql = "SELECT * FROM menurol WHERE idmenu= " . $idmenu . " AND idrol= " . $idRol;

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $objRol = null;
                    $objMenu = null;
                    $row = $base->Registro();

                    if ($row['idrol'] != null) {
                        $objRol = new rol();
                        $objRol->setIdrol($row['idrol']);
                        $objRol->cargar();
                    }

                    if ($row['idmenu'] != null) {

                        $objMenu = new menu();
                        $objMenu->setIdmenu($row['idmenu']);
                        $objMenu->cargar();
                    }
                    $this->setear($objMenu, $objRol);
                }
            }
        } else {
            $this->setMensajeOperacion("menuRol->cargar: " . $base->getError());
        }

        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $objMenu = $this->getObjMenu();
        $objRol = $this->getObjRol();
        $idmenu = $objMenu->getIdmenu();
        $idRol = $objRol->getIdrol();
        $sql = "INSERT INTO menurol(idmenu,idrol)  VALUES(" . $idmenu . "," . $idRol . ")";
        echo $sql;

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Menurol->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Menurol->insertar: " . $base->getError());
        }

        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $idmenu = $this->getObjMenu()->getIdmenu();
        $idRol = $this->getObjRol()->getIdrol();
        $sql = " UPDATE menurol SET ";
        $sql .= " idrol = " . $idRol;
        $sql .= " WHERE idmenu =" . $idmenu;

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Menurol->modificar 1: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Menurol->modificar 2: " . $base->getError());
        }

        return $resp;
    }


    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM menurol WHERE idmenu=" . $this->getObjMenu()->getIdmenu() . " and idrol= " . $this->getObjRol()->getIdrol();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Menurol->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Menurol->eliminar: " . $base->getError());
        }

        return $resp;
    }



    public static function listar($condicion = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM menurol ";
        if ($condicion != "") {
            $sql .= 'WHERE ' . $condicion;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $objMenuRol = new menurol();
                    $abmUs = new abmmenu();
                    $arrayUs = $abmUs->buscar(['idmenu' => $row['idmenu']]);
                    $abmRol = new abmrol();
                    $objRol = $abmRol->buscar(['idrol' => $row['idrol']]);
                    $objMenuRol->setear($arrayUs[0], $objRol);
                    array_push($arreglo, $objMenuRol);
                }
            }
        } else {
            $this->setMensajeOperacion("Menurol->listar: " . $base->getError());
        }

        return $arreglo;
    }
}
