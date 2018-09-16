<?php 
class Database
{
    private $driver = 'mysql';
    private $host = 'localhost';
    private $port = 3306;
    private $dbName = '2048';
    private $user = "test";
    private $pass = "test";

    private function getConnectionStr()
    {
        return $this->driver
        .":host=".$this->host
        .";port=".$this->port
        .";dbname=".$this->dbName;
        
    }

    public function getConnection()
    {
        $cs = $this->getConnectionStr();
        return new PDO($cs, $this->user, $this->pass);        
    }
}
