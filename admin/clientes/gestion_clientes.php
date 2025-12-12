<?php
    session_start();
    if(!isset($_SESSION["nombre"])){
        header("location:../index.php");
        die();
    }
    include("../db/db_pdo.inc"); // Incluimos la conexión a la BD
    // Obtener todos los clientes
    $clientes = $pdo -> query("SELECT * FROM clientes ORDER BY id DESC") -> fetchAll(PDO::FETCH_ASSOC);
    $usuario = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];

    // PDO
    /*if (isset($_GET['eliminar'])) {
      $id = intval($_GET['eliminar']);
      $pdo->prepare("DELETE FROM clientes WHERE id = ?")->execute([$id]);
      header("Location: gestion_clientes.php");
      exit;
      die();
    }*/
    //MYSQLI
    /*
    if(isset($_GET["eliminar"])){
      $id = intval($_GET["eliminar"]);
      sql = "DELETE FROM clientes WHERE id=$id"
      mysqli_query($conn, $sql);
    }
    */
?> 
<!DOCTYPE html> 
<html lang="es"> 
<head>
  <meta charset="UTF-8"> 
  <title>Gestión de Clientes</title> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
</head> 
<body class="bg-light">
  <aside class="d-flex float-start bg-primary vh-100 text-light">
    <div class="container float-start border border-light">
      <img src="../img/admin.jpg" class="float-start">
      <div class="float-start">
        <p><?=$usuario?></p>
        <p><?php if ($rol == 1) { echo("Administrador"); } else { echo("Usuario"); }?></p>
        <a href="../desc.php"><img src="../img/8917901.png" class="float-right" width="50px"></a>
      </div>
      
      <div>
        <p>Menú principal</p>
        <hr>
        <ul class="list-unstyled">
          <li class="fw-bold">Clientes</li>
          <li>Productos</li>
          <li>Pedidos</li>
        </ul>
      </div>
    </div>
      
  </aside>
</aside>

<div class="container mt-4"> 
  <h2 class="text-center mb-4">📋 Gestión de Clientes</h2> 
 <!-- Tabla de clientes --> 
  <div class="card shadow">
    <div class="card-header bg-secondary text-white">📋 Lista de Clientes</div> 
    <div class="card-body"> 
      <?php
        if(isset($_GET["cli"])){
          if($_GET["cli"] == 0){
            echo '<div class="alert alert-success">✅ Cliente insertado correctamente.</div>';
          }
          else if($_GET["cli"] == 1){
            echo '<div class="alert alert-warning">⚠ Cliente ya existe.</div>';
          }
          else if($_GET["cli"] == 2){
            echo '<div class="alert alert-warning">⚠ Error en el registro.</div>';
          }
        }
        if(isset($_GET["upd"])){
          if($_GET["upd"] == 0){
            echo '<div class="alert alert-success">✅ Cliente actualizado correctamente.</div>';
          }
          else if($_GET["upd"] == 1){
            echo '<div class="alert alert-warning">⚠ Error, no se puede repetir el correo de otro usuario.</div>';
          }
          else if($_GET["upd"] == 2){
            echo '<div class="alert alert-warning">⚠ Error en la actualización.</div>';
          }
        }
      ?>
<div class="row mb-3 me-2 float-end"> 
   <a href="ins_cli_mysqli.php" class="btn btn-success">➕ Nuevo Cliente</a> 
      </div> 
      <table class="table table-striped table-hover align-middle"> 
        <thead class="table-dark"> 
          <tr> 
            <th>ID</th> 
            <th>Nombre</th> 
            <th>Apellidos</th> 
            <th>Email</th> 
            <th>Género</th> 
            <th>Dirección</th> 
            <th>Código Postal</th> 
            <th>Población</th> 
            <th>Provincia</th>
            <th>Creado</th>
            <th>Acciones</th> 
          </tr> 
        </thead> 
        <tbody> 
          <?php foreach ($clientes as $c):?>
          <tr> 
            <td><?= $c['id'] ?></td> 
            <td><?= htmlspecialchars($c['nombre']) ?></td>
            <td><?= htmlspecialchars($c['apellidos']) ?></td>
            <td><?= htmlspecialchars($c['email']) ?></td>
            <td><?= $c['genero'] ?></td>
            <td><?= htmlspecialchars($c['direccion']) ?></td>
            <td><?= $c['codpostal'] ?></td>
            <td><?= htmlspecialchars($c['poblacion']) ?></td>
            <td><?= htmlspecialchars($c['provincia']) ?></td>
            <td><?= htmlspecialchars(date("d M Y", strtotime($c['creacion']))) ?></td>
            <td>
              <a href="edit_cli_mysqli.php?edit=<?= $c['id']; ?>" class="btn btn-sm btn-warning">✏️</a>
              <button type="button" class="btn btn-sm btn-danger" onclick="eliminarCliente(<?= $c['id']; ?>)">🗑️</button>
            </td>
          </tr>           
          <?php endforeach;?> 
        </tbody> 
      </table> 
    </div> 
  </div> 
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true"> 
  <div class="modal-dialog modal-dialog-centered"> 
    <div class="modal-content"> 
      <div class="modal-header bg-danger text-white"> 
        <h5 class="modal-title">Confirmar eliminación</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button> 
      </div> 
      <div class="modal-body"> 
        ¿Seguro que deseas eliminar este Cliente? 
      </div> 
      <div class="modal-footer"> 
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button> 
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button> 
      </div>
    </div>
  </div>
</div>
<script>
function eliminarCliente(numcliente) {
  const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
  modal.show();
  document.getElementById('confirmDeleteBtn').onclick = () => {
    window.location.href = 'gestion_clientes.php?eliminar= ' + numcliente;
    modal.hide();
  };
}
</script>
</body>
</html>