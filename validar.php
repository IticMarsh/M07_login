<?php
session_start(); 


//arxiu de configuracio
include ("dbConf.php");

$connect= mysqli_connect(DB_HOST, DB_USERS, DB_PSW, DB_NAME, DB_PORT);

//gestió d'errors
if ($connect->connect_error) {
    die("Conexió fallida: " . $connect->connect_error);
}
//obtenir dades post del form 
$email = $_POST['email'];
$password = $_POST['password'];


  // consulta SQL per verificar que les dades entrades estan a la bd
  $query= "SELECT * FROM `user` WHERE `email`='$email' AND `password`='$password';";
  $resultat= mysqli_query($connect, $query);



  if ($resultat->num_rows == 1) {
   
     // El usuario existe, obtener sus datos
     $row = $resultat->fetch_assoc();
    
     // Establecer variables de sesión
     $_SESSION["LoggedIn"] = true;
     $_SESSION["name"] = $row["name"];
     $_SESSION["rol"] = $row["rol"];       
     $_SESSION["user_id"] = $row["user_id"]; 
 
      
     // Redireccionar a la página principal
     header("Location: dashboard.php");



} else {
    // Usuario incorrecto, redireccionar de nuevo a la página de inicio de sesión
    header("Location: login.html");
}

?>

