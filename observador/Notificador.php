<?php

interface Notificador {
    public function agregarObservador(Observador $observador): void;
    public function eliminarObservador(Observador $observador): void;
    public function notificarObservadores(): void;
}