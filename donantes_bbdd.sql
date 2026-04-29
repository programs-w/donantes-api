DROP DATABASE IF EXISTS donantes_bbdd;

CREATE DATABASE donantes_bbdd
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE donantes_bbdd;

CREATE TABLE donantes (
    id_donante INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(150) NOT NULL,
    grupo_sanguineo VARCHAR(5) NOT NULL,
    contacto VARCHAR(20) UNIQUE,
    fecha_nacimiento DATE NULL,
    ciudad_residencia VARCHAR(100),
    observaciones TEXT
);

CREATE TABLE donaciones (
    id_donacion INT AUTO_INCREMENT PRIMARY KEY,
    id_donante INT NOT NULL,
    fecha_donacion DATE NOT NULL,
    centro VARCHAR(100) NOT NULL,
    tipo_donacion VARCHAR(50) NOT NULL, 
    cantidad_ml INT,
    CONSTRAINT fk_donante
        FOREIGN KEY (id_donante)
        REFERENCES donantes(id_donante)
        ON DELETE CASCADE
);

INSERT INTO donantes (nombre, apellidos, grupo_sanguineo, contacto, fecha_nacimiento, ciudad_residencia, observaciones) VALUES
('Laura', 'Gómez Ruiz', 'A+', '600123001', '1990-04-12', 'Vitoria-Gasteiz', 'Donante habitual, sin alergias conocidas.'),
('Carlos', 'Martínez López', 'O-', '600123002', '1985-11-23', 'Donostia-San Sebastián', 'Apto para donación, presión estable.'),
('Ana', 'Serrano Díaz', 'B+', '600123003', '1998-07-05', 'Bilbao', 'Primera donación realizada en 2023.'),
('Javier', 'Pérez Santos', 'AB-', '600123004', '1979-02-18', 'Barakaldo', 'Donante poco frecuente, revisar niveles de hierro.'),
('María', 'López García', 'O+', '600123005', '1993-09-30', 'Getxo', 'Sin incidencias, buena recuperación.'),
('David', 'Hernández Torres', 'A-', '600123006', '1987-12-14', 'Vitoria-Gasteiz', 'Alergia leve al polen, sin relevancia para donación.'),
('Lucía', 'Ramírez Ortiz', 'B-', '600123007', '2000-03-22', 'Irún', 'Donante joven, apta sin restricciones.'),
('Sergio', 'Navarro Castillo', 'AB+', '600123008', '1995-06-10', 'Durango', 'Última donación en 2024, todo correcto.');

INSERT INTO donaciones (id_donante, fecha_donacion, centro, tipo_donacion, cantidad_ml) VALUES
(1, '2024-01-15', 'Centro de Donación de Sangre de Álava - Vitoria-Gasteiz', 'Sangre total', 450),
(1, '2024-06-20', 'Hospital Universitario de Álava - Txagorritxu', 'Plasma', 600),
(2, '2023-12-02', 'Hospital Universitario Donostia', 'Sangre total', 470),
(3, '2024-03-10', 'Centro Vasco de Transfusión y Tejidos Humanos - Bilbao', 'Plaquetas', 250),
(3, '2024-08-12', 'Hospital de Basurto - Bilbao', 'Sangre total', 460),
(4, '2023-11-20', 'Hospital de Cruces - Barakaldo', 'Sangre total', 455),
(5, '2024-02-05', 'Unidad Móvil de Donación - Getxo', 'Plasma', 580),
(6, '2023-10-18', 'Centro de Donación de Sangre de Álava - Vitoria-Gasteiz', 'Sangre total', 440),
(6, '2024-05-03', 'Hospital Universitario de Álava - Santiago', 'Plaquetas', 260),
(7, '2024-04-01', 'Hospital Comarcal del Bidasoa - Irún', 'Sangre total', 450),
(8, '2024-01-28', 'Hospital de Galdakao-Usansolo', 'Sangre total', 465);





