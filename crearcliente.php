<?php

include 'funciones.php';

csrf();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
  die();
}

if (isset($_POST['submit'])) {
  $resultado = [
    'error' => false,
    'mensaje' => 'El Cliente ' . escapar($_POST['nombre']) . ' ha sido agregado con éxito'
  ];

  $config = include 'config.php';

  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $clientes = [
      
      "rut"   => $_POST['rut'],
      "nombre"   => $_POST['nombre'],
      "apellido" => $_POST['apellido'],
      "email"   => $_POST['email'],
      "fono"    => $_POST['fono'],
      "celular"  => $_POST['celular'],
      "empresa"     => $_POST['empresa'],
      "direccion"    => $_POST['direccion'],
    ];

    $consultaSQL = "INSERT INTO clientes (rut, nombre, apellido, email, fono, celular, empresa, direccion)";
    $consultaSQL .= "values (:" . implode(", :", array_keys($clientes)) . ")";

    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute($clientes);

  } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}
?>

<?php include 'templates/header.php'; ?>

<?php
if (isset($resultado)) {
  ?>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-<?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
          <?= $resultado['mensaje'] ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-4">Crear Cliente</h2>
      <hr>
      <form method="post">
      <div class="form-group">
          <label for="rut">Rut</label>
          <input type="text" name="rut" id="rut" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="apellido">Apellido</label>
          <input type="text" name="apellido" id="apellido" class="form-control"required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control"required>
        </div>
        <div class="form-group">
          <label for="fono">Fono</label>
          <input type="text" name="fono" id="fono" class="form-control"required>
        </div>
        <div class="form-group">
          <label for="celular">Celular</label>
          <input type="text" name="celular" id="celular" class="form-control"required>
        </div>
        <div class="form-group">
          <label for="empresa">Empresa</label>
          <input type="text" name="empresa" id="empresa" class="form-control"required>
        </div>
        <div class="form-group">
          <label for="direccion">Direccion</label>
          <input type="text" name="direccion" id="direccion" class="form-control"required>
        </div>

        <div class="form-group">
          <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
          <input type="submit" name="submit" class="btn btn-primary" value="Guardar">
          <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'templates/footer.php'; ?>