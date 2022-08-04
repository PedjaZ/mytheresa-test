<?php
namespace App\Services\Database\Client;

final class DatabaseClient {

    private static ?DatabaseClient $instance = null;

    /**
     * @var \PDO
     */
    private \PDO $connection;

    private final function __construct()
    {
        try {
            $this->connection = new \PDO('mysql:host=' . $this->getDatabaseHost() . ';dbname=' . $this->getDatabaseName(), $this->getDatabaseUser(), $this->getDatabasePassword());
        } catch (\PDOException $exception) {
            Throw new \Exception(sprintf('Connection to DB host %s could not be established because of the following error: %s !', $this->getDatabaseHost(), $exception->getMessage()));
        }
    }

    public static function getInstance(): DatabaseClient
    {
        if(!self::$instance) {
            self::$instance = new DatabaseClient();
        }
        return self::$instance;
    }

    public function connect(): \PDO
    {
        return $this->connection;
    }

    public static function disconnect(){
        return self::$instance = null;
    }

    private function getDatabaseHost()
    {
        return $_ENV['DATABASE_HOST'];
    }

    private function getDatabasePort()
    {
        return $_ENV['DATABASE_PORT'];
    }

    private function getDatabaseName()
    {
        return $_ENV['DATABASE_NAME'];
    }

    private function getDatabaseUser()
    {
        return $_ENV['DATABASE_USER'];
    }

    private function getDatabasePassword()
    {
        return $_ENV['DATABASE_PASSWORD'];
    }

}