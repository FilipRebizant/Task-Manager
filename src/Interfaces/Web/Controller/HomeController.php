<?php

namespace App\Interfaces\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @return Response
     */
    public function home(): Response
    {
//        return $this->
        return new Response('ok', 200);
    }
}
