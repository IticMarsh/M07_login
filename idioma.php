<?php
function setLanguageCookie($language)
{//creacio cookie
    setcookie("language", $language, time() + 3600, "/");
}

if (isset($_GET["lang"])) {
    $selectedLanguage = $_GET["lang"];
    setLanguageCookie($selectedLanguage);
}
//redirigir
header("Location: dashboard.php");
exit;
?>
