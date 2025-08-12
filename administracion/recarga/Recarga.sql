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
update_by varchar(50),
create_at datetime,
create_by varchar(50)
);
select * from recarga;