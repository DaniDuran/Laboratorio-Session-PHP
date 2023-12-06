<?php

class DB{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct()
    {
        // Obtener valores de las variables de entorno o usar valores predeterminados
        $this->host = getenv('DB_HOST') ?: 'localhost:3305';
        $this->db = getenv('DB_DATABASE') ?: 'compras';
        $this->user = getenv('DB_USER') ?: 'root';
        $this->password = getenv('DB_PASSWORD') ?: 'root';
        $this->charset = 'utf8mb4';
    }

    public function connect()
    {
        try 
        {
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($connection, $this->user, $this->password, $options);

            return $pdo;
        } catch (PDOException $e) 
        {
            throw new Exception('Error en la conexión a la base de datos: ' . $e->getMessage());
        }
    }
}

?>
