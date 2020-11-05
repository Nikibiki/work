<?php


namespace app\controllers;


use app\core\App;
use app\core\Controller;

class SiteController extends Controller
{
    public function home()
    {
        return $this->render('home', [
            'name' => "Home Page"
        ]);
    }
    public function contact()
    {
        return App::$app->router->renderView('contact');
    }

    public function handleContact(){
        return 'handling submitted data';
    }
}