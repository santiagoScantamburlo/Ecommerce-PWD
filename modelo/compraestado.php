<?php

class compraestado
{
    private $idcompraestado;
    private $idcompra;
    private $idcompraestadotipo;
    private $cefechaini;
    private $cefechafin;
    private $mensajeoperacion;


    public function __construct()
    {
        $this->idcompraestado = "";
        $this->idcompra = new compra();
        $this->idcompraestadotipo = new compraestadotipo();
        $this->cefechaini = "";
        $this->cefechafin = "";
        $this->mensajeoperacion = "";
    }
    
    // Getters
    public function getIdCompraEstado()
    {
        return $this->idcompraestado;
    }
    
    public function getIdCompra()
    {
        return $this->idcompra;
    }
    
    public function getIdCompraEstadoTipo()
    {
        return $this->idcompraestadotipo;
    }
    
    public function getCeFechaIni()
    {
        return $this->cefechaini;
    }
    
    public function getCeFechaFin()
    {
        return $this->cefechafin;
    }
    
    public function getMensajeOperacion()
    {
        return $this->mensajeoperacion;
    }
    
    // Setters
    public function setIdCompraEstado($idcompraestado)
    {
        $this->idcompraestado = $idcompraestado;
    }

    public function setIdCompra($idcompra)
    {
        $this->idcompra = $idcompra;
    }

    public function setIdCompraEstadoTipo($idcompraestadotipo)
    {
        $this->idcompraestadotipo = $idcompraestadotipo;
    }

    public function setCeFechaIni($cefechaini)
    {
        $this->cefechaini = $cefechaini;
    }

    public function setCeFechaFin($cefechafin)
    {
        $this->cefechafin = $cefechafin;
    }

    public function setMensajeOperacion($msj)
    {
        $this->mensajeoperacion = $msj;
    }
    
    // Metodos
    public function setear($idcompraestado, $idcompra, $idcompraestadotipo, $cefechaini, $cefechafin)
    {
        $this->setIdCompraEstado($idcompraestado);
        $this->setIdCompra($idcompra);
        $this->setIdCompraEstadoTipo($idcompraestadotipo);
        $this->setCeFechaIni($cefechaini);
        $this->setCeFechaFin($cefechafin);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM compraestado WHERE idcompraestado = " . $this->getIdCompraEstado();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();

                    $objCompra = NULL;
                    if ($row['idcompra'] != null) {
                        $objCompra = new Compra();
                        $objCompra->setIdCompra($row['idcompra']);
                        $objCompra->cargar();
                    }
                    $objCompraEstadoTipo = NULL;
                    if ($row['idcompraestadotipo'] != null) {
                        $objCompraEstadoTipo = new compraestadotipo();
                        $objCompraEstadoTipo->setIdCompraEstadoTipo($row['idcompraestadotipo']);
                        $objCompraEstadoTipo->cargar();
                    }

                    $this->setear($row['idcompraestado'], $objCompra, $objCompraEstadoTipo, $row['cefechaini'], $row['cefechafin']);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("CompraEstado->listar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO compraestado (idcompra, idcompraestadotipo, cefechaini, cefechafin) VALUES ('{$this->getIdCompra()->getIdCompra()}','{$this->getIdCompraEstadoTipo()->getIdCompraEstadoTipo()},'{$this->getCeFechaIni()}','{$this->getCeFechaFin()}');";
        if ($base->Iniciar()) {
            if ($base = $base->Ejecutar($sql)) {
                $this->setIdCompraEstado($base);
                $resp = true;
            } else {
                $this->setMensajeOperacion("CompraEstado->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraEstado->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE compraestado SET idcompraestado='{$this->getIdCompraEstado()}', idcompra='{$this->getIdCompra()->getIdCompra()}', idcompraestadotipo='{$this->getIdCompraEstadoTipo()->getIdCompraEstadoTipo()}', cefechaini='{$this->getCeFechaIni()}', cefechafin='{$this->getCeFechaFin()}' WHERE idcompraestado='{$this->getIdCompraEstado()}'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("CompraEstado->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraEstado->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM compraestado WHERE idcompraestado=" . $this->getIdCompraEstado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeOperacion("CompraEstado->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraEstado->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM compraestado ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {
                    $obj = new compraestado();

                    $objCompra = NULL;
                    if ($row['idcompra'] != null) {
                        $objCompra = new Compra();
                        $objCompra->setIdCompra($row['idcompra']);
                        $objCompra->cargar();
                    }
                    $objCompraEstadoTipo = NULL;
                    if ($row['idcompraestadotipo'] != null) {
                        $objCompraEstadoTipo = new compraestadotipo();
                        $objCompraEstadoTipo->setIdCompraEstadoTipo($row['idcompraestadotipo']);
                        $objCompraEstadoTipo->cargar();
                    }

                    $obj->setear($row['idcompraestado'], $objCompra, $objCompraEstadoTipo, $row['cefechaini'], $row['cefechafin']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("CompraEstado->listar: " . $base->getError());
        }

        return $arreglo;
    }
}