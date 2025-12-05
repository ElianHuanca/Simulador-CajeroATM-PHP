<?php
require_once '../observador/Notificador.php';
require_once 'OperacionEstrategia.php';
require_once '../cadenaResponsabilidad/ManejadorBillete.php';
require_once '../cadenaResponsabilidad/DepositoYRetiro.php';

class Context implements Notificador
{
    /** @var Observador[] */
    private array $observadores;

    private OperacionEstrategia $operacion;

    public function __construct(OperacionEstrategia $operacion)
    {
        $this->observadores = [];
        $this->operacion = $operacion;
    }

    public function setEstrategia(OperacionEstrategia $operacion): void
    {
        $this->operacion = $operacion;
        $this->notificarObservadores();
    }

    public function realizarOperacion(ManejadorBillete $manejador, DepositoYRetiro $operacion, Cajero $cajero): string
    {
        return $this->operacion->ejecutarOperacion($manejador, $operacion, $cajero);
    }

    // -------------------------
    // IMPLEMENTACIÓN OBSERVER
    // -------------------------

    public function notificarObservadores(): void
    {
        foreach ($this->observadores as $o) {
            $o->actualizar();
        }
    }

    public function agregarObservador(Observador $o): void
    {
        $this->observadores[] = $o;
    }

    public function eliminarObservador(Observador $o): void
    {
        // quitarlo del array
        $this->observadores = array_filter(
            $this->observadores,
            fn ($obs) => $obs !== $o
        );
    }
}
