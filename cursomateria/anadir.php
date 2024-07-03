<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codCurso = $_POST["codCurso"];
    $codMateria = $_POST["codMateria"];

    $sql = "INSERT INTO CURSOMATERIA (codCurso, codMateria) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ii", $codCurso, $codMateria);

    if ($stmt->execute()) {
        echo "Nueva asignación de curso y materia añadida correctamente";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al añadir la asignación: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
}

include '../header.php';
?>

<h1>Añadir CursoMateria</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
        <label for="codMateria">Materia:</label>
        <select class="form-control" id="codMateria" name="codMateria" required>
            <?php
            $sql = "SELECT codMateria, nombreMateria FROM MATERIA";
            $result = $conexion->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["codMateria"] . "'>" . $row["nombreMateria"] . "</option>";
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Añadir</button>
</form>

<?php
include '../footer.php';
?>
