<?php
include '../conexion.php';

$codPadre = $_GET["id"];

$sql = "DELETE FROM PADRE WHERE codPadre=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $codPadre);

if ($stmt->execute()) {
    echo "Padre eliminado correctamente";
} else {
    echo "Error al eliminar el padre: " . $conexion->error;
}

$stmt->close();
$conexion->close();
header("Location: index.php");
exit();
?>
