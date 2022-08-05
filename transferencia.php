<?php
include 'includes/plantillas/header.php';
?>

<body>

    <label for=""> Cuenta 1</label>
    <input type="text" name="cantidad1" id="cuenta1" value="1200">
    <label for=""> Cuenta 2</label>
    <input type="text" name="cantidad2" id="cuenta2" value="800">

    <form >

        <label>Transferencia</label>
        <input type="text" name="" id="cantidad" placeholder="Cantidad">

        <input type="button" value="transferencia" id="transferencia" onclick="formula()">

    </form>
</body>

<?php
include 'includes/plantillas/footer.php';
?>