<?php
namespace App\Services\Routing\RouteTypes;

enum HTTPMethods: string {
    case GET = 'GET';
    case POST = 'POST';
    case PATCH = 'PATCH';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
}