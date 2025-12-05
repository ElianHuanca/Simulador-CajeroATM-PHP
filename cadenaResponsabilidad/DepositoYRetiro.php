<?php

class DepositoYRetiro
{
    private $cantidadOperacion;
    private $totalCuenta;
    private $cantidadRestante;

    public function __construct(int $totalC, int $cantidadReq) {
        $this->totalCuenta = $totalC;
        $this->cantidadOperacion = $cantidadReq;
    }

    public function getCantidadOperacion(): int {
        return $this->cantidadOperacion;
    }

    public function getTotalCuenta(): int {
        return $this->totalCuenta;
    }

    public function getCantidadRestante(): int {
        return $this->cantidadRestante;
    }

    public function setCantidadRestante(int $nuevaCantidadRestante): void {
        $this->cantidadRestante = $nuevaCantidadRestante;
    }
    
    public function setTotalCuenta(int $totalCuenta): void {
        $this->totalCuenta = $totalCuenta;
    }
}