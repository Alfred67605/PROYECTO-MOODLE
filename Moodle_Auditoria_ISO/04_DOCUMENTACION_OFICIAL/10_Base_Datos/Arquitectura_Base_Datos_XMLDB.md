# Arquitectura de Base de Datos y Capa XMLDB en Moodle

> **METADATOS DE AUDITORÍA:**
> - **Fuente oficial:** MoodleDocs / MoodleDev HQ
> - **URL Oficial Principal:** https://docs.moodle.org/503/en/XMLDB
> - **URL Oficial Español:** https://docs.moodle.org/all/es/XMLDB
> - **Fecha de Consulta:** 12 de Octubre de 2026
> - **Versión Moodle:** 5.3 (v5.3.0)
> - **Categoría:** 10_Base_Datos
> - **Nota Técnica:** Se conserva la versión inglesa vigente por prevalencia técnica complementada con referencias en español.

---

## Resumen Ejecutivo
Descripción de la capa de abstracción agnóstica de base de datos y esquema relacional.

---

## Contenido Técnico Oficial
1. Abstracción con XMLDB
Moodle no utiliza sentencias DDL nativas directas para la creación de tablas. En su lugar, utiliza definiciones XML estándar en archivos db/install.xml que son interpretadas por el motor XMLDB para generar el SQL óptimo para cada motor soportado (PostgreSQL, MySQL, MariaDB, Oracle, SQL Server).
2. Convenciones del Esquema

  Prefijo de tabla configurable (por defecto mdl_).
  Claves primarias enteras autoincrementales denominadas id.
  Campos de auditoría temporales estándar: timecreated, timemodified.

---
*Archivo consolidado para el Expediente de Auditoría ISO Moodle 5.3*
