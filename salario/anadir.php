<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codEmpleado = $_POST["codEmpleado"];
    $monto = $_POST["monto"];

    $sql = "INSERT INTO SALARIO (codEmpleado, monto) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("id", $codEmpleado, $monto);

    if ($stmt->execute()) {
        echo "Nuevo salario añadido correctamente";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al añadir el salario: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
}

include '../header.php';
?>

<h1>Añadir Salario</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
        <label for="codEmpleado">Empleado:</label>
        <select class="form-control" id="codEmpleado" name="codEmpleado" required>
            <?php
            $sql = "SELECT codEmpleado, nombre, apellido FROM EMPLEADO";
            $result = $conexion->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["codEmpleado"] . "'>" . $row["nombre"] . " " . $row["apellido"] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="monto">Monto:</label>
        <input type="number" step="0.01" class="form-control" id="monto" name="monto" required>
    </div>
    <button type="submit" class="btn btn-primary">Añadir</button>
</form>

<?php
include '../footer.php';
?>
