<?php 
require_once 'ManejadorBillete.php';
require_once 'DepositoYRetiro.php';
require_once 'Cajero.php';

class Billete50Manejador extends ManejadorBillete{

    public function retirar(DepositoYRetiro $retiro,Cajero $cajero): string {
        $imp = "";
        $cantidadRequerida = $retiro->getCantidadRestante();

        $cantBilletes = $cantidadRequerida / 50;
        
        $retorno=$cantBilletes;
        $billetes50=$cajero->getBilletes50();

        if ($cantBilletes > 0 && $billetes50> 0) {
            if($billetes50 > $cantBilletes){
                $retorno=0;
                $cajero->setBilletes50($billetes50-$cantBilletes);
            }else{
                $retorno=$cantBilletes-$billetes50;
                $cajero->setBilletes50(0);
            }
            $imp = "\n" . ($cantBilletes-$retorno) . " billetes de 50 bs";          
        }
        $cantidadPendiente = ($cantidadRequerida % 50) + ($retorno*50);
        if ($cantidadPendiente > 0) {
            $retiro->setCantidadRestante($cantidadPendiente);
            $imp .= $this->siguienteManejador->retirar($retiro,$cajero);
        }
        
        return $imp;
    }

    
    public function depositar(DepositoYRetiro $deposito, Cajero $cajero):string {
        $imp = "";
        $cantRequerida = $deposito->getCantidadRestante();
        $cantBilletes = $cantRequerida / 50;

        if ($cantBilletes > 0) {
            $imp = "\n" . $cantBilletes . " billetes de 50 bs";
            $cajero->setBilletes50($cajero->getBilletes50()+$cantBilletes);
        }

        $cantPendiente = $cantRequerida % 50;

        if ($cantPendiente > 0) {
            $deposito->setCantidadRestante($cantPendiente);
            $imp .= $this->siguienteManejador->depositar($deposito, $cajero);
        }

        return $imp;
    }
    
}