<?php

namespace Core;

use Controller\AbstractController;
use Exception;

class Template
{
    private $viewPath = '%s/src/View';
    private $baseView = 'base.html';
    private $reservedVariables = ['application_name', 'body'];

    public function __construct()
    {
        $this->viewPath = sprintf($this->viewPath, APP_ROOT);
    }

    public function getView($controller, array $variables = [])
    {

    }

    private function validateVariables(array $variables = [])
    {

    }


    /**
     * @param AbstractController $controller
     * @return string
     */
    private function getDirectory(AbstractController $controller): string
    {
        $parts = explode('\\', $controller);

        return end($parts);
    }
    
    /**
     * @param AbstractController $controller
     * @return string|array
     */
    private function getFile(AbstractController $controller)
    {
        return str_replace(APP_CONTROLLER_METHOD_SUFFIX, null, $controller);
    }
}
