# Comprobaciones Oficiales de Seguridad y Hardening

> **METADATOS DE AUDITORÍA:**
> - **Fuente oficial:** MoodleDocs / MoodleDev HQ
> - **URL Oficial Principal:** https://docs.moodle.org/503/en/Security_checks
> - **URL Oficial Español:** https://docs.moodle.org/all/es/Comprobaciones_de_seguridad
> - **Fecha de Consulta:** 12 de Octubre de 2026
> - **Versión Moodle:** 5.3 (v5.3.0)
> - **Categoría:** 06_Seguridad
> - **Nota Técnica:** Se conserva la versión inglesa vigente por prevalencia técnica complementada con referencias en español.

---

## Resumen Ejecutivo
Mecanismos de auditoría preventiva incluidos en Moodle para detección de vectores de riesgo.

---

## Contenido Técnico Oficial
1. Informe de Comprobaciones de Seguridad (report_security)
Moodle incluye una herramienta automatizada en Administración del sitio &gt; Informes &gt; Comprobaciones de seguridad que evalúa 18 aspectos críticos de seguridad:

  Accesibilidad pública de dataroot: Verifica que la carpeta moodledata no sea accesible por HTTP.
  Visualización de errores PHP (display_errors): Recomienda desactivarlo para evitar fuga de información sensible.
  Acceso de invitados abierto: Alerta si hay cursos con matrícula abierta sin clave.
  Políticas de contraseñas: Verifica que se exijan contraseñas robustas.
  Seguridad de cookies de sesión: Verifica el uso de cookies HTTPOnly y Secure (bajo HTTPS).
  Prevención de XSS y CSRF: Validación de tokens de sesión (sesskey) en todas las peticiones modificadoras.

---
*Archivo consolidado para el Expediente de Auditoría ISO Moodle 5.3*
