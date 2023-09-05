<!doctype html>
<html lang="en">

<head>
    <title>Citaciones</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <?php
    $paginaActual = "citaciones";
    include 'modulos/template/navbar.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fechaActual = date('Y-m-d');
        $fecha_cita = $_POST['date'];

        $fechaActualObj = new DateTime($fechaActual);
        $fechaCitaObj = new DateTime($fecha_cita);

        if ($fechaCitaObj < $fechaActualObj) {
            echo "<h6 class='text-danger text-center'> La fecha ingresada es menor que la fecha actual. </h6>";
        } else {
            $motivo_cita = $_POST['motivo'];
            $idUser = $_SESSION['idUser'];
            $sql = "INSERT INTO citas (idUser, fecha_cita, motivo_cita) VALUES (?,?,?);";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$idUser, $fecha_cita, $motivo_cita]);
        }
    }

    $idUser = $_SESSION['idUser'];
    $sql = 'SELECT * FROM citas WHERE idUser = ?';
    $citaciones = $conexion->prepare($sql);
    $citaciones->execute([$idUser]);

    if (isset($_GET['create'])) {
        $showInfoCreate = true;
    }
    ?>

    <main class="container my-3 d-flex flex-column align-items-center gap-2">
        <a class="btn btn-primary" href="<?php echo 'citaciones.php?create=' . $idUser . ' ' ?>">Crear Cita</a>
        <div class="table-responsive w-100 <?php echo ($citaciones->rowCount() > 0) ? "" : "d-none" ?>">
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
                    while ($fila = $citaciones->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . $fila['idCita'] . '</td>';
                        echo '<td>' . $fila['fecha_cita'] . '</td>';
                        echo '<td>' . $fila['motivo_cita'] . '</td>';

                        $fechaActual = date('Y-m-d');
                        $fechaActualObj = new DateTime($fechaActual);
                        $fechaCitaObj = new DateTime($fila['fecha_cita']);
                        if ($fechaCitaObj < $fechaActualObj) {
                            echo '<td class="text-danger">Modificar</td>';
                            echo '<td class="text-danger">Eliminar</td>';
                        }else{
                            echo '<td><a href="modificar-citas.php?idCita=' . $fila['idCita'] . '">Modificar</a></td>';
                            echo '<td><a href="borrar-citas.php?idCita=' . $fila['idCita'] . '">Eliminar</a></td>';
                        }

                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="w-75<?php echo ($showInfoCreate) ? '' : 'd-none' ?>">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                class="d-flex flex-column w-100 gap-2">
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
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>
</body>

</html>