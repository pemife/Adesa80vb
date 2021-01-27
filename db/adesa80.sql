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

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios
(
    id                BIGSERIAL       PRIMARY KEY
  , nombre            VARCHAR(32)     NOT NULL UNIQUE
                                      CONSTRAINT ck_nombre_sin_espacios
                                      CHECK (nombre NOT ILIKE '% %')
  , password          VARCHAR(60)     NOT NULL
  , created_at        DATE            NOT NULL DEFAULT CURRENT_DATE
  -- , requested_at      TIMESTAMP(0)    DEFAULT CURRENT_TIMESTAMP
  -- , token               VARCHAR(32)
  -- , email               VARCHAR(255)    NOT NULL UNIQUE
  -- , img_key             VARCHAR(255)
);

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

DROP TABLE IF EXISTS fotos CASCADE;

CREATE TABLE fotos
(
    id                BIGSERIAL       PRIMARY KEY
  , titulo            VARCHAR(255)    NOT NULL
  , imagen_nombre     VARCHAR(255)    NOT NULL
  , imagen_url        VARCHAR(255)    NOT NULL
  , fecha             DATE            NOT NULL
  , equipo_id         BIGINT          REFERENCES equipos (id)
                                      ON DELETE NO ACTION
                                      ON UPDATE CASCADE
  , contadorVisitas   NUMERIC(6)      NOT NULL DEFAULT 0
  -- , validada          BOOLEAN         NOT NULL
);

-- DROP TABLE IF EXISTS comentarios CASCADE;

-- CREATE TABLE comentarios
-- (
--     id              BIGSERIAL         PRIMARY KEY
--   , texto           TEXT              NOT NULL
--   , created_at      TIMESTAMP(0)      NOT NULL
--                                       DEFAULT CURRENT_TIMESTAMP
--   -- , last_update     TIMESTAMP(0)      DEFAULT CURRENT_TIMESTAMP
--   , usuario_id      BIGINT            NOT NULL
--                                       REFERENCES usuarios (id)
--                                       ON DELETE NO ACTION
--                                       ON UPDATE CASCADE
--   , foto_id         BIGINT            REFERENCES fotos (id)
--                                       ON DELETE NO ACTION
--                                       ON UPDATE CASCADE
--   , video_id        BIGINT            REFERENCES videos (id)
--                                       ON DELETE NO ACTION
--                                       ON UPDATE CASCADE
--   , CONSTRAINT ck_alternar_valores_nulos CHECK (
--         (foto_id IS NOT NULL AND video_id IS NULL)
--         OR
--         (foto_id IS NULL AND video_id IS NOT NULL)
--     )
-- );


-- INSTER INTO'S --

INSERT INTO usuarios (nombre, password)
VALUES ('admin', crypt('hnmpl', gen_salt('bf', 10)));