<?php

namespace App\Interfaces\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/{reactRouting}", name="index", defaults={"reactRouting": null})
     */
    public function home(): Response
    {
        return $this->render('home/home.html.twig');
    }
}
