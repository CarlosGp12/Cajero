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
    //consultar
    $query = "SELECT * FROM movimiento";
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
    <h1>Transferencias realizadas:</h1>
    <div class="contenedor">
    <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cuenta origen</th>
                    <th>Cuenta destino</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($movimiento = mysqli_fetch_assoc($resultado)) : ?>
                    <tr>
                        <td><?php echo $movimiento['id'] ?></td>
                        <td><?php echo $movimiento['num_origen'] ?></td>
                        <td><?php echo $movimiento['num_destino'] ?></td>
                        <td>$<?php echo $movimiento['cantidad'] ?></td>
                        <td><?php echo $movimiento['fecha'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<?php
    include 'includes/plantillas/footer.php';
?>
