<?php
namespace App\Services\Repository;

use App\Services\Database\Client\DatabaseClient;

abstract class BaseRepository implements RepositoryInterface {

    protected DatabaseClient $connection;

    public function __construct() {
        $this->connection = DatabaseClient::getInstance();
    }


}
