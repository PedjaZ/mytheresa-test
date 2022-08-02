<?php
namespace App\Services\Repository;

interface RepositoryInterface {
    public function getAll(array $filters = []);
    public function getSingle($id);
    public function update($id, array $values);
}