<?php
include 'includes/plantillas/header.php';
require 'includes/funciones.php';
require 'includes/config/database.php';
if (!isset($_SESSION)) {
    $auth = estaAutenticado() ?? false;
}

if (!$auth) {
    header('Location: login.php');
}
$errores = [];
// echo "<pre>";
// var_dump($_SESSION['usuario']);
// echo "</pre>";
// exit;
$usuarioId = $_SESSION['usuario'];
$nombre = $_SESSION['nombre'];
$db = conectarDB();
$queryUsuario = "SELECT * FROM usuarios WHERE id = $usuarioId";
$resultadoUsuario = mysqli_query($db, $queryUsuario);
$usuario = mysqli_fetch_assoc($resultadoUsuario);
$CuentasId = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $CuentasId = mysqli_real_escape_string($db, $_POST['cuentas']);
    if (!$CuentasId) {
        $errores[] = "Elige un tipo de cuenta";
    }
    if (!empty($CuentasId)) {
        $query = "SELECT * FROM saldo WHERE (cuentaId = $CuentasId AND usuarioId = $usuarioId)";
        $resultado = mysqli_query($db, $query);
        $usuario = mysqli_fetch_assoc($resultado);
    }
}
?>

<body>

    <div class="contenedor">
        <H1 class="titulo">TRANFERENCIA</H1>
        <div class="grid-3-1">
            <div class="contenedor-campos">
                <img class="img-transf" src="img/user1.svg" alt="">
                <label class="labels" for=""><?php echo $usuario['usuario'] ?></label>
                <input class="campos" type="text" name="cantidad1" id="cuenta1" value="1200">
            </div>

            <div class="contendor-img-transf">
                <img class="img-transf" src="img/flechaDerecha.svg" alt="">
            </div>

            <div class="contenedor-campos">
                <!-- <label class="labels" for=""> Cuenta 2</label> -->

                <img class="img-transf" src="img/user2.svg" alt="">
                
                <input class="campos" type="text" name="cantidad2" id="cuenta2" value="800">
            </div>

            <div class="contenedor-formulario">
                <form>
                    <label class="labels">Transferencia</label>
                    <input class="campos" type="text" name="" id="cantidad" placeholder="Cantidad">

                </form>

            </div>

        </div>

    </div>
    <input class="boton" type="button" value="transferencia" id="transferencia" onclick="formula()">
    <script src="js/transferencia.js">

    </script>
</body>

<?php
include 'includes/plantillas/footer.php';
?>