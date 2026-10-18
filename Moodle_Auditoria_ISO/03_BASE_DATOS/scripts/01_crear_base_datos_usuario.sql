-- SCRIPT DE INICIALIZACIÓN DE BASE DE DATOS Y USUARIO PARA AUDITORÍA
-- Plataforma: PostgreSQL 18+
-- Entorno: Moodle 5.3 Laboratorio de Auditoría ISO

-- 1. Crear rol con permisos de conexión y creación
DO
$$
BEGIN
    IF NOT EXISTS (SELECT FROM pg_catalog.pg_roles WHERE rolname = 'moodleuser') THEN
        CREATE ROLE moodleuser WITH LOGIN PASSWORD 'Moodle_Audit_2026_Secure!' CREATEDB;
    END IF;
END
$$;

-- 2. Crear base de datos Moodle con codificación UTF-8
-- Nota: Si se ejecuta vía psql interactivo o cliente administrativo:
-- CREATE DATABASE moodle WITH OWNER moodleuser ENCODING 'UTF8' LC_COLLATE = 'C' LC_CTYPE = 'C';

-- 3. Otorgar privilegios totales sobre la base de datos
GRANT ALL PRIVILEGES ON DATABASE moodle TO moodleuser;
