<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codSalario = $_POST["codSalario"];
    $codEmpleado = $_POST["codEmpleado"];
    $monto = $_POST["monto"];

    $sql = "UPDATE SALARIO SET codEmpleado=?, monto=? WHERE codSalario=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("idi", $codEmpleado, $monto, $codSalario);

    if ($stmt->execute()) {
        echo "Salario actualizado correctamente";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar el salario: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    $codSalario = $_GET["id"];
    $sql = "SELECT * FROM SALARIO WHERE codSalario=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $codSalario);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();
}

include '../header.php';
?>

<h1>Editar Salario</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="hidden" name="codSalario" value="<?php echo $row["codSalario"];?>">
    <div class="form-group">
        <label for="codEmpleado">Empleado:</label>
        <select class="form-control" id="codEmpleado" name="codEmpleado" required>
            <?php
            $sql = "SELECT codEmpleado, nombre, apellido FROM EMPLEADO";
            $result = $conexion->query($sql);
            while ($empleado = $result->fetch_assoc()) {
                $selected = ($empleado["codEmpleado"] == $row["codEmpleado"]) ? "selected" : "";
                echo "<option value='" . $empleado["codEmpleado"] . "' $selected>" . $empleado["nombre"] . " " . $empleado["apellido"] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="monto">Monto:</label>
        <input type="number" step="0.01" class="form-control" id="monto" name="monto" value="<?php echo $row["monto"];?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<?php
include '../footer.php';
?>
