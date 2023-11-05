<?php
session_start();
include ("dbConf.php");

$connect= mysqli_connect(DB_HOST, DB_USERS, DB_PSW, DB_NAME, DB_PORT);

// Comprueba si el usuario está autenticado
if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] !== true) {
    // Si no está autenticado, redirige a la página de inicio de sesión
    header("Location: login.html");
    exit;
}

//metode get amb parametre id
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

   

    $query = "SELECT * FROM `user` WHERE `user_id` = $userId";
    $result = mysqli_query($connect, $query);

    // comproba la consulta
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        echo "Informació detallada de l'usuari:<br>";
        echo "Nom: " . $user['name'] . "<br>";
        echo "Cognom: " . $user['surname'] . "<br>";
        echo "Email: " . $user['email'] . "<br>";
        echo "Rol: " . $user['rol'] . "<br>";
        echo "Contrasenya: " . $user['password'] . "<br>";
        echo "ID: " . $user['user_id'] . "<br>";
        echo "Actiu: " . $user['active'] . "<br>";

        echo '<p><a href="dashboard.php">Tornar a Dashboard</a></p>';
        
      

    } else {
        echo "Usuari no trobat.";
    }
} else {
    echo "Falta el parámetre 'id' a la URL.";
}
?>
