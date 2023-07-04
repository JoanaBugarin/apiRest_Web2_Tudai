<?php

class ThemeModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_scape_rooms;charset=utf8', 'root', '');
    }

    /**
     * Obtiene la lista de temáticas.
     */
    public function getAll($pagination) {
        if ($pagination[0]) {
            $query = $this->db->prepare('SELECT * FROM themes LIMIT '.$pagination[2].' OFFSET '.($pagination[1]-1)*$pagination[2]);
            $query->execute();
        } else {
            $query = $this->db->prepare('SELECT * FROM themes');
            $query->execute();
        }
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Obtiene la lista de temáticas ordenada por un campo de la tabla y un orden (ASC O DESC), a elección.
     */
    public function getAllSorted($orderBy, $order, $pagination) {
        if ($pagination[0]) {
            $query = $this->db->prepare('SELECT * FROM themes ORDER BY '. $orderBy.' '. $order.' LIMIT '.$pagination[2].' OFFSET '.($pagination[1]-1)*$pagination[2]);
            $query->execute();
        } else {
            $query = $this->db->prepare('SELECT * FROM themes ORDER BY '. $orderBy.' '. $order);
            $query->execute();
        }
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Obtiene las temáticas ordenadas por el campo classification según el orden pasado como parámetro (ASC o DESC)
     */
    public function getAllSortedByCapacity($order, $pagination) {
        if ($pagination[0]) {
            $query = $this->db->prepare('SELECT * FROM themes ORDER BY classification '. $order.' LIMIT '.$pagination[2].' OFFSET '.($pagination[1]-1)*$pagination[2]);
            $query->execute();
        } else {
            $query = $this->db->prepare('SELECT * FROM themes ORDER BY classification '. $order);
            $query->execute();
        }
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Obtiene la lista de temáticas filtrada por un campo a elección de la tabla.
     */
    public function getAllByFilter($filterBy, $value, $pagination) {
        if ($pagination[0]) {
            $query = $this->db->prepare('SELECT * FROM themes WHERE '. $filterBy.' = '. $value. ' LIMIT '.$pagination[2].' OFFSET '.($pagination[1]-1)*$pagination[2]);
            $query->execute();
        } else {
            $query = $this->db->prepare('SELECT * FROM themes WHERE '. $filterBy.' = '.'"'.$value.'"');
            $query->execute();
        }
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Retorna una temática según el id pasado.
     */
    public function get($idTheme) {
        $query = $this->db->prepare('SELECT * FROM themes WHERE id = ?');
        $query->execute(array($idTheme));

        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Guarda una temática en la base de datos.
     */
    public function save($name, $classification) {

        $query = $this->db->prepare('INSERT INTO themes(name, classification) VALUES(?,?)');
        $query->execute([$name, $classification]);

        return $this->db->lastInsertId();
    }
 
    /**
     * Elimina una temática de la BBDD según el id pasado.
     */
    function delete($idTheme) {
        $query = $this->db->prepare('DELETE FROM themes WHERE id = ?');
        $query->execute([$idTheme]); 
    }

    /**
     * Actualiza la temática en la base de datos
     */

    function update($name, $classification, $id) {
        $query = $this->db->prepare('UPDATE themes SET name = ?, classification = ? WHERE id = ?');
        $query->execute([$name, $classification, $id]);
    }

}
