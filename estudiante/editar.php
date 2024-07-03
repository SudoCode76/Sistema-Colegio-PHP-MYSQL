<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codEstudiante = $_POST["codEstudiante"];
    $cedulaIdEstudiante = $_POST["cedulaIdEstudiante"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $nacionalidad = $_POST["nacionalidad"];
    $genero = $_POST["genero"];
    $tutor = $_POST["tutor"];
    $direccion = $_POST["direccion"];
    $estado = $_POST["estado"];
    $fechaNacimiento = $_POST["fechaNacimiento"];
    $celular = $_POST["celular"];
    $correo = $_POST["correo"];

    $sql = "UPDATE ESTUDIANTE SET 
            cedulaIdEstudiante='$cedulaIdEstudiante', 
            nombre='$nombre', 
            apellido='$apellido', 
            nacionalidad='$nacionalidad',
            genero='$genero',
            tutor='$tutor',
            direccion='$direccion',
            estado='$estado',
            fechaNacimiento='$fechaNacimiento',
            celular='$celular',
            correo='$correo',
            codPadre='$codPadre',
            codAsistencia='$codAsistencia'
            WHERE codEstudiante='$codEstudiante'";

    if ($conexion->query($sql) === TRUE) {
        echo "Registro actualizado correctamente";
    } else {
        echo "Error actualizando registro: " . $conexion->error;
    }

    $conexion->close();
    header("Location: index.php");
    exit();
} else {
    $codEstudiante = $_GET["id"];
    $sql = "SELECT * FROM ESTUDIANTE WHERE codEstudiante='$codEstudiante'";
    $result = $conexion->query($sql);
    $row = $result->fetch_assoc();
    if (!$row) {
        echo "Estudiante no encontrado.";
        exit();
    }
}

include '../header.php';
?>

<h1>Editar Estudiante</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="hidden" name="codEstudiante" value="<?php echo $row["codEstudiante"];?>">
    <div class="form-group">
        <label for="cedulaIdEstudiante">Cédula:</label>
        <input type="text" class="form-control" id="cedulaIdEstudiante" name="cedulaIdEstudiante" value="<?php echo $row["cedulaIdEstudiante"];?>">
    </div>
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row["nombre"];?>">
    </div>
    <div class="form-group">
        <label for="apellido">Apellido:</label>
        <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $row["apellido"];?>">
    </div>
    <div class="form-group">
        <label for="nacionalidad">Nacionalidad:</label>
        <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" value="<?php echo $row["nacionalidad"];?>">
    </div>
    <div class="form-group">
        <label for="genero">Género:</label>
        <input type="text" class="form-control" id="genero" name="genero" value="<?php echo $row["genero"];?>">
    </div>
    <div class="form-group">
        <label for="tutor">Tutor:</label>
        <input type="text" class="form-control" id="tutor" name="tutor" value="<?php echo $row["tutor"];?>">
    </div>
    <div class="form-group">
        <label for="direccion">Dirección:</label>
        <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $row["direccion"];?>">
    </div>
    <div class="form-group">
        <label for="estado">Estado:</label>
        <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $row["estado"];?>">
    </div>
    <div class="form-group">
        <label for="fechaNacimiento">Fecha de Nacimiento:</label>
        <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $row["fechaNacimiento"];?>">
    </div>
    <div class="form-group">
        <label for="celular">Celular:</label>
        <input type="text" class="form-control" id="celular" name="celular" value="<?php echo $row["celular"];?>">
    </div>
    <div class="form-group">
        <label for="correo">Correo:</label>
        <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $row["correo"];?>">
    </div>
    <div class="form-group">
        <label for="codPadre">CodPadre:</label>
        <input type="text" class="form-control" id="codPadre" name="codPadre" value="<?php echo $row["codPadre"];?>">
    </div>
    <div class="form-group">
        <label for="codAsistencia">CodAsistencia:</label>
        <input type="text" class="form-control" id="codAsistencia" name="codAsistencia" value="<?php echo $row["codAsistencia"];?>">
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<?php
include '../footer.php';
?>
