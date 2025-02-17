<?php

namespace Rmunate\Php2Js\Data;

use Illuminate\Support\Facades\Route;

class UrlPhp2Js
{
    private $facadeRouteCurrent;
    private $serverHTTPx;
    private $serverHost;
    private $serverUri;

    /**
     * Contructor Class
     * Routes.
     */
    public function __construct()
    {
        $this->facadeRouteCurrent = Route::current();
        $this->serverHTTPx = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $this->serverHost = $_SERVER['HTTP_HOST'];
        $this->serverUri = $_SERVER['REQUEST_URI'];
    }

    /**
     * @param string $path
     * @param array  $parameters
     * @param null   $secure
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->serverHTTPx.$this->serverHost;
    }

    /**
     * return full uri current.
     *
     * @return string
     */
    public function getFullUrl()
    {
        return $this->serverHTTPx.$this->serverHost.$this->serverUri;
    }

    /**
     * Return Current Uri in Use
     * Use Facade Laravel.
     *
     * @return string
     */
    public function getUri()
    {
        return $this->facadeRouteCurrent->uri;
    }

    /**
     * Return Parameter Route Laravel
     * Use Facade Laravel.
     *
     * @return string
     */
    public function getParametersRoute()
    {
        return $this->facadeRouteCurrent->parameters;
    }

    /**
     * Return Parameter POST.
     *
     * @return string
     */
    public function getParametersPost()
    {
        return $_POST ?? [];
    }

    /**
     * Return Parameter GET.
     *
     * @return string
     */
    public function getParametersGet()
    {
        return $_GET ?? [];
    }

    /**
     * Return schema in use.
     *
     * @return string
     */
    public function getSchema()
    {
        return strtoupper(str_replace('://', '', $this->serverHTTPx));
    }

    /**
     * Obtener el nombre de la ruta actual.
     *
     * @return string|null
     */
    public function getCurrentRouteName()
    {
        return $this->facadeRouteCurrent->getName();
    }

    /**
     * Verificar si la solicitud es segura (HTTPS).
     *
     * @return bool
     */
    public function isSecure()
    {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    }
}
