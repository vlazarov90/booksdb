<?php

namespace DB;

use Extensions\Configuration;

/**
 * Class Connection
 * @package DB
 */
class Connection
{
    private $conn;
    private static $instance;

    /**
     * Connection constructor.
     * @throws \Exception
     */
    private function __construct()
    {
        $this->connect();
    }

    /**
     * @return Connection
     * @throws \Exception
     */
    public static function getInstance()
    {
        if(!self::$instance){
            self::$instance = new Connection();
        }

        return self::$instance;
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->conn;
    }

    /**
     * @throws \Exception
     *
     * use connection string from config to connect to DB
     */
    public function connect()
    {
        $config = Configuration::getConfig('database');

        if(!$config){
            throw new \Exception('Database config is empty or missing');
        }

        $this->conn = pg_connect("host={$config['host']} user={$config['username']} password={$config['password']} dbname={$config['dbname']}");
    }
}