<?php

namespace App\Interfaces\Web\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController
{
    /**
     * @return JsonResponse
     */
    public function home(): JsonResponse
    {
        return new JsonResponse('Home', 200);
    }
}
