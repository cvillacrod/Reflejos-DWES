<?php
    
class Deportista {
  
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $fechaNacimiento;
    private $club;
    private $deporte;
    private $entrenadorEmail;

    public function __construct($nombre, $apellido1, $apellido2, $fechaNacimiento, $club, $deporte, $entrenadorEmail) {
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->club = $club;
        $this->deporte = $deporte;
        $this->entrenadorEmail = $entrenadorEmail;
    }

    // Setters
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;
    }

    public function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;
    }

    public function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function setClub($club) {
        $this->club = $club;
    }

    public function setDeporte($deporte) {
        $this->deporte = $deporte;
    }

    public function setEntrenadorEmail($entrenadorEmail) {
        $this->entrenadorEmail = $entrenadorEmail;
    }

    // Getters
    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido1() {
        return $this->apellido1;
    }

    public function getApellido2() {
        return $this->apellido2;
    }

    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    public function getClub() {
        return $this->club;
    }

    public function getDeporte() {
        return $this->deporte;
    }

    public function getEntrenadorEmail() {
        return $this->entrenadorEmail;
    }

    
    
}
?>
