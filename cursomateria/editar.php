<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codCursoMateria = $_POST["codCursoMateria"];
    $codCurso = $_POST["codCurso"];
    $codMateria = $_POST["codMateria"];

    $sql = "UPDATE CURSOMATERIA SET codCurso=?, codMateria=? WHERE codCursoMateria=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iii", $codCurso, $codMateria, $codCursoMateria);

    if ($stmt->execute()) {
        echo "Asignación de curso y materia actualizada correctamente";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar la asignación: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    $codCursoMateria = $_GET["id"];
    $sql = "SELECT * FROM CURSOMATERIA WHERE codCursoMateria=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $codCursoMateria);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();
}

include '../header.php';
?>

<h1>Editar CursoMateria</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="hidden" name="codCursoMateria" value="<?php echo $row["codCursoMateria"];?>">
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
        <label for="codMateria">Materia:</label>
        <select class="form-control" id="codMateria" name="codMateria" required>
            <?php
            $sql = "SELECT codMateria, nombreMateria FROM MATERIA";
            $result = $conexion->query($sql);
            while ($materia = $result->fetch_assoc()) {
                $selected = ($materia["codMateria"] == $row["codMateria"]) ? "selected" : "";
                echo "<option value='" . $materia["codMateria"] . "' $selected>" . $materia["nombreMateria"] . "</option>";
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<?php
include '../footer.php';
?>
