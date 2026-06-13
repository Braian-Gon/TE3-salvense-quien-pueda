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

-- Crear tablas

create table Personas (
ci int primary key,
nombre nvarchar(100) not null,
passwd nvarchar(100) not null,
rol nvarchar(20) not null check (rol in ('Administrador', 'Socio', 'Profesor')),
estado nvarchar(30) not null default 'Activo' check (estado in ('Activo', 'Desactivado') )
);
GO

create table Telefonos (
ci int,
telefono int,
foreign key (ci) references Personas(ci),
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
ci int,
id_membresia int not null,
valor decimal (10,2) not null,
fecha_pago datetime not null,
fecha_exp datetime not null,   
foreign key (id_membresia) references Membresias(id),
foreign key (ci) references Personas(ci)
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
ci int not null,
horario_inicio datetime not null,
horario_fin datetime not null,
estado nvarchar(30) not null default 'Pendiente' check (estado in ('Terminado', 'Pendiente', 'Suspendido')),
foreign key (id_cancha) references Canchas(id_cancha),
foreign key (ci) references Personas(ci)
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
ci int,
id_actividad int,
primary key (ci, id_actividad),
foreign key (ci) references Personas(ci),
foreign key (id_actividad) references Actividades(id_actividad)
);
GO

create table Lista(
ci int,
id_clase int,
estado nvarchar(30) not null default 'Pendiente' check (estado in ('Asistencia', 'Pendiente', 'Cancelado', 'Inasistencia')),
primary key (ci, id_clase),
foreign key (ci) references Personas(ci),
foreign key (id_clase) references Clases(id_clase));
GO

-- Datos de Prueba

INSERT INTO Personas (ci,nombre,passwd,rol)
VALUES
(1001,'Juan Perez','jp1001','Administrador'),
(1002,'Maria Gomez','mg1002','Socio'),
(1003,'Carlos Silva','cs1003','Profesor'),
(1004,'Ana Rodriguez','ar1004','Socio'),
(1005,'Luis Fernandez','lf1005','Profesor'),
(1006,'Sofia Martinez','sm1006','Socio'),
(1007,'Diego Lopez','dl1007','Profesor'),
(1008,'Valentina Diaz','vd1008','Socio'),
(1009,'Mateo Castro','mc1009','Profesor'),
(1010,'Lucia Herrera','lh1010','Socio'),
(1011,'Andres Torres','at1011','Profesor'),
(1012,'Camila Morales','cm1012','Socio'),
(1013,'Martin Vega','mv1013','Profesor'),
(1014,'Paula Rios','pr1014','Socio'),
(1015,'Javier Medina','jm1015','Profesor'),
(1016,'Florencia Ruiz','fr1016','Socio'),
(1017,'Rodrigo Acosta','ra1017','Profesor'),
(1018,'Martina Ponce','mp1018','Socio'),
(1019,'Gabriel Suarez','gs1019','Profesor'),
(1020,'Julieta Sosa','js1020','Socio'),
(1021,'Nicolas Cabrera','nc1021','Profesor'),
(1022,'Agustina Romero','ar1022','Socio'),
(1023,'Federico Molina','fm1023','Profesor'),
(1024,'Carla Ortiz','co1024','Socio'),
(1025,'Santiago Gimenez','sg1025','Profesor'),
(1026,'Victoria Benitez','vb1026','Socio'),
(1027,'Facundo Navarro','fn1027','Profesor'),
(1028,'Emilia Pereyra','ep1028','Socio'),
(1029,'Bruno Correa','bc1029','Profesor'),
(1030,'Renata Alvarez','ra1030','Socio');
GO

INSERT INTO Telefonos (ci,telefono)
VALUES
(1001,91100001),
(1002,91100002),
(1003,91100003),
(1004,91100004),
(1005,91100005),
(1006,91100006),
(1007,91100007),
(1008,91100008),
(1009,91100009),
(1010,91100010),
(1011,91100011),
(1012,91100012),
(1013,91100013),
(1014,91100014),
(1015,91100015),
(1016,91100016),
(1017,91100017),
(1018,91100018),
(1019,91100019),
(1020,91100020),
(1021,91100021),
(1022,91100022),
(1023,91100023),
(1024,91100024),
(1025,91100025),
(1026,91100026),
(1027,91100027),
(1028,91100028),
(1029,91100029),
(1030,91100030);
GO

