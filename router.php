<?php
//base model
require_once('models/BaseModel.php');
//base controllers
require_once('controllers/BaseController.php');
//home controller
require_once('controllers/HomeController.php');

class Router {
    public function route($url) {
        $urlParts = parse_url($url);
        $path = $urlParts['path'];
        $query = isset($urlParts['query']) ? $urlParts['query'] : '';
        $baseModel = new BaseModel();
        switch ($path) {

            case "/":
            case "/taskmanager/":
            case "/taskmanager/index.php":
                $homeController = new HomeController();
                $homeController->index();
                break;
            
            case "/taskmanager/index.php/create":
                $homeController = new HomeController();
                $homeController->createTask();
                break;

            case "/taskmanager/index.php/save":
                $homeController = new HomeController();
                $homeController->saveTask();
                break;

            case "/taskmanager/index.php/view":
                $homeController = new HomeController();
                $homeController->detailsTask();
                break;

            case "/taskmanager/index.php/update":
                $homeController = new HomeController();
                $homeController->updateTask();
                break;

            case "/taskmanager/index.php/updateStatus":
                $homeController = new HomeController();
                $homeController->updateStatusTask();
                break;

            case "/taskmanager/index.php/deleteTask":
                $homeController = new HomeController();
                $homeController->deleteTask();
                break;
           
            default:
                http_response_code(404);
                echo 'Not Found';
                break;
        }

        parse_str($query, $params);

        if (isset($params['sub'])) {
            $subParam = $params['sub'];
            // Do something with $subParam
        }
    }
}