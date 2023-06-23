-- Agregando tabla para pagos de solicitudes

create table pagos_solicitudes(
    id int auto_increment primary key,
    id_solicitud int not null,
    id_area int not null,
    id_direccion int not null,
    cantidad int not null,
    precio decimal(9,2) not null
)Engine=InnoDB;

