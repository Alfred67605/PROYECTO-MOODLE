# Requisitos Oficiales del Servidor y Entorno

> **METADATOS DE AUDITORÍA:**
> - **Fuente oficial:** MoodleDocs / MoodleDev HQ
> - **URL Oficial Principal:** https://docs.moodle.org/503/en/Environment_-_Server_requirements
> - **URL Oficial Español:** https://docs.moodle.org/all/es/Requisitos_del_servidor
> - **Fecha de Consulta:** 12 de Octubre de 2026
> - **Versión Moodle:** 5.3 (v5.3.0)
> - **Categoría:** 02_Instalacion
> - **Nota Técnica:** Se conserva la versión inglesa vigente por prevalencia técnica complementada con referencias en español.

---

## Resumen Ejecutivo
Especificaciones técnicas oficiales de dependencias, extensiones y configuraciones mínimas requeridas por Moodle HQ para la rama 5.3.

---

## Contenido Técnico Oficial
1. Extensiones PHP Obligatorias

  intl: Requerida para internacionalización y manipulación de locales.
  mbstring: Requerida para cadenas multiocteto UTF-8.
  curl: Requerida para comunicación con repositorios y servicios externos.
  openssl y sodium: Requeridas para cifrado, firma de tokens y seguridad de contraseñas.
  zip: Requerida para descompresión de paquetes y copias de seguridad.
  gd: Requerida para procesamiento y miniaturas de imágenes.
  xml, dom, xmlreader, xmlwriter: Requeridas para serialización y XMLDB.
  soap: Requerida para integración con servicios web corporativos.
  pgsql / pdo_pgsql: Requerida para comunicación con PostgreSQL.

2. Ajustes de PHP recomendados

  memory_limit: Mínimo 256M, recomendado 512M+.
  max_execution_time: Recomendado 300 segundos para tareas pesadas y migraciones.
  opcache.enable = 1: Para aceleración de ejecución de scripts PHP.

---
*Archivo consolidado para el Expediente de Auditoría ISO Moodle 5.3*
