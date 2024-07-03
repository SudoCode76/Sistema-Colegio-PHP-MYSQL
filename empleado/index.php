<?php
include '../conexion.php';
include '../header.php';
?>

<div class="container-fluid">
    <h1 class="text-center mt-5 text-light">Lista de Empleados</h1>
    <div class="mb-3 text-right">
        <a href="anadir.php" class="btn btn-success">Añadir Empleado</a>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped w-100">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Tipo</th>
                    <th>Dirección</th>
                    <th>Celular</th>
                    <th>Correo</th>
                    <th>Estado</th>
                    <th>Salario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM VistaEmpleadosSalario";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["codEmpleado"]. "</td>
                                <td>" . $row["cedulaIdEmpleado"]. "</td>
                                <td>" . $row["nombre"]. "</td>
                                <td>" . $row["apellido"]. "</td>
                                <td>" . $row["tipoEmpleado"]. "</td>
                                <td>" . $row["direccion"]. "</td>
                                <td>" . $row["celular"]. "</td>
                                <td>" . $row["correo"]. "</td>
                                <td>" . $row["estado"]. "</td>
                                <td>" . $row["salario"]. "</td>
                                <td>
                                    <a href='editar.php?id=".$row["codEmpleado"]."' class='btn btn-primary btn-sm'>Editar</a>
                                    <a href='eliminar.php?id=".$row["codEmpleado"]."' class='btn btn-danger btn-sm'>Eliminar</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='11' class='text-center'>No hay empleados</td></tr>";
                }
                $conexion->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include '../footer.php';
?>
