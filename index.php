<?php
    include 'includes/plantillas/header.php';
    require 'includes/funciones.php';
    if(!isset($_SESSION)){
        $auth = estaAutenticado() ?? false;
    }
    
    if (!$auth) {
        header('Location: login.php');
    }
?>

    <main>
        <h1 class="h1">Elija la operacion</h1>
        <div class="contenedor grid-2">
            
            <a href="retiro.php" class="contenido enlace retiro"> 
                <img src="img/salida.svg" class="iconos" alt="">
                Retirar dinero
            </a>
        
            
            <a href="transferencia.php" class="contenido enlace">
                <img src="img/transferencia.svg" class="iconos" alt="">
                Transferencia
            </a>
        
        

            <a href="consultar.php" class="contenido enlace">
                <img src="img/lista.svg" class="iconos" alt="">
                Consulta de datos
            </a>

        </div>
    </main>
<?php
    include 'includes/plantillas/footer.php';
?>
