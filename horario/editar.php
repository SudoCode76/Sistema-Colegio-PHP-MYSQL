<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codHorario = $_POST["codHorario"];
    $codCursoMateria = $_POST["codCursoMateria"];
    $periodo = $_POST["periodo"];
    $horaInicio = $_POST["horaInicio"];
    $horaFin = $_POST["horaFin"];

    $sql = "UPDATE HORARIO SET codCursoMateria=?, periodo=?, horaInicio=?, horaFin=? WHERE codHorario=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("isssi", $codCursoMateria, $periodo, $horaInicio, $horaFin, $codHorario);

    if ($stmt->execute()) {
        echo "Horario actualizado correctamente";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar el horario: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    $codHorario = $_GET["id"];
    $sql = "SELECT * FROM HORARIO WHERE codHorario=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $codHorario);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();
}

include '../header.php';
?>

<h1>Editar Horario</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="hidden" name="codHorario" value="<?php echo $row["codHorario"];?>">
    <div class="form-group">
        <label for="codCursoMateria">CursoMateria:</label>
        <select class="form-control" id="codCursoMateria" name="codCursoMateria" required>
            <?php
            $sql = "SELECT codCursoMateria FROM CURSOMATERIA";
            $result = $conexion->query($sql);
            while ($cursoMateria = $result->fetch_assoc()) {
                $selected = ($cursoMateria["codCursoMateria"] == $row["codCursoMateria"]) ? "selected" : "";
                echo "<option value='" . $cursoMateria["codCursoMateria"] . "' $selected>" . $cursoMateria["codCursoMateria"] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="periodo">Periodo:</label>
        <input type="text" class="form-control" id="periodo" name="periodo" value="<?php echo $row["periodo"];?>" required>
 
