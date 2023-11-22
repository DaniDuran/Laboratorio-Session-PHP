<?php


class DatabaseSessionHandler implements SessionHandlerInterface
{
    // Propiedad privada para almacenar la conexión PDO a la base de datos
    private $pdo;

    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Método para abrir la sesión (no realiza ninguna acción específica en este caso)
    public function open($savePath, $sessionName)
    {
        return true;
    }

    // Método para cerrar la sesión (no realiza ninguna acción específica en este caso)
    public function close()
    {
        return true;
    }

    // Método para leer los datos de la sesión utilizando el ID de sesión
    public function read($sessionId)
    {
        // Consulta SQL para obtener los datos de sesión
        $sql = "SELECT data FROM sessions WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $sessionId, PDO::PARAM_STR);
        $stmt->execute();

        // Recupera el resultado de la consulta
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retorna los datos de sesión o una cadena vacía si no hay datos
        return $result ? $result['data'] : '';
    }

    // Método para escribir los datos de la sesión en la base de datos
    public function write($sessionId, $data)
    {        
        // Obtiene la dirección IP del cliente y el nombre del host (user agent)
        // $ipAddress = $_SERVER['REMOTE_ADDR'];
        $ipAddress = gethostname();        
        if(isset($_SESSION['user'])){
        $userAgent = $_SESSION['user'];
        }
        

        // Consulta SQL para insertar o reemplazar los datos de sesión en la base de datos
        $sql = "REPLACE INTO sessions (id, data, last_accessed, ip_address, user_agent) VALUES (:id, :data, NOW(), :ip_address, :user_agent)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $sessionId, PDO::PARAM_STR);
        $stmt->bindParam(':data', $data, PDO::PARAM_STR);
        $stmt->bindParam(':ip_address', $ipAddress, PDO::PARAM_STR);
        $stmt->bindParam(':user_agent', $userAgent, PDO::PARAM_STR);

        // var_dump($stmt);
        // echo"|| sesion: {$sessionId} || data: {$data}  || ip: {$ipAddress}  ||user: {$userAgent}";                
        
        // Ejecuta la consulta y devuelve el resultado
        return $stmt->execute();
    }

    // Método para destruir una sesión según el ID de sesión proporcionado
    public function destroy($sessionId)
    {
        // Consulta SQL para eliminar una sesión de la base de datos
        $sql = "DELETE FROM sessions WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $sessionId, PDO::PARAM_STR);

        // Ejecuta la consulta y devuelve el resultado
        return $stmt->execute();
    }

    // Método para limpiar sesiones caducadas según el tiempo de vida máximo proporcionado
    public function gc($maxlifetime)
    {
        // Consulta SQL para eliminar sesiones caducadas de la base de datos
        $sql = "DELETE FROM sessions WHERE last_accessed < DATE_SUB(NOW(), INTERVAL :maxlifetime SECOND)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':maxlifetime', $maxlifetime, PDO::PARAM_INT);

        // Ejecuta la consulta y devuelve el resultado
        return $stmt->execute();
    }
}

?>
