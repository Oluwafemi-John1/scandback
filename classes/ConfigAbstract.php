<?php
class DatabaseConfig
{
    private $cleardb_server;
    private $cleardb_username;
    private $cleardb_password;
    private $cleardb_db;
    
    public function __construct($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db)
    {
        $this->cleardb_server = $cleardb_server;
        $this->cleardb_username = $cleardb_username;
        $this->cleardb_password = $cleardb_password;
        $this->cleardb_db = $cleardb_db;
    }

    
    public function getHost()
    {
        return $this->cleardb_server;
    }
    
    public function getUsername()
    {
        return $this->cleardb_username;
    }
    
    public function getPassword()
    {
        return $this->cleardb_password;
    }
    
    public function getDbName()
    {
        return $this->cleardb_db;
    }
}

class DatabaseConnection
{
    private $config;
    private $connection;
    
    public function __construct(DatabaseConfig $config)
    {
        $this->config = $config;
        $this->connection = new mysqli(
            $this->config->getHost(),
            $this->config->getUsername(),
            $this->config->getPassword(),
            $this->config->getDbName()
        );
        if ($this->connection->connect_error) {
            die("Unable to connect to database: " . $this->connection->connect_error);
        }
    }
    
    public function getConnection()
    {
        return $this->connection;
    }
}

?>