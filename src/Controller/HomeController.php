<?php

namespace Controller;


use Core\Template;

class HomeController extends AbstractController
{

    public function __construct()
    {
        parent::__construct(new Template());
    }

    public function index()
    {
        return parent::getView(
            __METHOD__,
            [
                'title' => APP_NAME,
                'header' => 'Welcome',
                'application_name' => APP_NAME,
            ]
        );
    }
}
