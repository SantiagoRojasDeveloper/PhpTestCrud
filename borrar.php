<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <main>
        <?php $paginaActual = "usuarios-admin";
        include 'modulos/template/navbar.php' ?>

        <?php
        include("conexion.php");
        $idConsult = $_GET["id"];

        $sql1 = "DELETE FROM users_data WHERE users_data.idUser = ?";
        $stmt1 = $conexion->prepare($sql1);

        $sql2 = "DELETE FROM users_login WHERE users_login.idUser = ?";
        $stmt2 = $conexion->prepare($sql2);

        if($stmt2->execute([$idConsult]) && $stmt1->execute([$idConsult])){
            echo "<h1>Eliminación Exitosa</h1>";
            echo "<a href='usuarios-admin.php'>Volver</a>";
        }else{
            echo "Error al eliminar;";
        };

        ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>
</body>

</html>