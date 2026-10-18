# INFORME TÉCNICO DE INSTALACIÓN, CONFIGURACIÓN Y LÍNEA BASE DE AUDITORÍA
# MOODLE LMS 5.3 (ETIQUETA OFICIAL v5.3.0)

**Expediente de Auditoría:** ISO/IEC 27001 - ISO/IEC 25010 - ISO 19011  
**Fecha de Emisión:** 12 de Octubre de 2026  
**Responsable Técnico:** Especialista DevOps y Auditor de Sistemas de Información  
**Entorno de Laboratorio:** Estación de Trabajo Local (Windows 11 Pro 64-bit)  

---

## 1. Objetivo
Desplegar una instancia local totalmente funcional, inmutable y reproducible de **Moodle 5.3 (v5.3.0)** soportada por una base de datos relacional **PostgreSQL 18+**, configurando el idioma Español Internacional como predeterminado, aprovisionando datos de prueba representativos para auditoría, y consolidando un expediente documental oficial exhaustivo con evidencia técnica, sumas criptográficas y trazabilidad para procesos de auditoría bajo estándares ISO/IEC.

---

## 2. Alcance
- Descarga y verificación de integridad de las fuentes oficiales de Moodle HQ (Moodle Core, Moodle-Docker y DevDocs).
- Aislamiento y configuración de base de datos dedicada en PostgreSQL sobre puerto no conflictivo (5433).
- Configuración y habilitación de extensiones críticas de PHP 8.4.
- Instalación automatizada e inmutable de la plataforma mediante CLI (`admin/cli/install.php`).
- Configuración de internacionalización (Español `es` y preservación de Inglés `en`).
- Aprovisionamiento de identidades ficticias y curso académico representativo (`AUD-101`).
- Verificación empírica de seguridad (`report_security`), logs de auditoría y tareas programadas (`cron.php`).
- Generación de copias de respaldo consistentes (Código, Base de Datos con `pg_dump`, y `moodledata`) con manifiesto de hashes SHA-256.
- Recopilación de documentación técnica oficial estructurada en formatos PDF, HTML y Markdown.

---

## 3. Equipo y Estación de Trabajo
- **Nombre del Equipo:** DESKTOP-FJP4IH3
- **Arquitectura:** x86_64 (64 bits)
- **Memoria RAM:** 16 GB DDR4 (15.4 GB visible en SO, 3.5 GB libres)
- **Almacenamiento:** Unidad C:\ con 354 GB disponibles en sistema de archivos NTFS.

---

## 4. Sistema Operativo (SO)
- **Denominación:** Microsoft Windows 11 Pro
- **Versión:** 10.0.26300
- **Compilación (Build):** 26300 (64-bit)

---

## 5. Requisitos del Sistema
Moodle 5.3 exige PHP >= 8.3 y soporte oficial para PostgreSQL 17/18. Todas las dependencias de memoria (`memory_limit = 512M`), tiempo de ejecución (`max_execution_time = 300s`) y extensiones criptográficas/de internacionalización se cumplieron holgadamente sin comprometer el host.

---

## 6. Herramientas Utilizadas
- **Git:** Versión 2.55.0.windows.5 para control de versiones e inmutabilidad.
- **Node.js:** Versión 24.21.0 y npm 11.19.0 para automatización documental.
- **Google Chrome Headless:** Motor de renderizado para generación de PDFs oficiales de auditoría.
- **PowerShell:** Shell nativo para automatización de tareas y servicios.

---

## 7. Versión Exacta de Moodle
- **Producto:** Moodle LMS Core
- **Versión:** 5.3 (Build: 20261005)
- **Versión Interna ($version):** 2026100500.00
- **Rama (Branch):** 503
- **Madurez:** MATURITY_STABLE
- **Etiqueta Oficial (Tag):** `v5.3.0`
- **Tag Object:** `d3ae3f3a367b936e38dcc06adfd6bf954302101d`
- **Commit SHA HEAD:** `42622298fe06f9626d988d60b2bf589bd8f850e8`
- **Licencia:** GNU General Public License v3.0 or later (GPL-3.0-or-later)

---

