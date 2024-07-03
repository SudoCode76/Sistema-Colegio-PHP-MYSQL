<?php
include '../conexion.php';
include '../header.php';
?>

<div class="container-fluid">
    <h1 class="text-center mt-5 text-light">Lista de Horarios</h1>
    <div class="mb-3 text-right">
        <a href="anadir.php" class="btn btn-success">Añadir Horario</a>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped w-100">
            <thead class="thead-dark">
                <tr>
                    <th>ID Horario</th>
                    <th>CursoMateria</th>
                    <th>Periodo</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT h.codHorario, cm.codCursoMateria, h.periodo, h.horaInicio, h.horaFin 
                        FROM HORARIO h 
                        JOIN CURSOMATERIA cm ON h.codCursoMateria = cm.codCursoMateria";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["codHorario"]. "</td>
                                <td>" . $row["codCursoMateria"]. "</td>
                                <td>" . $row["periodo"]. "</td>
                                <td>" . $row["horaInicio"]. "</td>
                                <td>" . $row["horaFin"]. "</td>
                                <td>
                                    <a href='editar.php?id=".$row["codHorario"]."' class='btn btn-primary btn-sm'>Editar</a>
                                    <a href='eliminar.php?id=".$row["codHorario"]."' class='btn btn-danger btn-sm'>Eliminar</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No hay horarios</td></tr>";
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
