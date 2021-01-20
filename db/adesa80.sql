------------------------------
-- Archivo de base de datos --
------------------------------

-- [idea] equipos (categoria, genero, entrenador)

-- videos (descripcion, titulo, archivo, contadorVisitas)

-- fotos (titulo, archivo, validada[?], fecha, contadorVisitas, equipo)

-- usuario (migue, contraseña)
-- [idea] usuarios (nombre, contraseña, email, token)

-- [idea] comentarios (video, texto, usuario)

-- DROP TABLE IF EXISTS categorias CASCADE;

-- CREATE TABLE categorias
-- (
--       id            BIGSERIAL       PRIMARY KEY
--     , nombre        VARCHAR(15)     NOT NULL UNIQUE
-- );

DROP TABLE IF EXISTS equipos CASCADE;

CREATE TABLE equipos
(
      id            BIGSERIAL       PRIMARY KEY
    , categoria     VARCHAR(15)     NOT NULL
    -- , categoria     BIGINT          NOT NULL
    --                                 REFERENCES categorias(id)
    --                                 ON DELETE NO ACTION
    --                                 ON UPDATE CASCADE
    , genero        CHAR(1)         NOT NULL
    , entrenador    VARCHAR(32)     NOT NULL
    , CONSTRAINT ck_genero_valido   CHECK (genero = 'M' OR genero = 'F')
);

DROP TABLE IF EXISTS videos CASCADE;

CREATE TABLE videos
(
      id                BIGSERIAL       PRIMARY KEY
    , titulo            VARCHAR(255)    NOT NULL
    , descripcion       TEXT            NOT NULL
    , archivo           VARCHAR(255)    NOT NULL
    , contadorVisitas   NUMERIC(6)      NOT NULL
);