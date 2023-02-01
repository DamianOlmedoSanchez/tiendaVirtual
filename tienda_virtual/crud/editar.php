<?php
    include "conexion.php";    

    //Cuando mostramos la página con el formulario y los datos del alumno
    if (!isset($_GET['id'])) { //Si no nos pasan el id del alumno        
        echo "El articulo no existe";        
    }else{
        $id = $_GET['id'];
        $consultaSQL = "SELECT * FROM articulos WHERE id =" . $id;
    
        $sentencia = $conexion->query($consultaSQL);            
        $articulo = $sentencia->fetch_object();    
        if ($articulo) {            
            $nombre = $articulo->nombre;
            $descripcion = $articulo->descripcion;
            $precio = $articulo->precio;
            $categoria = $articulo->categoria;
        }else{            
            echo 'No se ha encontrado el alumno';
        }
        
    }
    
    //Cuando nos envían los datos del alumno desde el formulario y tenemos que actualizarlo
    if (isset($_POST['submit'])) {    
        $id = $_GET['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $categoria = $_POST['categoria'];
        
        $consultaSQL = "UPDATE articulos SET  nombre = '$nombre', descripcion = '$descripcion', precio = $precio, categoria = '$categoria',";
        $consultaSQL .= "updated_at = NOW() WHERE id = $id";
        
        $consulta = $conexion->query($consultaSQL);        
        header("Status: 301 Moved Permanently");
        header("Location: index.php");
        exit;
    }    
?>

<?php require "templates/header.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mt-4">Editando el articulo <?= escapar($nombre)?></h2>
        <hr>
        <form method="post">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?= escapar($nombre) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="descripcion">Descrpcion</label>
            <input type="text" name="descripcion" id="descripcion" value="<?= escapar($descripcion) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" step="0.01" name="precio" id="precio" value="<?= escapar($precio) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="categoria">Categoria</label>
            <input type="text" name="categoria" id="categoria" value="<?= escapar($categoria) ?>" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Actualizar">
            <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php require "templates/footer.php"; ?>