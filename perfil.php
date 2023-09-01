<!doctype html>
<html lang="en">

<head>
    <title>Perfil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

    <?php $paginaActual = "perfil";
    include 'modulos/template/navbar.php' ?>
    <?php
    include('conexion.php');

    if ($_SESSION["idUser"]) {
        $idUser = $_SESSION["idUser"];
        $sql = "SELECT * FROM users_login, users_data WHERE users_login.idUser = users_data.idUser AND users_login.idUser = ?;";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$idUser]);
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>

    <main>
        <form class="form-group container p-2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nombre">Nombre:</label>
            <input class="form-control" type="text" name="nombre" value="<?php echo $user_data['nombre'] ?>" required><br>

            <label for="apellidos">Apellidos:</label>
            <input class="form-control" type="text" name="apellidos" value="<?php echo $user_data['apellidos'] ?>" required><br>

            <label for="email">Email:</label>
            <input class="form-control" type="email" name="email" value="<?php echo $user_data['email'] ?>" required><br>

            <label for="telefono">Teléfono:</label>
            <input class="form-control" type="text" name="telefono" value="<?php echo $user_data['telefono'] ?>" required><br>

            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input class="form-control" type="date" name="fecha_nacimiento" value="<?php echo $user_data['fecha_nacimiento'] ?>"
                required><br>

            <label for="direccion">Dirección:</label>
            <textarea class="form-control" name="direccion" value="<?php echo $user_data['direccion'] ?>"></textarea><br>

            <label for="sexo">Sexo:</label>
            <select class="form-control" name="sexo">
                <option value="Masculino" <?php if ($user_data['sexo'] == 'Masculino')
                    echo 'selected'; ?>>
                    Masculino</option>
                <option value="Femenino" <?php if ($user_data['sexo'] == 'Femenino')
                    echo 'selected'; ?>>Femenino
                </option>
            </select>

            <label for="usuario">Usuario:</label>
            <input class="form-control" readonly type="text" name="usuario" value="<?php echo $user_data['usuario'] ?>" required><br>

            <label for="password">Contraseña:</label>
            <input class="form-control" type="password" name="password" required><br>

            <input class="form-control btn btn-primary" type="submit" value="Modificar">
        </form>
    </main>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>
</body>

</html>