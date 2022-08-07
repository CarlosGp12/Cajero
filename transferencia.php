<?php
include 'includes/plantillas/header.php';
?>

<body>

    <div class="contenedor  ">
        <H1 class="titulo">TRANFERENCIA</H1>
        <div class="grid-3-1">
            <div class="contenedor-campos">

                <!-- <label class="labels" for=""> Cuenta 1</label> -->
                <img class="img-transf" src="img/user1.svg" alt="">
                <select class="selectores" name="" id="">
                    <option value="">Cuenta 1</option>
                    <option value="">Cuenta 2</option>
                </select>
                <input class="campos" type="text" name="cantidad1" id="cuenta1" value="1200">
            </div>

            <div class="contendor-img-transf">
                <img class="img-transf" src="img/flechaDerecha.svg" alt="">
            </div>

            <div class="contenedor-campos">
                <!-- <label class="labels" for=""> Cuenta 2</label> -->

                <img class="img-transf" src="img/user2.svg" alt="">
                <select class="selectores" name="" id="">
                    <option value="">Cuenta 2</option>
                    <option value="">Cuenta 1</option>
                </select>
                <input class="campos" type="text" name="cantidad2" id="cuenta2" value="800">
            </div>

            <div class=" contenedor-formulario">
                <form>

                    <label class="labels">Transferencia</label>
                    <input class="campos" type="text" name="" id="cantidad" placeholder="Cantidad">

                </form>

            </div>
        </div>

    </div>
    <input class="boton" type="button" value="transferencia" id="transferencia" onclick="formula()">
    <script src="js/transferencia.js">

    </script>
</body>

<?php
include 'includes/plantillas/footer.php';
?>