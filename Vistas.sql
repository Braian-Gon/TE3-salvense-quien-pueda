create view v_All_Personas as
select ci, nombre, rol , estado 
from Personas 
where rol != 'Administrador';
GO
-- select * from v_All_Personas;

create view v_Personas_Socios as
select ci, nombre, rol, estado 
from Personas 
where rol = 'Socio';
GO
-- select * from v_Personas_Socios;

create view v_Personas_Profesores as
select ci, nombre, rol, estado 
from Personas 
where rol = 'Profesor';
GO
-- select * from v_Personas_Profesores;

create view v_All_Canchas as
select id_cancha, tipo_cancha, capacidad, estado
from Canchas;
GO
-- select * from v_All_Canchas;

create view v_All_Membresias as
select * from Membresias;
GO
-- select * from v_All_Membresias

create view v_All_Actividades as
select * from Actividades;
GO
-- select * from v_All_Actividades;

create view v_Resumen_Membresias as
select * from Historial_Compras where YEAR(fecha_pago) = YEAR(GETDATE()) and MONTH(fecha_pago) = MONTH(GETDATE());
GO
-- select * from v_Resumen_Membresias;
create view v_All_Clases as
select clase.id_clase 'ID Clase', cancha.tipo_cancha 'Cancha', profesor.nombre 'Profesor', clase.horario_inicio 'Inicio', clase.horario_fin 'Fin', clase.estado 'Estado', count(lista.ci) 'Inscriptos', cancha.capacidad 'Capacidad'
from Clases clase
Join Canchas cancha
on 
clase.id_cancha = cancha.id_cancha
Join Lista lista
on
clase.id_clase = lista.id_clase
join Personas profesor
on
clase.ci = profesor.ci
group by clase.id_clase, cancha.tipo_cancha , profesor.nombre , clase.horario_inicio , clase.horario_fin, clase.estado , lista.id_clase, cancha.capacidad;
GO
-- select * from v_All_Clases; 

create view v_Reportes_Membresias as
select count(id_compra) Compra, sum(valor) Ingresos, MONTH(fecha_pago) Mes ,Year(fecha_pago) Anio 
from Historial_Compras 
group by MONTH(fecha_pago), Year(fecha_pago);
GO
-- select * from v_Reportes_Membresias

