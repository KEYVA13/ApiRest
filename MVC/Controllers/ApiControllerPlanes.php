<?php

 require_once './MVC/controllers/ApiController.php';
 require_once './MVC/models/ModelPlanes.php';

class PlanesApiController extends ApiController{
    private $model;

    function __construct(){
        $this->model = new ModelPlanes();
        parent::__construct();
    }

    public function deletePlan($params = []){
        $existePlan = $this->model->getPlan($params[':ID']);
        if(!empty($existePlan)){
            $this->model->deletePlan($params[':ID']);
            $this->view->response('El jugador con el id= '. $params[':ID'] . ' ha sido eliminado', 200);
        } else {
            $this->view->response('El jugador con el id= '. $params[':ID'] . ' no ha sido eliminado', 404);
        }
    }

    public function updatePlan($params = []){

        $idPlan = $params[':ID'];
        $existePlan = $this->model->getPlan($idPlan);

        if($existePlan){
            $body = $this->getData();
            $plan = $body->plan;
            $duracion = $body->duracion;
            $precio = $body->precio;
            $porcentaje = $body->porcentaje;
            $this->model->editPlan($idPlan, $plan, $duracion, $precio, $porcentaje);
            $this->view->response(['El plan con el id ' .$params[':ID'].' a sido modificado con exito'],200);
        }else{
            $this->view->response(['El plan con el id ' .$params[':ID'].' no existe'],404);
        }
    }

    public function addPlan(){
    
        $body = $this->getData();

        $plan = $body->Plan;
        $duracion = $body->Duracion;
        $precio = $body->Precio;
        $porcentaje = $body->Porcentaje;

        $id = $this->model->addPlan($plan,$duracion,$precio,$porcentaje);
        $this->view->response(['El plan e agrego con exito con el id = '.$id],201);
    }

    public function editPlan($params = []){
        
        $idPlan = $params[':ID'];
        $existePlan = $this->model->getPlan($idPlan);
        if(!empty($existePlan)){
            $body = $this->getData();
            $plan = $body->Plan;
            $duracion = $body->Duracion;
            $precio = $body->Precio;
            $porcentaje = $body->Porcentaje;
            $planEdit = $this->model->editPlan($idPlan,$plan,$duracion,$precio,$porcentaje);
            $this->view->response(['El plan con el id = '.$idPlan.'se modifico con exito'],200);
        }else{
            $this->view->response(['El plan con el id = '.$idPlan.'no existe'],404);
        }
    }

    public function get($params = []) {
        if (empty($params)) {
                $planes = $this->model->getPlanes();
                return $this->view->response($planes, 200);
        } else {
            $plan = $this->model->getPlan($params[':ID']);
            if (!empty($plan)) {
                return $this->view->response($plan, 200);
            } else {
                return $this->view->response(['No existe El Plan con id = ' . $params[':ID']], 404);
            }
        }
    }

    public function getPaginadoYOrdenado() {
            // Verifica si se solicita paginación
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Página actual
            $per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 10; // Elementos por página
            $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'ID';
            $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
    
            if($order == 'ASC' || $order == 'DESC' && $sort_by == 'ID' ||$sort_by == 'Precio' ||$sort_by == 'Plan' ||$sort_by == 'Duracion' || $sort_by == 'Porcentaje'){
                $planes = $this->model->getPlanesPaginadosYOrdenados($sort_by, $order, $page, $per_page);
                return $this->view->response($planes, 200);
            }else{
                return $this->view->response(['no existe el orden o la columna'], 404);
            }
    }

    public function FiltrarPlanes(){
        
        $filtro = $_GET['filtro'];
        $tipo = $_GET['tipo'];

        if($filtro == 'ID' || $filtro == 'Plan' || $filtro == 'Duracion' || $filtro == 'Precio' || $filtro == 'Porcentaje'){
         $datos = $this->model->FiltrarDatos($filtro,$tipo);
         $this->view->response($datos,200);
        }else{
            $this->view->response(['el filtro q ingresas te no existe'],404);
        }
    }
}