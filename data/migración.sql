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
  direccion VARCHAR(50)
);