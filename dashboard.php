<?php
session_start();
//arxiu de config
include("dbConf.php");
//conectar bd
$connect = mysqli_connect(DB_HOST, DB_USERS, DB_PSW, DB_NAME, DB_PORT);


//recuperar variables sessio
$nom = $_SESSION["name"];
$rol = $_SESSION["rol"];

//si no son correctes tornar a login
if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] !== true) {
    header("Location: login.html");
    exit;
}

//obtenir usuaris
function Users($connect, $query2)
{
    $result = mysqli_query($connect, $query2);
    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        return array();
    }
}
//crear la cookie amb timer de 10min
function setLanguageCookie($language)
{
    setcookie("language", $language, time() + 3600, "/");
}

//comprobar si existeix la cookie
$selectedLanguage = isset($_COOKIE["language"]) ? $_COOKIE["language"] : "default";

//pel metode get
//redirigir a idioma.php
if (isset($_GET["lang"])) {
    $selectedLanguage = $_GET["lang"];
    setLanguageCookie($selectedLanguage);
    header("Location: idioma.php"); // Redirige a idioma.php para configurar la cookie
    exit;
}

//array asociatiu amb la info de la traducció
$translations = array(
    "default" => array(
        "welcome" => "Benvingut",
        "you_are" => "ets un",
        "show_info" => "Mostrar informació",
        "logout" => "Desconnectar",
        "name" => "nom",
        "surname" => "cognom",
        "email" => "correu",
    ),
    "cat" => array(
        "welcome" => "Benvingut",
        "you_are" => "ets un",
        "show_info" => "Mostrar informació",
        "logout" => "Desconnectar",
        "name" => "nom",
        "surname" => "cognom",
        "email" => "correu",
    ),
    "es" => array(
        "welcome" => "Bienvenido",
        "you_are" => "eres",
        "show_info" => "Mostrar información",
        "logout" => "Cerrar sesión",
        "name" => "nombre",
        "surname" => "apellido",
        "email" => "correo",
    ),
    "eng" => array(
        "welcome" => "Welcome",
        "you_are" => "you are",
        "show_info" => "Show Information",
        "logout" => "Logout",
        "name" => "name",
        "surname" => "surname",
        "email" => "email",
    ),
);

//variable per a recollir la cookie i el valor del array
$selectedTranslations = isset($translations[$selectedLanguage]) ? $translations[$selectedLanguage] : $translations["default"];

//si no son correctes tornar a login
if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] !== true) {
    header("Location: login.html");
    exit;
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>
        <?php echo $selectedTranslations["welcome"]; ?>
    </title>
</head>

<body>
    <h2>
        <?php echo $selectedTranslations["welcome"] . " " . $nom . " " . $selectedTranslations["you_are"] . " " . $rol; ?>
    </h2>

    <?php if ($rol == "professorat"): ?>
        <p><a href="userdetails.php?id=<?php echo $_SESSION["user_id"]; ?>">
                <?php echo $selectedTranslations["show_info"]; ?>
            </a></p>
        <table border="1">
            <tr>
                <th>
                    <?php echo $selectedTranslations["name"]; ?>
                </th>
                <th>
                    <?php echo $selectedTranslations["surname"]; ?>
                </th>
                <th>
                    <?php echo $selectedTranslations["email"]; ?>
                </th>
            </tr>
            <?php
            //creació taula
            $query2 = "SELECT * FROM `user`";
            $usuaris = Users($connect, $query2);

            foreach ($usuaris as $usuari) {
                echo '<tr>';
                echo '<td>' . $usuari['name'] . '</td>';
                echo '<td>' . $usuari['surname'] . '</td>';
                echo '<td>' . $usuari['email'] . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    <?php endif; ?>


    <p><a href="desconectar.php">
            <?php echo $selectedTranslations["logout"]; ?>
        </a></p>

    <p>
        <a href="?lang=cat">Cat</a>
        <a href="?lang=es">Es</a>
        <a href="?lang=eng">Eng</a>
        <a href="delete.php">Eliminar</a>
    </p>
</body>

</html>