use `mvc`;

drop table if exists jugadores;

CREATE TABLE jugadores(
    id int auto_increment PRIMARY KEY,
    nombre VARCHAR(100),
    nacimiento DATETIME,
    puesto VARCHAR(30) NOT NULL
);


INSERT INTO jugadores(nombre, puesto, nacimiento)
VALUES
('De Gea', 'Portero',  '1998-05-22'),
('Kepa', 'Portero',  '1997-03-12'),
('Azpilicueta', 'Defensa',  '1995-7-08'),
('Sergio Ramos', 'Centrocampista',  '1998-05-22'),
('Jordi Alba', 'Defensa',  '1997-03-12'),
('Iñigo Martínez', 'Defensa',  '1995-7-08'),
('S. Roberto', 'Centrocampista',  '1997-03-12'),
('Isco', 'Centrocampista', '1998-05-22'),
('Asensio', 'Delantero',  '1997-03-12'),
('Saúl', 'Centrocampista',  '1988-05-22'),
('Busquets', 'Centrocampista',  '1990-03-12'),
('Diego Costa', 'Delantero',  '1995-7-08');
