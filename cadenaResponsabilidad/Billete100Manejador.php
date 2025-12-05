<?php 
require_once 'ManejadorBillete.php';
require_once 'DepositoYRetiro.php';
require_once 'Cajero.php';
    
class Billete100Manejador extends ManejadorBillete{

    public function retirar(DepositoYRetiro $retiro,Cajero $cajero): string {
        $imp = "";
        $cantidadRequerida = $retiro->getCantidadRestante();

        $cantBilletes = $cantidadRequerida / 100;
        
        $retorno=$cantBilletes;
        $billetes100=$cajero->getBilletes100();

        if ($cantBilletes > 0 && $billetes100> 0) {
            if($billetes100 > $cantBilletes){
                $retorno=0;
                $cajero->setBilletes100($billetes100-$cantBilletes);
            }else{
                $retorno=$cantBilletes-$billetes100;
                $cajero->setBilletes100(0);
            }
            $imp = "\n" . ($cantBilletes-$retorno) . " billetes de 100 bs";          
        }
        $cantidadPendiente = ($cantidadRequerida % 100) + ($retorno*100);
        if ($cantidadPendiente > 0) {
            $retiro->setCantidadRestante($cantidadPendiente);
            $imp .= $this->siguienteManejador->retirar($retiro,$cajero);
        }
        
        return $imp;
    }

    
    public function depositar(DepositoYRetiro $deposito, Cajero $cajero):string {
        $imp = "";
        $cantRequerida = $deposito->getCantidadRestante();
        $cantBilletes = $cantRequerida / 100;

        if ($cantBilletes > 0) {
            $imp = "\n" . $cantBilletes . " billetes de 100 bs";
            $cajero->setBilletes100($cajero->getBilletes100()+$cantBilletes);
        }

        $cantPendiente = $cantRequerida % 100;

        if ($cantPendiente > 0) {
            $deposito->setCantidadRestante($cantPendiente);
            $imp .= $this->siguienteManejador->depositar($deposito, $cajero);
        }

        return $imp;
    }
    
}