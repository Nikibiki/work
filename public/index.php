<?php
require_once __DIR__ . '/../vendor/autoload.php';

use app\core\App;
use app\controllers\SiteController;



$app = new App( dirname(__DIR__) );

$app->router->get('/', 'home');

$app->router->get('/contact', 'contact');
$app->router->post('/contact', [ SiteController::class, 'handleContact' ] );

$app->run();