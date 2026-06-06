-- Crear Base de Datos
create database polideportivo;
GO
use polideportivo;
GO

-- Crear Usuarios

create login WEB with password ='WEB1234';
GO
create user WEB for login WEB;
GO

alter role db_owner add member WEB;

-- Crear tablas

create table Persona (
ci int primary key,
id int identity not null,
nombre nvarchar(100) not null,
passwd nvarchar(100) not null,
rol nvarchar(20) not null check (rol in ('Administrador', 'Socio', 'Profesor')),
estado nvarchar(30) not null default 'Activo' check (estado in ('Activo', 'Desactivado') )
);
GO

create table Telefono (
ci int,
telefono int,
foreign key (ci) references Persona(CI),
primary key (ci, telefono)
);
GO

insert into persona (ci, nombre, passwd, rol) values (12946658, 'Juan', '$2y$12$/QGYDorSJhp.O.FNEZ1jX.kzxDoEKTj6r0.43fErigjTgZRYeIcl2','Administrador');
select * from persona;