CREATE DATABASE cafeteria;
use cafeteria;

CREATE TABLE productos (
    id_productos INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(8,2) NOT NULL,
    stock INT NOT NULL,
    fk_proveedor int(10) NOT NULL,
    tipo_producto VARCHAR(50) NOT NULL,
    codigo_barra text NOT NULL,
    descripcion TEXT NOT NULL,	
    imagen VARCHAR(255),
    estado TINYINT DEFAULT 1,
    create_by int(10),
	update_by int(10),
	create_at datetime,
	update_at datetime
);


CREATE TABLE recarga(
id_recarga int(10) primary key not null auto_increment,
barras text,
nombre varchar(50),
apellido varchar(50),
salanterior float ,
saltotal float  ,
salrecarga float  ,
metodoPago varchar (15),
estado INT(1), /*Estado de recarga: 1 = creado, 0 = Eliminado*/
tipo INT(1) DEFAULT 1, /*Tipo de recarga: 1 = dinero sumado a la cuenta, 2 = dinero eliminado de la cuenta*/
update_at datetime,
update_by int(10),
create_at datetime,
create_by int(10)
);


create table compras(
id_compras int(10) primary key not null auto_increment,
encargado varchar(30),
activo int, 
metodo_de_pago varchar(30), 
fk_proveedor varchar(15), 
total_compra varchar(10),
observaciones text, 
createAt datetime, 
updateAt datetime, 
createBy int, 
updateBy int
);

create table detalle_compra(
id_detalle_compra int(10) primary key not null auto_increment,
cantidad varchar(30) ,
unidad_de_medida varchar(15), 
precio varchar(30), 
caducidad varchar(15), 
codigo_de_barras varchar(15), 
sub_total varchar(30), 
fk_producto varchar(15), 
fk_compras int, 
estado int, 
createAt datetime, 
updateAt datetime, 
createBy int, 
updateBy int
);


 create table usuario(
 id_usuario int(10) primary Key not null auto_increment,
 nombre varchar (50),
 apellido varchar(50),
 telefono varchar(15),
 tipo varchar(25),
 correo text not null,
 estado varchar(20) not null,
 codigobarra varchar(25) not null,
 nickname varchar(30),
 contraseña text,
 contraseña_plano text,
 Create_at datetime not null,
 Update_at datetime,
 Create_by varchar(15) not null,
 Update_by varchar(15),
modificacion VARCHAR(50)
 );
 
create table proveedor(
	id_proveedor int(10) primary key not null auto_increment,
	Nombre varchar(50) not null,
	Direccion text ,
	Tipo_Producto varchar(50) ,
	Notelef_ficina int(50) not null,
	Nombre_De_Repartidor varchar(50) not null,
	Notelef_Repartidor int(50) not null,
	Tipo_De_Pago varchar(50) not null,
	NitProveedor varchar(50),
	Create_by int(10),
	Update_by int(10),
	Create_at datetime,
	Update_at datetime,
	activo TINYINT(1) DEFAULT 1
	);


create table clientes(
id_cliente int(10) primary key not null auto_increment,
nombre varchar(50) not null,
apellido varchar(50) not null,
nickname varchar(30),
saldo float Not null,
estado_de_tarjeta varchar(30),
Create_by int(10),
Update_by int(10),
Create_at datetime,
Update_at datetime
);


create table ventas(
id_venta INT PRIMARY KEY AUTO_INCREMENT,
id_cliente int,
total_pagado float,
create_at datetime,
update_at datetime,
createby int,
updateby int
);


create table detalle_ventas(
id_detalleventas INT PRIMARY KEY AUTO_INCREMENT,
id_venta int,
id_producto int,
cantidad int,
precio_unitario float,
subtotal float,
create_time time,
create_date date,
update_time time,
update_date date
);