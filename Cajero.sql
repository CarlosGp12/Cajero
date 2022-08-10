use cajero;

create table usuarios(
	id int(11) NOT NULL auto_increment,
	usuario varchar(30),
    nombre varchar(50),
    cedula varchar(10),
    num_tarjeta char(10),
    clave varchar(25),
    primary key(id)
);

create table cuentas(
	id int(11) NOT NULL auto_increment,
    nombreCuenta varchar(30),
    primary key(id)
);

create table saldo(
	id int(11) NOT NULL auto_increment,
    cuentaId int(11),
    usuarioId int(11),
    saldo decimal(6,2),
    primary key(id),
    KEY usuarioId (usuarioId),
    constraint usuario_FK
    foreign key (usuarioId)
    references usuarios (id),
    KEY cuentaId (cuentaId),
    constraint cuenta_FK
    foreign key (cuentaId)
    references cuentas (id)
);

create table movimiento(
	id int(11) NOT NULL auto_increment,
    num_origen char(10),
    num_destino char(10),
    cantidad decimal(6,2),
    fecha date,
    primary key(id)
);

create table retiros(
	id int(11) NOT NULL auto_increment,
    cuentaId int(11),
    cantidad decimal(6,2),
    fecha date,
    primary key(id)
);

-- drop table cuenta_ahorro;
-- drop table cuenta_corriente;
-- drop table movimiento;
-- drop table retiros;

select * from usuarios;
select * from cuentas;
select * from saldo;
select * from movimiento;
select * from retiros;

insert into usuarios (usuario, nombre, cedula, num_tarjeta, clave) values ("CarlosGp", "Carlos","0923377972","0947854124", "1242");
insert into usuarios (usuario, nombre, cedula, num_tarjeta, clave) values ("CesarMp", "Cesar","0923374788","0978623247", "4754");
insert into cuentas (nombreCuenta) values ("Ahorro");
insert into cuentas (nombreCuenta) values ("Corriente");
insert into saldo (cuentaId, usuarioId, saldo) values (1 , 1, 1200);
insert into saldo (cuentaId, usuarioId, saldo) values (2 , 1, 1000);
insert into saldo (cuentaId, usuarioId, saldo) values (1 , 2, 900);
insert into saldo (cuentaId, usuarioId, saldo) values (2 , 2, 700);

SELECT * FROM saldo WHERE (cuentaId = 1 AND usuarioId =1);

UPDATE saldo SET saldo = saldo+100 where id=1;
UPDATE saldo SET saldo = saldo - 6 where (cuentaId = 1 AND usuarioId = 2)