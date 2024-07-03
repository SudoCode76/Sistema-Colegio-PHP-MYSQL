<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreCurso = $_POST["nombreCurso"];
    $nivel = $_POST["nivel"];


    $sql = "INSERT INTO CURSO (nombreCurso, nivel) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $nombreCurso, $nivel);

    if ($stmt->execute()) {
        echo "Nuevo curso añadido correctamente";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al añadir el curso: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
}

include '../header.php';
?>

<h1>Añadir Curso</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
        <label for="nombreCurso">Nombre del Curso:</label>
        <input type="text" class="form-control" id="nombreCurso" name="nombreCurso" required>
    </div>
    <div class="form-group">
        <label for="nivel">Nivel:</label>
        <input type="text" class="form-control" id="nivel" name="nivel" required>
    </div>

    <button type="submit" class="btn btn-primary">Añadir</button>
</form>

<?php
include '../footer.php';
?>
