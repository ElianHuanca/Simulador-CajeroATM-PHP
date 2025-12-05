<?php

require_once '../cadenaResponsabilidad/ManejadorBillete.php';
require_once '../cadenaResponsabilidad/DepositoYRetiro.php';
require_once '../cadenaResponsabilidad/Cajero.php';

abstract class OperacionEstrategia
{
    abstract public function ejecutarOperacion(ManejadorBillete $manejador, DepositoYRetiro $operacion, Cajero $cajero): string;
}