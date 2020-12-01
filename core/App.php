<?php


namespace app\core;


class App
{
    public Router $router;
    public Request $request;
    public Response $response;
    public Database $db;
    public Controller $controller;

    public static $app;
    public static $ROOT_DIR;


    public function __construct( $rootPath, array $config )
    {
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router( $this->request, $this->response );

        $this->db = new Database( $config['db'] );
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function isGet()
    {
        return $this->request->isGet();
    }

    public function isPost()
    {
        return $this->request->isPost();
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
}