<?php
class Database extends PDO
{
    public function __construct()
    {
        $host = 'localhost';
        $dbname = 'faltometro';
        $username = 'root';
        $password = 'Bia@06_10_2007';
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        parent::__construct($dsn, $username, $password);

        $this->exec("set names utf8mb4");
        $this->exec('set character set utf8mb4');
        $this->exec('set collation_connection = utf8mb4_unicode_ci');
    }
}
