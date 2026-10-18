# Arquitectura de Logs, Trazabilidad y Eventos en Moodle

> **METADATOS DE AUDITORÍA:**
> - **Fuente oficial:** MoodleDocs / MoodleDev HQ
> - **URL Oficial Principal:** https://docs.moodle.org/503/en/Event_monitoring
> - **URL Oficial Español:** https://docs.moodle.org/all/es/Monitoreo_de_eventos
> - **Fecha de Consulta:** 12 de Octubre de 2026
> - **Versión Moodle:** 5.3 (v5.3.0)
> - **Categoría:** 08_Logs_Auditoria
> - **Nota Técnica:** Se conserva la versión inglesa vigente por prevalencia técnica complementada con referencias en español.

---

## Resumen Ejecutivo
Especificación de la API de Eventos y el subsistema de registro estándar (Standard Log Store).

---

## Contenido Técnico Oficial
1. Moodle Events API
Todas las acciones significativas en Moodle disparan eventos tipificados bajo la jerarquía \core\event\*. Cada evento almacena:

  eventname: Identificador formal del evento (ej: \core\event\user_loggedin).
  component: Subsistema emisor (ej: core, mod_assign).
  action: Tipo de operación (crear, ver, actualizar, borrar).
  userid: Identificador del usuario que realizó la acción.
  courseid y contextid: Contexto académico donde ocurrió el hecho.
  ip: Dirección IP de origen.
  timecreated: Marca de tiempo UNIX exacta.

2. Almacenes de Registro (Log Stores)

  Standard log: Almacena registros en la tabla mdl_logstore_standard_log en PostgreSQL.
  External log store: Permite desviar registros a bases de datos externas o SIEM para preservación forense.

---
*Archivo consolidado para el Expediente de Auditoría ISO Moodle 5.3*
