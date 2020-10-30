<?php


namespace app\core;


class App
{
//    public Router $router;
    public  $router;
    public  $request;
    public $response;
    public static $app;
    public static $ROOT_DIR;


    public function __construct( $rootPath )
    {
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router( $this->request, $this->response );
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}