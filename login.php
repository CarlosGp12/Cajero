<?php

    $errores = [];
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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
    
        $num_tarjeta = mysqli_real_escape_string($db, $_POST['num_tarjeta']); //validamos si es o no un email
        // var_dump($email);
        $clave = mysqli_real_escape_string($db, $_POST['clave']);
    
        if (!$num_tarjeta) {
            $errores[] = "El numero de la tarjeta es obligatorio o no es valido";
        }
        if (!$clave) {
            $errores[] = "El clave es obligatorio";
        }
    
        if (empty($errores)) {
            //revisar si el usuario existe
    
            $query = "SELECT * FROM usuarios WHERE num_tarjeta = '$num_tarjeta'";
            $resultado = mysqli_query($db, $query);
            // var_dump($resultado);
            //si vemos el resultado con un var_dump habra una objeto llamado num_rows si ese objeto tiene valor 0 es porque no encontro coincidencia pero si trae otro numero es porque si encontro coincidencia
    
            if ($resultado->num_rows) {
                //resultado si el password es correcto 
                $usuario = mysqli_fetch_assoc($resultado);
                // var_dump($usuario['password']);
                //verificar si el password es correcto o no

                // $auth = password_verify($clave, $usuario['clave']);
                //parametro 1 el password que ingreso el usuario, segundo parametro el usuario que esta en la base de datos hasheado, esta funcion devolvera un true o false
                if ($usuario['clave']== $clave) {
                    //El usuario esta autenticado
                    session_start();
                    //llenar el arreglo de la sesion
                    $_SESSION['usuario'] = $usuario['id'];
                    $_SESSION['nombre'] = $usuario['usuario'];
                    $_SESSION['nun_tarjet'] = $usuario['num_tarjeta'];
                    $_SESSION['login'] = true;
                    header('Location: index.php');
                } else {
                    $errores[] = "El password es incorrecto";
                }
            } else {
                $errores[] = "El usuario no existe";
            }
        }
        
    }
    //incluir encabezado
    include 'includes/plantillas/header.php';
?>
    <h1 class="titulo">Ingrese sus credenciales</h1>
    
    <form class="contenedor" method="POST">
        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>
        <div>    
            <div class="flex">
                <img class="img-transf" src="img/tarjeta.svg" alt="">
                <div class="contenedor-campos">
                    <label class="labels-login" for="num_tarjeta">Ingrese su numero de tarjeta</label>
                    <input id="num_tarjeta" name="num_tarjeta" class="campos" type="text" >
                </div>
            </div>
            <div class="flex">
                <img class="img-transf" src="img/password.svg" alt="">
                <div class="contenedor-campos">
                    <label class="labels-login" for="clave">Ingrese su clave</label>
                    <input  class="campos" id="clave" name="clave"  type="password" >
                </div>
            </div>
        </div>
        <input class="boton" type="submit" value="Enviar">
    </form>
    
<?php
    include 'includes/plantillas/footer.php';
?>
