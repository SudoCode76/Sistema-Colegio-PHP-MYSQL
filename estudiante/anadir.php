<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedulaId = $_POST["cedulaId"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $estado = $_POST["estado"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $parentesco = $_POST["parentesco"];
    $genero = $_POST["genero"];

    $sql = "INSERT INTO PADRE (cedulaId, nombre, apellido, estado, direccion, telefono, parentesco, genero) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssss", $cedulaId, $nombre, $apellido, $estado, $direccion, $telefono, $parentesco, $genero);

    if ($stmt->execute()) {
        echo "Nuevo padre añadido correctamente";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al añadir el padre: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
}

include '../header.php';
?>

<h1>Añadir Padre</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
        <label for="cedulaId">Cédula:</label>
        <input type="text" class="form-control" id="cedulaId" name="cedulaId" required>
    </div>
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="form-group">
        <label for="apellido">Apellido:</label>
        <input type="text" class="form-control" id="apellido" name="apellido" required>
    </div>
    <div class="form-group">
        <label for="estado">Estado:</label>
        <input type="text" class="form-control" id="estado" name="estado">
    </div>
    <div class="form-group">
        <label for="direccion">Dirección:</label>
        <input type="text" class="form-control" id="direccion" name="direccion">
    </div>
    <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input type="text" class="form-control" id="telefono" name="telefono">
    </div>
    <div class="form-group">
        <label for="parentesco">Parentesco:</label>
        <input type="text" class="form-control" id="parentesco" name="parentesco">
    </div>
    <div class="form-group">
        <label for="genero">Género:</label>
        <input type="text" class="form-control" id="genero" name="genero">
    </div>
    <button type="submit" class="btn btn-primary">Añadir</button>
</form>

<?php
include '../footer.php';
?>
