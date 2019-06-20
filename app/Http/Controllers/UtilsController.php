<?php


namespace App\Http\Controllers;


class UtilsController
{
    private $title;
    private $headers;
    private $url;
    private $fnEditar;

    public function __construct($title, $headers, $url, $fnEditar)
    {
        $this->setTitle(['title' => $title]);
        $this->setHeaders(['headers' => $headers]);
        $this->setUrl(['url' => $url]);
        $this->setFnEditar(['fnEditar' => $fnEditar]);
    }

    public function getInfosGrid() {
        return array_merge($this->getTitle(), $this->getHeaders(), $this->getUrl(), $this->getFnEditar());
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getFnEditar()
    {
        return $this->fnEditar;
    }

    /**
     * @param mixed $fnEditar
     */
    public function setFnEditar($fnEditar): void
    {
        $this->fnEditar = $fnEditar;
    }
}
