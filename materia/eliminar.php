<?php
include '../conexion.php';

$codMateria = $_GET["id"];

$sql = "DELETE FROM MATERIA WHERE codMateria=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $codMateria);

if ($stmt->execute()) {
    echo "Materia eliminada correctamente";
} else {
    echo "Error al eliminar la materia: " . $conexion->error;
}

$stmt->close();
$conexion->close();
header("Location: index.php");
exit();
?>
