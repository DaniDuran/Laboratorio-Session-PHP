<?php

class UserSession{

    public function __construct(){
        session_save_path('C:\www\xampp\htdocs\Laboratorio-Session-PHP\session');  
        session_start();
        
    }

    public function setCurrentUser($user){
        $_SESSION['user'] = $user;
    }

    public function getCurrentUser(){
        return $_SESSION['user'];
    }

    public function closeSession(){
        session_unset();
        session_destroy();
    }
}

?>
