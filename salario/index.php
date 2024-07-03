<?php
include '../conexion.php';
include '../header.php';
?>

<div class="container-fluid">
    <h1 class="text-center mt-5 text-light">Lista de Salarios</h1>
    <div class="mb-3 text-right">
        <a href="anadir.php" class="btn btn-success">Añadir Salario</a>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped w-100">
            <thead class="thead-dark">
                <tr>
                    <th>ID Empleado</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Monto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT s.codSalario, e.nombre, e.apellido, s.monto 
                        FROM SALARIO s 
                        JOIN EMPLEADO e ON s.codEmpleado = e.codEmpleado";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["codSalario"]. "</td>
                                <td>" . $row["nombre"]. "</td>
                                <td>" . $row["apellido"]. "</td>
                                <td>" . $row["monto"]. "</td>
                                <td>
                                    <a href='editar.php?id=".$row["codSalario"]."' class='btn btn-primary btn-sm'>Editar</a>
                                    <a href='eliminar.php?id=".$row["codSalario"]."' class='btn btn-danger btn-sm'>Eliminar</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No hay salarios</td></tr>";
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
