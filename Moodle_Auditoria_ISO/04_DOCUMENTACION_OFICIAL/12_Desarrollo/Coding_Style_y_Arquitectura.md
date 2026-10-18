# Estándares de Codificación Oficiales de Moodle HQ

> **METADATOS DE AUDITORÍA:**
> - **Fuente oficial:** MoodleDocs / MoodleDev HQ
> - **URL Oficial Principal:** https://moodledev.io/general/development/policies/codingstyle
> - **URL Oficial Español:** https://docs.moodle.org/all/es/Gu%C3%ADa_de_estilo_de_codificaci%C3%B3n
> - **Fecha de Consulta:** 12 de Octubre de 2026
> - **Versión Moodle:** 5.3 (v5.3.0)
> - **Categoría:** 12_Desarrollo
> - **Nota Técnica:** Se conserva la versión inglesa vigente por prevalencia técnica complementada con referencias en español.

---

## Resumen Ejecutivo
Normas de estilo PSR-12 adaptadas, documentación PHPDoc y directrices de arquitectura limpia.

---

## Contenido Técnico Oficial
1. Reglas Principales

  Cumplimiento riguroso de convenciones de nombrado (camelCase para métodos, minúsculas para variables).
  Obligatoriedad de tipado estricto en parámetros y valores de retorno en PHP 8.x.
  Uso exclusivo de la API de manipulación de datos ($DB) para prevenir inyecciones SQL.
  Sanitización estricta de parámetros HTTP mediante required_param() y optional_param() con tipos parametrizados (PARAM_INT, PARAM_TEXT, etc.).

---
*Archivo consolidado para el Expediente de Auditoría ISO Moodle 5.3*