## 8. Base de Datos (PostgreSQL)
- **Motor:** PostgreSQL 18.6 (x86_64-windows)
- **Modo de Despliegue:** Cluster dedicado de auditoría inicializado con `initdb` en `02_ENTORNO_EJECUCION/pgsql_data`.
- **Puerto Asignado:** 5433 (aislado del puerto 5432 preexistente en el equipo).
- **Base de Datos:** `moodle`
- **Propietario / Usuario:** `moodleuser`
- **Codificación:** UTF-8 / Collation C.

---

## 9. Intérprete PHP
- **Versión:** PHP 8.4.25 (cli) (built: Aug 25 2026 18:38:47) ZTS Visual C++ 2022 x64.
- **Extensiones Validadas al 100%:** `curl`, `intl`, `mbstring`, `openssl`, `sodium`, `zip`, `gd`, `xml`, `soap`, `pgsql`, `pdo_pgsql`, `exif`, `opcache`.

---

## 10. Evaluación del Entorno Docker
- **Detección:** Docker Desktop y WSL2 no se encontraban activos en la máquina anfitriona.
- **Decisión DevOps/Auditoría:** Se clonó el repositorio oficial `moodle-docker` en `01_CODIGO_FUENTE/moodle-docker` como especificación de referencia, implementando la ejecución local nativa mediante PostgreSQL 18 + PHP 8.4 para evitar requerimientos intrusivos de reinicio de sistema o privilegios UAC no solicitados.

---

## 11. Procedimiento de Instalación
1. Creación de la estructura normalizada de carpetas `Moodle_Auditoria_ISO`.
2. Inicialización del cluster PostgreSQL en puerto 5433 y creación de BD `moodle` y usuario `moodleuser`.
3. Ajuste de `php.ini` con extensiones requeridas y adición de binarios PostgreSQL al PATH.
4. Clonación de las fuentes oficiales de Moodle en tag `v5.3.0`.
5. Ejecución del asistente CLI `admin/cli/install.php` con parámetros automatizados.
6. Instalación y activación del paquete de idioma español `es`.

---

## 12. Configuración de la Instancia
- **Nombre Completo del Sitio:** Moodle Auditoria ISO
- **Nombre Corto:** MOODLE-AUDIT
- **URL Base (wwwroot):** `http://localhost:8000`
- **Directorio de Datos (dataroot):** `Moodle_Auditoria_ISO/02_ENTORNO_EJECUCION/moodledata`
- **Router Web:** `02_ENTORNO_EJECUCION/router.php` para soporte de archivos estáticos y slasharguments.

---

## 13. Idioma y Localización
- **Idioma Predeterminado:** Español Internacional (`es`).
- **Idiomas Disponibles:** Español (`es`) e Inglés (`en`).
- **Verificación:** Interfaz de acceso, panel de control, menús administrativos y cursos renderizados en español.

---

## 14. Datos de Prueba (Ambiente de Auditoría)
- **Administrador:** `admin_auditoria` (local de laboratorio).
- **Profesores Ficticios:**
  - Prof. Carlos Mendoza (`profesor1`)
  - Dra. Elena Paredes (`profesor2`)
- **Estudiantes Ficticios:**
  - Andrea Soto (`estudiante1`)
  - David Quiroga (`estudiante2`)
  - Gabriel Morales (`estudiante3`)
  - Mariana Fuentes (`estudiante4`)
  - Valeria Ríos (`estudiante5`)
- **Curso Ficticio:** `AUD-101 Auditoría de Sistemas de Información`.
- **Actividades Implementadas:** Tarea de Auditoría ISO/IEC 27001, Foro de Debate Técnico, Cuestionario de Evaluación y Libro de Calificaciones.

---

## 15. Tareas Programadas (Cron)
- **Script de Ejecución:** `02_ENTORNO_EJECUCION/ejecutar_cron.ps1`
- **Comando Núcleo:** `php admin/cli/cron.php`
- **Registro de Evidencia:** `06_EVIDENCIAS_INSTALACION/logs/cron.log`

---

## 16. Verificación de Seguridad y Línea Base
- **Módulo:** `report_security` de Moodle Core.
- **Resultado de Auditoría Inicial:** Se conservó la línea base original sin alterar hallazgos de laboratorio (entorno HTTP local, visualización de errores controlada) para su evaluación transparente en el expediente ISO.
- **Ubicación:** `09_AUDITORIA_ISO/LINEA_BASE_SEGURIDAD/`.

