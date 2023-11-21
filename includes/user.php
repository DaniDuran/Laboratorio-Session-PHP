<?php
include 'db.php';

class User extends DB{
    private $nombre;
    private $username;


    public function userExists($user, $pass){
        $md5pass = md5($pass);
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user AND password = :pass');
    
        if ($query === false) {
            // Manejar el error en la preparación
            die('Error en la preparación de la consulta.');
        }
    
        $result = $query->execute(['user' => $user, 'pass' => $md5pass]);
    
        if ($result === false) {
            // Manejar el error en la ejecución
            die('Error al ejecutar la consulta.');
        }
    
        if($query->rowCount()){
            return true;
        } else {
            return false;
        }
    }
    

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
        $query->execute(['user' => $user]);
        
        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['nombre'];
            $this->username = $currentUser['username'];
        }
    }

    public function getNombre(){
        return $this->nombre;
    }
}

?>