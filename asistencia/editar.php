<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codAsistencia = $_POST["codAsistencia"];
    $estado = $_POST["estado"];
    $fecha = $_POST["fecha"];

    $sql = "UPDATE ASISTENCIA SET estado=?, fecha=? WHERE codAsistencia=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssi", $estado, $fecha, $codAsistencia);

    if ($stmt->execute()) {
        echo "Asistencia actualizada correctamente";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar la asistencia: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    $codAsistencia = $_GET["id"];
    $sql = "SELECT * FROM ASISTENCIA WHERE codAsistencia=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $codAsistencia);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();
}

include '../header.php';
?>

<h1>Editar Asistencia</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="hidden" name="codAsistencia" value="<?php echo $row["codAsistencia"];?>">
    <div class="form-group">
        <label for="estado">Estado:</label>
        <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $row["estado"];?>" required>
    </div>
    <div class="form-group">
        <label for="fecha">Fecha:</label>
        <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $row["fecha"];?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<?php
include '../footer.php';
?>
