<?php
require 'includes/funciones.php';

if (!isset($_SESSION)) {
    $auth = estaAutenticado() ?? false;
}

if (!$auth) {
    header('Location: login.php');
}
//conexion
require 'includes/config/database.php';
$db = conectarDB();
$resultadoget = $_GET['resultado'];
$usuarioId = $_SESSION['usuario'];
$tipoCuenta = $_SESSION['tipoCuenta'];

echo "<pre>";
var_dump($_GET);
echo "</pre>";
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
//consultar
$query = "UPDATE saldo SET saldo = saldo-$resultadoget WHERE (cuentaId = $tipoCuenta AND usuarioId = $usuarioId)";
//obtener resultado
$resultado = mysqli_query($db, $query);
// while ($usuarios = mysqli_fetch_assoc($resultado)){
//     echo "<pre>";
//     var_dump($usuarios);
//     echo "</pre>";
// }

//incluir encabezado
include 'includes/plantillas/header.php';
?>
<div class="grid-3">
    <div class="pantalla pantalla-central">
        <label class="texto" for="">Valor retirado:</label>
        <h3 class="pantalla-text">$<?php echo $resultadoget ?? null ?></h3>
    </div>
</div>

<?php
include 'includes/plantillas/footer.php';
?>