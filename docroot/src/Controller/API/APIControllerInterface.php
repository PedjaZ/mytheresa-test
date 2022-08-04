<?php
namespace App\Controller\API;

use Symfony\Component\HttpFoundation\Request;

interface APIControllerInterface {
    public function getAll(Request $request);
    public function getSingle(Request $request);
    public function createMultiple(Request $request);
    public function update(Request $request);
}