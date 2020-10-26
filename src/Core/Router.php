<?php

namespace App\Core;

use App\Controller\Controller;
use App\Exceptions\NotFoundException;
use App\Network\Request;

class Router
{
    private Controller $controller;
    private ?string $method = null;
    private array $params = [];
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        try {
            $this->__resolve();
        } catch (NotFoundException $e) {
            // build an error handler to show a 404 page or something. but for now:
            http_response_code($e->getCode());
            echo $e->getMessage();
        }
    }

    /**
     * @return void
     * @throws NotFoundException
     */
    private function __resolve(): void
    {
        if ($this->request->url !== Request::ROOT) {
            $url = explode(Request::ROOT, filter_var(rtrim($this->request->url, Request::ROOT), FILTER_SANITIZE_URL));
            $url[0] = '\App\Controller\\' . ucwords($url[0]) . 'Controller';
            if ($this->__setController($url[0])) {
                unset($url[0]);
                if (isset($url[1])) {
                    if ($this->__setMethod($url[1])) {
                        unset($url[1]);
                        $this->__setParams($url);
                    }
                } else {
                    $this->__setMethod('index');
                }
            }
        } else {
            $this->__setController('\App\Controller\\HomeController');
            $this->__setMethod('index');
        }
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Set the controller.
     * @param string $controller
     * @return bool
     * @throws NotFoundException
     */
    private function __setController(string $controller): bool
    {
        if (class_exists($controller)) {
            $this->controller = new $controller;
            return true;
        }
        throw new NotFoundException;
    }

    /**
     * Set the controller method.
     * @param string $method
     * @return bool
     * @throws NotFoundException
     */
    private function __setMethod(string $method): bool
    {
        if (method_exists($this->controller, $method)) {
            $this->method = $method;
            return true;
        }
        throw new NotFoundException;
    }

    /**
     * Set the controller's params.
     * @param array $params
     * @return void
     */
    private function __setParams(array $params): void
    {
        $this->params = !empty($params) ? array_values($params) : [];
    }
}