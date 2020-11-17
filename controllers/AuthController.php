<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

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
        $registerModel = new RegisterModel();


        if( $request->isPost() )
        {
            $registerModel->load( $request->getBody() );


            if ( $registerModel->validate() && $registerModel->save() ) {
//                return 'Success';
            }
//            var_dump($registerModel->errors);
//            die;

//            return $this->render('register', []);
        }


        return $this->render('register', [
            'model' => $registerModel
        ]);
    }
}