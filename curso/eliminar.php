<?php
include '../conexion.php';

$codCurso = $_GET["id"];

$sql = "DELETE FROM CURSO WHERE codCurso=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $codCurso);

if ($stmt->execute()) {
    echo "Curso eliminado correctamente";
} else {
    echo "Error al eliminar el curso: " . $conexion->error;
}

$stmt->close();
$conexion->close();
header("Location: index.php");
exit();
?>
