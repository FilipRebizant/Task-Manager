<?php

namespace App\Interfaces\Web\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function home ()
    {
        return new Response('Home', 200);
    }
}
