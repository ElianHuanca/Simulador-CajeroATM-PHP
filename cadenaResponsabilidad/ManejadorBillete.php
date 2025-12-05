<?php
require_once 'DepositoYRetiro.php';
require_once 'Cajero.php';

abstract class ManejadorBillete
{
    protected ?ManejadorBillete $siguienteManejador;

    public function establecerSiguiente(ManejadorBillete $manejador): void {
        $this->siguienteManejador = $manejador;           
    }

    abstract public function retirar(DepositoYRetiro $retiro, Cajero $cajero): String;
    abstract public function depositar(DepositoYRetiro $deposito, Cajero $cajero): String;
}