<?php

include_once 'includes/user.php';
include_once 'includes/user_session.php';

$userSession = new UserSession();
$user = new User();

// Verifica si hay una sesión de usuario activa
if(isset($_SESSION['user'])){
    // Si hay una sesión, establece la información del usuario en la instancia de la clase User
    $user->setUser($userSession->getCurrentUser());
    // Incluye la vista de inicio
    include_once 'vistas/home.php';
} 
else if(isset($_POST['username']) && isset($_POST['password'])){
    // Si se enviaron datos de inicio de sesión a través del formulario POST
    
    $userForm = $_POST['username'];
    $passForm = $_POST['password'];

    $user = new User();

    // Verifica si el usuario con las credenciales proporcionadas existe en la base de datos
    if($user->userExists($userForm, $passForm)){
        // Si el usuario existe, establece la sesión del usuario y la información del usuario
        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);
        // Incluye la vista de inicio
        include_once 'vistas/home.php';
    } 
    else {
        // Si las credenciales son incorrectas, muestra un mensaje de error
        $errorLogin = "Nombre de usuario y/o contraseña incorrectos";
        // Incluye la vista de inicio de sesión con mensaje de error
        include_once 'vistas/login.php';
    }
} 
else {
    // Si no hay una sesión activa y no se enviaron datos de inicio de sesión, muestra el formulario de inicio de sesión
    include_once 'vistas/login.php';
}

?>
