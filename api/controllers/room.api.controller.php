<?php
require_once("./api/models/room.model.php");
require_once("./api/views/json.view.php");
require_once ("./api/helpers/auth.api.helper.php");

class RoomApiController {

    private $model;
    private $view;
    private $authHelper;

    private $data;

    public function __construct() {
        $this->model = new RoomModel();
        $this->view = new JSONView();
        $this->data = file_get_contents("php://input");
        $this->authHelper = new AuthApiHelper();
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getRooms() {
        $pagination = [false];
        $properties = array('name', 'description', 'capacity', 'theme_id', 'difficulty', 'time', 'image');
        try {
            if (isset($_GET['page']) && isset($_GET['limit'])) {
                if ($_GET['page'] < 1)
                    throw new Exception("La paginación debe ser mayor a 0");
                $pagination[0] = true;
                array_push($pagination, $_GET['page'], $_GET['limit']);
            }
            if (isset($_GET['order'])) {
                $order = $_GET['order'];
                if($order != 'ASC' && $order != 'DESC')
                    throw new Exception("Los valores posibles de order son ASC o DESC");

                if (isset($_GET['orderBy'])) {
                    $orderBy = $_GET['orderBy'];
                    if(!in_array($orderBy, $properties, true))
                        throw new Exception("Los valores posibles de orderBy son: name, description,
                        theme_id, capacity, difficulty, image, time");
                    $rooms = $this->model->getAllSorted($orderBy, $order, $pagination);
                } else {
                    $rooms = $this->model->getAllSortedByCapacity($order, $pagination);
                }
            } else if (isset($_GET['filterBy']) && isset($_GET['value'])) {
                $filterBy = $_GET['filterBy'];
                $value = $_GET['value'];
                if(!in_array($filterBy, $properties, true))
                    throw new Exception("Los valores posibles de filterBy son: name, description, ".
                    "theme_id, capacity, difficulty, image, time");
                if ((is_null($value) || (is_numeric($value) && $value < 1)))
                    throw new Exception("El valor de value debe ser de tipo entero y mayor a cero");

                $rooms = $this->model->getAllByFilter($filterBy, $value, $pagination);
            } else {
                $rooms = $this->model->getAll($pagination);
            }

            if ($rooms) {
                $this->view->response($rooms, 200);
            } else
                $this->view->response("No se han encontrado registros en la base de datos para los parámetros ingresados", 200);
        } catch (Exception $error) {
            $this->view->response("Error: ".$error->getMessage(),400);
        }
    }

    public function getRoom($params = null) {
        $id = $params[':ID'];
        
        $room = $this->model->get($id);        
        if ($room)
            $this->view->response($room, 200);
        else
            $this->view->response("La sala con el id={$id} no existe", 404);
    } 

    public function deleteRoom($params = null) {
        $id = $params[':ID'];
        if(!$this->authHelper->isLoggedIn()) {
            $this->view->response("No estás logeado", 401);
            return;
        }
        $room = $this->model->get($id);
        if ($room) {
            $this->model->delete($id);
            $this->view->response("La sala fue borrada con éxito.", 200);
        } else
            $this->view->response("La sala con el id={$id} no existe", 404);
        
    }

    public function addRoom($params = null) {
        if(!$this->authHelper->isLoggedIn()) {
            $this->view->response("No estás logeado", 401);
            return;
        }
        $data = $this->getData();

        $id = $this->model->save($data->name, $data->description, $data->capacity, $data->theme_id, $data->difficulty, $data->time, $data->image);
        
        $room = $this->model->get($id);
        if ($room)
            $this->view->response($room, 200);
        else
            $this->view->response("Error al crear la sala", 500);

    }

    public function updateRoom($params = null) {
        $id = $params[':ID'];
        if(!$this->authHelper->isLoggedIn()) {
            $this->view->response("No estás logeado", 401);
            return;
        }
        $data = $this->getData();
        
        $room = $this->model->get($id);
        if ($room) {
            $this->model->update($data->name, $data->description, $data->capacity, $data->theme_id, $data->difficulty, $data->time, $data->image, $id);
            $this->view->response("La sala fue modificada con éxito.", 200);
        } else
            $this->view->response("La sala con el id={$id} no existe", 404);
    }
}
