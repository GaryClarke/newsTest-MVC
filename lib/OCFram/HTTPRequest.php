<?php

namespace OCFram;

class HTTPRequest extends ApplicationComponent {

    /**
     * Return the cookie data if it exists
     *
     * @param $key
     * @return null
     */
    public function cookieData($key)
    {
        return $this->cookieExists($key) ? $_COOKIE[$key] : null;
    }

    /**
     * Check to see if a cookie exists
     *
     * @param $key
     * @return bool
     */
    public function cookieExists($key)
    {
        return isset($_COOKIE[$key]);
    }

    /**
     * Return the the get value if it exists
     *
     * @param $key
     * @return null
     */
    public function getData($key)
    {
        return $this->getExists($key) ? $_GET[$key] : null;
    }

    /**
     * Check to see if there is a get request for a specified attribute
     *
     * @param $key
     * @return bool
     */
    public function getExists($key)
    {
        return isset($_GET[$key]);
    }

    /**
     * Obtain the request method (post/get)
     *
     * @return mixed
     */
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Return a post value if it exists
     *
     * @param $key
     * @return null
     */
    public function postData($key)
    {
        return $this->postExists($key) ? $_POST[$key] : null;
    }

    /**
     * Check to see if there is post data for a specified attribute
     *
     * @param $key
     * @return bool
     */
    public function postExists($key)
    {
        return isset($_POST[$key]);
    }


    public function requestURI()
    {
        return $_SERVER['REQUEST_URI'];
    }
}