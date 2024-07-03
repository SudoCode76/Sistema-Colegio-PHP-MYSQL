<?php
include '../conexion.php';

$codSalario = $_GET["id"];

$sql = "DELETE FROM SALARIO WHERE codSalario=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $codSalario);

if ($stmt->execute()) {
    echo "Salario eliminado correctamente";
} else {
    echo "Error al eliminar el salario: " . $conexion->error;
}

$stmt->close();
$conexion->close();
header("Location: index.php");
exit();
?>
