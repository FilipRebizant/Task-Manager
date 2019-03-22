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

    /**
     * @param string $controller
     * @param array $variables
     * @return mixed
     * @throws \Exception
     */
    protected function getView(string $controller, array $variables = [])
    {
        return $this->template->getView($controller, $variables);
    }
}
