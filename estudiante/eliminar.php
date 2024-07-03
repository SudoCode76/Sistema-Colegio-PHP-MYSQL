<?php
include '../conexion.php';

$codEstudiante = $_GET["id"];
$sql = "DELETE FROM ESTUDIANTE WHERE codEstudiante='$codEstudiante'";

if ($conexion->query($sql) === TRUE) {
    echo "Registro eliminado correctamente";
} else {
    echo "Error eliminando registro: " . $conexion->error;
}

$conexion->close();
header("Location: index.php");
exit();
?>
