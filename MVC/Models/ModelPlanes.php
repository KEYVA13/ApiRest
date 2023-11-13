<?php
require_once './MVC/Models/ModelDB.php';

class ModelPlanes extends ModelDB {
    
    // Agrega un nuevo plan a la base de datos
    public function addPlan($plan, $duracion, $precio, $porcentaje) {
        $datos = $this->conexion->prepare('INSERT INTO planes (Plan, Duracion, Precio, Porcentaje) VALUES (?, ?, ?, ?)');
        $datos->execute([$plan, $duracion, $precio, $porcentaje]);

        // Devuelve "true" si la operación se realizó con éxito
        return $this->conexion->lastInsertId();
    }

    // Elimina un plan según su ID
    public function deletePlan($id) {
        $datos = $this->conexion->prepare('DELETE FROM planes WHERE ID = ?');
        $datos->execute([$id]);

        // Devuelve "true" si la operación se realizó con éxito
        return true;
    }

    // Obtiene información de un plan según su ID
    public function getPlan($id) {
        $datos = $this->conexion->prepare('SELECT * FROM planes WHERE ID = ?');
        $datos->execute([$id]);
        $plan = $datos->fetch(PDO::FETCH_OBJ);
        return $plan;
    }

    // Edita un plan según su ID con nuevos valores
    public function editPlan($id, $plan, $duracion, $precio, $porcentaje) {
        $datos = $this->conexion->prepare('UPDATE planes SET Plan = ?, Duracion = ?, Precio = ?, Porcentaje = ? WHERE ID = ?');
        $datos->execute([$plan, $duracion, $precio, $porcentaje, $id]);

        // Devuelve "true" si la operación se realizó con éxito
        return true;
    }

    public function getPlanes() {
        $datos = $this->conexion->prepare('SELECT * FROM planes');
        $datos->execute();
        return $datos->fetchAll(PDO::FETCH_OBJ);
    }


    public function getPlanesPaginadosYordenados($sort_by, $order, $page, $per_page) {
        // Asegúrate de que $sort_by sea un nombre de columna válido y seguro.
        // Asegúrate de que $order sea "ASC" o "DESC" para la dirección de orden.

        // Calcula el límite y el desplazamiento para la paginación
        $limit = $per_page;
        $offset = ($page - 1) * $per_page;
    
        // Construye la consulta SQL con el nombre de la columna y la dirección de orden, además de la paginación.
        $query = "SELECT * FROM planes ORDER BY $sort_by $order LIMIT $limit OFFSET $offset";
        
        // Prepara y ejecuta la consulta.
        $datos = $this->conexion->prepare($query);
        $datos->execute();
        
        // Obtén los resultados en forma de objetos.
        $resultado = $datos->fetchAll(PDO::FETCH_OBJ);
        
        return $resultado;
    }

    public function FiltrarDatos($filtro,$tipo){
        $datos = $this->conexion->prepare("SELECT * FROM planes WHERE $filtro = ? ");
        $datos->execute([$tipo]);
        return $datos->fetchAll(PDO::FETCH_OBJ);
    }
}