# Procedimientos de Actualización y Modo de Mantenimiento

> **METADATOS DE AUDITORÍA:**
> - **Fuente oficial:** MoodleDocs / MoodleDev HQ
> - **URL Oficial Principal:** https://docs.moodle.org/503/en/Upgrading
> - **URL Oficial Español:** https://docs.moodle.org/all/es/Actualizaci%C3%B3n_de_Moodle
> - **Fecha de Consulta:** 12 de Octubre de 2026
> - **Versión Moodle:** 5.3 (v5.3.0)
> - **Categoría:** 15_Actualizacion_Mantenimiento
> - **Nota Técnica:** Se conserva la versión inglesa vigente por prevalencia técnica complementada con referencias en español.

---

## Resumen Ejecutivo
Protocolos para transiciones seguras entre versiones y preservación de la continuidad del servicio.

---

## Contenido Técnico Oficial
1. Modo Mantenimiento (Maintenance Mode)
Bloquea el acceso a usuarios no administradores mediante php admin/cli/maintenance.php --enable para garantizar que no ocurran transacciones durante migraciones de esquema.
2. Migración de Esquema CLI
La ejecución de php admin/cli/upgrade.php --non-interactive actualiza tablas, índices y datos de forma atómica y auditable.

---
*Archivo consolidado para el Expediente de Auditoría ISO Moodle 5.3*
