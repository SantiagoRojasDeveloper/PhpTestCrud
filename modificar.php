<!doctype html>
<html lang="en">

<head>
    <title>Modificar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

    <?php include 'modulos/template/navbar.php' ?>
    <?php
    include('conexion.php');

    if (isset($_POST['nombre'])) {
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $email = $_POST["email"];
        $telefono = $_POST["telefono"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $direccion = $_POST["direccion"];
        $sexo = $_POST["sexo"];
        $idUser = $_POST["idUser"];

        $sql = "UPDATE users_data 
        SET nombre = ?, apellidos = ?, email = ?, telefono = ?, fecha_nacimiento = ?, direccion = ?, sexo = ? 
        WHERE idUser = ?";
        $stmt = $conexion->prepare($sql);
        
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $sql2 = "UPDATE users_login SET password = ? WHERE idUser = ?";
        $stmt2 = $conexion->prepare($sql2);

        if($stmt->execute([$nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo, $idUser])
        && $stmt2->execute([$password, $idUser])){
            header("Location: usuarios-admin.php");
        }

    } else if ($_SESSION["idUser"]) {
        $idConsult = $_GET["id"];
        $sql = "SELECT * FROM users_login, users_data WHERE users_login.idUser = users_data.idUser AND users_data.idUser = ?;";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$idConsult]);
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
    }




    ?>

    <main class="container">
        <h1>Modificación de perfil</h1>
        <form class="form-group container p-2" method="post" action="modificar.php">
            <input type="hidden" name="idUser" value="<?php echo $idConsult ?>"></input>

            <label for="nombre">Nombre:</label>
            <input class="form-control" type="text" name="nombre" value="<?php echo $user_data['nombre'] ?>"
                required><br>

            <label for="apellidos">Apellidos:</label>
            <input class="form-control" type="text" name="apellidos" value="<?php echo $user_data['apellidos'] ?>"
                required><br>

            <label for="email">Email:</label>
            <input class="form-control" type="email" name="email" value="<?php echo $user_data['email'] ?>"
                required><br>

            <label for="telefono">Teléfono:</label>
            <input class="form-control" type="text" name="telefono" value="<?php echo $user_data['telefono'] ?>"
                required><br>

            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input class="form-control" type="date" name="fecha_nacimiento"
                value="<?php echo $user_data['fecha_nacimiento'] ?>" required><br>

            <label for="direccion">Dirección:</label>
            <textarea class="form-control" name="direccion"
                value="<?php echo $user_data['direccion'] ?>"></textarea><br>

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
            <input class="form-control" readonly type="text" name="usuario" value="<?php echo $user_data['usuario'] ?>"
                required><br>
            <label for="password">Contraseña:</label>
            <input class="form-control" type="password" name="password" required><br>

            <input type="submit">
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