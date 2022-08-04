<?php
include 'includes/plantillas/header.php';
?>

<body>

    <label for=""> Cuenta 1</label>
    <input type="text" name="cantidad1" id="cuenta1" value="1200">
    <label for=""> Cuenta 2</label>
    <input type="text" name="cantidad2" id="cuenta2" value="800">

    <form action="">

        <label>Transferencia</label>
        <input type="text" name="" id="cantidad" placeholder="Cantidad">

        <input type="button" value="transferencia" id="transferencia" onclick="formula()">

    </form>

    <script>
        function formula() {
            var CantidadT = parseInt(document.getElementById('cantidad').value);
            var Cantidad1 = parseInt(document.getElementById('cuenta1').value);
            var Cantidad2 = parseInt(document.getElementById('cuenta2').value);
            document.getElementById('cuenta1').value = (Cantidad1 - CantidadT);
            document.getElementById('cuenta2').value = (Cantidad2 + CantidadT);
        }
    </script>
</body>

<?php
include 'includes/plantillas/footer.php';
?>