---

## 17. Logs y Trazabilidad Forense
- **Mecanismo:** Standard Log Store (`mdl_logstore_standard_log`).
- **Eventos Registrados:** Inicio de sesión, matriculación de usuarios, creación de actividades, envíos de tareas y registro de calificaciones.

---

## 18. Copias de Seguridad (Backup)
- **Script:** `07_BACKUPS/ejecutar_backup_completo.ps1`
- **Componentes Respaldados:**
  1. Base de datos: Dump SQL consistente mediante `pg_dump`.
  2. Directorio de datos: Archivo comprimido de `moodledata`.
  3. Código fuente: Archivo comprimido del código de Moodle v5.3.0.
- **Integridad:** Hashes SHA-256 calculados y documentados en `07_BACKUPS/MANIFIESTO_BACKUP.txt`.

---

## 19. Documentación Oficial Descargada y Organizada
- **Total de Documentos Catalogados:** 23 documentos en 20 categorías.
- **Formatos:** PDF generado mediante Google Chrome Headless, HTML fuente y Markdown técnico.
- **Inventario:** Catalogado en `INDICE_DOCUMENTACION.xlsx` e `INDICE_DOCUMENTACION.md`.
- **Código Fuente de Documentación:** Repositorio oficial `devdocs` clonado en su totalidad (2683 archivos).

---

## 20. Incidencias Técnicas Detectadas
1. Puerto 5432 en uso por servicio previo `postgresql-x64-18` con contraseña desconocida.
2. Extensiones PHP (`intl`, `soap`, `sodium`, `exif`) deshabilitadas por defecto en la instalación de WinGet.
3. Fallo en carga inicial de `libpq.dll` debido a ausencia del directorio bin de PostgreSQL en el PATH del usuario.
4. Protección de Cloudflare (HTTP 403) ante descargas directas no autenticadas con `curl`.

---

## 21. Soluciones Implementadas
1. Creación de un cluster PostgreSQL 18 aislado en puerto 5433, garantizando independencia operativa y reproducibilidad.
2. Actualización automatizada de `php.ini` habilitando todas las extensiones requeridas y ajustando `memory_limit` a 512M.
3. Adición de `C:\Program Files\PostgreSQL\18\bin` a la variable de entorno `PATH` del usuario.
4. Renderizado y compilación de documentación oficial mediante Google Chrome Headless a partir de las fuentes oficiales de MoodleDocs y DevDocs.

---

## 22. Resultado Final
Instalación completada al 100%, sistema funcional, auditable, con base de datos PostgreSQL 18 dedicada, trazabilidad de logs, respaldos consistentes, y expediente ISO exhaustivo.

---

## 23. Evidencias Disponibles
- Registradas en `06_EVIDENCIAS_INSTALACION/capturas/` con nomenclatura estandarizada `EVID-XXX`.
- Bitácora cronológica de comandos en `06_EVIDENCIAS_INSTALACION/comandos/REGISTRO_COMANDOS.md`.
- Logs de ejecución en `06_EVIDENCIAS_INSTALACION/logs/`.

---

## 24. Rutas Físicas del Proyecto
- **Directorio Principal:** `c:\Users\llano\OneDrive\Documentos\OCTAVO SEMESTRE\AUDITORIA\PROYECTO\Moodle_Auditoria_ISO`
- **Código Moodle:** `01_CODIGO_FUENTE\moodle`
- **Base de Datos:** `02_ENTORNO_EJECUCION\pgsql_data`
- **Directorio de Datos:** `02_ENTORNO_EJECUCION\moodledata`
- **Documentación Oficial:** `04_DOCUMENTACION_OFICIAL`
- **Expediente ISO:** `09_AUDITORIA_ISO`

---

## 25. URLs Locales del Servicio
- **Portal Principal:** `http://localhost:8000/`
- **Inicio de Sesión:** `http://localhost:8000/login/index.php`
- **Administración del Sitio:** `http://localhost:8000/admin/`
- **Puerto PostgreSQL:** `127.0.0.1:5433`
