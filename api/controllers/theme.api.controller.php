<?php
require_once("./api/models/theme.model.php");
require_once("./api/views/json.view.php");
require_once ("./api/helpers/auth.api.helper.php");

class ThemeApiController {

    private $model;
    private $view;
    private $authHelper;

    private $data;

    public function __construct() {
        $this->model = new ThemeModel();
        $this->view = new JSONView();
        $this->data = file_get_contents("php://input");
        $this->authHelper = new AuthApiHelper();
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getThemes() {
        $pagination = [false];
        $properties = array('name', 'classification');
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
                        throw new Exception("Los valores posibles de orderBy son: name, classification");
                    $themes = $this->model->getAllSorted($orderBy, $order, $pagination);
                } else {
                    $themes = $this->model->getAllSortedByCapacity($order, $pagination);
                }
            } else if (isset($_GET['filterBy']) && isset($_GET['value'])) {
                $filterBy = $_GET['filterBy'];
                $value = $_GET['value'];
                if(!in_array($filterBy, $properties, true))
                    throw new Exception("Los valores posibles de filterBy son: name, classification");
                if (is_null($value))
                    throw new Exception("El valor de value no puede ser nulo");

                $themes = $this->model->getAllByFilter($filterBy, $value, $pagination);
            } else {
                $themes = $this->model->getAll($pagination);
            }

            if ($themes) {
                $this->view->response($themes, 200);
            } else
                $this->view->response("No se han encontrado registros en la base de datos para los parámetros ingresados", 200);
        } catch (Exception $error) {
            $this->view->response("Error: ".$error->getMessage(),400);
        }
    }

    public function getTheme($params = null) {
        $id = $params[':ID'];
        
        $theme = $this->model->get($id);        
        if ($theme)
            $this->view->response($theme, 200);
        else
            $this->view->response("La temática con el id={$id} no existe", 404);
    } 

    public function deleteTheme($params = null) {
        $id = $params[':ID'];
        if(!$this->authHelper->isLoggedIn()) {
            $this->view->response("No estás logeado", 401);
            return;
        }
        $theme = $this->model->get($id);
        if ($theme) {
            $this->model->delete($id);
            $this->view->response("La temática fue borrada con éxito.", 200);
        } else
            $this->view->response("La temática con el id={$id} no existe", 404);
        
    }

    public function addTheme($params = null) {
        if(!$this->authHelper->isLoggedIn()) {
            $this->view->response("No estás logeado", 401);
            return;
        }
        $data = $this->getData();

        $id = $this->model->save($data->name, $data->classification);
        
        $theme = $this->model->get($id);
        if ($theme)
            $this->view->response($theme, 200);
        else
            $this->view->response("Error al crear la temática", 500);

    }

    public function updateTheme($params = null) {
        $id = $params[':ID'];
        if(!$this->authHelper->isLoggedIn()) {
            $this->view->response("No estás logeado", 401);
            return;
        }
        $data = $this->getData();
        
        $theme = $this->model->get($id);
        if ($theme) {
            $this->model->update($data->name, $data->classification, $id);
            $this->view->response("La temática fue modificada con éxito.", 200);
        } else
            $this->view->response("La temática con el id={$id} no existe", 404);
    }
}
