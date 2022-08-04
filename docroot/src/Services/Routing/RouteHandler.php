<?php

namespace App\Services\Routing;

use App\Controller\API\APIControllerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Services\Routing\RouteLoader;

/**
 * Class responsible for handling HTTP requests. Resolves routes for their controllers and returns the response.
 */
class RouteHandler {

    private $routes = [];

    public function __construct(){
        // Get all the routes and set them.
        $routeLoader = RouteLoader::getInstance();
        $this->routes = $routeLoader->getRoutes();
    }

    /**
     * Function that handles the requested route.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return bool|\Exception|null
     */
    public function handle(Request $request) {
        try {
            $path = $request->getPathInfo();
            $controller = $this->resolveRoute($path);

            if ($controller) {
                $method = $controller['method'];
                return $controller['controller']->$method($request);
            }
            else {
                throw new \Exception('Route not found!', 404);
            }
        }
        catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Function that resolves the route and returns the controller responsible for serving the route.
     *
     * @param $path
     *
     * @throws \Exception
     */
    public function resolveRoute($path) {
        $controller = NULL;
        // Go trough all the routes and get the configured controller for the route.
        foreach ($this->routes as $title => $routeDetails) {
            if ($routeDetails['url'] === $path) {

                // Instantiate the controller.
                $controller = new $routeDetails['controller'];

                // If the configured controller is valid break the loop.
                if ($controller instanceof APIControllerInterface) {
                    $method = $routeDetails['method'];
                    break;
                }
                else {
                    throw new \Exception('The defined class for the route must be a controller!
          It needs to implement Exchange\Controller\ControllerInterface!
          Check the class: ' . $routeDetails['controller'] . '.
          Correct the route configuration!');
                }
            }
        }

        if ($controller) {
            return ['controller' => $controller, 'method' => $method];
        }
        else {
            return FALSE;
        }
    }
}