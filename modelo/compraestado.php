<?php

class compraestado
{
    private $idcompraestado;
    private $objCompra;
    private $objCET;
    private $cefechaini;
    private $cefechafin;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idcompraestado = "";
        $this->objCompra = new compra();
        $this->objCET = new compraestadotipo();
        $this->cefechaini = "";
        $this->cefechafin = "";
        $this->mensajeoperacion = "";
    }

    // Getters
    public function getIdcompraestado()
    {
        return $this->idcompraestado;
    }

    public function getObjCompra()
    {
        return $this->objCompra;
    }

    public function getObjCompraEstadoTipo()
    {
        return $this->objCET;
    }

    public function getCefechaini()
    {
        return $this->cefechaini;
    }

    public function getCefechafin()
    {
        return $this->cefechafin;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeoperacion;
    }

    // Setters
    public function setIdcompraestado($idcompraestado)
    {
        $this->idcompraestado = $idcompraestado;
    }

    public function setObjCompra($objCompra)
    {
        $this->objCompra = $objCompra;
    }

    public function setObjCompraEstadoTipo($objCET)
    {
        $this->objCET = $objCET;
    }

    public function setCefechaini($cefechaini)
    {
        $this->cefechaini = $cefechaini;
    }

    public function setCefechafin($cefechafin)
    {
        $this->cefechafin = $cefechafin;
    }

    public function setMensajeOperacion($msj)
    {
        $this->mensajeoperacion = $msj;
    }

    // Metodos
    public function setear($idcompraestado, $objCompra, $objCompraEstadoTipo, $cefechaini, $cefechafin)
    {
        $this->setIdcompraestado($idcompraestado);
        // print_r($objCompra);
        $this->setObjCompra($objCompra);
        // print_r($objCompraEstadoTipo);
        $this->setObjCompraEstadoTipo($objCompraEstadoTipo);
        $this->setCefechaini($cefechaini);
        $this->setCefechafin($cefechafin);
        // print_r($this->getObjCompraEstadoTipo());
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM compraestado WHERE idcompraestado = " . $this->getIdcompraestado();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();

                    $objCompra = null;
                    if ($row['idcompra'] != null) {
                        $objCompra = new compra();
                        $objCompra->setIdcompra($row['idcompra']);
                        $objCompra->cargar();
                    }
                    $objCompraEstadoTipo = null;
                    if ($row['idcompraestadotipo'] != null) {
                        $objCompraEstadoTipo = new compraestadotipo();
                        $objCompraEstadoTipo->setIdcompraestadotipo($row['idcompraestadotipo']);
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
        $sql = "INSERT INTO compraestado (idcompra, idcompraestadotipo, cefechaini, cefechafin) VALUES ({$this->getObjCompra()->getIdcompra()},{$this->getObjCompraEstadoTipo()->getIdcompraestadotipo()},'{$this->getCefechaini()}','{$this->getCefechafin()}');";
        echo $sql;
        if ($base->Iniciar()) {
            if ($base = $base->Ejecutar($sql)) {
                $this->setIdcompraestado($base);
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
        $sql = "UPDATE compraestado SET idcompra={$this->getObjCompra()->getIdcompra()}, idcompraestadotipo={$this->getObjCompraEstadoTipo()->getIdcompraestadotipo()}, cefechaini='{$this->getCefechaini()}', cefechafin='{$this->getCefechafin()}' WHERE idcompraestado={$this->getIdcompraestado()}";
        echo $sql;
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
        $sql = "DELETE FROM compraestado WHERE idcompraestado=" . $this->getIdcompraestado();
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
                    $objCompra = null;
                    if ($row['idcompra'] != null) {
                        $objCompra = new compra();
                        $objCompra->setIdcompra($row['idcompra']);
                        $objCompra->cargar();
                        // print_r($objCompra);
                    }
                    $objCompraEstadoTipo = null;
                    if ($row['idcompraestadotipo'] != null) {
                        $objCompraEstadoTipo = new compraestadotipo();
                        $objCompraEstadoTipo->setIdcompraestadotipo($row['idcompraestadotipo']);
                        // print_r($objCompraEstadoTipo);
                        $objCompraEstadoTipo->cargar();
                        // print_r($objCompraEstadoTipo);
                    }

                    $obj->setear($row['idcompraestado'], $objCompra, $objCompraEstadoTipo, $row['cefechaini'], $row['cefechafin']);
                    // print_r($obj);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("CompraEstado->listar: " . $base->getError());
        }
        return $arreglo;
    }
}

// class compraestado
// {
//     private $idcompraestado;
//     private $idcompra;
//     private $idcompraestadotipo;
//     private $cefechaini;
//     private $cefechafin;
//     private $mensajeoperacion;

//     public function __construct()
//     {
//         $this->idcompraestado = "";
//         $this->idcompra = new compra();
//         $this->idcompraestadotipo = new compraestado();
//         $this->cefechaini = "";
//         $this->cefechafin = "";
//         $this->mensajeoperacion = "";
//     }

//     // Getters
//     public function getIdcompraestado()
//     {
//         return $this->idcompraestado;
//     }

//     public function getIdcompra()
//     {
//         return $this->idcompra;
//     }

//     public function getIdcompraestadotipo()
//     {
//         return $this->idcompraestadotipo;
//     }

//     public function getCefechaini()
//     {
//         return $this->cefechaini;
//     }

//     public function getCefechafin()
//     {
//         return $this->cefechafin;
//     }

//     public function getmensajeoperacion()
//     {
//         return $this->mensajeoperacion;
//     }

//     // Setters
//     public function setIdcompraestado($idcompraestado)
//     {
//         $this->idcompraestado = $idcompraestado;
//     }

//     public function setIdcompra($idcompra)
//     {
//         $this->idcompra = $idcompra;
//     }

//     public function setIdcompraestadotipo($idcompraestadotipo)
//     {
//         $this->idcompraestadotipo = $idcompraestadotipo;
//     }

//     public function setCefechaini($cefechaini)
//     {
//         $this->cefechaini = $cefechaini;
//     }

//     public function setCefechafin($cefechafin)
//     {
//         $this->cefechafin = $cefechafin;
//     }

//     public function setmensajeoperacion($msj)
//     {
//         $this->mensajeoperacion = $msj;
//     }

//     // Metodos
//     public function setear($idcompraestado, $idcompra, $idcompraestadotipo, $cefechaini, $cefechafin)
//     {
//         $this->setIdcompraestado($idcompraestado);
//         $this->setIdcompra($idcompra);
//         $this->setIdcompraestadotipo($idcompraestadotipo);
//         $this->setCefechaini($cefechaini);
//         $this->setCefechafin($cefechafin);
//     }

//     public function cargar()
//     {
//         $resp = false;
//         $base = new BaseDatos();
//         $sql = "SELECT * FROM compraestado WHERE idcompraestado = " . $this->getIdcompraestado();
//         if ($base->Iniciar()) {
//             $res = $base->Ejecutar($sql);
//             if ($res > -1) {
//                 if ($res > 0) {
//                     $row = $base->Registro();

//                     $objCompra = NULL;
//                     if ($row['idcompra'] != null) {
//                         $objCompra = new Compra();
//                         $objCompra->setIdcompra($row['idcompra']);
//                         $objCompra->cargar();
//                     }
//                     $objCompraEstadoTipo = NULL;
//                     if ($row['idcompraestadotipo'] != null) {
//                         $objCompraEstadoTipo = new compraestadotipo();
//                         $objCompraEstadoTipo->setIdcompraestadotipo($row['idcompraestadotipo']);
//                         $objCompraEstadoTipo->cargar();
//                     }

//                     $this->setear($row['idcompraestado'], $objCompra, $objCompraEstadoTipo, $row['cefechaini'], $row['cefechafin']);
//                     $resp = true;
//                 }
//             }
//         } else {
//             $this->setmensajeoperacion("CompraEstado->listar: " . $base->getError());
//         }
//         return $resp;
//     }

//     public function insertar()
//     {
//         $resp = false;
//         $base = new BaseDatos();
//         $sql = "INSERT INTO compraestado (idcompra, idcompraestadotipo, cefechaini, cefechafin) VALUES ('{$this->getIdcompra()->getIdcompra()}','{$this->getIdcompraestadotipo()->getIdcompraestadotipo()},'{$this->getCefechaini()}','{$this->getCefechafin()}');";
//         if ($base->Iniciar()) {
//             if ($base = $base->Ejecutar($sql)) {
//                 $this->setIdcompraestado($base);
//                 $resp = true;
//             } else {
//                 $this->setmensajeoperacion("CompraEstado->insertar: " . $base->getError());
//             }
//         } else {
//             $this->setmensajeoperacion("CompraEstado->insertar: " . $base->getError());
//         }
//         return $resp;
//     }

//     public function modificar()
//     {
//         $resp = false;
//         $base = new BaseDatos();
//         $sql = "UPDATE compraestado SET idcompraestado='{$this->getIdcompraestado()}', idcompra='{$this->getIdcompra()->getIdcompra()}', idcompraestadotipo='{$this->getIdcompraestadotipo()->getIdcompraestadotipo()}', cefechaini='{$this->getCefechaini()}', cefechafin='{$this->getCefechafin()}' WHERE idcompraestado='{$this->getIdcompraestado()}'";
//         if ($base->Iniciar()) {
//             if ($base->Ejecutar($sql)) {
//                 $resp = true;
//             } else {
//                 $this->setmensajeoperacion("CompraEstado->modificar: " . $base->getError());
//             }
//         } else {
//             $this->setmensajeoperacion("CompraEstado->modificar: " . $base->getError());
//         }
//         return $resp;
//     }

//     public function eliminar()
//     {
//         $resp = false;
//         $base = new BaseDatos();
//         $sql = "DELETE FROM compraestado WHERE idcompraestado=" . $this->getIdcompraestado();
//         if ($base->Iniciar()) {
//             if ($base->Ejecutar($sql)) {
//                 return true;
//             } else {
//                 $this->setmensajeoperacion("CompraEstado->eliminar: " . $base->getError());
//             }
//         } else {
//             $this->setmensajeoperacion("CompraEstado->eliminar: " . $base->getError());
//         }
//         return $resp;
//     }

//     public static function listar($parametro = "")
//     {
//         $arreglo = array();
//         $base = new BaseDatos();
//         $sql = "SELECT * FROM compraestado ";
//         if ($parametro != "") {
//             $sql .= 'WHERE ' . $parametro;
//         }
//         $res = $base->Ejecutar($sql);
//         if ($res > -1) {
//             if ($res > 0) {

//                 while ($row = $base->Registro()) {
//                     $obj = new compraestado();

//                     $objCompra = NULL;
//                     if ($row['idcompra'] != null) {
//                         $objCompra = new compra();
//                         $objCompra->setIdcompra($row['idcompra']);
//                         $objCompra->cargar();
//                     }
//                     $objCompraEstadoTipo = NULL;
//                     if ($row['idcompraestadotipo'] != null) {
//                         $objCompraEstadoTipo = new compraestadotipo();
//                         $objCompraEstadoTipo->setIdcompraestadotipo($row['idcompraestadotipo']);
//                         $objCompraEstadoTipo->cargar();
//                     }

//                     $obj->setear($row['idcompraestado'], $objCompra, $objCompraEstadoTipo, $row['cefechaini'], $row['cefechafin']);
//                     array_push($arreglo, $obj);
//                 }
//             }
//         } else {
//             $this->setmensajeoperacion("CompraEstado->listar: " . $base->getError());
//         }

//         return $arreglo;
//     }
// }
