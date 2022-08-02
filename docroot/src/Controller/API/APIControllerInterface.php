<?php
namespace App\Controller\API;

interface APIControllerInterface {
    public function getAll();
    public function createMultiple();
    public function update();
}