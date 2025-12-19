<?php 
require_once 'ManejadorBillete.php';
require_once 'DepositoYRetiro.php';
require_once 'Cajero.php';

class Billete200Manejador extends ManejadorBillete{

    public function retirar(DepositoYRetiro $retiro,Cajero $cajero): string {
        $imp = "";
        $cantidadRequerida = $retiro->getCantidadOperacion();

        $cantBilletes = intdiv($cantidadRequerida, 200);
        
        $retorno=$cantBilletes;
        $billetes200=$cajero->getBilletes200();

        if ($cantBilletes > 0 && $billetes200> 0) {
            if($billetes200 > $cantBilletes){
                $retorno=0;
                $cajero->setBilletes200($billetes200-$cantBilletes);
            }else{
                $retorno=$cantBilletes-$billetes200;
                $cajero->setBilletes200(0);
            }
            $imp = "\n" . ($cantBilletes-$retorno) . " billetes de 200 bs";          
        }
        $cantidadPendiente = ($cantidadRequerida % 200) + ($retorno*200);
        if ($cantidadPendiente > 0) {
            $retiro->setCantidadRestante($cantidadPendiente);
            $imp .= $this->siguienteManejador->retirar($retiro,$cajero);
        }
        
        return $imp;
    }

    
    public function depositar(DepositoYRetiro $deposito, Cajero $cajero):string {
        $imp = "";
        $cantRequerida = $deposito->getCantidadOperacion();
        $cantBilletes = intdiv($cantRequerida, 200);


        if ($cantBilletes > 0) {
            $imp = "\n" . $cantBilletes . " billetes de 200 bs";
            $cajero->setBilletes200($cajero->getBilletes200()+$cantBilletes);
        }

        $cantPendiente = $cantRequerida % 200;

        if ($cantPendiente > 0) {
            $deposito->setCantidadRestante($cantPendiente);
            $imp .= $this->siguienteManejador->depositar($deposito, $cajero);
        }

        return $imp;
    }
    
}