<?php
    //conexion
    require 'includes/config/database.php';
    require 'includes/funciones.php';

    $auth = estaAutenticado();

    if (!$auth) {
        header('Location: login.php');
    }

    // echo "<pre>";
    // var_dump($_SESSION['usuario']);
    // echo "</pre>";
    // exit;
    $db = conectarDB();
    $num_tarjeta =$_SESSION['usuario'];
    //consultar
    $usuario = "SELECT id FROM usuarios WHERE num_tarjeta= $num_tarjeta";
    
    //obtener resultado
    $resultado = mysqli_query($db, $usuario);

    $cliente = mysqli_fetch_assoc($resultado);
    $usuarioId = $cliente['id'];

    $query = "SELECT * FROM cuenta_corriente WHERE usuarioId= $usuarioId";
    $resultado = mysqli_query($db, $query);

    $cliente = mysqli_fetch_assoc($resultado);
    // while ($usuarios = mysqli_fetch_assoc($resultado)){
        echo "<pre>";
        var_dump($cliente);
        echo "</pre>";
    // }

    //incluir encabezado
    include 'includes/plantillas/header.php';
?>
    <h1>Su saldo es:</h1>

    <div class="contenedor grid-3">

        <div class="pantalla-central">
            <label class="texto" for="">Valor ingresado</label>
            <h3 class="pantalla"><?php echo $cliente["saldo"] ?></h3>
        </div>
        
        <a href="index.php" class="volver">Volver</a>
    </div>
<?php
    include 'includes/plantillas/footer.php';
?>
