<?php

class RoomModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_scape_rooms;charset=utf8', 'root', '');
    }

    /**
     * Obtiene la lista de salas.
     */
    public function getAll($pagination) {
        if ($pagination[0]) {
            $query = $this->db->prepare('SELECT * FROM rooms LIMIT '.$pagination[2].' OFFSET '.($pagination[1]-1)*$pagination[2]);
            $query->execute();
        } else {
            $query = $this->db->prepare('SELECT * FROM rooms');
            $query->execute();
        }
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Obtiene la lista de salas ordenada por un campo de la tabla y un orden (ASC O DESC), a elección.
     */
    public function getAllSorted($orderBy, $order, $pagination) {
        if ($pagination[0]) {
            $query = $this->db->prepare('SELECT * FROM rooms ORDER BY '. $orderBy.' '. $order.' LIMIT '.$pagination[2].' OFFSET '.($pagination[1]-1)*$pagination[2]);
            $query->execute();
        } else {
            $query = $this->db->prepare('SELECT * FROM rooms ORDER BY '. $orderBy.' '. $order);
            $query->execute();
        }
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Obtiene las salas ordenadas por el campo capacidad según el orden pasado como parámetro (ASC o DESC)
     */
    public function getAllSortedByCapacity($order, $pagination) {
        if ($pagination[0]) {
            $query = $this->db->prepare('SELECT * FROM rooms ORDER BY capacity '. $order.' LIMIT '.$pagination[2].' OFFSET '.($pagination[1]-1)*$pagination[2]);
            $query->execute();
        } else {
            $query = $this->db->prepare('SELECT * FROM rooms ORDER BY capacity '. $order);
            $query->execute();
        }
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Obtiene la lista de salas filtrada por un campo a elección de la tabla.
     */
    public function getAllByFilter($filterBy, $value, $pagination) {
        if ($pagination[0]) {
            $query = $this->db->prepare('SELECT * FROM rooms WHERE '. $filterBy.' = '. $value. ' LIMIT '.$pagination[2].' OFFSET '.($pagination[1]-1)*$pagination[2]);
            $query->execute();
        } else {
            $query = $this->db->prepare('SELECT * FROM rooms WHERE '. $filterBy.' = '. $value);
            $query->execute();
        }
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Retorna una sala según el id pasado.
     */
    public function get($idRoom) {
        $query = $this->db->prepare('SELECT * FROM rooms WHERE id = ?');
        $query->execute(array($idRoom));

        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Guarda una sala en la base de datos.
     */
    public function save($name, $description, $capacity, $theme_id, $difficulty, $time, $image) {

        $query = $this->db->prepare('INSERT INTO rooms(name, description, capacity, theme_id, difficulty, time, image) VALUES(?,?,?,?,?,?,?)');
        $query->execute([$name, $description, $capacity, $theme_id, $difficulty, $time, $image]);

        return $this->db->lastInsertId();
    }
 
    /**
     * Elimina una sala de la BBDD según el id pasado.
     */
    function delete($idRoom) {
        $query = $this->db->prepare('DELETE FROM rooms WHERE id = ?');
        $query->execute([$idRoom]); 
    }

    /**
     * Actualiza la sala en la base de datos
     */

    function update($name, $desc, $cap, $id_the, $diff, $time, $img, $id) {
        $query = $this->db->prepare('UPDATE rooms SET name = ?, description = ?, capacity = ?, theme_id = ?, difficulty = ?, time = ?, image = ? WHERE id = ?');
        $query->execute([$name, $desc, $cap, $id_the, $diff, $time, $img, $id]);
    }

}
