-- Crear base de datos

create database polideportivo;
GO
use polideportivo;

-- Crear Usuarios

create login WEB with password ='WEB1234';
create user WEB for login WEB;

alter role db_owner add member WEB;

-- Crear tablas

create table Persona (
ci int primary key,
nombre nvarchar(100) not null,
contraseña nvarchar(100) not null,
estado nvarchar(30) not null check (estado in ('Activo', 'Desactivado'))
);

create table Administrador (
id_administrador int identity primary key,
CI int,
foreign key (CI) references Persona(CI)
);


create table Socio (
id_socio int identity primary key,
CI int,
foreign key (CI) references Persona(CI)
);


create table Profesor (
id_profesor int identity primary key,
CI int,
foreign key (CI) references Persona(CI)
);

create table telefono (
ci int,
telefono int,
foreign key (ci) references Persona(CI),
primary key (ci, telefono)
);

insert into persona (ci, nombre, contraseña, estado) values (12345678, 'Juan Perez', 'juan1234', 'Activo');
insert into Administrador (CI) values (12345678);