INSERT INTO Membresias (Nombre,precio)
VALUES
('Basica',1200),
('Premium',1800),
('VIP',2500),
('Estudiante',900),
('Familiar',3000),
('Basica Plus',1400),
('Premium Plus',2000),
('VIP Plus',2800),
('Mensual A',1000),
('Mensual B',1100),
('Mensual C',1200),
('Mensual D',1300),
('Mensual E',1400),
('Mensual F',1500),
('Mensual G',1600),
('Mensual H',1700),
('Mensual I',1800),
('Mensual J',1900),
('Mensual K',2000),
('Mensual L',2100),
('Mensual M',2200),
('Mensual N',2300),
('Mensual O',2400),
('Mensual P',2500),
('Mensual Q',2600),
('Mensual R',2700),
('Mensual S',2800),
('Mensual T',2900),
('Mensual U',3000),
('Mensual V',3100);
GO

INSERT INTO Historial_Compras
(ci,id_membresia,valor,fecha_pago,fecha_exp)
VALUES
(1001,1,1200,'2026-01-01','2026-02-01'),
(1002,2,1800,'2026-01-02','2026-02-02'),
(1003,3,2500,'2026-01-03','2026-02-03'),
(1004,4,900,'2026-01-04','2026-02-04'),
(1005,5,3000,'2026-01-05','2026-02-05'),
(1006,6,1400,'2026-01-06','2026-02-06'),
(1007,7,2000,'2026-01-07','2026-02-07'),
(1008,8,2800,'2026-01-08','2026-02-08'),
(1009,9,1000,'2026-01-09','2026-02-09'),
(1010,10,1100,'2026-01-10','2026-02-10'),
(1011,11,1200,'2026-01-11','2026-02-11'),
(1012,12,1300,'2026-01-12','2026-02-12'),
(1013,13,1400,'2026-01-13','2026-02-13'),
(1014,14,1500,'2026-01-14','2026-02-14'),
(1015,15,1600,'2026-01-15','2026-02-15'),
(1016,16,1700,'2026-01-16','2026-02-16'),
(1017,17,1800,'2026-01-17','2026-02-17'),
(1018,18,1900,'2026-01-18','2026-02-18'),
(1019,19,2000,'2026-01-19','2026-02-19'),
(1020,20,2100,'2026-01-20','2026-02-20'),
(1021,21,2200,'2026-01-21','2026-02-21'),
(1022,22,2300,'2026-01-22','2026-02-22'),
(1023,23,2400,'2026-01-23','2026-02-23'),
(1024,24,2500,'2026-01-24','2026-02-24'),
(1025,25,2600,'2026-01-25','2026-02-25'),
(1026,26,2700,'2026-01-26','2026-02-26'),
(1027,27,2800,'2026-01-27','2026-02-27'),
(1028,28,2900,'2026-01-28','2026-02-28'),
(1029,29,3000,'2026-01-29','2026-03-01'),
(1030,30,3100,'2026-01-30','2026-03-02');
GO

INSERT INTO Canchas
(tipo_cancha,capacidad)
VALUES
('Futbol 5',10),
('Futbol 5',10),
('Futbol 7',14),
('Futbol 7',14),
('Basquetbol',12),
('Basquetbol',12),
('Tenis',4),
('Tenis',4),
('Padel',4),
('Padel',4),
('Voleibol',12),
('Voleibol',12),
('Futbol 5',10),
('Futbol 5',10),
('Futbol 7',14),
('Futbol 7',14),
('Basquetbol',12),
('Basquetbol',12),
('Tenis',4),
('Tenis',4),
('Padel',4),
('Padel',4),
('Voleibol',12),
('Voleibol',12),
('Futbol 5',10),
('Futbol 7',14),
('Basquetbol',12),
('Tenis',4),
('Padel',4),
('Voleibol',12);
GO

INSERT INTO Actividades
(nombre,descripcion)
VALUES
('Natacion','Clases de natacion'),
('Musculacion','Entrenamiento en gimnasio'),
('Futbol','Practica de futbol'),
('Basquetbol','Practica de basquetbol'),
('Tenis','Practica de tenis'),
('Padel','Practica de padel'),
('Voleibol','Practica de voleibol'),
('Crossfit','Entrenamiento funcional'),
('Yoga','Clases de yoga'),
('Pilates','Clases de pilates'),
('Spinning','Bicicleta fija'),
('Boxeo','Entrenamiento de boxeo'),
('Karate','Artes marciales'),
('Judo','Artes marciales'),
('Taekwondo','Artes marciales'),
('Zumba','Baile fitness'),
('Aerobica','Ejercicios aerobicos'),
('Running','Entrenamiento de carrera'),
('Stretching','Flexibilidad'),
('Ajedrez','Actividad recreativa'),
('Handball','Practica de handball'),
('Hockey','Practica de hockey'),
('Gimnasia','Gimnasia general'),
('Escalada','Muro de escalada'),
('Patinaje','Clases de patinaje'),
('Atletismo','Entrenamiento atletico'),
('Rugby','Practica de rugby'),
('Natacion Avanzada','Natacion nivel avanzado'),
('Musculacion Avanzada','Gimnasio avanzado'),
('Futbol Infantil','Escuela de futbol');
GO

