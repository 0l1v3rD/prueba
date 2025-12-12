<?php
    include("../db/db_pdo.inc");
    function set($campo){
        if(isset($_GET["$campo"])){
            return TRUE;
        }
        else{
            return false;
        }
    }
    if(set("nombre")){
        $nombre = $_GET["nombre"];
    }
    if(set("apellidos")){
        $apellidos = $_GET["apellidos"];
    }
    if(set("email")){
        $email = $_GET["email"];
    }
    if(set("genero")){
        $genero = $_GET["genero"];
    }
    if(set("direccion")){
        $direccion = $_GET["direccion"];
    }
    if(set("codpostal")){
        $codpostal = $_GET["codpostal"];
    }
    if(set("poblacion")){
        $poblacion = $_GET["poblacion"];
    }
    if(set("provincia")){
        $provincia = $_GET["provincia"];
    }
    $check = $pdo->prepare("SELECT id FROM clientes WHERE email = ?"); 
    $check->execute([$email]); 
    if ($check->rowCount() > 0) { 
    echo '<div class="alert alert-warning">⚠️ El email ya existe 
    en la base de datos.</div>'; 
    } else { 
        $sql = "INSERT INTO clientes (nombre, apellidos, email, 
    genero, direccion, codpostal, poblacion, provincia)  
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)"; 
        $stmt = $pdo->prepare($sql); 
        $stmt->execute([$nombre, $apellidos, $email, $genero, 
    $direccion, $codpostal, $poblacion, $provincia]); 
        echo '<div class="alert alert-success">✅ Cliente insertado 
    correctamente.</div>';
    header("Refresh:5; url=ins_cli_mysqli.php");
    }
?>