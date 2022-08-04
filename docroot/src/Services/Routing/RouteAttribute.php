<?php
namespace App\Services\Routing;

#[\Attribute] class RouteAttribute {
    protected string $name;
    protected string $route;
    protected string $method;

    public function __construct($name, $route, $method)
    {
        $this->name = $name;
        $this->route = $route;
        $this->method = $method;
    }

    public function getRouteName(): string {
        return $this->name;
    }

    public function getRoute(): string {
        return $this->route;
    }

    public function getMethod(): string {
        return $this->method;
    }
}