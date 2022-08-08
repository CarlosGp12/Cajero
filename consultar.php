<?php
    //conexion
    require 'includes/config/database.php';
    require 'includes/funciones.php';
    
    $auth = estaAutenticado();

    if (!$auth) {
        header('Location: login.php');
    }
    $errores = [];
    // echo "<pre>";
    // var_dump($_SESSION['usuario']);
    // echo "</pre>";
    // exit;
    $usuarioId = $_SESSION['usuario'];
    $db = conectarDB();
    $queryCuentas = "SELECT * FROM cuentas";
    $resultadoCuentas = mysqli_query($db, $queryCuentas);
    $CuentasId = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $CuentasId = mysqli_real_escape_string($db,$_POST['cuentas']); 
        if (!$CuentasId) {
            $errores[] = "Elige un tipo de cuenta";
        }
        if(!empty($CuentasId)){
            $query = "SELECT * FROM saldo WHERE (cuentaId = $CuentasId AND usuarioId =$usuarioId)";
            $resultado = mysqli_query($db, $query);
            $usuario = mysqli_fetch_assoc($resultado);
        }

    }
    //incluir encabezado
    include 'includes/plantillas/header.php';
?>
    <h1>Su saldo es:</h1>

    <div class="contenedor">
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
        <div class="grid-3">
            <form method="POST" class="centro" action="">
                <h3>Seleccione la el tipo de cuenta:</h3>
                <select class="selectores " name="cuentas" id="">
                    <option value="" >--Seleccione--</option>
                    <?php while($cuentas = mysqli_fetch_assoc($resultadoCuentas)): ?>
                        <option   <?php echo $CuentasId===$cuentas['id'] ? 'selected' : ''?> 
                        value="<?php echo $cuentas['id']; ?>"><?php echo $cuentas['nombreCuenta'];?></option>
                    <?php endwhile;?>
                </select>
                <input value="Solicitar" type="submit" class="boton">
            </form>
            <div class="pantalla-central-consulta">
                <label class="texto" for="">Valor ingresado</label>
                <h3 class="pantalla">$<?php echo $usuario["saldo"] ?? null ?></h3>
            </div>
            
            <a href="index.php" class="volver">Volver</a>
        </div>
    </div>
<?php
    include 'includes/plantillas/footer.php';
?>
