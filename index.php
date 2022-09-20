<?php

require_once 'Autoloader.php';
require_once 'config/config.php';

use App\Autoloader;
use App\Controller\HomeController;
use App\Exception\RouterException;
use App\Service\Router;

Autoloader::$folderList =
    [
        "App\Entity",
        "App/Controller/",
        "App/Repository/",
        "App/Service/",
        "App/Exception/",
        "App/Form/",
        "App/Validator/",
    ];
AutoLoader::register();

//intégrant le systeme de Router.php qui permet de lancer une méthode
//d'un controlleur en fonction de URL soumis au navigateur

session_start();

try {
    $router = new Router($_GET['url']);

    $router->get('/', function () {
        echo (new HomeController())->invoke();
    });

//    $router->post('/add', function () {
//        echo (new HomeController())->add();
//    });

    $router->run();
} catch (RouterException|Exception $e) {
    die('Error: ' . $e);
}


