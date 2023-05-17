CREATE DATABASE tutorial_crud;

use tutorial_crud;

CREATE TABLE alumnos (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(30) NOT NULL,
  apellido VARCHAR(30) NOT NULL,
  email VARCHAR(50) NOT NULL,
  edad INT(3),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE clientes (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  rut VARCHAR(15) ,
  nombre VARCHAR(30) ,
  apellido VARCHAR(30) ,
  email VARCHAR(50) ,
  fono VARCHAR(20),
  celular VARCHAR(20),
  empresa VARCHAR(20),
  direccion VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE clientes1 (
  id_cliente INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  rut_cliente VARCHAR(15) ,
  nombre_cliente VARCHAR(30),
  apellido_cliente VARCHAR(30),
  email_cliente VARCHAR(50),
  fono_cliente VARCHAR(20),
  celular_cliente VARCHAR(20),
  empresa_cliente VARCHAR(20),
  tipo_mantencion VARCHAR(20),
  reporte_cliente VARCHAR(255),
  reporte_ingeniero VARCHAR(255),
  observaciones VARCHAR(255),
  direccion_cliente VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE os (
  id_os INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  id_cliente VARCHAR(15),
  numero_ot INT(11),
  numero_oc INT(11),
  nombre_cliente VARCHAR(30),
  apellido_cliente VARCHAR(30),
  email_cliente VARCHAR(50),
  fono_cliente VARCHAR(20),
  celular_cliente VARCHAR(20),
  empresa_cliente VARCHAR(20),
  tipo_mantencion VARCHAR(20),
  reporte_cliente VARCHAR(255),
  reporte_ingeniero VARCHAR(255),
  observaciones VARCHAR(255),
  estado_os VARCHAR(20),
  direccion_cliente VARCHAR(50)
);

CREATE TABLE informe (
  id_informe INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  id_os INT(11),
  id_cliente VARCHAR(15),
  numero_ot INT(11),
  numero_oc INT(11),
  nombre_cliente VARCHAR(30),
  apellido_cliente VARCHAR(30),
  email_cliente VARCHAR(50),
  fono_cliente VARCHAR(20),
  celular_cliente VARCHAR(20),
  empresa_cliente VARCHAR(20),
  tipo_mantencion VARCHAR(20),
  reporte_cliente VARCHAR(255),
  reporte_ingeniero VARCHAR(255),
  observaciones VARCHAR(255),
  estado_os VARCHAR(20),
  direccion_cliente VARCHAR(50)
);