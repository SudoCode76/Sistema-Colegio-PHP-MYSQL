<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreMateria = $_POST["nombreMateria"];
    $gestion = $_POST["gestion"];

    $sql = "INSERT INTO MATERIA (nombreMateria, gestion) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $nombreMateria, $gestion);

    if ($stmt->execute()) {
        echo "Nueva materia añadida correctamente";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al añadir la materia: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
}

include '../header.php';
?>

<h1>Añadir Materia</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
        <label for="nombreMateria">Nombre de la Materia:</label>
        <input type="text" class="form-control" id="nombreMateria" name="nombreMateria" required>
    </div>
    <div class="form-group">
        <label for="gestion">Gestion:</label>
        <textarea class="form-control" id="gestion" name="gestion" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Añadir</button>
</form>

<?php
include '../footer.php';
?>
