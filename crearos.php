<?php

include 'funciones.php';

csrf();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
  die();
}

if (isset($_POST['submit'])) {
  $resultado = [
    'error' => false,
    'mensaje' => 'La Orden de Servicio ha sido creada exitosamente!' . escapar($_POST['nombre']) . 'ha sido agregado con éxito'
  ];

  $config = include 'config.php';

  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    if (isset($_POST['apellido'])) {
      $consultaSQL = "SELECT * FROM clientes WHERE apellido LIKE '%" . $_POST['apellido'] . "%'";
    } else {
      $consultaSQL = "SELECT * FROM clientes";
    }
  
    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute();
  
    $clientes = $sentencia->fetchAll();
  } catch (PDOException $error) {
    $error = $error->getMessage();


/*  VARIABLES OS
    id_os
    id_cliente
    numero_ot
    numero_oc
    nombre_cliente
    apellido_cliente
    email_cliente
    fono_cliente
    celular_cliente
    empresa_cliente
    tipo_mantencion
    direccion_cliente
    estado_os
*/

/*  VARIABLES EQUIPO
  id_equipo 
  nombre_equipo 
  descripcion_equipo 
  modelo_equipo 
  serie_equipo 
  nota_equipo 
*/

    $clientes = [
      "id_os"   => $_POST['id_os'],
      "id_cliente" => $_POST['id_cliente'],
      "numero_ot"    => $_POST['numero_ot'],
      "numero_oc"     => $_POST['numero_oc'],
      "nombre_cliente"   => $_POST['nombre_cliente'],
      "apellido_cliente" => $_POST['apellido_cliente'],
      "email_cliente"    => $_POST['email_cliente'],
      "fono_cliente"     => $_POST['fono_cliente'],
      "celular_cliente"   => $_POST['celular_cliente'],
      "empresa_cliente" => $_POST['empresa_cliente'],
      "tipo_mantencion"    => $_POST['tipo_mantencion'],
      "direccion_cliente"     => $_POST['direccion_cliente'],
      "estado_os"     => $_POST['estado_os'],
    ];

    $equipo = [
      "id_os"   => $_POST['id_os'],
      "id_cliente" => $_POST['id_cliente'],
      "numero_ot"    => $_POST['numero_ot'],
      "numero_oc"     => $_POST['numero_oc'],
      "nombre_cliente"   => $_POST['nombre_cliente'],
      "apellido_cliente" => $_POST['apellido_cliente'],
      "email_cliente"    => $_POST['email_cliente'],
      "fono_cliente"     => $_POST['fono_cliente'],
      "celular_cliente"   => $_POST['celular_cliente'],
      "empresa_cliente" => $_POST['empresa_cliente'],
      "tipo_mantencion"    => $_POST['tipo_mantencion'],
      "direccion_cliente"     => $_POST['direccion_cliente'],
      "estado_os"     => $_POST['estado_os'],
    ];

    // $consultaSQL = "INSERT INTO alumnos (nombre, apellido, email, edad)";
    // $consultaSQL .= "values (:" . implode(", :", array_keys($alumno)) . ")";

    $consultaSQL = "INSERT INTO clientes1 (id_os, id_cliente, numero_ot, numero_oc, nombre_cliente, apellido_cliente, email_cliente, fono_cliente, celular_cliente, celular_cliente, empresa_cliente, tipo_mantencion, direccion_cliente, estado_os)";
    $consultaSQL .= "values (:" . implode(", :", array_keys($clientes)) . ")";

    $sentencia = $conexion->prepare($consultaSQL);
    // $sentencia->execute($alumno);

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
      <h2 class="mt-4">Crear Orden de Servicio</h2>
      <hr>

      <h4 class="mt-5">Cliente</h4>
      
      <form method="post" class="form-inline">
        <div class="form-group mr-3">
          <input type="text" id="apellido_cliente" name="apellido_cliente" placeholder="Buscar por Apellido" class="form-control">
        </div>
        <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
        <button type="submit" name="submit" class="btn btn-primary">Buscar</button>
      </form>
      
      <hr>

      <form method="post">
        <div class="form-group">
          <label for="nombre_cliente">Nombre</label>
          <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="apellido_cliente">Apellido</label>
          <input type="text" name="apellido_cliente" id="apellido_cliente" class="form-control"required>
        </div>
        <div class="form-group">
          <label for="direccion_cliente">Direccion</label>
          <input type="text" name="direccion_cliente" id="direccion_cliente" class="form-control"required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control"required>
        </div>
        <div class="form-group">
          <label for="empresa_cliente">Empresa</label>
          <input type="text" name="empresa_cliente" id="empresa_cliente" class="form-control"required>
        </div>

        <h4 class="mt-5">Equipo</h4>

        <hr>


        <form method="post">
        <div class="form-group">
          <label for="marca_equipo">Marca</label>
          <input type="text" name="marca_equipo" id="marca_equipo" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="modelo_equipo">Modelo</label>
          <input type="text" name="modelo_equipo" id="modelo_equipo" class="form-control"required>
        </div>
        <div class="form-group">
          <label for="descripcion_equipo">Descripcion</label>
          <input type="text" name="descripcion_equipo" id="descripcion_equipo" class="form-control"required>
        </div>
        <div class="form-group">
          <label for="serie_equipo">Serie</label>
          <input type="text" name="serie_equipo" id="serie_equipo" class="form-control"required>
        </div>
        <div class="form-group">
          <label for="nota_equipo">Nota</label>
          <input type="text" name="nota_equipo" id="nota_equipo" class="form-control"required>
        </div>


        <h4 class="mt-5">Reporte</h4>

        <hr>


        <form method="post">
        <div class="form-group">
          <label for="marca_equipo">Reporte Cliente</label>
          <input type="text" name="reporte_cliente" id="reporte_cliente" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="observaciones_equipo">Observaciones</label>
          <input type="text" name="observaciones_equipo" id="observaciones_equipo" class="form-control" required>
        </div>
        

        <h4 class="mt-5">Tipo de Mantencion</h4>

        <hr>

        <p>
            <input type="checkbox" name="mantencion_preventiva" value="mantencion_preventiva"> Preventiva<br>
            <input type="checkbox" name="mantencion_correctiva" value="mantencion_correctiva"> Correctiva<br>
            <input type="checkbox" name="instalacion" value="instalacion"> Instalacion<br>
            <input type="checkbox" name="garantia" value="garantia"> Garantia<br>
            <input type="checkbox" name="contrato" value="contrato"> Contrato<br>
            <input type="checkbox" name="facturable" value="facturable"> Facturable<br>
       </p>
       
      
      
      
        <hr>
        
        
        
        
  <!-- id_equipo INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre_equipo VARCHAR(100),
  descripcion_equipo VARCHAR(255),
  modelo_equipo VARCHAR(100),
  serie_equipo VARCHAR(100),
  nota_equipo VARCHAR(30) -->
        
        
        
        
        
        
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