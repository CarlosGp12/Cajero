<?php
require 'includes/funciones.php';

if (!isset($_SESSION)) {
    $auth = estaAutenticado() ?? false;
}

if (!$auth) {
    header('Location: login.php');
}
$creado = date("Y/m/d");
//conexion
require 'includes/config/database.php';
$db = conectarDB();
$resultadoget = $_GET['resultado'];
$usuarioId = $_SESSION['usuario'];
$tipoCuenta = $_SESSION['tipoCuenta'];

//consultar
$query = "UPDATE saldo SET saldo = saldo-$resultadoget WHERE (cuentaId = $tipoCuenta AND usuarioId = $usuarioId)";
//obtener resultado
$resultado = mysqli_query($db, $query);
// while ($usuarios = mysqli_fetch_assoc($resultado)){
//     echo "<pre>";
//     var_dump($usuarios);
//     echo "</pre>";
// }
$queryRetiros = "INSERT INTO retiros (cuentaId, cantidad, fecha) VALUES ($tipoCuenta , $resultadoget, '$creado')";
$resultadoRetiros = mysqli_query($db, $queryRetiros);
//incluir encabezado
include 'includes/plantillas/header.php';
?>
<div class="contenedor">
    <h1>Gracias por elegir a Cajero Amiko</h1>
    <div class="grid-3">
        
        <div class="pantalla pantalla-central">
            <label class="texto" for="">Valor retirado:</label>
            <h3 class="pantalla-text">$<?php echo $resultadoget ?? null ?></h3>
        </div>
    </div>
    <a href="index.php" class="boton flex-end">Aceptar</a>
</div>
<?php
include 'includes/plantillas/footer.php';
?>