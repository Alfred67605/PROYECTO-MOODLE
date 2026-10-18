# Estrategias de Copia de Seguridad y Recuperación ante Desastres

> **METADATOS DE AUDITORÍA:**
> - **Fuente oficial:** MoodleDocs / MoodleDev HQ
> - **URL Oficial Principal:** https://docs.moodle.org/503/en/Site_backup
> - **URL Oficial Español:** https://docs.moodle.org/all/es/Copia_de_seguridad_del_sitio
> - **Fecha de Consulta:** 12 de Octubre de 2026
> - **Versión Moodle:** 5.3 (v5.3.0)
> - **Categoría:** 09_Backup_Restauracion
> - **Nota Técnica:** Se conserva la versión inglesa vigente por prevalencia técnica complementada con referencias en español.

---

## Resumen Ejecutivo
Procedimientos de respaldo consistente de los tres componentes esenciales de Moodle.

---

## Contenido Técnico Oficial
1. Los Tres Componentes Esenciales

  Código Fuente (Moodle Core): Directorio de scripts PHP. Respaldado vía Git o paquete tar.gz.
  Base de Datos (PostgreSQL): Dumps transaccionales consistentes generados con pg_dump.
  Directorio de Datos (moodledata): Almacén de archivos físicos (filedir), cachés y certificados.

2. Respaldo Automatizado de Cursos (.mbz)
Moodle genera paquetes de archivo de curso comprimidos en formato MBZ que contienen la estructura curricular, banco de preguntas, recursos y opcionalmente los datos de los usuarios.

---
*Archivo consolidado para el Expediente de Auditoría ISO Moodle 5.3*
