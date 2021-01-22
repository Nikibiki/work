<?php


namespace app\controllers;


use app\core\App;
use app\core\Controller;
use app\core\Request;
use app\models\User;

class AuthController extends Controller
{

    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register( Request $request )
    {
        $this->setLayout('auth');
        $user = new User();


        if( $request->isPost() )
        {
            $user->load( $request->getBody() );


            if ( $user->validate() && $user->save() ) {
                App::$app->session->setFlash('success', 'Thanks for registering');
                App::$app->response->redirect('/');
                exit;
            }
//            var_dump($registerModel->errors);
//            die;

//            return $this->render('register', []);
        }


        return $this->render('register', [
            'model' => $user
        ]);
    }
}