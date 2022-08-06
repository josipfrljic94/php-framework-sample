<?php
namespace app\core;
use app\core\Application;



class Controller
{
    public string $layout = "main";

    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }


    // /**
    //  * Get the value of layout
    //  */
    // public function getLayout()
    // {
    //     return $this->layout;
    // }


    public function setLayout($layout)
    {
        $this->layout = $layout;

    }
}