create database webServices;
use webServices;

create table colaboradores(
	idcolaborador int auto_increment primary key,
    apellidos varchar(40) not null,
    nombres varchar(40) not null,
    telefono char(9) not null,
    email varchar(40) null,
    direccion varchar(40) null,
    inactive_at datetime null,
    register_at datetime null default now(),
    update_at datetime null
) engine = innodb

Delimiter $$
create procedure spu_colaboradores_registrar
(
	in _apellidos varchar(40),
    in _nombres varchar(40),
    in _telefono char(9),
    in _email varchar(90),
    in _direccion varchar(90)
) begin
	insert into colaboradores
		(apellidos, nombres, telefono, email, direccion)
        values (_apellidos, _nombres, _telefono, nullif(_email, ''), nullif(_direccion, ''));
end $$

Delimiter $$
create procedure spu_colaboradores_listar()
begin
	select
		idcolaborador,
        apellidos,
        nombres,
        telefono,
        email,
        direccion
        from colaboradores
        where inactive_at is null
        order by idcolaborador desc;
end $$

Delimiter $$
create procedure spu_colaboradores_eliminar(In _idcolaborador int)
begin
	update colaboradores set
		inactive_at = Now()
    where idcolaborador = _idcolaborador;
end $$

Delimiter $$
create procedure spu_colaboradores_getdata(in _idcolaborador int)
begin
	select
		idcolaborador, apellidos, nombres, telefono, email, direccion
        from colaboradores
        where idcolaborador = _idcolaborador;
end $$

Delimiter $$
create procedure spu_colaboradores_update(
	in _idcolaborador int,
    in _apellidos varchar(40),
    in _nombres varchar(40),
    in _telefono varchar(9),
    in _email varchar(90),
    in _direccion varchar(90)
)
begin 
	UPDATE colaboradores set
	apellidos = _apellidos,
    nombres = _nombres,
    telefono = _telefono,
    email = nullif(_email, ''),
    direccion = nullif(_direccion, ''),
    update_at = now()
    where idcolaborador = _idcolaborador;
end $$

call spu_colaboradores_registrar('barrios saavedra', 'fabrizio', '987654326', 'holamundo@icloud.pe','');
call spu_colaboradores_registrar('coliflor zapallo', 'pepe', '987654321', 'colipepe@hotmail.com','');

update colaboradores set inactive_at = 1;
call spu_colaboradores_eliminar(1);

call spu_colaboradores_update(1, 'barrios0', 'fabri', '987654321', '', '');
call spu_colaboradores_listar();

