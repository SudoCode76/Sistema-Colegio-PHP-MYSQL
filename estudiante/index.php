<?php
include '../conexion.php';
include '../header.php';
?>
<div class="container-fluid">
    <h1 class="text-center mt-5 text-light">Lista de Estudiantes</h1>
    <!-- Botón para añadir un nuevo estudiante -->
    <div class="mb-3 text-right">
        <a href="anadir.php" class="btn btn-success">Añadir Estudiante</a>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped w-100">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Nacionalidad</th>
                    <th>Género</th>
                    <th>Tutor</th>
                    <th>Dirección</th>
                    <th>Estado</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Celular</th>
                    <th>Correo</th>
                    <th>CodPadre</th>
                    <th>CodAsistencia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM ESTUDIANTE";
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["codEstudiante"]. "</td>
                                <td>" . $row["cedulaIdEstudiante"]. "</td>
                                <td>" . $row["nombre"]. "</td>
                                <td>" . $row["apellido"]. "</td>
                                <td>" . $row["nacionalidad"]. "</td>
                                <td>" . $row["genero"]. "</td>
                                <td>" . $row["tutor"]. "</td>
                                <td>" . $row["direccion"]. "</td>
                                <td>" . $row["estado"]. "</td>
                                <td>" . $row["fechaNacimiento"]. "</td>
                                <td>" . $row["celular"]. "</td>
                                <td>" . $row["correo"]. "</td>
                                <td>" . $row["codPadre"]. "</td>
                                <td>" . $row["codAsistencia"]. "</td>
                                <td>
                                    <a href='editar.php?id=".$row["codEstudiante"]."' class='btn btn-primary btn-sm'>Editar</a>
                                    <a href='eliminar.php?id=".$row["codEstudiante"]."' class='btn btn-danger btn-sm'>Eliminar</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='15' class='text-center'>No hay estudiantes</td></tr>";
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
