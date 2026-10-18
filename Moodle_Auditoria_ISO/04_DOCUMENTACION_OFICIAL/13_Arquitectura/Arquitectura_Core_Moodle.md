# Arquitectura de Subsistemas del Core de Moodle

> **METADATOS DE AUDITORÍA:**
> - **Fuente oficial:** MoodleDocs / MoodleDev HQ
> - **URL Oficial Principal:** https://moodledev.io/docs/apis/subsystems
> - **URL Oficial Español:** https://docs.moodle.org/all/es/Arquitectura
> - **Fecha de Consulta:** 12 de Octubre de 2026
> - **Versión Moodle:** 5.3 (v5.3.0)
> - **Categoría:** 13_Arquitectura
> - **Nota Técnica:** Se conserva la versión inglesa vigente por prevalencia técnica complementada con referencias en español.

---

## Resumen Ejecutivo
Desglose técnico de los componentes que integran el núcleo del LMS.

---

## Contenido Técnico Oficial
1. Subsistemas Fundamentales

  core_access: Motor de control de accesos y RBAC.
  core_files: Sistema de archivos desacoplado con almacenamiento basado en SHA1/SHA256 (content-addressed storage).
  core_task: Programador y ejecutor de tareas cron y ad-hoc.
  core_hook: Sistema moderno de inyección de hooks para desacoplamiento de plugins.
  core_user: Gestión centralizada de identidades.

---
*Archivo consolidado para el Expediente de Auditoría ISO Moodle 5.3*
