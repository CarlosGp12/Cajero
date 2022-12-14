<?php
include 'includes/plantillas/header.php';
require 'includes/config/database.php';
require 'includes/funciones.php';

if (!isset($_SESSION)) {
    $auth = estaAutenticado() ?? false;
}

if (!$auth) {
    header('Location: login.php');
}
$errores = [];

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";
// exit;

//******USUARIO*******/
$usuarioId = $_SESSION['usuario'];

$nombre = $_SESSION['nombre'];
$db = conectarDB();
$queryUsuario = "SELECT * FROM usuarios WHERE id = $usuarioId";
$resultadoUsuario = mysqli_query($db, $queryUsuario);
$usuario = mysqli_fetch_assoc($resultadoUsuario);
$num_tarjeta1 = $usuario['num_tarjeta'];
$CuentasId1 = '';
$CuentasId2 = '';
$num_tarjeta2 = '';
/******CUENTAS********/
$queryCuentas = "SELECT * FROM cuentas";
$resultadoCuentas = mysqli_query($db, $queryCuentas);
$resultadoCuentas2 = mysqli_query($db, $queryCuentas);
$cantidad = 0;
$creado = date("Y/m/d");
/******Saldo******/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $num_tarjeta2 = mysqli_real_escape_string($db, $_POST['num_tarjeta2']) ?? null;
    $CuentasId1 = mysqli_real_escape_string($db, $_POST['cuentas1']);
    $CuentasId2 = mysqli_real_escape_string($db, $_POST['cuentas2']);
    $cantidad =  $_POST['cantidad'];
    $querySaldo = "SELECT * FROM saldo WHERE (cuentaId = $CuentasId1 AND usuarioId = $usuarioId)";
    $resultadoSaldo = mysqli_query($db, $querySaldo);
    $saldo = mysqli_fetch_assoc($resultadoSaldo);
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";
    if (!$CuentasId1) {
        $errores[] = "Elija su tipo de cuenta";
    }
    if (!$cantidad) {
        $errores[] = "Ingrese la cantidad";
    }
    if (!$CuentasId2) {
        $errores[] = "Elija el tipo de cuenta";
    }
    if (($_SESSION['nun_tarjet'])=== $num_tarjeta2) {
        $errores[] = "No puede introducir su numero de tarjeta";
    }
    if (empty($errores)) {
        
        /*******************************************************************************************/
        $query = "SELECT * FROM usuarios WHERE num_tarjeta = '$num_tarjeta2'";
        $resultado = mysqli_query($db, $query);
        if (!$resultado->num_rows) {
            $errores[] = "El usuario no existe";
        }
        $usuario2 = mysqli_fetch_assoc($resultado);
        $usuarioId2 = $usuario2['id'];

        $queryAumento = "UPDATE saldo SET saldo = saldo+$cantidad where (cuentaId =$CuentasId2 AND usuarioId = $usuarioId2)";
        $resultadoAumento = mysqli_query($db, $queryAumento);
        $queryMenos = "UPDATE saldo SET saldo = saldo - $cantidad where (cuentaId =$CuentasId1 AND usuarioId = $usuarioId)";;
        $resultadoMenos = mysqli_query($db, $queryMenos);
        // echo $resultadoAumento;
        if ($resultadoMenos) {
            //Redireccionar al usuario
            $queryMovimiento =  "INSERT INTO movimiento (num_origen, num_destino, cantidad, fecha) values ($num_tarjeta1, $num_tarjeta2, $cantidad, '$creado')";
            
            $resultadoMovimiento = mysqli_query($db, $queryMovimiento);
            header('Location: index.php?resultado=1'); //Despues del "?" va el mesnaje o valor que queremos pasar
        }
    }
}
?>

<body>

    <div class="contenedor">
        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <H1 class="titulo">TRANFERENCIA</H1>
            <form class="grid-3-1" method="POST" action="">
                <div class="contenedor-campos">
                    <img class="img-transf" src="img/user1.svg" alt="">
                    <label class="labels" for=""><?php echo $usuario['usuario'] ?></label>
                    <select class="selectores " name="cuentas1" id="">
                        
                        <option value="">Seleccione</option>
                        <?php while ($cuentas = mysqli_fetch_assoc($resultadoCuentas)) : ?>
                            <option <?php echo $CuentasId1 === $cuentas['id'] ? 'selected' : null ?> value="<?php echo $cuentas['id']; ?>"><?php echo $cuentas['nombreCuenta']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <div class="flex">
                        <p>SU SALDO ES: </p>
                        <p> <?php echo $saldo['saldo'] ?? null ?></p>
                    </div>
                </div>


                <div class="contendor-img-transf">
                    <img class="img-transf" src="img/flechaDerecha.svg" alt="">
                </div>
                            
                <div class="contenedor-campos">
                    <!-- <label class="labels" for=""> Cuenta 2</label> -->

                    <img class="img-transf" src="img/user2.svg" alt="">
                    <select class="selectores " name="cuentas2" id="">
                        <option value="">Seleccione</option>
                        
                        <?php while ($cuentas = mysqli_fetch_assoc($resultadoCuentas2)) : ?>
                            <option <?php echo $CuentasId2 === $cuentas['id'] ? 'selected' : '' ?> value="<?php echo $cuentas['id']; ?>"><?php echo $cuentas['nombreCuenta']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <label for="cuenta2">Numero de cuenta</label>
                    <input class="campos" type="number" name="num_tarjeta2" value="<?php echo $num_tarjeta2 ?>" id="cuenta2" placeholder="Ej: 0978215642">
                    
                </div>

                <div class="contenedor-formulario">
                    <label class="labels">Transferencia</label>
                    <input class="campos" value="<?php echo $cantidad ?>" type="number" name="cantidad" id="cantidad" placeholder="Cantidad">
                </div>
                <input type="submit" value="comprobar" class="boton">
            </form>
            
            
    </div>
    
</body>

<?php
include 'includes/plantillas/footer.php';
?>