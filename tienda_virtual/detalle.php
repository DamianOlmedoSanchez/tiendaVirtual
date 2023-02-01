<?php
include "templates/header.php";
session_start();
// $nprod=$_SESSION["nprod"];
// $nprod++;
// $_SESSION["nprod"]=$nprod;
// echo "<a href='carrito.php'><img src='img/carrito.png' style='height:50px;'></a>";
// echo "$nprod";

$id=isset($_GET["id"]) ? $_GET["id"] :1;
if (!isset($_SESSION["listado"])) {
    $_SESSION["listado"]=[];
}
$_SESSION["listado"][]=$id;

$conexion = new mysqli("localhost", "miguelzuza2", "MiguelMurcia2022");
if ($conexion->connect_errno > 0) {
    echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
    die ("Error: " . $conexion->connect_error);
} else {
        $conexion->select_db("h0122u0007_miguelzuza");
        $conexion->set_charset("utf8");

        $consulta = $conexion->query("SELECT * FROM articulos where id=$id");
        $articulo = $consulta->fetch_object();
        if($articulo!=null){    
            echo "<div style='margin:auto;  width: 400px; float:center; text-align:justify;'>";    
            echo "<h2>" . $articulo->nombre . "</h2><br>";
            echo "<img src='crud/uploads/" . $articulo->imagen . "' style='height:300px;'> <br>";
            echo "<br><strong>Precio:</strong> " . $articulo->precio . "<br>";
            echo "<strong>Categoria:</strong> " . $articulo->categoria . "<br>";
            echo "<strong>Descripcion:</strong> " . $articulo->descripcion . "<br>";
            echo "<p><a href='index.php'>Seguir Comprando</a></p>";
            echo "</div>";
        }else{
            echo "No existe";
        }
    }

?>