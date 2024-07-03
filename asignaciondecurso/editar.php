<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codAsignacion = $_POST["codAsignacion"];
    $codEmpleado = $_POST["codEmpleado"];
    $codCurso = $_POST["codCurso"];
    $fechaAsignacion = $_POST["fechaAsignacion"];

    $sql = "UPDATE ASIGNACIONCURSO SET codEmpleado=?, codCurso=?, fechaAsignacion=? WHERE codAsignacion=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iisi", $codEmpleado, $codCurso, $fechaAsignacion, $codAsignacion);

    if ($stmt->execute()) {
        echo "Asignación de curso actualizada correctamente";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar la asignación: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    $codAsignacion = $_GET["id"];
    $sql = "SELECT * FROM ASIGNACIONCURSO WHERE codAsignacion=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $codAsignacion);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();
}

include '../header.php';
?>

<h1>Editar Asignación de Curso</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="hidden" name="codAsignacion" value="<?php echo $row["codAsignacion"];?>">
    <div class="form-group">
        <label for="codEmpleado">Empleado:</label>
        <select class="form-control" id="codEmpleado" name="codEmpleado" required>
            <?php
            $sql = "SELECT codEmpleado, nombre FROM EMPLEADO";
            $result = $conexion->query($sql);
            while ($empleado = $result->fetch_assoc()) {
                $selected = ($empleado["codEmpleado"] == $row["codEmpleado"]) ? "selected" : "";
                echo "<option value='" . $empleado["codEmpleado"] . "' $selected>" . $empleado["nombre"] . "</option>";
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
            while ($curso = $result->fetch_assoc()) {
                $selected = ($curso["codCurso"] == $row["codCurso"]) ? "selected" : "";
                echo "<option value='" . $curso["codCurso"] . "' $selected>" . $curso["nombreCurso"] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="fechaAsignacion">Fecha de Asignación:</label>
        <input type="date" class="form-control" id="fechaAsignacion" name="fechaAsignacion" value="<?php echo $row["fechaAsignacion"];?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<?php
include '../footer.php';
?>
