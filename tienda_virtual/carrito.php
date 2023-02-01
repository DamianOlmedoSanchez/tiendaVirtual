<?php
include "templates/header.php";
session_start();
if (isset($_SESSION["listado"])) {
    $conexion = new mysqli("localhost", "miguelzuza2", "MiguelMurcia2022");
    $conexion->select_db("h0122u0007_miguelzuza");
    $conexion->set_charset("utf8");
    for ($i=0; $i <count($_SESSION["listado"]) ; $i++) { 
        $id=$_SESSION["listado"][$i];
        $consulta = $conexion->query("SELECT * FROM articulos where id=$id");
        $articulo = $consulta->fetch_object();
        if($articulo!=null){    
            echo "<div style='margin:auto;  width: 400px; float:center; text-align:justify;'>";    
            echo "<h2>" . $articulo->nombre . "</h2><br>";
            echo "<img src='crud/uploads/" . $articulo->imagen . "' style='height:300px;'> <br>";
            echo "<br><strong>Precio:</strong> " . $articulo->precio . "<br>";
           // echo "<strong>Descripcion:</strong> " . $articulo->descripcion . "<br>";
            echo "<p><a href='index.php'>Seguir Comprando</a></p>";
            echo "</div>";
        }else{
            echo "No existe";
        }
    }
}else{
    echo "El carrito esta vacio";
}


?>