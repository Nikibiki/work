<?php


namespace app\core;


class Controller
{
    public $layout = 'main';

    public function render( $view, $params = [] )
    {
        return App::$app->router->renderView( $view, $params );
    }

    public function setLayout( $layoutName )
    {
        $this->layout = $layoutName;
    }
}