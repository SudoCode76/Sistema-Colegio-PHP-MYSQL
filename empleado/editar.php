<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codEmpleado = $_POST["codEmpleado"];
    $cedulaIdEmpleado = $_POST["cedulaIdEmpleado"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $tipoEmpleado = $_POST["tipoEmpleado"];
    $direccion = $_POST["direccion"];
    $celular = $_POST["celular"];
    $correo = $_POST["correo"];
    $estado = $_POST["estado"];
    $salario = $_POST["salario"];

    $sqlEmpleado = "UPDATE EMPLEADO SET cedulaIdEmpleado=?, nombre=?, apellido=?, tipoEmpleado=?, direccion=?, celular=?, correo=?, estado=? WHERE codEmpleado=?";
    $stmtEmpleado = $conexion->prepare($sqlEmpleado);
    $stmtEmpleado->bind_param("ssssssssi", $cedulaIdEmpleado, $nombre, $apellido, $tipoEmpleado, $direccion, $celular, $correo, $estado, $codEmpleado);

    if ($stmtEmpleado->execute()) {
        $sqlSalario = "UPDATE SALARIO SET monto=? WHERE codEmpleado=?";
        $stmtSalario = $conexion->prepare($sqlSalario);
        $stmtSalario->bind_param("di", $salario, $codEmpleado);

        if ($stmtSalario->execute()) {
            echo "Empleado actualizado correctamente";
            header("Location: index.php");
            exit();
        } else {
            echo "Error al actualizar el salario: " . $conexion->error;
        }
    } else {
        echo "Error al actualizar el empleado: " . $conexion->error;
    }

    $stmtEmpleado->close();
    $stmtSalario->close();
    $conexion->close();
} else {
    $codEmpleado = $_GET["id"];
    $sql = "SELECT * FROM EMPLEADO WHERE codEmpleado=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $codEmpleado);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $sqlSalario = "SELECT monto FROM SALARIO WHERE codEmpleado=?";
    $stmtSalario = $conexion->prepare($sqlSalario);
    $stmtSalario->bind_param("i", $codEmpleado);
    $stmtSalario->execute();
    $resultSalario = $stmtSalario->get_result();
    $rowSalario = $resultSalario->fetch_assoc();

    $stmt->close();
    $stmtSalario->close();
}

include '../header.php';
?>

<h1>Editar Empleado</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="hidden" name="codEmpleado" value="<?php echo $row["codEmpleado"];?>">
    <div class="form-group">
        <label for="cedulaIdEmpleado">Cédula:</label>
        <input type="text" class="form-control" id="cedulaIdEmpleado" name="cedulaIdEmpleado" value="<?php echo $row["cedulaIdEmpleado"];?>" required>
    </div>
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row["nombre"];?>" required>
    </div>
    <div class="form-group">
        <label for="apellido">Apellido:</label>
        <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $row["apellido"];?>" required>
    </div>
    <div class="form-group">
        <label for="tipoEmpleado">Tipo de Empleado:</label>
        <input type="text" class="form-control" id="tipoEmpleado" name="tipoEmpleado" value="<?php echo $row["tipoEmpleado"];?>" required>
    </div>
    <div class="form-group">
        <label for="direccion">Dirección:</label>
        <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $row["direccion"];?>">
    </div>
    <div class="form-group">
        <label for="celular">Celular:</label>
        <input type="text" class="form-control" id="celular" name="celular" value="<?php echo $row["celular"];?>">
    </div>
    <div class="form-group">
        <label for="correo">Correo:</label>
        <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $row["correo"];?>">
    </div>
    <div class="form-group">
        <label for="estado">Estado:</label>
        <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $row["estado"];?>">
    </div>
    <div class="form-group">
        <label for="salario">Salario:</label>
        <input type="number" step="0.01" class="form-control" id="salario" name="salario" value="<?php echo $rowSalario["monto"];?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<?php
include '../footer.php';
?>
