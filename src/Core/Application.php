<?php

namespace App\Core;

use App\Network\Request;

class Application
{

    public Request $request;
    public Router $router;

    public function __construct()
    {
        $this->request = new Request;
        $this->router = new Router($this->request);
    }
}