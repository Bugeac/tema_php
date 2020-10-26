<?php

namespace App\Controller;

use App\Network\Request;
use App\View\View;

abstract class Controller
{

    protected Request $request;
    protected View $View;

    public function __construct()
    {
        $this->request = new Request;
        $this->View = new View;
    }

    /**
     * @param string $view
     * @param array $viewVariables
     */
    protected function render(string $view, array $viewVariables)
    {
        $this->View->render($view, $viewVariables);
    }

    /**
     * @param string $location
     */
    protected function redirect(string $location)
    {
        header("Location: {$location}");
    }
}