DROP DATABASE IF EXISTS aplus;

CREATE database
    aplus CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

use aplus;

DROP TABLE IF EXISTS persona;

CREATE TABLE
    persona(
        id int AUTO_INCREMENT primary key,
        ci VARCHAR(350) NOT NULL,
        nombre VARCHAR(350) NOT NULL,
        apellido VARCHAR(350) NOT NULL,
        image text NULL,
        fecha_nac DATE NULL,
        dirrecion VARCHAR(350) NOT NULL,
        telefono VARCHAR(350) NOT NULL,
        celular VARCHAR(350) NOT NULL,
        email VARCHAR(350) NOT NULL
    );

DROP TABLE IF EXISTS rol;

CREATE TABLE
    rol(
        id int AUTO_INCREMENT primary key,
        nombre VARCHAR(350) NOT NULL
    );

DROP TABLE IF EXISTS usuario;

CREATE TABLE
    usuario(
        id int AUTO_INCREMENT primary key,
        persona_id VARCHAR(350) NOT NULL,
        nickname VARCHAR(350) NOT NULL,
        username VARCHAR(350) NOT NULL,
        password VARCHAR(350) NOT NULL
    );

DROP TABLE IF EXISTS usuario_rol;

CREATE TABLE
    usuario_rol(
        id int AUTO_INCREMENT primary key,
        usuario_id int NOT NULL,
        rol_id int NOT NULL
    );

DROP TABLE IF EXISTS cliente;

CREATE TABLE
    cliente(
        id int AUTO_INCREMENT primary key,
        codigo VARCHAR(350) NOT NULL,
        nombre VARCHAR(350) NOT NULL,
        descripcion VARCHAR(350) NULL,
        telefono VARCHAR(350) NULL,
        dirrecion VARCHAR(350) NULL,
        facturacion VARCHAR(350) NULL,
        nit VARCHAR(350) NULL,
        fecha_registro datetime NOT NULL
    );

DROP TABLE IF EXISTS contacto;

CREATE TABLE
    contacto(
        id int AUTO_INCREMENT primary key,
        nombre VARCHAR(350) NULL,
        celular VARCHAR(350) NULL,
        email VARCHAR(350) NULL,
        cliente_id int NOT NULL
    );

DROP TABLE IF EXISTS servicio;

CREATE TABLE
    servicio(
        id int AUTO_INCREMENT primary key,
        nombre VARCHAR(350) NULL
    );

DROP TABLE IF EXISTS material;

CREATE TABLE
    material(
        id int AUTO_INCREMENT primary key,
        nombre VARCHAR(350) NULL,
        descripcion VARCHAR(350) NULL,
        codigo VARCHAR(350) NULL
    );

DROP TABLE IF EXISTS cotizacion;

CREATE TABLE
    cotizacion(
        id int AUTO_INCREMENT primary key,
        servicio_id int NULL,
        cliente_id int NULL,
        nombre VARCHAR(350) NULL,
        descripcion VARCHAR(350) NULL,
        precio_total DECIMAL (10, 2) NOT NULL
    );

DROP TABLE IF EXISTS material_cotizacion;

CREATE TABLE
    material_cotizacion(
        id int AUTO_INCREMENT primary key,
        material_id int NULL,
        cotizacion_id int NULL,
        cantidad int NULL,
        precio_unitario DECIMAL (10, 2) NOT NULL,
        precio_total DECIMAL (10, 2) NOT NULL
    );

DROP TABLE IF EXISTS material;

CREATE TABLE
    material(
        id int AUTO_INCREMENT primary key,
        nombre VARCHAR(350) NULL,
        codigo VARCHAR(350) NULL,
        descripcion VARCHAR(350) NULL
    );

DROP TABLE IF EXISTS proyecto;

CREATE TABLE
    proyecto(
        id int AUTO_INCREMENT primary key,
        nombre VARCHAR(350) NULL,
        cotizacion_id int NOT NULL
    );

DROP TABLE IF EXISTS actividad;

CREATE TABLE
    actividad(
        id int AUTO_INCREMENT primary key,
        nombre VARCHAR(350) NULL,
        proyecto_id int NOT NULL,
        fecha_inicio DATETIME NOT NULL,
        fecha_fin DATETIME NOT NULL,
        fecha_registro DATETIME NOT NULL,
        horas_total DECIMAL (10, 1) NOT NULL,
        dias_total DECIMAL (10, 1) NOT NULL,
        estado_actividad VARCHAR(350) NULL
    );

DROP TABLE IF EXISTS tareas;

CREATE TABLE
    tareas(
        id int AUTO_INCREMENT primary key,
        descripcion VARCHAR(350) NULL,
        actividad_id int NOT NULL,
        fecha_inicio DATETIME NOT NULL,
        fecha_fin DATETIME NOT NULL
    );

#insert inicial
INSERT INTO
    `persona`(
        `ci`,
        `nombre`,
        `apellido`,
        `image`,
        `fecha_nac`,
        `dirrecion`,
        `telefono`,
        `celular`,
        `email`
    )
VALUES (
        '8963497',
        'stiven',
        'lovera',
        '',
        '1991-09-01',
        'barrio tobotochi',
        '',
        '75679775',
        'stivenlovera@gmail.com'
    );

INSERT INTO
    `usuario`(
        `persona_id`,
        `nickname`,
        `username`,
        `password`
    )
VALUES ('1', 'stiven', 'admin', 'admin');

/*rol*/

INSERT INTO `rol`( `nombre`) VALUES ('Administracion');

INSERT INTO `rol`( `nombre`) VALUES ('Personal');

INSERT INTO `rol`( `nombre`) VALUES ('Invitado');

/*servicio*/

INSERT INTO `servicio`(`nombre`) VALUES ('instalacion de camaras');

INSERT INTO `servicio`(`nombre`) VALUES ('desarrollo web') 