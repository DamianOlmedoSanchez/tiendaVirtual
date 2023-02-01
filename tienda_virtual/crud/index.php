<?php
    include "conexion.php";
    include "templates/header.php"; 

    csrf();
    if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
        die();
    }
?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="crear.php"  class="btn btn-primary mt-4">Añadir Articulo</a>
                <hr>
            </div>            
        </div>
        <div class="container">
            <div class="row">
                <form action="" method="post" class="form-inline">
                    <div class="form-group mr-3">
                    <input type="text" id="nombre" name="nombre" placeholder="Buscar por nombre" class="form-control">
                    </div>
                    <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
                    <button type="submit" name="submit" class="btn btn-primary">Ver resultados</button>
                </form>                
            </div>
        </div>
        <?php            
            if (isset($_POST['nombre']) ) {
                $nombre=$_POST['nombre'];
                $consultaSQL = "SELECT * FROM articulos WHERE nombre LIKE '%$nombre%'";
                $titulo = ($apellido!="") ? 'Lista de alumnos (' . $_POST['apellido'] . ')': 'Lista de alumnos';
            } else {
                $consultaSQL = "SELECT * FROM articulos";
                $titulo = 'Lista de articulos';
            }   
            
            echo "<h1 class='mt-3'>$titulo</h1>";
        ?>        
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Categoria</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
        <?php                 
                 
            $consulta=$conexion->query($consultaSQL);    
            while($elemento=$consulta->fetch_object()){  
                $id=$elemento->id;
                $nombre=$elemento->nombre;
                $descripcion=$elemento->descripcion;
                $imagen=$elemento->imagen;
                $precio=$elemento->precio;
                $categoria=$elemento->categoria;
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$nombre</td>";
                echo "<td>$descripcion</td>";
                echo "<td><img src='uploads/$imagen' style='width:100px'></td>";
                echo "<td>$precio</td>";
                echo "<td>$categoria</td>";
                //echo "<td><a href='borrar.php?id=$id ?'>🗑️Borrar</a>";
                echo "<td><form action='borrar.php?id=$id' method='post' onSubmit='return confirm(\"Seguro?\")'><input type='submit' value='borrar'></form>";
                echo "<a href='editar.php?id=$id'>✏️Editar</a></td>";
                echo "</tr>";
            }
        ?>
            </tbody>
        </table>
    </div>

    <p><a href="https://www.neoguias.com/tutorial-crud-php/">Inspirado parcialmente en el tutorial de esta URL</a></p>
<?php 
    include "templates/footer.php"; 
?>
