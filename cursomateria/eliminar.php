<?php
include '../conexion.php';

$codCursoMateria = $_GET["id"];

$sql = "DELETE FROM CURSOMATERIA WHERE codCursoMateria=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $codCursoMateria);

if ($stmt->execute()) {
    echo "Asignación de curso y materia eliminada correctamente";
} else {
    echo "Error al eliminar la asignación: " . $conexion->error;
}

$stmt->close();
$conexion->close();
header("Location: index.php");
exit();
?>
