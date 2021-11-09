<?php

class CompraItem
{
    private $idcompraitem;
    private $idproducto;
    private $idcompra;
    private $cicantidad;
    private $mensajeoperacion;


    public function __construct()
    {
        $this->idcompraitem = "";
        $this->idproducto = new producto();
        $this->idcompra = new compra();
        $this->cicantidad = "";
        $this->mensajeoperacion = "";
    }
    
    // Setters
    public function getIdCompraItem()
    {
        return $this->idcompraitem;
    }
    
    public function getIdProducto()
    {
        return $this->idproducto;
    }
    
    public function getIdCompra()
    {
        return $this->idcompra;
    }

    public function getCiCantidad()
    {
        return $this->cicantidad;
    }
    
    public function getMensajeOperacion()
    {
        return $this->mensajeoperacion;
    }
    
    // Setters
    public function setIdCompraItem($idcompraitem)
    {
        $this->idcompraitem = $idcompraitem;
    }

    public function setIdProducto($idproducto)
    {
        $this->idproducto = $idproducto;
    }

    public function setIdCompra($idcompra)
    {
        $this->idcompra = $idcompra;
    }

    public function setCiCantidad($cicantidad)
    {
        $this->cicantidad = $cicantidad;
    }

    public function setMensajeOperacion($msj)
    {
        $this->mensajeoperacion = $msj;
    }
    
    // Metodos
    public function setear($idcompraitem, $idproducto, $idcompra, $cicantidad)
    {
        $this->setIdCompraItem($idcompraitem);
        $this->setIdProducto($idproducto);
        $this->setIdCompra($idcompra);
        $this->setCiCantidad($cicantidad);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM compraitem WHERE idcompraitem = " . $this->getIdCompraItem();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();

                    $objProducto = NULL;
                    if ($row['idproducto'] != null) {
                        $objProducto = new producto();
                        $objProducto->setIdProducto($row['idproducto']);
                        $objProducto->cargar();
                    }
                    $objCompra = NULL;
                    if ($row['idcompra'] != null) {
                        $objCompra = new compra();
                        $objCompra->setIdCompra($row['idcompra']);
                        $objCompra->cargar();
                    }

                    $this->setear($row['idcompraitem'], $objProducto, $objCompra, $row['cicantidad']);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("CompraItem->listar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO compraitem (idproducto, idcompra, cicantidad) VALUES ('{$this->getIdProducto()->getIdProducto()}','{$this->getIdCompra()->getIdCompra()}','{$this->getCiCantidad()}');";
        if ($base->Iniciar()) {
            if ($base = $base->Ejecutar($sql)) {
                $this->setIdCompraItem($base);
                $resp = true;
            } else {
                $this->setMensajeOperacion("CompraItem->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraItem->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE compraitem SET idcompraitem='{$this->getIdCompraItem()}', idproducto='{$this->getIdProducto()->getIdProducto()}', idcompra='{$this->getIdCompra()->getIdCompra()}', cicantidad='{$this->getCiCantidad()}' WHERE idcompraitem='{$this->getIdCompraItem()}'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("CompraItem->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraItem->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM compraitem WHERE idcompraitem=" . $this->getIdCompraItem();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeOperacion("CompraItem->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraItem->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM compraitem ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {
                    $obj = new CompraItem();

                    $objProducto = NULL;
                    if ($row['idproducto'] != null) {
                        $objProducto = new producto();
                        $objProducto->setIdProducto($row['idproducto']);
                        $objProducto->cargar();
                    }
                    $objCompra = NULL;
                    if ($row['idcompra'] != null) {
                        $objCompra = new compra();
                        $objCompra->setIdCompra($row['idcompra']);
                        $objCompra->cargar();
                    }

                    $obj->setear($row['idcompraitem'], $objProducto, $objCompra, $row['cicantidad']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("CompraItem->listar: " . $base->getError());
        }

        return $arreglo;
    }
}