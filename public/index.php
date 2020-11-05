<?php
require_once __DIR__ . '/../vendor/autoload.php';
// 1:13:00
use app\core\App;
use app\controllers\SiteController;



$app = new App( dirname(__DIR__) );


$app->router->get('/', [ SiteController::class, 'home' ]);
$app->router->get('/contact', [ SiteController::class, 'contact' ] );
$app->router->post('/contact', [ SiteController::class, 'handleContact' ] );

$app->run();