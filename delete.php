<?php
//eliminar la cookie ficant ek temps invers
setcookie("language", "", time() - 3600, "/");


header("Location: dashboard.php");
exit;
?>
