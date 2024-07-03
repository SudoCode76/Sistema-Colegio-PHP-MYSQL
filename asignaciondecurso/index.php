<?php
include '../conexion.php';
include '../header.php';
?>

<div class="container-fluid">
    <h1 class="text-center mt-5 text-light">Lista de Asignaciones de Curso</h1>
    <div class="mb-3 text-right">
        <a href="anadir.php" class="btn btn-success">Asignar Curso</a>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped w-100">
            <thead class="thead-dark">
                <tr>
                    <th>ID Asignación</th>
                    <th>Empleado</th>
                    <th>CursoMateria</th>
                    <th>Fecha de Asignación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT ac.codAsignacion, e.nombre AS nombreEmpleado, cm.codCursoMateria, ac.fechaAsignacion 
                        FROM ASIGNACIONCURSO ac 
                        JOIN EMPLEADO e ON ac.codEmpleado = e.codEmpleado 
                        JOIN CURSOMATERIA cm ON ac.codCursoMateria = cm.codCursoMateria";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["codAsignacion"]. "</td>
                                <td>" . $row["nombreEmpleado"]. "</td>
                                <td>" . $row["codCursoMateria"]. "</td>
                                <td>" . $row["fechaAsignacion"]. "</td>
                                <td>
                                    <a href='editar.php?id=".$row["codAsignacion"]."' class='btn btn-primary btn-sm'>Editar</a>
                                    <a href='eliminar.php?id=".$row["codAsignacion"]."' class='btn btn-danger btn-sm'>Eliminar</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No hay asignaciones de curso</td></tr>";
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
