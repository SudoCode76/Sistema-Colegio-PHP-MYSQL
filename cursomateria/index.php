<?php
include '../conexion.php';
include '../header.php';
?>

<div class="container-fluid">
    <h1 class="text-center mt-5 text-light">Lista de CursoMateria</h1>
    <div class="mb-3 text-right">
        <a href="anadir.php" class="btn btn-success">Añadir CursoMateria</a>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped w-100">
            <thead class="thead-dark">
                <tr>
                    <th>ID CursoMateria</th>
                    <th>Curso</th>
                    <th>Materia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT cm.codCursoMateria, c.nombreCurso, m.nombreMateria 
                        FROM CURSOMATERIA cm 
                        JOIN CURSO c ON cm.codCurso = c.codCurso 
                        JOIN MATERIA m ON cm.codMateria = m.codMateria";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["codCursoMateria"]. "</td>
                                <td>" . $row["nombreCurso"]. "</td>
                                <td>" . $row["nombreMateria"]. "</td>
                                <td>
                                    <a href='editar.php?id=".$row["codCursoMateria"]."' class='btn btn-primary btn-sm'>Editar</a>
                                    <a href='eliminar.php?id=".$row["codCursoMateria"]."' class='btn btn-danger btn-sm'>Eliminar</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No hay asignaciones de curso y materia</td></tr>";
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
