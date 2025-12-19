<?php
require_once 'OperacionEstrategia.php';
require_once '../cadenaResponsabilidad/ManejadorBillete.php';
require_once '../cadenaResponsabilidad/Cajero.php';
require_once '../cadenaResponsabilidad/DepositoYRetiro.php';

class DepositoEstrategia extends OperacionEstrategia
{
    public function ejecutarOperacion(ManejadorBillete $manejador, DepositoYRetiro $operacion, Cajero $cajero): string
    {
        $cantidadOperacion = $operacion->getCantidadOperacion();
        $operacion->setTotalCuenta($operacion->getTotalCuenta() + $cantidadOperacion);
        $str = "Depósito realizado: " . $cantidadOperacion . "Bs\n";
        return $str . $manejador->depositar($operacion, $cajero);
    }
}
