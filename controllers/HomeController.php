<?php
require_once('BaseController.php');
//import function from models/TaskModel.php
require_once('models/TaskModel.php');
class HomeController extends BaseController {

    
    //get task lisk
    public function index() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : null;
        $title = isset($_GET['title']) ? $_GET['title'] : null;
        $status = isset($_GET['status']) ? $_GET['status'] : null;
        $limit = 10;

        //get from models/TaskModel.php
        $tasks = new TaskModel();
        $task = $tasks->getTask($page, $limit, $keyword, $title, $status);
        $totalTasks = $tasks->countTask($keyword, $title, $status);
        $totalPages = ceil($totalTasks / $limit);

        // Pass data to the view
        $data = [
            'tasks' => $task,
            'total_pages' => $totalPages,
            'current_page' => $page,
        ];
        // var_dump($data);
        // render view from views
        $this->renderView('views/index.php', $data, 'Task List');
    }

    //form create task
    public function createTask() {
        $this->renderView('views/task/create.php', NULL ,'Create Task');
    }

    //save task
    public function saveTask() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tasks = new TaskModel();
            $result = $tasks->saveTask();
           
            echo $result;
            
        }
    }

    //update task
    public function updateTask() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $title = isset($_POST['title']) ? $_POST['title'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;

            // var_dump($id, $title, $description);
            
            $tasks = new TaskModel();
            $result = $tasks->updateTask($id, $title, $description);
           
            echo $result;
            
        }
    }

    //update status task
    public function updateStatusTask() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $tasks = new TaskModel();
            $result = $tasks->updateStatusTask();
           
            echo $result;
            
        }
    }

    //details task by id
    public function detailsTask(){

        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $tasks = new TaskModel();
        $task = $tasks->getTaskById($id);

        $data = [ 'task' => $task ];

        $this->renderView('views/task/view.php', $data ,'View Task');


    }

    //delete task by id
    public function deleteTask(){

        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $tasks = new TaskModel();
        $delete = $tasks->deleteTaskById($id);

        echo $delete;


    }

}

