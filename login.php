<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

    <?php $paginaActual = "login";
    include 'modulos/template/navbar.php' ?>

    <main class="container d-flex flex-column justify-content-center align-items-center my-5">
        <h1 class="display-5">Iniciar Sesión</h1>

        <?php

        include('conexion.php');

        function validarCredenciales($usuario, $password, $conexion)
        {
            $sql = "SELECT * FROM users_login WHERE usuario = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$usuario]);
            $usuarioEncontrado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuarioEncontrado && password_verify($password, $usuarioEncontrado['password'])) {
                session_start();
                $_SESSION["idUser"] = $usuarioEncontrado['idUser'];
                return true;
            } else {
                return false;
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = $_POST["usuario"];
            $password = $_POST["password"];
            if (validarCredenciales($usuario, $password, $conexion)) {
                session_start();
                $_SESSION["usuario"] = $usuario;
                header("Location: index.php");
                exit();
            } else {
                echo "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
            }
        }
        ?>

        <form class="w-50 border rounded p-3" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="usuario">Usuario:</label>
            <input class="form-control" type="text" name="usuario" required><br>

            <label for="password">Contraseña:</label>
            <input class="form-control" type="password" name="password" required><br>

            <input class="form-control btn btn-primary" type="submit" value="Iniciar Sesión">
        </form>
        <p class="my-3">¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>
</body>

</html>