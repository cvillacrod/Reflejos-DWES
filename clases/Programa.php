<?php

class Programa {
    private $tipo;
    private $distancia;
    private $nciclos;
    private $tejercicio;
    private $tdescanso;
    private $entrenador;
    private $descripcion;

    public function __construct($tipo, $distancia, $nciclos, $tejercicio, $tdescanso, $entrenador, $descripcion) {
        $this->tipo = $tipo;
        $this->distancia = $distancia;
        $this->nciclos = $nciclos;
        $this->tejercicio = $tejercicio;
        $this->tdescanso = $tdescanso;
        $this->entrenador = $entrenador;
        $this->descripcion = $descripcion;
    }

    // Getters
    public function getTipo() {
        return $this->tipo;
    }

    public function getDistancia() {
        return $this->distancia;
    }

    public function getNCiclos() {
        return $this->nciclos;
    }

    public function getTEjercicio() {
        return $this->tejercicio;
    }

    public function getTDescanso() {
        return $this->tdescanso;
    }

    public function getEntrenador() {
        return $this->entrenador;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }
}

?>
