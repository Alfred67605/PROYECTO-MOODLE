# Guía Oficial de Instalación de Moodle 5.3

> **METADATOS DE AUDITORÍA:**
> - **Fuente oficial:** MoodleDocs / MoodleDev HQ
> - **URL Oficial Principal:** https://docs.moodle.org/503/en/Installing_Moodle
> - **URL Oficial Español:** https://docs.moodle.org/all/es/Instalaci%C3%B3n_de_Moodle
> - **Fecha de Consulta:** 12 de Octubre de 2026
> - **Versión Moodle:** 5.3 (v5.3.0)
> - **Categoría:** 02_Instalacion
> - **Nota Técnica:** Se conserva la versión inglesa vigente por prevalencia técnica complementada con referencias en español.

---

## Resumen Ejecutivo
Procedimiento formal y detallado para el despliegue de Moodle 5.3 sobre entornos auditados con PostgreSQL.

---

## Contenido Técnico Oficial
1. Prerrequisitos de Infraestructura

  Servidor HTTP: Apache 2.4+, Nginx o servidor integrado para entornos de laboratorio.
  PHP: Versión 8.3 o superior (verificado con PHP 8.4.25).
  Motor de Base de Datos: PostgreSQL 17+ (verificado con PostgreSQL 18.6 en puerto 5433).
  Directorio de datos (moodledata): Fuera del alcance web directo con permisos estrictos de lectura y escritura.

2. Parámetros de Instalación CLI
La instalación mediante CLI (admin/cli/install.php) es el método preferido para entornos reproducibles y auditados:
php admin/cli/install.php \
  --lang=es \
  --wwwroot="http://localhost:8000" \
  --dataroot="C:/.../moodledata" \
  --dbtype=pgsql \
  --dbhost=127.0.0.1 \
  --dbport=5433 \
  --dbname=moodle \
  --dbuser=moodleuser \
  --dbpass="***" \
  --fullname="Moodle Auditoria ISO" \
  --shortname="MOODLE-AUDIT" \
  --adminuser=admin_auditoria \
  --non-interactive \
  --agree-license

---
*Archivo consolidado para el Expediente de Auditoría ISO Moodle 5.3*
