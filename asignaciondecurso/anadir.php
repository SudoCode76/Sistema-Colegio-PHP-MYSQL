<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codEmpleado = $_POST["codEmpleado"];
    $codCurso = $_POST["codCurso"];
    $fechaAsignacion = $_POST["fechaAsignacion"];

    $sql = "INSERT INTO ASIGNACIONCURSO (codEmpleado, codCurso, fechaAsignacion) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iis", $codEmpleado, $codCurso, $fechaAsignacion);

    if ($stmt->execute()) {
        echo "Curso asignado correctamente";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al asignar el curso: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
}

include '../header.php';
?>

<h1>Asignar Curso</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
        <label for="codEmpleado">Empleado:</label>
        <select class="form-control" id="codEmpleado" name="codEmpleado" required>
            <?php
            $sql = "SELECT codEmpleado, nombre FROM EMPLEADO";
            $result = $conexion->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["codEmpleado"] . "'>" . $row["nombre"] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="codCurso">Curso:</label>
        <select class="form-control" id="codCurso" name="codCurso" required>
            <?php
            $sql = "SELECT codCurso, nombreCurso FROM CURSO";
            $result = $conexion->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["codCurso"] . "'>" . $row["nombreCurso"] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="fechaAsignacion">Fecha de Asignación:</label>
        <input type="date" class="form-control" id="fechaAsignacion" name="fechaAsignacion" required>
    </div>
    <button type="submit" class="btn btn-primary">Asignar</button>
</form>

<?php
include '../footer.php';
?>
