<?php

include 'db.php';

/**
 * Clase User
 * Proporciona funcionalidades relacionadas con la gestión de usuarios.
 */
class User extends DB{
    
    private $nombre;
    private $username;

    /**
     * Verifica si un usuario con el nombre de usuario y la contraseña proporcionados existe en la base de datos.
     *
     * @param string $user Nombre de usuario
     * @param string $pass Contraseña (se espera en formato MD5)
     * @return bool True si el usuario existe, False en caso contrario
     */
    public function userExists($user, $pass){
        // Convierte la contraseña a MD5
        $md5pass = md5($pass);

        // Prepara la consulta SQL para verificar la existencia del usuario
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user AND password = :pass');

        // Verifica si la preparación de la consulta fue exitosa
        if ($query === false) {
            // Manejar el error en la preparación
            die('Error en la preparación de la consulta.');
        }

        // Ejecuta la consulta con los parámetros proporcionados
        $result = $query->execute(['user' => $user, 'pass' => $md5pass]);

        // Verifica si la ejecución de la consulta fue exitosa
        if ($result === false) {
            // Manejar el error en la ejecución
            die('Error al ejecutar la consulta.');
        }

        // Verifica si hay filas devueltas, lo que indica que el usuario existe
        if($query->rowCount()){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Establece las propiedades de la clase con la información del usuario proporcionado.
     *
     * @param string $user Nombre de usuario
     */
    public function setUser($user){
        // Prepara la consulta SQL para obtener la información del usuario por nombre de usuario
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user');

        // Ejecuta la consulta con el parámetro proporcionado
        $query->execute(['user' => $user]);
        
        // Itera sobre los resultados (debería ser solo un usuario)
        foreach ($query as $currentUser) {
            // Establece las propiedades de la clase con la información del usuario
            $this->nombre = $currentUser['nombre'];
            $this->username = $currentUser['username'];
        }
    }

    /**
     * Obtiene el nombre del usuario.
     *
     * @return string Nombre del usuario
     */
    public function getNombre(){
        return $this->nombre;
    }
}

?>