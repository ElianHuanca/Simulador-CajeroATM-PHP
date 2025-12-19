<?php
require_once 'OperacionEstrategia.php';
require_once '../cadenaResponsabilidad/ManejadorBillete.php';
require_once '../cadenaResponsabilidad/Cajero.php';
require_once '../cadenaResponsabilidad/DepositoYRetiro.php';

class RetiroEstrategia extends OperacionEstrategia{

    public function ejecutarOperacion(ManejadorBillete $manejador, DepositoYRetiro $operacion, Cajero $cajero): string
    {
        $cantidadOperacion = $operacion->getCantidadOperacion();
        if ($cantidadOperacion > $operacion->getTotalCuenta()) {
            return "Fondos insuficientes en la cuenta para realizar el retiro.\n";
        }
        if($operacion->getCantidadOperacion() > $cajero->getTotalDisponible()){
            return "Fondos insuficientes en el cajero para realizar el retiro.\n";
        }
        $operacion->setTotalCuenta($operacion->getTotalCuenta() - $cantidadOperacion);
        $str = "Retiro realizado: " . $cantidadOperacion . "Bs\n";
        return $str . $manejador->retirar($operacion, $cajero);
    }
}