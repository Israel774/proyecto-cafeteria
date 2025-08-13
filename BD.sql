TABLAS DE VENTAS Y DETALLE DE VENTAS
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