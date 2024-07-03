<?php
include '../conexion.php';

$codHorario = $_GET["id"];

$sql = "DELETE FROM HORARIO WHERE codHorario=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $codHorario);

if ($stmt->execute()) {
    echo "Horario eliminado correctamente";
} else {
    echo "Error al eliminar el horario: " . $conexion->error;
}

$stmt->close();
$conexion->close();
header("Location: index.php");
exit();
?>