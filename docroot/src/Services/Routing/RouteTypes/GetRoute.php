<?php
namespace App\Services\Routing\RouteTypes;

use App\Services\Routing\RouteAttribute;

class GetRoute extends RouteAttribute {
    public function __construct($name, $route)
    {
        parent::__construct($name, $route, HTTPMethods::GET);
    }
}