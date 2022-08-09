    <?php
    require 'includes/config/database.php';
    include 'includes/plantillas/header.php';
    require 'includes/funciones.php';
    if (!isset($_SESSION)) {
        $auth = estaAutenticado() ?? false;
    }

    if (!$auth) {
        header('Location: login.php');
    }
    $errores = [];
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
            $_SESSION['tipoCuenta'] = $CuentasId;
        }

    }
    ?>
        <h1>Seleccione la cantidad de dinero a retirar</h1>

        <div class="contenedor ">
            <?php foreach ($errores as $error) : ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>
            <form method="POST" class="centro">
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
            <div class="grid-3">
                <div class="valores-left">
                    <div class="box">
                        <a  href="confirmacion.php?resultado=5" class="valor">$5</a>
                    </div>
                </div>
                <div class="valores-right">
                    <div class="box2">
                        <a href="confirmacion.php?resultado=100" class="valor">$100</a>
                    </div>
                </div>

                <div class="valores-left">
                    <div class="box">
                        <a href="confirmacion.php?resultado=20" class="valor">$20</a>
                    </div>
                </div>
                <div class="valores-right">
                    <div class="box2">
                        <a href="confirmacion.php?resultado=200" class="valor">$200</a>
                    </div>
                </div>

                <div class="valores-left">
                    <div class="box">
                        <a href="confirmacion.php?resultado=50" class="valor">$50</a>
                    </div>
                </div>
                <div class="valores-right">
                    <div class="box2">
                        <a href="confirmacion.php?resultado=300" class="valor">$300</a>
                    </div>
                </div>

                <div class="pantalla pantalla-central">
                    <label class="texto" for="">Saldo actual:</label>
                    <h3 class="pantalla-text">$<?php echo $usuario["saldo"] ?? null ?></h3>
                </div>

                <a href="index.php" class="volver">Volver</a>
            </div>

        </div>
    <?php
    include 'includes/plantillas/footer.php';
    ?>