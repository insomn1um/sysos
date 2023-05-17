<?php
include 'funciones.php';

csrf();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
  die();
}

$config = include 'config.php';

$resultado = [
  'error' => false,
  'mensaje' => ''
];

if (!isset($_GET['id'])) {
  $resultado['error'] = true;
  $resultado['mensaje'] = 'El cliente no existe';
}

if (isset($_POST['submit'])) {
  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $clientes = [
      "id"        => $_GET['id'],
      "rut"   => $_POST['rut'],
      "nombre"   => $_POST['nombre'],
      "apellido" => $_POST['apellido'],
      "email"   => $_POST['email'],
      "fono"    => $_POST['fono'],
      "celular"  => $_POST['celular'],
      "empresa"     => $_POST['empresa'],
      "direccion"    => $_POST['direccion'],
    ];
    
    $consultaSQL = "UPDATE clientes SET
        id = :id,
        rut = :rut,
        nombre = :nombre,
        apellido = :apellido,
        email = :email,
        fono = :fono,
        celular = :celular,
        empresa = :empresa,
        direccion = direccion,
        updated_at = NOW()
        WHERE id = :id";
    $consulta = $conexion->prepare($consultaSQL);
    $consulta->execute($clientes);

  } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
    
  $id = $_GET['id'];
  $consultaSQL = "SELECT * FROM clientes WHERE id =" . $id;

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $clientes = $sentencia->fetch(PDO::FETCH_ASSOC);

  if (!$clientes) {
    $resultado['error'] = true;
    $resultado['mensaje'] = 'No se ha encontrado el cliente';
  }

} catch(PDOException $error) {
  $resultado['error'] = true;
  $resultado['mensaje'] = $error->getMessage();
}
?>

<?php require "templates/header.php"; ?>

<?php
if ($resultado['error']) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $resultado['mensaje'] ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php
if (isset($_POST['submit']) && !$resultado['error']) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-success" role="alert">
          El cliente ha sido actualizado correctamente
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php
if (isset($clientes) && $clientes) {
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mt-4">Editando cliente <?= escapar($clientes['nombre']) . ' ' . escapar($clientes['apellido'])  ?></h2>
        <hr>
        <form method="post">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?= escapar($clientes['nombre']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" value="<?= escapar($clientes['apellido']) ?>" class="form-control">
          </div>
          
          <div class="form-group">
            <label for="rut">Rut</label>
            <input type="text" name="rut" id="rut" value="<?= escapar($clientes['rut']) ?>" class="form-control">
          </div>  
        
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= escapar($clientes['email']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="fono">Fono</label>
            <input type="text" name="fono" id="fono" value="<?= escapar($clientes['fono']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="celular">Celular</label>
            <input type="text" name="celular" id= "celular" value="<?= escapar($clientes['celular']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="empresa">Empresa</label>
            <input type="text" name="empresa" id="empresa" value="<?= escapar($clientes['empresa']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" name="direccion" id="direccion" value="<?= escapar($clientes['direccion']) ?>" class="form-control">
          </div>
          
          
          <div class="form-group">
            <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
            <input type="submit" name="submit" class="btn btn-primary" value="Actualizar">
            <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php require "templates/footer.php"; ?>