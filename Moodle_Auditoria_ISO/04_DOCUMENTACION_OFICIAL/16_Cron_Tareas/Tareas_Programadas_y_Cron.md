# Arquitectura de Tareas Programadas y Ejecución de Cron CLI

> **METADATOS DE AUDITORÍA:**
> - **Fuente oficial:** MoodleDocs / MoodleDev HQ
> - **URL Oficial Principal:** https://docs.moodle.org/503/en/Cron
> - **URL Oficial Español:** https://docs.moodle.org/all/es/Cron
> - **Fecha de Consulta:** 12 de Octubre de 2026
> - **Versión Moodle:** 5.3 (v5.3.0)
> - **Categoría:** 16_Cron_Tareas
> - **Nota Técnica:** Se conserva la versión inglesa vigente por prevalencia técnica complementada con referencias en español.

---

## Resumen Ejecutivo
Funcionamiento del motor de tareas en segundo plano esencial para correos, limpieza y estadísticas.

---

## Contenido Técnico Oficial
1. Función del Cron
Moodle requiere la ejecución periódica del script admin/cli/cron.php cada 1 minuto en producción o según demanda en laboratorios.
2. Tareas Críticas Ejecutadas por Cron

  Envío de notificaciones por correo de foros y tareas pendientes.
  Cálculo de calificaciones agregadas complejas.
  Generación y rotación de copias de seguridad automáticas.
  Limpieza de sesiones expiradas y archivos temporales.

---
*Archivo consolidado para el Expediente de Auditoría ISO Moodle 5.3*
