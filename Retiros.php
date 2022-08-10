<?php
    //conexion
    require 'includes/config/database.php';
    $db = conectarDB();
    //consultar
    $query = "SELECT * FROM retiros";
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
    <h1>Retiros realizados:</h1>
<div class="contenedor">
    <table class="propiedades">
        <div class="flex-justify">
            <a href="movimientos.php" class="volver">Transferencias</a>
            <a href="Retiros.php" class="select volver">Retiros</a>
        </div>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo cuenta</th>
                <th>Cantidad</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($movimiento = mysqli_fetch_assoc($resultado)) : ?>
                <tr>
                    <td><?php echo $movimiento['id'] ?></td>
                    <td><?php echo $movimiento['cuentaId'] ?></td>
                    <td>$<?php echo $movimiento['cantidad'] ?></td>
                    <td><?php echo $movimiento['fecha'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="index.php" class="boton flex-end">Aceptar</a>
</div>
<?php
    include 'includes/plantillas/footer.php';
?>
