<!doctype html>
<html lang="en">

<head>
    <title>Citas Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

    <?php $paginaActual = "citas-admin";
    include 'modulos/template/navbar.php' ?>

    <main class="d-flex flex-column container my-2 align-items-center gap-2">
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Email</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Ver Citas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('conexion.php');
                    $sql = "SELECT * FROM users_data as data, users_login as login WHERE data.idUser = login.idUser";
                    $resultado = $conexion->query($sql);
                    if ($resultado->rowCount() > 0) {
                        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . $fila['nombre'] . '</td>';
                            echo '<td>' . $fila['apellidos'] . '</td>';
                            echo '<td>' . $fila['email'] . '</td>';
                            echo '<td>' . $fila['usuario'] . '</td>';
                            echo '<td> <a href="citas-admin.php?find=' . $fila['idUser'] . '&usuario='.$fila['usuario'].' ">Ver Citas</a> </td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fecha_cita = $_POST['date'];
            $motivo_cita = $_POST['motivo'];
            $idUser = $_POST['idUser'];
            $sql = "INSERT INTO citas (idUser, fecha_cita, motivo_cita) VALUES (?,?,?);";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$idUser, $fecha_cita, $motivo_cita]);
        }

        if (isset($_GET['find'])) {
            $idUserFind = $_GET['find'];
            $sql = 'SELECT * FROM citas WHERE idUser = ?';
            $infoCitas = $conexion->prepare($sql);
            $infoCitas->execute([$idUserFind]);
        }

        if (isset($_GET['usuario'])){
            $usuario = $_GET['usuario'];
        }

        if (isset($_GET['create'])) {
            $showInfoCreate = true;
        }
        ?>

        <div class="d-flex align-items-center flex-column w-100 <?php echo ($idUserFind) ? 'd-block' : 'd-none' ?>">
            <h4>Informacion del usuario <?php echo $usuario?></h4>
            <a href="<?php echo 'citas-admin.php?find=' . $idUserFind . '&create=true&usuario='.$usuario.'' ?>">Crear Cita</a>
            <small class="text-danger <?php echo ($infoCitas->rowCount() != 0) ? "d-none" : "" ?>">El usuario no tiene
                citas</small>
            <div class="table-responsive <?php echo ($infoCitas->rowCount() > 0 && !$showInfoCreate) ? "" : "d-none" ?>">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">Id Cita</th>
                            <th scope="col">Fecha Cita</th>
                            <th scope="col">Motivo</th>
                            <th scope="col">Modificar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($fila = $infoCitas->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . $fila['idCita'] . '</td>';
                            echo '<td>' . $fila['fecha_cita'] . '</td>';
                            echo '<td>' . $fila['motivo_cita'] . '</td>';
                            echo '<td><a href="modificar-citas.php?idCita='.$fila['idCita'].'">Modificar</a></td>';
                            echo '<td><a href="borrar-citas.php?idCita='.$fila['idCita'].'">Eliminar</a></td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="w-75<?php echo ($showInfoCreate) ? '' : 'd-none' ?>">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                    class="d-flex flex-column w-100 gap-2">
                    <input name="idUser" type="hidden" value="<?php echo $idUserFind ?>">
                    <div class="d-flex flex-column">
                        <label for="date">Fecha de Cita</label>
                        <input name="date" class="form-control" id="date" type="date" required>
                    </div>
                    <div class="d-flex flex-column">
                        <label for="motivo">Motivo</label>
                        <textarea name="motivo" style="resize: none;" class="form-control" id="motivo" id="" cols="30"
                            rows="10" required></textarea>
                    </div>
                    <button name="crear-cita" class="btn btn-primary" type="submit">Crear Cita</button>
                </form>
            </div>
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