INSERT INTO Habilitado
(ci,id_actividad)
VALUES
(1003,1),
(1005,2),
(1007,3),
(1009,4),
(1011,5),
(1013,6),
(1015,7),
(1017,8),
(1019,9),
(1021,10),
(1023,11),
(1025,12),
(1027,13),
(1029,14),
(1003,15),
(1005,16),
(1007,17),
(1009,18),
(1011,19),
(1013,20),
(1015,21),
(1017,22),
(1019,23),
(1021,24),
(1023,25),
(1025,26),
(1027,27),
(1029,28),
(1003,29),
(1005,30);
GO

INSERT INTO Clases
(id_cancha,ci,horario_inicio,horario_fin)
VALUES
(1,1003,'2026-06-01 08:00','2026-06-01 09:00'),
(2,1005,'2026-06-01 09:00','2026-06-01 10:00'),
(3,1007,'2026-06-01 10:00','2026-06-01 11:00'),
(4,1009,'2026-06-01 11:00','2026-06-01 12:00'),
(5,1011,'2026-06-01 12:00','2026-06-01 13:00'),
(6,1013,'2026-06-01 13:00','2026-06-01 14:00'),
(7,1015,'2026-06-01 14:00','2026-06-01 15:00'),
(8,1017,'2026-06-01 15:00','2026-06-01 16:00'),
(9,1019,'2026-06-01 16:00','2026-06-01 17:00'),
(10,1021,'2026-06-01 17:00','2026-06-01 18:00'),
(11,1023,'2026-06-01 18:00','2026-06-01 19:00'),
(12,1025,'2026-06-01 19:00','2026-06-01 20:00'),
(13,1027,'2026-06-01 20:00','2026-06-01 21:00'),
(14,1029,'2026-06-01 21:00','2026-06-01 22:00'),
(15,1003,'2026-06-02 08:00','2026-06-02 09:00'),
(16,1005,'2026-06-02 09:00','2026-06-02 10:00'),
(17,1007,'2026-06-02 10:00','2026-06-02 11:00'),
(18,1009,'2026-06-02 11:00','2026-06-02 12:00'),
(19,1011,'2026-06-02 12:00','2026-06-02 13:00'),
(20,1013,'2026-06-02 13:00','2026-06-02 14:00'),
(21,1015,'2026-06-02 14:00','2026-06-02 15:00'),
(22,1017,'2026-06-02 15:00','2026-06-02 16:00'),
(23,1019,'2026-06-02 16:00','2026-06-02 17:00'),
(24,1021,'2026-06-02 17:00','2026-06-02 18:00'),
(25,1023,'2026-06-02 18:00','2026-06-02 19:00'),
(26,1025,'2026-06-02 19:00','2026-06-02 20:00'),
(27,1027,'2026-06-02 20:00','2026-06-02 21:00'),
(28,1029,'2026-06-02 21:00','2026-06-02 22:00'),
(29,1003,'2026-06-03 08:00','2026-06-03 09:00'),
(30,1005,'2026-06-03 09:00','2026-06-03 10:00');
GO

INSERT INTO Lista
(ci,id_clase,estado)
VALUES
(1001,1,'Asistencia'),
(1002,2,'Asistencia'),
(1004,3,'Pendiente'),
(1006,4,'Cancelado'),
(1008,5,'Asistencia'),
(1010,6,'Inasistencia'),
(1012,7,'Asistencia'),
(1014,8,'Pendiente'),
(1016,9,'Asistencia'),
(1018,10,'Cancelado'),
(1020,11,'Asistencia'),
(1022,12,'Inasistencia'),
(1024,13,'Asistencia'),
(1026,14,'Pendiente'),
(1028,15,'Asistencia'),
(1030,16,'Cancelado'),
(1001,17,'Asistencia'),
(1002,18,'Pendiente'),
(1004,19,'Asistencia'),
(1006,20,'Inasistencia'),
(1008,21,'Asistencia'),
(1010,22,'Cancelado'),
(1012,23,'Asistencia'),
(1014,24,'Pendiente'),
(1016,25,'Asistencia'),
(1018,26,'Inasistencia'),
(1020,27,'Asistencia'),
(1022,28,'Cancelado'),
(1024,29,'Asistencia'),
(1026,30,'Pendiente'),
(1022, 1, 'Pendiente');
GO


-- Procedimientos Almacenados
-- Login

CREATE PROCEDURE sp_Login
	@ci int,
	@passwd nvarchar(100)
	as begin
	select nombre, rol from Personas
	where ci = @ci and passwd = @passwd and estado = 'Activo'
end

