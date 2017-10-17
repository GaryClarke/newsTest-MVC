<?php


namespace OCFram;


interface Router {

    public function addRoute(Route $route);

    public function getRoute($url);

}