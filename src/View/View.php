<?php

namespace App\View;

class View
{
    /**
     * Method used to include and render a view + create the view variables
     * send from the controller action.
     * @param string $view
     * @param array $viewVariables
     */
    public function render(string $view, array $viewVariables)
    {
        if (!empty($viewVariables)) {
            foreach ($viewVariables as $key => $value) {
                $$key = $value;
            }
        }
        require_once APP_ROOT . "/src/Templates/header.php";
        require_once APP_ROOT . "/src/Templates/$view.php";
        require_once APP_ROOT . "/src/Templates/footer.php";
    }
}