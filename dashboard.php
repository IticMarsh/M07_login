<?php
session_start(); 

// Verifica si el usuario está autenticado
if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] !== true) {
    header("Location: login.html");
    exit;
}

include ("dbConf.php");

$connect= mysqli_connect(DB_HOST, DB_USERS, DB_PSW, DB_NAME, DB_PORT);



// crear variables de sessio
$nom = $_SESSION["name"];
$rol = $_SESSION["rol"];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pàgina Principal</title>
</head>
<body>
    <h2><?php echo "Hola " . $nom . " ets un " . $rol; ?></h2>
</body>
</html>


<?php
function Users($connect, $query2) {
    $result = mysqli_query($connect, $query2);
    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        return array(); // Devuelve un array vacío en caso de error
    }
}



if ($rol == "professorat") {
    $query2 = "SELECT * FROM `user`";
    $usuaris = Users($connect, $query2);
    
    echo "La lista de usuarios en la base de datos: <br>";
    
    // Comienza una tabla HTML
    echo '<table border="1">';
    echo '<tr><th>Nombre</th><th>Apellido</th><th>Email</th></tr>'; // Encabezados de la tabla
    
    foreach ($usuaris as $usuari) {
        // Agrega cada fila de la tabla con los datos de los usuarios
        echo '<tr>';
        echo '<td>' . $usuari['name'] . '</td>';
        echo '<td>' . $usuari['surname'] . '</td>';
        echo '<td>' . $usuari['email'] . '</td>';
        echo '</tr>';
    }
    
    // Cierra la tabla HTML
    echo '</table>';
}

echo '<a href="userdetails.php?id=' . $_SESSION["user_id"]  . '">Mostrar informació</a>';
echo '<a href="desconectar.php">Desconectar</a>';

    ?> 
                   
