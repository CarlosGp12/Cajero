<?php
    include 'includes/plantillas/header.php';
    require 'includes/funciones.php';
    $excelente = [];
    $resultado = $_GET['resultado'] ?? null;
    if(!isset($_SESSION)){
        $auth = estaAutenticado() ?? false;
    }
    if($resultado == 1){
        $excelente[] = "La transaccion se realizo correctamente";
    }
    if (!$auth) {
        header('Location: login.php');
    }
?>

    <main>
        <?php foreach ($excelente as $ex) : ?>
            <div class="alerta exito">
                <?php echo $ex; ?>
            </div>
        <?php endforeach; ?>
        <h1 class="h1">Elija la operacion</h1>
        <div class="contenedor grid-2">
            
            <a href="retiro.php" class="contenido enlace"> 
                <img src="img/salida.svg" class="iconos" alt="">
                Retirar dinero
            </a>
        
            
            <a href="transferencia.php" class="contenido enlace">
                <img src="img/movimiento.svg" class="iconos" alt="">
                Transferencia
            </a>
        
            <a href="movimientos.php" class="contenido enlace">
                <img src="img/lista.svg" class="iconos" alt="">
                Consulta de movimientos
            </a>

            <a href="consultar.php" class="contenido enlace">
                <img src="img/dinero.svg" class="iconos" alt="">
                Consulta de saldo
            </a>

        </div>
    </main>
<?php
    include 'includes/plantillas/footer.php';
?>
