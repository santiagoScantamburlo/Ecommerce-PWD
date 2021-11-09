<?php

class compra
{
    private $idcompra;
    private $cofecha;
    private $idusuario;
    private $mensajeoperacion;


    public function __construct()
    {
        $this->idcompra = "";
        $this->cofecha = "";
        $this->idusuario = new usuario();
        $this->mensajeoperacion = "";
    }
    
    // Getters
    public function getIdCompra()
    {
        return $this->idcompra;
    }
    
    public function getCoFecha()
    {
        return $this->cofecha;
    }
    
    public function getIdUsuario()
    {
        return $this->idusuario;
    }
    
    public function getMensajeOperacion()
    {
        return $this->mensajeoperacion;
    }
    
    // Setters
    public function setIdCompra($idcompra)
    {
        $this->idcompra = $idcompra;
    }

    public function setCoFecha($cofecha)
    {
        $this->cofecha = $cofecha;
    }

    public function setIdUsuario($idusuario)
    {
        $this->idusuario = $idusuario;
    }

    public function setMensajeOperacion($msj)
    {
        $this->mensajeoperacion = $msj;
    }
    
    // Metodos
    public function setear($idcompra, $cofecha, $idusuario)
    {
        $this->setIdCompra($idcompra);
        $this->setCoFecha($cofecha);
        $this->setIdUsuario($idusuario);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM compra WHERE idcompra = " . $this->getIdCompra();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();

                    $objUsuario = NULL;
                    if ($row['idusuario'] != null) {
                        $objUsuario = new usuario();
                        $objUsuario->setIdUsuario($row['idusuario']);
                        $objUsuario->cargar();
                    }

                    $this->setear($row['idcompra'], $row['cofecha'], $objUsuario);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("Compra->listar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO compra (cofecha, idusuario) VALUES ('{$this->getCoFecha()}','{$this->getIdUsuario()->getIdUsuario()}');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdCompra($elid);
                $resp = true;
            } else {
                $this->setMensajeOperacion("Compra->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Compra->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE compra SET idcompra='{$this->getIdCompra()}', cofecha='{$this->getCoFecha()}', idusuario='{$this->getIdUsuario()->getIdUsuario()}' WHERE idcompra='{$this->getIdCompra()}'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Compra->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Compra->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM compra WHERE idcompra=" . $this->getIdCompra();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeOperacion("Compra->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Compra->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM compra ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {
                    $obj = new Compra();

                    $objUsuario = NULL;
                    if ($row['idusuario'] != null) {
                        $objUsuario = new usuario();
                        $objUsuario->setIdUsuario($row['idusuario']);
                        $objUsuario->cargar();
                    }

                    $obj->setear($row['idcompra'], $row['cofecha'], $objUsuario, $row['idpadre'], $row['medeshabilitado']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("Compra->listar: " . $base->getError());
        }

        return $arreglo;
    }
}