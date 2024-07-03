<?php
include '../conexion.php';

$codAsignacion = $_GET["id"];

$sql = "DELETE FROM ASIGNACIONCURSO WHERE codAsignacion=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $codAsignacion);

if ($stmt->execute()) {
    echo "Asignación de curso eliminada correctamente";
} else {
    echo "Error al eliminar la asignación: " . $conexion->error;
}

$stmt->close();
$conexion->close();
header("Location: index.php");
exit();
?>
