<?php
require('config/db.php');
require('module/common.php');
require('controllers/APIController.php');

use controller\APIController;

class APP
{
    public function run()
    {
        header('Content-Type: application/json');

        $method = $_SERVER['REQUEST_METHOD'];

        $path = explode('/',trim($_SERVER['PATH_INFO'],'/'));
        require_once("module/$path[0].php");

        $apiController = new APIController();
        echo json_encode(
            $apiController->processRequest($method,$path),
            JSON_UNESCAPED_UNICODE
        );
    }
}

$app = new APP();
$app->run();