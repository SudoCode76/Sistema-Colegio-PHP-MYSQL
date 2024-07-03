<?php
include '../conexion.php';
include '../header.php';
?>

<div class="container-fluid">
    <h1 class="text-center mt-5">Lista de Padres</h1>
    <div class="mb-3 text-right">
        <a href="anadir.php" class="btn btn-success">Añadir Padre</a>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped w-100">
            <thead class="thead-dark">
                <tr>
                    <th>ID Padre</th>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Estado</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Parentesco</th>
                    <th>Género</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM PADRE";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["codPadre"]. "</td>
                                <td>" . $row["cedulaId"]. "</td>
                                <td>" . $row["nombre"]. "</td>
                                <td>" . $row["apellido"]. "</td>
                                <td>" . $row["estado"]. "</td>
                                <td>" . $row["direccion"]. "</td>
                                <td>" . $row["telefono"]. "</td>
                                <td>" . $row["parentesco"]. "</td>
                                <td>" . $row["genero"]. "</td>
                                <td>
                                    <a href='editar.php?id=".$row["codPadre"]."' class='btn btn-primary btn-sm'>Editar</a>
                                    <a href='eliminar.php?id=".$row["codPadre"]."' class='btn btn-danger btn-sm'>Eliminar</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10' class='text-center'>No hay padres</td></tr>";
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
