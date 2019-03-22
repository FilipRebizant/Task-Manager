<?php

namespace Controller;

use Core\Template;

class AbstractController
{

    /**
     * @var Template $template
     */
    private $template;

    /**
     * AbstractController constructor.
     */
    public function __construct()
    {
        $this->template = new Template();
    }


    protected function getView($controller, array $variables = [])
    {
        return $this->template->getView($controller, $variables);
    }
}
