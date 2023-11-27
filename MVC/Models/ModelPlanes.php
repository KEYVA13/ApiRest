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
    public function getPlanes($sort_by, $order, $page, $per_page) {
        $limit = $per_page;
        $offset = ($page - 1) * $per_page;
        $datos = $this->conexion->prepare("SELECT * FROM planes ORDER BY $sort_by $order LIMIT :limit OFFSET :offset");
    
        // Vincula los valores de los marcadores de posición
        $datos->bindParam(':limit', $limit, PDO::PARAM_INT);
        $datos->bindParam(':offset', $offset, PDO::PARAM_INT);
        $datos->execute();
        $planes = $datos->fetchAll(PDO::FETCH_OBJ);
        return $planes;
    } 

    // Edita un plan según su ID con nuevos valores
    public function editPlan($id, $plan, $duracion, $precio, $porcentaje) {
        $datos = $this->conexion->prepare('UPDATE planes SET Plan = ?, Duracion = ?, Precio = ?, Porcentaje = ? WHERE ID = ?');
        $datos->execute([$plan, $duracion, $precio, $porcentaje, $id]);

        // Devuelve "true" si la operación se realizó con éxito
        return true;
    }

    public function getPlan($ID) {
        $datos = $this->conexion->prepare('SELECT * FROM planes WHERE ID = ?');
        $datos->execute([$ID]);
        return $datos->fetchAll(PDO::FETCH_OBJ);
    }


    public function FiltrarDatos($filtro,$tipo){
        $datos = $this->conexion->prepare("SELECT * FROM planes WHERE $filtro = ? ");
        $datos->execute([$tipo]);
        return $datos->fetchAll(PDO::FETCH_OBJ);
    }
}