<?php 
require_once 'ManejadorBillete.php';
require_once 'DepositoYRetiro.php';
require_once 'Cajero.php';

class Billete20Manejador extends ManejadorBillete{

    public function retirar(DepositoYRetiro $retiro,Cajero $cajero): string {
        $imp = "";
        $cantidadRequerida = $retiro->getCantidadRestante();

        $cantBilletes = intdiv($cantidadRequerida, 20);
        
        $retorno=$cantBilletes;
        $billetes20=$cajero->getBilletes20();

        if ($cantBilletes > 0 && $billetes20> 0) {
            if($billetes20 > $cantBilletes){
                $retorno=0;
                $cajero->setBilletes20($billetes20-$cantBilletes);
            }else{
                $retorno=$cantBilletes-$billetes20;
                $cajero->setBilletes20(0);
            }
            $imp = "\n" . ($cantBilletes-$retorno) . " billetes de 20 bs";          
        }
        $cantidadPendiente = ($cantidadRequerida % 20) + ($retorno*20);
        if ($cantidadPendiente > 0) {
            $retiro->setCantidadRestante($cantidadPendiente);
            $imp .= $this->siguienteManejador->retirar($retiro,$cajero);
        }
        
        return $imp;
    }

    
    public function depositar(DepositoYRetiro $deposito, Cajero $cajero):string {
        $imp = "";
        $cantRequerida = $deposito->getCantidadRestante();
        $cantBilletes = intdiv($cantRequerida, 20);

        if ($cantBilletes > 0) {
            $imp = "\n" . $cantBilletes . " billetes de 20 bs";
            $cajero->setBilletes20($cajero->getBilletes20()+$cantBilletes);
        }

        $cantPendiente = $cantRequerida % 20;

        if ($cantPendiente > 0) {
            $deposito->setCantidadRestante($cantPendiente);
            $imp .= $this->siguienteManejador->depositar($deposito, $cajero);
        }

        return $imp;
    }
    
}