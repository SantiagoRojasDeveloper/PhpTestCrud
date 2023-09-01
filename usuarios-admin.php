<!doctype html>
<html lang="en">

<head>
    <title>Usuarios Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

    <?php $paginaActual = "usuarios-admin";
    include 'modulos/template/navbar.php' ?>

    <main class="d-flex flex-column container my-2 align-items-center gap-2">
        <a href="registro-admin.php" class="btn btn-primary" class="w-25">Crear Usuario</a>
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Email</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Modificar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        include('conexion.php');
                        $sql = "SELECT * FROM users_data as data, users_login as login WHERE data.idUser = login.idUser";
                        $resultado = $conexion->query($sql);
                        if($resultado->rowCount() > 0){
                            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td>' . $fila['nombre'] . '</td>';
                                echo '<td>' . $fila['apellidos'] . '</td>';
                                echo '<td>' . $fila['email'] . '</td>';
                                echo '<td>' . $fila['usuario'] . '</td>';
                                echo '<td> <a href="modificar.php?id=' . $fila['idUser'] . '">Modificar</a> </td>';
                                echo '<td> <a href="borrar.php?id=' . $fila['idUser'] . '">Borrar</a> </td>';
                                echo '</tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
        


    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>
</body>

</html>