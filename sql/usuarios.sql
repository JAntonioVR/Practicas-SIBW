CREATE TABLE tipo_usuario(
    tipo VARCHAR(20) NOT NULL PRIMARY KEY
);

CREATE TABLE usuario(
    nickname VARCHAR(30) PRIMARY KEY,
    nombre VARCHAR(100),
    email    VARCHAR(100),
    clave VARCHAR(100) NOT NULL,
    tipo VARCHAR(20),
    FOREIGN KEY (tipo) REFERENCES tipo_usuario(tipo)
);


INSERT INTO tipo_usuario VALUES 
    ("anonimo"),
    ("registrado"),
    ("moderador"),
    ("gestor"),
    ("super");