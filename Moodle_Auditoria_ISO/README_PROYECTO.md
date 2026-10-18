# EXPEDIENTE Y LABORATORIO DE AUDITORÍA ISO - MOODLE 5.3.0

Bienvenido al repositorio maestro del **Laboratorio Local y Expediente Documental Completo para Auditoría de Sistemas de Información (Normas ISO 19011, ISO/IEC 27001, 27002, 27005, 25010, 25040, 12207 y 29148)** basado en **Moodle 5.3.0**.

---

## 1. ¿QUÉ SE INSTALÓ?

Se implementó una instancia completa, inmutable y aislada de **Moodle 5.3** con su pila de soporte local en **Windows 11 Pro**:
- **Núcleo LMS:** Moodle 5.3 Oficial (Tag `v5.3.0`, Commit `42622298fe06f9626d988d60b2bf589bd8f850e8`).
- **Separación Web Root:** Estructura moderna de Moodle 5 con raíz web pública aislada en `public/`.
- **Motor de Base de Datos:** PostgreSQL 18.0 x64, ejecutando un clúster dedicado y aislado en el **puerto 5433** para no interferir con ningún servicio preexistente en el puerto 5432.
- **Intérprete y Servidor:** PHP 8.4.25 (Win64) configurado con extensiones requeridas (`intl`, `pgsql`, `pdo_pgsql`, `opcache`, `sodium`, `soap`, `exif`) y `max_input_vars = 5000`.
- **Localización:** Idioma **Español Internacional (`es`)** como idioma predeterminado del sitio (paquete oficial descargado directamente de Moodle HQ) manteniendo el inglés técnico (`en`) disponible.
- **Entorno de Datos:**
  - 1 Administrador de auditoría (`admin_auditoria`).
  - 2 Profesores ficticios (`profesor1`, `profesor2`).
  - 5 Estudiantes ficticios (`estudiante1` a `estudiante5`).
  - Curso: `AUD-101 Auditoría de Sistemas de Información`.
  - Módulos activos: Foro de discusión, Tarea con entrega y calificación, Cuestionario diagnóstico y registro de logs.

---

## 2. VERSIÓN EXACTA Y METADATOS TÉCNICOS

- **Producto:** Moodle LMS
- **Versión Oficial:** `v5.3.0` (Build: 20261005 / $version: 2026100500.00 / Branch: 503)
- **Tag Oficial Git:** `v5.3.0`
- **Commit SHA HEAD:** `42622298fe06f9626d988d60b2bf589bd8f850e8`
- **Remote Origin:** `https://github.com/moodle/moodle.git`
- **Licencia:** GNU General Public License v3 (GPLv3)
- **Base de Datos:** PostgreSQL 18.0 (BD: `moodle`, Esquema: 499 tablas nativas)

---

## 3. URL Y ACCESO LOCAL

- **URL de Acceso Local:** `http://localhost:8000`
- **Nombre del Sitio:** Moodle Auditoria ISO
- **Nombre Corto:** `MOODLE-AUDIT`

### Credenciales de Laboratorio (Pre-Auditoría):
- **Administrador:**
  - Usuario: `admin_auditoria`
  - Contraseña: `[GESTIONADA DE FORMA SEPARADA]`
- **Docentes:**
  - Usuarios: `profesor1`, `profesor2`
  - Contraseña: `[GESTIONADA DE FORMA SEPARADA]`
- **Estudiantes:**
  - Usuarios: `estudiante1`, `estudiante2`, `estudiante3`, `estudiante4`, `estudiante5`
  - Contraseña: `[GESTIONADA DE FORMA SEPARADA]`

---

## 4. CÓMO INICIAR EL SISTEMA

Para iniciar todos los servicios del laboratorio (Base de datos PostgreSQL en puerto 5433 y Servidor Web PHP en puerto 8000):

Abrir PowerShell y ejecutar:
```powershell
powershell -ExecutionPolicy Bypass -File "02_ENTORNO_EJECUCION\iniciar_moodle.ps1"
```
El script verificará el estado de PostgreSQL, iniciará el servicio si está detenido y levantará el servidor web PHP enrutado hacia `01_CODIGO_FUENTE\moodle\public`.

---

## 5. CÓMO DETENER EL SISTEMA

Para detener de forma ordenada los servicios del laboratorio:

