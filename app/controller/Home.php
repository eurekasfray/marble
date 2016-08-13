<?php

use Marble\View;
use Marble\Response;

class Home
{
    public function index()
    {
        $html = new View('Welcome');
        $response = new Response($html);
        return $response;
    }
}
