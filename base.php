<?php
    //conexion
    require 'includes/config/database.php';
    $db = conectarDB();
    //consultar
    $query = "SELECT * FROM usuarios";
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
    <h1>Su saldo es:</h1>
<?php
    include 'includes/plantillas/footer.php';
?>