Ejecutar en PowerShell:
```powershell
powershell -ExecutionPolicy Bypass -File "02_ENTORNO_EJECUCION\detener_moodle.ps1"
```
Esto finalizará el proceso PHP del servidor web y detendrá de forma segura el motor PostgreSQL 18 sin pérdida de datos.

---

## 6. MAPA DE UBICACIONES DEL PROYECTO

| Componente | Ruta en el Workspace | Descripción |
|---|---|---|
| **Código Fuente Moodle** | `01_CODIGO_FUENTE/moodle/` | Código inmutable clonado desde el tag oficial `v5.3.0`. |
| **Entorno Docker Oficial** | `01_CODIGO_FUENTE/moodle-docker/` | Repositorio oficial `moodlehq/moodle-docker`. |
| **Documentación Desarrollador** | `01_CODIGO_FUENTE/devdocs/` | Repositorio oficial Git de `moodle/devdocs` (2,683 ficheros). |
| **Base de Datos (Data Cluster)** | `02_ENTORNO_EJECUCION/pgsql_data/` | Clúster físico de PostgreSQL 18 (Puerto 5433). |
| **Archivos de Usuario (`dataroot`)** | `02_ENTORNO_EJECUCION/moodledata/` | Directorio de datos y paquetes de idioma (`lang/es`). |
| **Documentación Oficial Organizada** | `04_DOCUMENTACION_OFICIAL/` | 23 temas estructurados en MD, HTML y PDF en 20 categorías. |
| **Índice Documental** | `04_DOCUMENTACION_OFICIAL/INDICE_DOCUMENTACION.xlsx` y `.md` | Catálogo clasificado con estado, URLs oficiales y fechas. |
| **Evidencias Visuales (Capturas)** | `06_EVIDENCIAS_INSTALACION/capturas/` | 16 capturas oficiales PNG (`EVID-001` a `EVID-016`). |
| **Registros de Auditoría y Bitácoras** | `06_EVIDENCIAS_INSTALACION/logs/` | Bitácoras de cron (`cron.log`) y webserver. |
| **Copias de Seguridad (Backups)** | `07_BACKUPS/` | Respaldos de SQL dump (`pg_dump`), `moodledata` y código fuente. |
| **Manifiesto de Respaldo** | `07_BACKUPS/MANIFIESTO_BACKUP.txt` | Manifiesto con tamaños, fechas y sumas SHA-256. |
| **Matriz de Pruebas** | `08_PRUEBAS/MATRIZ_PRUEBAS_VERIFICACION.md` | Matriz de 17 Pruebas de Aceptación Técnica del Laboratorio (Verificación ≠ Auditoría ISO). |
| **Fichas Técnicas Normas ISO** | `09_AUDITORIA_ISO/` | Fichas oficiales de 8 normas ISO (19011, 27001, 27002, 27005, etc.). |
| **Línea Base de Seguridad** | `09_AUDITORIA_ISO/LINEA_BASE_SEGURIDAD/` | Reporte íntegro nativo de comprobaciones de seguridad (`report_security`). |
| **Sumas Criptográficas Maestras** | `00_CONTROL_PROYECTO/SHA256SUMS.txt` | Hashes SHA-256 de todas las evidencias, PDFs y backups. |
| **Informe de Instalación** | `00_CONTROL_PROYECTO/INFORME_INSTALACION_MOODLE.md` y `.pdf` | Informe de despliegue técnico del laboratorio. |
| **Informe de Verificación Pre-Auditoría** | `00_CONTROL_PROYECTO/INFORME_VERIFICACION_PREAUDITORIA.md` y `.pdf` | Informe formal de integridad documental y verificación técnica. |

---

## 7. EJECUCIÓN MANUAL DE TAREAS Y MANTENIMIENTO

### Ejecución de Tareas Programadas (Cron):
```powershell
powershell -ExecutionPolicy Bypass -File "02_ENTORNO_EJECUCION\ejecutar_cron.ps1"
```

### Ejecución de Respaldo Integral con Manifiesto SHA-256:
```powershell
powershell -ExecutionPolicy Bypass -File "07_BACKUPS\ejecutar_backup_completo.ps1"
```

### Verificación de Sumas de Integridad Criptográfica:
```powershell
powershell -ExecutionPolicy Bypass -File "02_ENTORNO_EJECUCION\scripts\generar_sha256sums.ps1"
```
