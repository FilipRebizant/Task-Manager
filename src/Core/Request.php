<?php

namespace Core;

use Exception;

class Request
{
    private $server;
    private $post;
    private $get;
    private $files;

    /**
     * Request constructor.
     * @param array $server
     * @param array $post
     * @param array $get
     * @param array $files
     */
    public function __construct(
        array $server = [],
        array $post = [],
        array $get = [],
        array $files = []
    ) {
      $this->server = $server;
      $this->post = $post;
      $this->get = $get;
      $this->files = $files;
    }

    /**
     * @param null $index
     * @return mixed
     */
    public function getServer($index = null)
    {
        return !is_null($index) && isset($this->server[$index]) ? $this->server[$index] : $this->server;
    }

    /**
     * @return array
     */
    public function getPost(): array
    {
        return $this->post;
    }

    /**
     * @return array
     */
    public function getGet(): array
    {
        return $this->get;
    }

    /**
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getController(): string
    {
        $urlParts = $this->getUrlParts();

        if (!isset($urlParts[0])) {
            return APP_CONTROLLER_NAMESPACE.APP_DEFAULT_CONTROLLER . $urlParts[0];
        }

        if (class_exists(APP_CONTROLLER_NAMESPACE . $urlParts[0])) {
            return APP_CONTROLLER_NAMESPACE . $urlParts[0];
        }

        http_response_code(404);
        throw new Exception(sprintf('Controller cannot be found: [%s]', APP_CONTROLLER_NAMESPACE . $urlParts[0]), 404);
    }

    /**
     * @param string $controller
     * @return string
     * @throws Exception
     */
    public function getMethod(string $controller): string
    {
        $urlParts = $this->getUrlParts();
        if (!isset($urlParts[1])) {
            return APP_DEFAULT_CONTROLLER_METHOD.APP_CONTROLLER_METHOD_SUFFIX;
        }

        if (!preg_match('/^[a-z\-]+$/', $urlParts[1])) {
            http_response_code(400);
            throw new Exception(sprintf('Invalid method: [%s]', $urlParts[1]), 400);
        }

        $method = $this->constructMethod($urlParts[1]);
        if (method_exists($controller, $method)) {
            return $method;
        }

        http_response_code(404);
        throw new Exception(sprintf('Method cannot be found: [%s:%s]', $controller, $method), 404);
    }

    /**
     * @return array
     */
    private function getUrlParts(): array
    {
        $url = str_replace(APP_INNER_DIRECTORY, null, $this->getServer('REQUEST_URI'));
        $urlParts = explode('/', $url);
        $urlParts = array_filter($urlParts);
        $urlParts = array_values($urlParts);

        return $urlParts;
    }

    /**
     * @param string $part
     * @return string
     */
    private function constructMethod(string $part): string
    {
        $method = null;

        $parts = explode('-', $part);
        foreach ($parts as $part) {
            if (!$method) {
                $method = $part;
            } else {
                $method .= ucfirst($part);
            }
        }

        return $method.APP_CONTROLLER_METHOD_SUFFIX;
    }
}
