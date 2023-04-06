<?php
class DatabaseConfig
{
    private $host;
    private $username;
    private $password;
    private $dbName;
    
    public function __construct($host, $username, $password, $dbName)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;
    }
    
    public function getHost()
    {
        return $this->host;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function getDbName()
    {
        return $this->dbName;
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