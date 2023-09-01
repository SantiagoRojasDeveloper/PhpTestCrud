<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <?php $paginaActual = "registro";
    include 'modulos/template/navbar.php' ?>
    <h1>Registro</h1>

    <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>

    <?php
    include('conexion.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $email = $_POST["email"];
        $telefono = $_POST["telefono"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $direccion = $_POST["direccion"];
        $usuario = $_POST["usuario"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $sexo = $_POST["sexo"];
        $rol = "user";

        $sql = "INSERT INTO users_data (nombre, apellidos, email, telefono, fecha_nacimiento, direccion, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo]);

        $lastInsertId = $conexion->lastInsertId();

        $sql = "INSERT INTO users_login (idUser, usuario, password, rol) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$lastInsertId, $usuario, $password, $rol]);

        echo "Registro exitoso. <a href='login.php'>Inicia sesión aquí</a>.";
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" required><br>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" required><br>

        <label for="direccion">Dirección:</label>
        <textarea name="direccion"></textarea><br>

        <label for="sexo">Sexo:</label>
        <select name="sexo">
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
        </select>

        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Registrarse">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>
</body>

</html>