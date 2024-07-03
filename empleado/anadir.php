<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedulaIdEmpleado = $_POST["cedulaIdEmpleado"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $tipoEmpleado = $_POST["tipoEmpleado"];
    $direccion = $_POST["direccion"];
    $celular = $_POST["celular"];
    $correo = $_POST["correo"];
    $estado = $_POST["estado"];
    $salario = $_POST["salario"];

    $sqlEmpleado = "INSERT INTO EMPLEADO (cedulaIdEmpleado, nombre, apellido, tipoEmpleado, direccion, celular, correo, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtEmpleado = $conexion->prepare($sqlEmpleado);
    $stmtEmpleado->bind_param("ssssssss", $cedulaIdEmpleado, $nombre, $apellido, $tipoEmpleado, $direccion, $celular, $correo, $estado);

    if ($stmtEmpleado->execute()) {
        $codEmpleado = $stmtEmpleado->insert_id;
        $sqlSalario = "INSERT INTO SALARIO (codEmpleado, monto) VALUES (?, ?)";
        $stmtSalario = $conexion->prepare($sqlSalario);
        $stmtSalario->bind_param("id", $codEmpleado, $salario);

        if ($stmtSalario->execute()) {
            echo "Nuevo empleado añadido correctamente";
            header("Location: index.php");
            exit();
        } else {
            echo "Error al añadir el salario: " . $conexion->error;
        }
    } else {
        echo "Error al añadir el empleado: " . $conexion->error;
    }

    $stmtEmpleado->close();
    $stmtSalario->close();
    $conexion->close();
}

include '../header.php';
?>

<h1>Añadir Empleado</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
        <label for="cedulaIdEmpleado">Cédula:</label>
        <input type="text" class="form-control" id="cedulaIdEmpleado" name="cedulaIdEmpleado" required>
    </div>
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="form-group">
        <label for="apellido">Apellido:</label>
        <input type="text" class="form-control" id="apellido" name="apellido" required>
    </div>
    <div class="form-group">
        <label for="tipoEmpleado">Tipo de Empleado:</label>
        <input type="text" class="form-control" id="tipoEmpleado" name="tipoEmpleado" required>
    </div>
    <div class="form-group">
        <label for="direccion">Dirección:</label>
        <input type="text" class="form-control" id="direccion" name="direccion">
    </div>
    <div class="form-group">
        <label for="celular">Celular:</label>
        <input type="text" class="form-control" id="celular" name="celular">
    </div>
    <div class="form-group">
        <label for="correo">Correo:</label>
        <input type="email" class="form-control" id="correo" name="correo" required>
    </div>
    <div class="form-group">
        <label for="estado">Estado:</label>
        <input type="text" class="form-control" id="estado" name="estado">
    </div>
    <div class="form-group">
        <label for="salario">Salario:</label>
        <input type="number" step="0.01" class="form-control" id="salario" name="salario" required>
    </div>
    <button type="submit" class="btn btn-primary">Añadir</button>
</form>

<?php
include '../footer.php';
?>
