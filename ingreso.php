<?php
    // //conexion
    // require 'includes/config/database.php';
    // $db = conectarDB();
    // //consultar
    // $query = "SELECT * FROM usuarios";
    // //obtener resultado
    // $resultado = mysqli_query($db, $query);
    // // while ($usuarios = mysqli_fetch_assoc($resultado)){
    // //     echo "<pre>";
    // //     var_dump($usuarios);
    // //     echo "</pre>";
    // // }

    //incluir encabezado
    include 'includes/plantillas/header.php';
?>
    <h1>Ingrese la cantidad de dinero a ingresar</h1>

    <div class="contenedor grid-3">
        <div class="valores-left">
            <div class="box">
                <a href="#" class="valor">$5</a>
            </div>
        </div>
        <div class="valores-right">
            <div class="box2">
                <a href="#" class="valor">$100</a>
            </div>
        </div>

        <div class="valores-left">
            <div class="box">
                <a href="#" class="valor">$20</a>
            </div>
        </div>
        <div class="valores-right">
            <div class="box2">
                <a href="#" class="valor">$200</a>
            </div>
        </div>

        <div class="valores-left">
            <div class="box">
                <a href="#" class="valor">$50</a>
            </div>
        </div>
        <div class="valores-right">
            <div class="box2">
                <a href="#" class="valor">$300</a>
            </div>
        </div>

        <div class="pantalla-central">
            <label class="texto" for="">Valor ingresado</label>
            <h3 class="pantalla">$220</h3>
        </div>
        
        <a href="index.php" class="volver">Volver</a>
        <a href="index.php" class="otro">otro valor</a>
        <a href="" class="aceptar">Aceptar</a>
    </div>
<?php
    include 'includes/plantillas/footer.php';
?>
