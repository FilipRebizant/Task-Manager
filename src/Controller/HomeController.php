<?php

namespace Controller;

use Core\Template;

class HomeController extends AbstractController
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct(new Template());
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        return parent::getView(
            __METHOD__,
            [
                'title' => APP_NAME,
                'header' => 'Welcome'
            ]
        );
    }
}
