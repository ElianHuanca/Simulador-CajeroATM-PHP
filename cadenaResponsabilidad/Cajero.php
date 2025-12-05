<?php

class Cajero
{
 
    private int $billetes_200;
    private int $billetes_100;
    private int $billetes_50;
    private int $billetes_20;
    private int $billetes_10;
    
    public function __construct(
        int $billetes_200 = 0,
        int $billetes_100 = 0,
        int $billetes_50 = 0,
        int $billetes_20 = 0,
        int $billetes_10 = 0
    ) {
        $this->billetes_200 = $billetes_200;
        $this->billetes_100 = $billetes_100;
        $this->billetes_50 = $billetes_50;
        $this->billetes_20 = $billetes_20;
        $this->billetes_10 = $billetes_10;
    }

    public function getBilletes200(): int
    {
        return $this->billetes_200;
    }

    public function setBilletes200(int $cantidad): void
    {
        $this->billetes_200 = $cantidad;
    }

    public function getBilletes100(): int
    {
        return $this->billetes_100;
    }

    public function setBilletes100(int $cantidad): void
    {
        $this->billetes_100 = $cantidad;
    }

    public function getBilletes50(): int
    {
        return $this->billetes_50;
    }

    public function setBilletes50(int $cantidad): void
    {
        $this->billetes_50 = $cantidad;
    }

    public function getBilletes20(): int
    {
        return $this->billetes_20;
    }

    public function setBilletes20(int $cantidad): void
    {
        $this->billetes_20 = $cantidad;
    }

    public function getBilletes10(): int
    {
        return $this->billetes_10;
    }

    public function setBilletes10(int $cantidad): void
    {
        $this->billetes_10 = $cantidad;
    }

    public function getTotalDisponible(): int
    {
        return ($this->billetes_200 * 200) +
               ($this->billetes_100 * 100) +
               ($this->billetes_50 * 50) +
               ($this->billetes_20 * 20) +
               ($this->billetes_10 * 10);
    }
}