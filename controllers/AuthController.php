<?php
namespace app\controllers;

use app\core\Controller;
use app\models\RegisterModel;


class AuthController extends Controller
{
    public function login()
    {
        return $this->render("login");
    }



    public function register($request)
    {
        $registerModel = new RegisterModel();
        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());
            if ($registerModel->validate() && $registerModel->register()) {
                // return $registerModel->showFormItems();
            }

          
        }
        $this->setLayout("auth");
        return $this->render('register', ["model" => $registerModel]);
    }
}