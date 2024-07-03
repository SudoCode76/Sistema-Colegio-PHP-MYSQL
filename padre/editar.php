<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codPadre = $_POST["codPadre"];
    $cedulaId = $_POST["cedulaId"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $estado = $_POST["estado"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $parentesco = $_POST["parentesco"];
    $genero = $_POST["genero"];

    $sql = "UPDATE PADRE SET cedulaId=?, nombre=?, apellido=?, estado=?, direccion=?, telefono=?, parentesco=?, genero=? WHERE codPadre=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssssi", $cedulaId, $nombre, $apellido, $estado, $direccion, $telefono, $parentesco, $genero, $codPadre);

    if ($stmt->execute()) {
        echo "Padre actualizado correctamente";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar el padre: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    $codPadre = $_GET["id"];
    $sql = "SELECT * FROM PADRE WHERE codPadre=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $codPadre);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();
}

include '../header.php';
?>

<h1>Editar Padre</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="hidden" name="codPadre" value="<?php echo $row["codPadre"];?>">
    <div class="form-group">
        <label for="cedulaId">Cédula:</label>
        <input type="text" class="form-control" id="cedulaId" name="cedulaId" value="<?php echo $row["cedulaId"];?>" required>
    </div>
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row["nombre"];?>" required>
    </div>
    <div class="form-group">
        <label for="apellido">Apellido:</label>
        <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $row["apellido"];?>" required>
    </div>
    <div class="form-group">
        <label for="estado">Estado:</label>
        <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $row["estado"];?>">
    </div>
    <div class="form-group">
        <label for="direccion">Dirección:</label>
        <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $row["direccion"];?>">
    </div>
    <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $row["telefono"];?>">
    </div>
    <div class="form-group">
        <label for="parentesco">Parentesco:</label>
        <input type="text" class="form-control" id="parentesco" name="parentesco" value="<?php echo $row["parentesco"];?>">
    </div>
    <div class="form-group">
        <label for="genero">Género:</label>
        <input type="text" class="form-control" id="genero" name="genero" value="<?php echo $row["genero"];?>">
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<?php
include '../footer.php';
?>
