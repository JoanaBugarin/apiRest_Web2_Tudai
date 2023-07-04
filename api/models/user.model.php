<?php

class UserModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_scape_rooms;charset=utf8', 'root', '');
    }

    /**
     * Retorna una sala según el id pasado.
     */
    public function getByUsername($username) {
        $query = $this->db->prepare('SELECT * FROM users WHERE username = ?');
        $query->execute(array($username));

        return $query->fetch(PDO::FETCH_OBJ);
    }
}