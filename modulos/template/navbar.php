<?php include('conexion.php');
session_start();
if (isset($_SESSION["idUser"])) {
    $showLoginOptions = false;
    if ($_SESSION["idUser"]) {
        $idUser = $_SESSION["idUser"];
        $sql = "SELECT rol FROM users_login, users_data WHERE users_login.idUser = users_data.idUser AND users_login.idUser = ?;";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$idUser]);
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $rol = $user_data['rol'];
    }
}else{
    $showLoginOptions = true;
}

?>

<?php
if (isset($_POST["logout"])) {
    session_destroy();
    unset($_SESSION['idUser']);
    header("Location: login.php");
    exit();
}
?>

<nav class="navbar navbar-expand navbar-light bg-light">
    <ul class="nav navbar-nav">
        <div class="<?php echo ($showLoginOptions) ? '':'d-none' ?> d-flex">
        <li class="nav-item">
            <a id="login" class="nav-link <?php echo ($paginaActual == 'login') ? 'active' : ''; ?>"
                href="login.php">Login</a>
        </li>
        <li class="nav-item">
            <a id="registro" class="nav-link <?php echo ($paginaActual == 'registro') ? 'active' : ''; ?>"
                href="registro.php">Registro</a>
        </li>
        </div>
        <li class="nav-item">
            <a id="index" class="nav-link <?php echo ($paginaActual == 'index') ? 'active' : ''; ?>"
                href="index.php">Index</a>
        </li>
        <li class="nav-item">
            <a id="noticias" class="nav-link <?php echo ($paginaActual == 'noticias') ? 'active' : ''; ?>"
                href="noticias.php">Noticias</a>
        </li>
        <li class="nav-item <?php echo ($rol == 'user' || $rol == 'admin') ? 'd-block' : 'd-none'; ?>">
            <a id="perfil" class="nav-link <?php echo ($paginaActual == 'perfil') ? 'active' : ''; ?>"
                href="perfil.php">Perfil</a>
        </li>
        <li class="nav-item <?php echo ($rol == 'user') ? 'd-block' : 'd-none'; ?>">
            <a id="citaciones" class="nav-link <?php echo ($paginaActual == 'citaciones') ? 'active' : ''; ?>"
                href="citaciones.php">Citaciones</a>
        </li>
        <li class="nav-item <?php echo ($rol == 'admin') ? 'd-block' : 'd-none'; ?>">
            <a id="usuarios-admin" class="nav-link <?php echo ($paginaActual == 'usuarios-admin') ? 'active' : ''; ?>"
                href="usuarios-admin.php">Usuarios Administración</a>
        </li>
        <li class="nav-item <?php echo ($rol == 'admin') ? 'd-block' : 'd-none'; ?>">
            <a id="citas-admin" class="nav-link <?php echo ($paginaActual == 'citas-admin') ? 'active' : ''; ?>"
                href="citas-admin.php">Citas Administración</a>
        </li>
        <li class="nav-item <?php echo ($rol == 'admin') ? 'd-block' : 'd-none'; ?>">
            <a id="noticias-admin" class="nav-link <?php echo ($paginaActual == 'noticias-admin') ? 'active' : ''; ?>"
                href="noticias-admin.php">Noticias Administración</a>
        </li>
        <form class="<?php echo (!$showLoginOptions) ? '':'d-none' ?>" action="logout.php" method="post">
            <li class="nav-item">
                <button class="btn text-danger" type="submit" name="logout" class="nav-link">Cerrar Sesión</button>
            </li>
        </form>

    </ul>
</nav>