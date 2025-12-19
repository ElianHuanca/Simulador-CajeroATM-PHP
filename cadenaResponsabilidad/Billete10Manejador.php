<?php
require_once 'ManejadorBillete.php';
require_once 'DepositoYRetiro.php';
require_once 'Cajero.php';

class Billete10Manejador extends ManejadorBillete
{

    public function retirar(DepositoYRetiro $retiro, Cajero $cajero): string
    {
        $imp = "";
        $cantidadRequerida = $retiro->getCantidadRestante();

        $cantBilletes = intdiv($cantidadRequerida, 10);        
        $billetes10 = $cajero->getBilletes10();

        if ($cantBilletes > 0) {
            $imp = "\n" . $cantBilletes . " billetes de 10 Bs";
            $cajero->setBilletes10($billetes10 - $cantBilletes);
        }

        return $imp;
    }

    public function depositar(DepositoYRetiro $deposito, Cajero $cajero): string
    {
        $imp = "";
        $cantRequerida = $deposito->getCantidadRestante();
        $cantBilletes = intdiv($cantRequerida, 10);

        if ($cantBilletes > 0) {
            $imp = "\n" . $cantBilletes . " billetes de 10 Bs";
            $cajero->setBilletes10($cajero->getBilletes10() + $cantBilletes);
        }

        return $imp;
    }
}
