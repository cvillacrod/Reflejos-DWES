<?php

class Entrenador {
    private $id;
    private $email;

    public function __construct($id, $email) {
        $this->id = $id;
        $this->email = $email;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }
}

?>
