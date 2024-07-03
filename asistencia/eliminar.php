<?php
include '../conexion.php';

$codAsistencia = $_GET["id"];

$sql = "DELETE FROM ASISTENCIA WHERE codAsistencia=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $codAsistencia);

if ($stmt->execute()) {
    echo "Asistencia eliminada correctamente";
} else {
    echo "Error al eliminar la asistencia: " . $conexion->error;
}

$stmt->close();
$conexion->close();
header("Location: index.php");
exit();
?>
