<?php
require_once('models/BaseModel.php');
class BaseController {

    //render view html
    protected function renderView($viewPath, $data = array(), $title=NULL) {
        $data['title'] = $title;
        include('views/templates/header.php');
        include($viewPath);
        include('views/templates/footer.php');
    }

    //format date
    protected function formatDate($datetime) {
        $timestamp = strtotime($datetime);
        $formattedDateTime = date('F j, Y g:i A', $timestamp);
        return $formattedDateTime;
    }
}

?>
