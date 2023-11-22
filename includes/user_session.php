<?php


include_once 'db.php';
include_once 'databaseSessionHandler.php';

/**
 * Clase UserSession
 * Gestiona la sesión del usuario utilizando un manejador personalizado y
 * opcionalmente almacena información adicional en archivos de sesión.
 * Debe comentarse un de los dos metodos (session_save_path, session_set_save_handler), no son compatibles entre si 
 */
class UserSession{
    
    public function __construct()
    {    
        $db = new DB();
        $pdo = $db->connect();
        
        $sessionHandler = new DatabaseSessionHandler($pdo);
        
        // Configura la ruta de guardado de sesiones para archivos (opcional)
        //session_save_path('C:\www\xampp\htdocs\Laboratorio-Session-PHP\session');

        // Registra el manejador de sesiones personalizado
        session_set_save_handler($sessionHandler, true);

        // Inicia la sesión del usuario
        session_start();
    }    

    /**
     * Establece el usuario actual en la sesión.
     *
     * @param string $user Nombre de usuario
     */
    public function setCurrentUser($user){
        $_SESSION['user'] = $user;
    }

    /**
     * Obtiene el usuario actual de la sesión.
     *
     * @return string Nombre de usuario actual
     */
    public function getCurrentUser(){
        return $_SESSION['user'];
    }

    /**
     * Cierra la sesión del usuario, eliminando las variables de sesión y destruyendo la sesión.
     */
    public function closeSession(){
        session_unset();    // Elimina todas las variables de sesión
        session_destroy();  // Destruye la sesión
    }
}

?>
