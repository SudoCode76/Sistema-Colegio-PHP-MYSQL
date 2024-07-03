<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codCursoMateria = $_POST["codCursoMateria"];
    $periodo = $_POST["periodo"];
    $horaInicio = $_POST["horaInicio"];
    $horaFin = $_POST["horaFin"];

    $sql = "INSERT INTO HORARIO (codCursoMateria, periodo, horaInicio, horaFin) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("isss", $codCursoMateria, $periodo, $horaInicio, $horaFin);

    if ($stmt->execute()) {
        echo "Nuevo horario añadido correctamente";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al añadir el horario: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
}

include '../header.php';
?>

<h1>Añadir Horario</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
        <label for="codCursoMateria">CursoMateria:</label>
        <select class="form-control" id="codCursoMateria" name="codCursoMateria" required>
            <?php
            $sql = "SELECT codCursoMateria FROM CURSOMATERIA";
            $result = $conexion->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["codCursoMateria"] . "'>" . $row["codCursoMateria"] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="periodo">Periodo:</label>
        <input type="text" class="form-control" id="periodo" name="periodo" required>
    </div>
    <div class="form-group">
        <label for="horaInicio">Hora Inicio:</label>
        <input type="time" class="form-control" id="horaInicio" name="horaInicio" required>
    </div>
    <div class="form-group">
        <label for="horaFin">Hora Fin:</label>
        <input type="time" class="form-control" id="horaFin" name="horaFin" required>
    </div>
    <button type="submit" class="btn btn-primary">Añadir</button>
</form>

<?php
include '../footer.php';
?>
