<?php
    session_start();
    if(!isset($_SESSION["nombre"])){
        header("location:../index.php");
        die();
    }
    include("../db/db.inc");
    if(isset($_POST["nombre"]) && !empty($_POST["nombre"])){
        $nombre = htmlspecialchars($_POST["nombre"]);
        $apellidos = htmlspecialchars($_POST["apellidos"]);
        $email = htmlspecialchars($_POST["email"]);
        $direccion = htmlspecialchars($_POST["direccion"]);
        $password = htmlspecialchars(sha1($_POST["password"]));
        $codpostal = htmlspecialchars($_POST["codpostal"]);
        $genero = htmlspecialchars($_POST["genero"]);
        $provincia = htmlspecialchars($_POST["provincia"]);
        $poblacion = htmlspecialchars($_POST["poblacion"]);

        $sql = "SELECT * FROM clientes WHERE email='$email'";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){ //Email existe, vuelta a formulario
            header("location:./gestion_clientes.php?cli=1");
            die();
        }
        $sql = "INSERT INTO clientes(nombre, apellidos, email, genero, direccion, codpostal, poblacion, provincia, password) 
        VALUES('$nombre', '$apellidos', '$email', '$genero', '$direccion', '$codpostal', '$poblacion', '$provincia', '$password')";
        if(mysqli_query($conn, $sql)){
            header("location:./gestion_clientes.php?cli=0");
        }
        else{
            header("location:./gestion_clientes.php?cli=2");
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <main class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-light"><h2>Registro de Cliente con Mysqli</h2></div>
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" aria-describedby="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" aria-describedby="apellidos" name="apellidos" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" aria-describedby="email" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="genero" class="form-label">Género</label>
                            <select class="form-control" id="genero" aria-describedby="genero" name="genero" required>
                                <option value="M" for="genero">Hombre</option>
                                <option value="F" for="genero">Mujer</option>
                                <option value="O" for="genero">Otro</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                        <div class="col-md-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="codpostal" class="form-label">Código Postal</label>
                            <input type="text" class="form-control" id="codpostal" name="codpostal" required>
                        </div>
                        <div class="col-md-4">
                            <label for="provincia" class="form-label">Provincia</label>
                            <input type="text" class="form-control" id="provincia" name="provincia" required>
                        </div>
                        <div class="col-md-4">
                            <label for="poblacion" class="form-label">Población</label>
                            <input type="text" class="form-control" id="poblacion" name="poblacion" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>