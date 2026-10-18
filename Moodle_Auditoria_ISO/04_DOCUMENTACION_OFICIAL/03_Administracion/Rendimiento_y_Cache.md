# Recomendaciones Oficiales de Rendimiento y Moodle Universal Cache (MUC)

> **METADATOS DE AUDITORÍA:**
> - **Fuente oficial:** MoodleDocs / MoodleDev HQ
> - **URL Oficial Principal:** https://docs.moodle.org/503/en/Performance_recommendations
> - **URL Oficial Español:** https://docs.moodle.org/all/es/Recomendaciones_sobre_rendimiento
> - **Fecha de Consulta:** 12 de Octubre de 2026
> - **Versión Moodle:** 5.3 (v5.3.0)
> - **Categoría:** 03_Administracion
> - **Nota Técnica:** Se conserva la versión inglesa vigente por prevalencia técnica complementada con referencias en español.

---

## Resumen Ejecutivo
Estrategias de optimización técnica para alta disponibilidad y reducción de tiempos de respuesta en plataformas Moodle.

---

## Contenido Técnico Oficial
1. Moodle Universal Cache (MUC)
MUC proporciona un sistema multicapa de almacenamiento en caché para definiciones, cadenas de idioma y objetos de sesión, reduciendo significativamente las consultas a la base de datos.
2. Buenas Prácticas de Optimización

  Habilitar OPcache en PHP con memoria suficiente (al menos 128MB).
  Configurar adecuadamente los índices de base de datos en PostgreSQL.
  Separar los discos de almacenamiento de base de datos y moodledata en entornos productivos.
  Ejecutar el cron periódicamente a través de CLI para evitar bloqueos web.

---
*Archivo consolidado para el Expediente de Auditoría ISO Moodle 5.3*
