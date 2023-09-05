<!doctype html>
<html lang="en">

<head>
    <title>Noticias</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

    <?php
    $paginaActual = "noticias";
    include 'modulos/template/navbar.php';
    if (isset($_SESSION["idUser"])) {
        $idUser = $_SESSION["idUser"];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idUser = $_POST['idUser'];
        $titulo = $_POST['titulo'];
        $imagen = $_POST['imagen'];
        $texto = $_POST['texto'];
        $fecha = $_POST['fecha'];
        $sql = "INSERT INTO noticias (titulo, imagen, texto, fecha, idUser) VALUES (?,?,?,?,?);";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$titulo, $imagen, $texto, $fecha, $idUser]);
    }

    if (isset($_GET['create'])) {
        $showInfoCreate = true;
    }

    ?>

    <main class="d-flex flex-column container my-2 align-items-center gap-2">
        <h1 class="display-5 border-bottom">NOTICIAS</h1>
        <div
            class="table-responsive justify-content-evenly d-flex gap-2 flex-wrap 
            <?php echo (!$showInfoCreate) ? '' : 'd-none' ?>">
            <?php
            include('conexion.php');
            $sql = "SELECT * FROM noticias, users_data WHERE noticias.idUser = users_data.idUser";
            $resultado = $conexion->query($sql);
            if ($resultado->rowCount() > 0) {
                $showErrorNoticias = false;
                while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {

                    echo '<div class="card w-100" style="max-width: 30%; height: 25rem; overflow: auto">';
                    echo '<img class="card-img-top" src="' . $fila['imagen'] . '" alt="Card image cap">';
                    echo '<div class="card-body d-flex flex-column justify-content-between">';
                    echo '<h5 class="card-title">' . $fila['titulo'] . '</h5>';
                    echo '<h6 class="card-subtitle mb-2 text-muted">'.$fila['nombre'].'</h6>';
                    echo '<input type="date" class="form-control" value="' . $fila['fecha'] . '" readonly>';
                    echo '<p class="card-text">' . $fila['texto'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                $showErrorNoticias = true;
            }
            ?>
        </div>

        <small class="<?php echo ($showErrorNoticias == true) ? '' : 'd-none' ?> text-danger">No hay noticias
            disponibles</small>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>
</body>

</html>