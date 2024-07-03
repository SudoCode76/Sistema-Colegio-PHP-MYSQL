<?php
include '../conexion.php';

$codEmpleado = $_GET["id"];

$sql = "CALL EliminarEmpleado(?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $codEmpleado);

if ($stmt->execute()) {
    echo "Empleado eliminado correctamente";
} else {
    echo "Error al eliminar el empleado: " . $conexion->error;
}

$stmt->close();
$conexion->close();
header("Location: index.php");
exit();
?>
