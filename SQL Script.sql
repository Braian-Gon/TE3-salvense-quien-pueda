-- Crear Base de Datos
create database polideportivo;
GO
use polideportivo;
GO

-- Crear Usuarios

create login Administrador with password ='Admin1234';
GO
create user Administrador for login Administrador;
GO
alter role db_owner add member Administrador;
GO
create login WEB with password ='WEB1234';
GO
create user WEB for login WEB;
GO
alter role db_owner add member WEB;
GO

-- Crear tablas

create table Personas (
ci int primary key,
id int identity not null,
nombre nvarchar(100) not null,
passwd nvarchar(100) not null,
rol nvarchar(20) not null check (rol in ('Administrador', 'Socio', 'Profesor')),
estado nvarchar(30) not null default 'Activo' check (estado in ('Activo', 'Desactivado') )
);
GO

create table Telefonos (
ci int,
telefono int,
foreign key (ci) references Persona(CI),
primary key (ci, telefono)
);
GO

create table Membresias(
id int identity primary key,
Nombre varchar(50) not null,
precio decimal(10,2) not null,
estado nvarchar(30) not null default 'Activo' check (estado in ('Activo', 'Desactivado') )
);
GO

create table Historial_Compras(
id_compra int identity primary key,
id_socio int,
id_membresia int not null,
valor decimal (10,2) not null,
fecha_pago datetime not null,
fecha_exp datetime not null,   
foreign key (id_membresia) references Membresias(id),
foreign key (ci) references Personas(id)
);
GO

create table Canchas(
id_cancha int identity primary key,
tipo_cancha nvarchar (50) not null,
capacidad int not null,
estado nvarchar(30) not null default 'Activo' check (estado in ('Activo', 'Desactivado'))
);
GO

create table Clases(
id_clase int identity primary key,
id_cancha int not null,
id_profesor int not null,
horario_inicio datetime not null,
horario_fin datetime not null,
estado nvarchar(30) not null default 'Pendiente' check (estado in ('Terminado', 'Pendiente', 'Suspendido')),
foreign key (id_cancha) references Canchas(id_cancha),
foreign key (id_profesor) references Personas(id)
);
GO

create table Actividades (
id_actividad int identity primary key,
nombre nvarchar(50) not null,
descripcion nvarchar(255) not null,
estado nvarchar(30) not null default 'Activo' check (estado in ('Activo', 'Desactivado'))
);
GO
create table Habilitado(
id_profesor int,
id_cancha int,
primary key (id_profesor, id_cancha),
foreign key (id_profesor) references Personas(id),
foreign key (id_cancha) references Canchas(id_cancha)
);
GO

create table Lista(
id_socio int,
id_clase int,
estado nvarchar(30) not null default 'Pendiente' check (estado in ('Asistencia', 'Pendiente', 'Cancelado', 'Inasistencia')),
foreign key (id_socio) references Personas(id),
foreign key (id_clase) references Clases(id_clase));
GO

-- Datos de Prueba
-- Unico administrador
insert into Personas (ci, nombre, passwd, rol) values (12345678, 'Mateo Oliveira', '$2y$12$mPHO5O.fwdd1JyEskf0Y3ePtSyYtrcAtOQ11iw.J95gLOQ9c/E8WO', 'Administrador'); -- NuevaPass7