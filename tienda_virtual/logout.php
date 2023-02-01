<?php
session_start();
 
    unset($_SESSION["nprod"]);
    unset($_SESSION["listado"]);

header("Status: 301 Moved Permanently");
header("Location: index.php");
exit;
//echo"<p><a href='index.php'>Inicio</p></a>";
?>