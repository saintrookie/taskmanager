<?php
require_once('BaseModel.php');

class TaskModel extends BaseModel {

    public function getTask($page = 1, $limit = 10, $keyword = null, $title = null, $status = null) {
        $offset = ($page - 1) * $limit;

        $query = "SELECT * FROM tasks WHERE 1 = 1";

        if ($title) {
            $query .= " AND title LIKE '%$title%'";
        }
        if ($status) {
            $query .= " AND status = '$status'";
        }

        $query .= " ORDER BY created_at DESC LIMIT $limit OFFSET $offset";

        //function from baseModel.php
        $result = $this->query($query);
        
        if ($result) {
            return $this->fetchAll($result);
        } else {
            return null;
        }
    }

    public function countTask($keyword = null, $title = null, $status = null) {
        $query = "SELECT COUNT(*) as total FROM tasks WHERE 1 = 1";
    
        if ($title) {
            $query .= " AND title LIKE '%$title%'";
        }
        
        if ($status) {
            $query .= " AND status = '$status'";
        }
        
        //function from baseModel.php
        $result = $this->query($query);

        $row = $this->fetch($result);
    
        return $row['total'];
    }
    
 
    public function saveTask(){

        header('Content-Type: application/json; charset=utf-8');

        $title = isset($_POST['title']) ? $_POST['title'] : null;

        $description = strip_tags(isset($_POST['description']) ? $_POST['description'] : null);
        
        $currentDateTime = date("Y-m-d H:i:s");

        //validation
        if(empty($title) || empty($description)) {
            echo json_encode(array('status' => 'error', 'message' => 'Title and description are required'));
            exit;
        }
    
        $query = "INSERT INTO tasks (title, description, status, created_at, updated_at) 
          VALUES ('$title', '$description', 'Pending', '$currentDateTime', '$currentDateTime')";

        //function from baseModel.php
        $result = $this->query($query);
        
        if ($result) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to insert task'));
        }
    }

    public function updateStatusTask(){

        header('Content-Type: application/json; charset=utf-8');

        $status = isset($_POST['status']) ? $_POST['status'] : null;

        $currentDateTime = date("Y-m-d H:i:s");
    
        $query = "UPDATE tasks SET status = '$status', updated_at = '$currentDateTime' WHERE id = " . $_POST['id'];

        //function from baseModel.php
        $result = $this->query($query);
        
        if ($result) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to update task'));
        }
    }

    public function updateTask($id, $title, $description) {

        header('Content-Type: application/json; charset=utf-8');
       
        $currentDateTime = date("Y-m-d H:i:s");
    
        $query = "UPDATE tasks SET title = '$title', description = '$description', updated_at = '$currentDateTime' WHERE id = " . $id;
        
        //function from baseModel.php
        $result = $this->query($query);
        
        if ($result) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to update task'));
        }
    }

    public function getTaskById($id){

        $query = "SELECT * FROM tasks WHERE id = $id";
        
        //function from baseModel.php
        $result = $this->query($query);
        
        if ($result) {
            return $this->fetch($result);
        } else {
            return null;
        }
    }

    public function deleteTaskById($id){

        header('Content-Type: application/json; charset=utf-8');

        $query = "DELETE FROM tasks WHERE id = $id";

        $result = $this->query($query);
        
        if ($result) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to delete task'));
        }
    }

}