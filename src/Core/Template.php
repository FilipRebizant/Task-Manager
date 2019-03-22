<?php

namespace Core;

use Controller\AbstractController;
use Exception;

class Template
{
    private $viewPath = '%s/src/View';
    private $baseView = 'base.html';
    private $reservedVariables = ['application_name', 'body'];

    /**
     * Template constructor.
     */
    public function __construct()
    {
        $this->viewPath = sprintf($this->viewPath, APP_ROOT);
    }

    /**
     * @param AbstractController $controller
     * @param array $variables
     * @return mixed
     * @throws Exception
     */
    public function getView(AbstractController $controller, array $variables = [])
    {
        $variables = $this->validateVariables($variables);

        $parts = explode('::', $controller);
        $directory = $this->getDirectory($parts[0]);
        $file = $this->getFile($parts[1]);

        $viewPath = $this->viewPath . '/' . $directory . '/' . $file . '.html';

        if (file_exists($viewPath)) {
            $baseView = file_get_contents($this->viewPath . '/' . $this->baseView);
            $body = file_get_contents($viewPath);
            $view = str_replace('{{ body }}', $body, $baseView);

            foreach ($variables as $key => $value) {
                $view = str_replace('{{ ' . $key . ' }}', $value, $view);
            }

            return $view;
        }

        http_response_code(404);
        throw new Exception(sprintf('View cannot be found: [%s]', $viewPath, 404));
    }

    /**
     * @param array $variables
     * @return array
     * @throws Exception
     */
    private function validateVariables(array $variables = []): array
    {
        foreach ($variables as $name => $value) {
            if (in_array($name, $this->reservedVariables)) {
                http_response_code(404);
                throw new Exception('Unacceptable view variable given: [body]', 409);
            }
        }

        $variables['application_name'] = APP_NAME;

        return $variables;
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
