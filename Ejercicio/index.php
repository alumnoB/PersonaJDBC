<?php

$errores = '';
$enviado = '';

$year = ['2000'=>'2000', '2001' => '2001', '2002' => '2002', '2003' => '2003' ];
$idioma = ['espanol'=>'Español', 'ingles' => 'Ingles', 'frances' => 'Frances'];
$estudios = ['eso'=>'Secundaria', 'bach' => 'Bachillerato', 'medio' => 'GradoMedio', 'superior' => 'GradoSuperior' ];


//recogida de datos y verificacion logica del negocio
if(isset($_GET['submit'])) {
    $nombre = $_GET['nombre'];
    $password = $_GET['password'];
    $prueba = $_GET['prueba'];
    $correo = $_GET['correo'];
    $sexo = isset($_GET['sexo']);
    $idioma = isset($_GET['idioma']);
    $year = isset($_GET['year']);
    $estudios = isset($_GET['estudios']);
    $file = isset($_GET['file']);
    $mensaje = $_GET['mensaje'];


    if(!empty($_FILES['file']['name'])){

        if(move_uploaded_file($_FILES['file']['tmp_name'],"img/".$_FILES['file']['name'])){
        
            echo 'Archivo subido correctamente.';
        
        }else{
        
            echo 'Ocurrió algunos problemas. Inténtelo más tarde.';
        
        }
        
    }

    if(!empty($nombre)) {
        $nombre = trim($nombre);
        $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    }else{
        $errores .= 'Por favor ingresa un nombre <br />';
    }

    if(!empty($password)) {
        $password = trim($password);
        $password = filter_var($password, FILTER_SANITIZE_STRING);
    }else{
        $errores .= 'Por favor ingresa un password <br />';
    }

    if(!empty($correo)) {
        $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);

        if(!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errores .= 'Por favor ingresa un correo valido <br />';
        }
    }else {
        $errores .= 'Por favor ingresa un correo <br />';
    }

    if(!empty($sexo)) {
        $sexo = $_GET['sexo'];
    }else{
        $errores .= 'Por favor elija un sexo <br />';
    }

    if(!empty($mensaje)) {
        $mensaje = htmlspecialchars($mensaje);
        $mensaje = trim($mensaje);
        $mensaje = stripslashes($mensaje);
        
    }else{
        $errores .= 'Por favor ingresa el mensaje <br />';
    }

    if(!$errores){

        $enviar_a = "tunombre@empresa.com";
        $asunto = 'Correo enviado desde mi paginaDatos.com';
        $mensaje_preparado = "De: $nombre \n";
        $mensaje_preparado .= "Password: $password \n";
        $mensaje_preparado .= "Correo: $correo \n";
        $mensaje_preparado .= "Sexo: $sexo \n";
        $mensaje_preparado .= "Mensaje: " . $mensaje;

        //mail($enviar_a, $asunto, $mensaje_preparado);
        $enviado = 'true';
    }
}


require 'index.view.html';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,100&display=swap" rel="stylesheet">
    

    <link rel="stylesheet" href="estilos.css">
    

    <title>Formulario</title>
</head>
<body>
    
    <p><br><br><br></p>
    <div class="wrap">
    <form action="index.php" method="get">
            <h3>Formulario Reenviado</h3>
            <p><br></p>
            <input type="text" placeholder="Nombre:" name="nombre" value="<?php echo $_GET['nombre']?>">

            
            <input type="hidden" id="prueba" name="prueba" value="<?php echo $_GET['prueba']; ?>">
            

            <input type="text" placeholder="Password:" name="password" value="<?php echo $_GET['password']?>">

            <input type="text" placeholder="Correo:" name="correo" value="<?php echo $_GET['correo']?>">

            <input type="hidden" id="prueba" name="prueba" value="<?php echo $_GET['prueba']?>">

            <div class="contenedor" >
                <p>Seleccione su sexo: </p><br>
                <p><input type="radio"  class="form-contrl" id="hombre" name="sexo" value="hombre" <?php if(isset($sexo)=="hombre") echo 'checked="checked"'; ?> > Hombre</p>
                
                <p><input type="radio"  class="form-contrl" id="mujer" name="sexo" value="mujer" <?php if(isset($sexo)=="mujer") echo 'checked="checked"'; ?> > Mujer</p>

            </div>
            
            <div class="contenedor">
                <div class="idiomas" id="idiomas">
                    <p>Seleccione los idiomas que domina: </p><br>
                    <p><input type="checkbox" class="form-contrl" id="espanol" name="idioma" value="espanol" <?php if(isset($idioma)=="espanol") echo 'checked="checked"'; ?> > Español</p>
                    <p><input type="checkbox" class="form-contrl" id="ingles" name="idioma" value="ingles" <?php if(isset($idioma)=="ingles") echo 'checked="checked"'; ?>> Ingles</p>
                    <p><input type="checkbox" class="form-contrl" id="frances"name="idioma" value="frances" <?php if(isset($idioma)=="frances") echo 'checked="checked"'; ?>> Frances</p>
                </div>     
            </div>

            <div class="contenedor">
                <p>¿A nacido usted entre estos años?</p><br>
                <select name="year" id="year">
                    <?php
                       for ($i=0;$i<count($year);$i++) 
                       { 
                            echo "<option value='$i'";
                            
                            if ($year[$i] == $i) {
                                
                                echo "<option value='".$_GET['year']."'>'".$_GET['year']."'</option>'";
                            }
                       } 
                    ?>
                </select>
            </div>

            <div class="contenedor">
                <p>Estudios que ah terminado:</p><br>
                <select multiple="multiple" id="estudios" name="estudios" size="5">
                    <?php
                       for ($i=0;$i<count($estudios);$i++) 
                       { 
                            echo "<option value='$i'";
                            
                            if ($estudios[$i] == $i) {
                                
                                echo "<option value='".$_GET['estudios']."'>'".$_GET['estudios']."'</option>'";
                            }
                       } 
             
                    ?>
                </select>
            </div>
            
            <div class="contenedor">
                <?php
                    echo $_GET['file'];
                ?>
            </div>
            
            <textarea name="mensaje" class="form-contrl" id="mensaje" placeholder="Mensaje: "><?php echo $_GET['mensaje']?></textarea>

        </form>
    </div>
</body>
</html>