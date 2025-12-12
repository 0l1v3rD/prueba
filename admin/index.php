<?php
    include("db/db.inc");
    if(isset($_POST["email"]) && !empty($_POST["email"]) && filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){ 
        if(isset($_POST["password"]) && !empty($_POST["password"])){ 
            $email = htmlspecialchars(trim($_POST["email"])); 
            $password = htmlspecialchars(sha1($_POST["password"])); 
            $check = $conn->prepare("SELECT nombre, email, rol FROM usuarios WHERE email = ? AND password = ?");
                //Utilizamos bind_param para evitar inyecciones de código sql 
    //Asocio las variables PHP a los placeholders (?) de la consulta 
    //preparada, indicando el tipo de dato. 
    //Esta cadena indica el tipo de dato de cada parámetro, en 
    //orden:s → string (cadena) s → string
                $check->bind_param("ss", $email, $password);
                $check->execute();      //Ejecutamos la consulta
                $check->store_result(); //Guardamos el resultado del SELECT
                if ($check->num_rows > 0) { //Si las credenciales son válidas ->
    // hay una fila coincidente en la BD
                session_start();
    // Vinculo las variables donde se guardarán los resultados de la consulta
                        $check->bind_result($nombre, $emailDB, $rol);
                        $check->fetch();    //Extraigo la fila de resultados y
    //lleno esas variables.
                        $_SESSION["nombre"] = $nombre;
                        $_SESSION["rol"] = $rol;
                        $_SESSION["email"] = $emailDB;
                    header("location:./clientes/gestion_clientes.php");
                    die();
                }
                else{ //Si no existe el email
                echo '<div class="alert alert-warning">⚠️ El email y la contraseña NO existen.</div>';
    }
        }
        else{ //Si password mal
            echo '<div class="alert alert-warning">⚠️ Error en el campo Password.</div>';
        }
    }
    else{ //Si no existe el email
        if(isset($_POST["email"]))
        echo '<div class="alert alert-warning">⚠️ El email no es válido.</div>';
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto</title>
    <link href="css/index.css" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Panel de administrador</h1>
    </header>
    <main>
        <form method="post">
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" required><br>
            <label for="password">Contraseña:</label><br>
            <input type="password" id="password" name="password" required><br>
            <button type="submit">Iniciar sesión</button>
        </form>
    </main>
    
</body>
</html>