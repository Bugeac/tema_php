<?php

namespace App\Network;

class Request
{

    public const ROOT = '/';
    public const POST = 'POST';
    public const GET = 'GET';
    public string $url;
    public ?array $data;

    public function __construct()
    {
        $this->__setData();
        $this->__parseUrl();
    }

    /**
     * Check the request type.
     * @param string $type The given request type.
     * @return bool Returns true if a matching request type is found, false otherwise.
     */
    public function is(string $type): bool
    {
        $type = strtoupper($type);
        switch ($type) {
            case self::POST: {
                return $_SERVER['REQUEST_METHOD'] === self::POST;
            }
            case self::GET: {
                return $_SERVER['REQUEST_METHOD'] === self::GET;
            }
            default : {
                return false;
            }
        }
    }

    /**
     * Parsing all the data that is being sent as JSON. `json_decode` turns our JSON-object
     * into a PHP Associative array.
     * If $data === null, $data falls back whatever is in $_GET or $_POST.
     * @return void
     */
    public function __setData(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if ($data === null) {
            if ($this->is('GET')) {
                $data = $_GET;
            }
            if ($this->is('POST')) {
                $data = $_POST;
            }
        }
        $this->data = $data;
    }

    /**
     * Method used to parse the url.
     * @return void
     */
    private function __parseUrl(): void
    {
        $url = $_SERVER['REQUEST_URI'] ?? self::ROOT;
        if ($url !== self::ROOT) {
            $url = ltrim($url, $url[0]);
            $position = strpos($url, '?');
            if ($position !== false) {
                $url = substr($url, 0, $position);
            }
        }
        $this->url = $url;
    }
}