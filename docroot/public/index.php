<?php
require __DIR__ . '/../vendor/autoload.php';


use App\Controller\API\ProductController;
use App\Services\Routing\RouteLoader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Routing\RouteHandler;
use Dotenv\Dotenv;

try {
    $env = Dotenv::createImmutable(__DIR__ . "/../");
    $env->load();

    $request = Request::createFromGlobals();

    $routeLoader = RouteLoader::getInstance();
    $routeLoader->registerController(ProductController::class);

    $handler = new RouteHandler();

    $response = $handler->handle($request);

    if ($response instanceof \Exception) {
        echo $response->getMessage();
        $code = $response->getCode();
        $response = new Response($response->getMessage());
        if ($code) {
            $response->setStatusCode($code);
        }
    }

    $response->send();
}
catch (Throwable $exception) {
    print $exception->getMessage();
}