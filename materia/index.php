<?php
include '../conexion.php';
include '../header.php';
?>

<div class="container-fluid">
    <h1 class="text-center mt-5 text-light">Lista de Materias</h1>
    <div class="mb-3 text-right">
        <a href="anadir.php" class="btn btn-success">Añadir Materia</a>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped w-100">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Gestion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM MATERIA";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["codMateria"]. "</td>
                                <td>" . $row["nombreMateria"]. "</td>
                                <td>" . $row["gestion"]. "</td>
                                <td>
                                    <a href='editar.php?id=".$row["codMateria"]."' class='btn btn-primary btn-sm'>Editar</a>
                                    <a href='eliminar.php?id=".$row["codMateria"]."' class='btn btn-danger btn-sm'>Eliminar</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No hay materias</td></tr>";
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
