<?php
namespace App\Services\Routing;

use App\Services\Routing\RouteTypes\GetRoute;

class RouteLoader {
    private static ?RouteLoader $instance = null;
    protected array $routes = [];
    protected array $controllers = [];

    private final function __construct() {

    }

    public static function getInstance(): RouteLoader {
        if(!self::$instance) {
            self::$instance = new RouteLoader();
        }
        return self::$instance;
    }

    protected function loadRoutes() {
        foreach ($this->controllers as $controllerClass) {
            $this->getControllerRoutes($controllerClass);
        }
    }

    protected function getControllerRoutes(string $controllerClass) {
        $reflection = new \ReflectionClass($controllerClass);
        $methods = $reflection->getMethods();

        foreach ($methods as $method) {
            $attributes = $method->getAttributes(RouteAttribute::class, \ReflectionAttribute::IS_INSTANCEOF);
            foreach ($attributes as $attribute) {
                $attributeInstance = $attribute->newInstance();
                $route = [
                    'name' => $attributeInstance->getRouteName(),
                    'url' => $attributeInstance->getRoute(),
                    'controller' => $controllerClass,
                    'method' => $method->name,
                ];

                if (!isset($this->routes[$attributeInstance->getRouteName()])) {
                    $this->routes[$attributeInstance->getRouteName()] = $route;
                }
            }
        }

    }

    public function registerController(string $controller): void {
        if (!in_array($controller, $this->controllers)) {
            $this->controllers[] = $controller;
        }
        $this->getControllerRoutes($controller);
    }

    public function getRoutes(): array {
        return $this->routes;
    }
}