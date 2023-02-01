<?php
echo "<h1 style='text-align:center;'>Tienda Virtual</h1>";
include "templates/header.php";
session_start();
//echo "<a href='carrito.php'><img src='img/carrito.png' style='height:50px;'></a>";
//$nprod=(isset($_SESSION["nprod"])) ? $_SESSION["nprod"] : 0;
//echo "$nprod";
//echo "<p><a href='logout.php'>Log out</a></p>";
//$_SESSION["nprod"]=$nprod;
$conexion = new mysqli("localhost", "miguelzuza2", "MiguelMurcia2022");
if ($conexion->connect_errno > 0) {
    echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
    die ("Error: " . $conexion->connect_error);
} else {
    //Elijo la base de datos a la que me conecto
    $conexion->select_db("h0122u0007_miguelzuza");
    $conexion->set_charset("utf8");
    
    $consulta = $conexion->query("SELECT * FROM articulos");
    
        echo "<body style='width:100%;'>";
        echo "<div style='display:flex;flex-direction: row; flex-wrap: wrap;width: 100%;justify-content: center;'>";
        while($articulo = $consulta->fetch_object()){
            echo "<div style='margin:5%;  width: 300px; text-align:center;'>";
            echo "<h2>" . $articulo->nombre . "</h2><br>";
            echo "<img src='crud/uploads/" . $articulo->imagen . "' style='height:300px;'> <br>";
            echo "<br><strong>Precio:</strong> " . $articulo->precio . "€<br>";
            echo "<strong>Categoria:</strong> " . $articulo->categoria . "<br>";
            echo "<br><a href='detalle.php?id=" . $articulo->id . "'>Ver Detalles</a>";
            echo "</div>";
        }
        echo"</div>";
        echo "<body>";
    }
?>