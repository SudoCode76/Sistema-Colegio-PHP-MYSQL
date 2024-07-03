<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codMateria = $_POST["codMateria"];
    $nombreMateria = $_POST["nombreMateria"];
    $gestion = $_POST["gestion"];

    $sql = "UPDATE MATERIA SET nombreMateria=?, gestion=? WHERE codMateria=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssi", $nombreMateria, $gestion, $codMateria);

    if ($stmt->execute()) {
        echo "Materia actualizada correctamente";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar la materia: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    $codMateria = $_GET["id"];
    $sql = "SELECT * FROM MATERIA WHERE codMateria=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $codMateria);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();
}

include '../header.php';
?>

<h1>Editar Materia</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="hidden" name="codMateria" value="<?php echo $row["codMateria"];?>">
    <div class="form-group">
        <label for="nombreMateria">Nombre de la Materia:</label>
        <input type="text" class="form-control" id="nombreMateria" name="nombreMateria" value="<?php echo $row["nombreMateria"];?>" required>
    </div>
    <div class="form-group">
        <label for="gestion">Gestion:</label>
        <textarea class="form-control" id="gestion" name="gestion" rows="3" required><?php echo $row["gestion"];?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<?php
include '../footer.php';
?>
