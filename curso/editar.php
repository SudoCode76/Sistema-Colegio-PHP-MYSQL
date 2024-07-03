<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codCurso = $_POST["codCurso"];
    $nombreCurso = $_POST["nombreCurso"];
    $nivel = $_POST["nivel"];

    $sql = "UPDATE CURSO SET nombreCurso=?, nivel=?, WHERE codCurso=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sss", $nombreCurso, $nivel, $codCurso);

    if ($stmt->execute()) {
        echo "Curso actualizado correctamente";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar el curso: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    $codCurso = $_GET["id"];
    $sql = "SELECT * FROM CURSO WHERE codCurso=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $codCurso);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();
}

include '../header.php';
?>

<h1>Editar Curso</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="hidden" name="codCurso" value="<?php echo $row["codCurso"];?>">
    <div class="form-group">
        <label for="nombreCurso">Nombre del Curso:</label>
        <input type="text" class="form-control" id="nombreCurso" name="nombreCurso" value="<?php echo $row["nombreCurso"];?>" required>
    </div>
    <div class="form-group">
        <label for="nivel">Nivel:</label>
        <input type="text" class="form-control" id="nivel" name="nivel" value="<?php echo $row["nivel"];?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<?php
include '../footer.php';
?>
