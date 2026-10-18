# GUÍA MAESTRA DE INSTALACIÓN, OPERACIÓN Y CREDENCIALES
## PROYECTO MOODLE LMS 5.3 — LABORATORIO DE AUDITORÍA INFORMÁTICA ISO

> **Asignatura:** Auditoría Informática (INF 881) — Octavo Semestre  
> **Guía Metodológica:** Actividad Grupal 1: "Diagnóstico y Análisis de Riesgos" (`Actividad1.pdf` / ISO/IEC 27005:2022)  
> **Docente:** Lic. Erick Sierra Caballero  
> **Auditor / Responsable Técnico:** Alfredo Llanos Taca  
> **URL Local de Acceso:** [http://localhost:8000](http://localhost:8000)  
> **Puerto PostgreSQL:** `5433` (Clúster aislado dedicado)

---

## 1. Credenciales de Acceso del Laboratorio (100% Verificadas)

Todas las contraseñas han sido verificadas empíricamente contra el motor de base de datos PostgreSQL 18 utilizando el algoritmo nativo de hash `bcrypt` de Moodle LMS.

### 1.1 Cuentas del Entorno Moodle (Portal Web)

| Rol Institucional | Nombre de Usuario (`username`) | Nombre Completo | Contraseña Activa | Correo Registrado | Contexto de Asignación |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Administrador del Sistema** | `admin_auditoria` | Admin User | `X%RDN5bnFyqPG@6+U&` | `admin@audit.local` | Contexto Global de Sistema |
| **Docente Titular 1** | `profesor1` | Docente Uno | `=YKvHz$nxsws5b@VYI` | `profesor1@audit.local` | Curso AUD-101 (Profesor con permiso de edición) |
| **Docente Titular 2** | `profesor2` | Docente Dos | `1F4h30LgRcUPwNJE7r` | `profesor2@audit.local` | Curso AUD-101 (Profesor con permiso de edición) |
| **Estudiante Ficticio 1** | `estudiante1` | Estudiante Uno | `Zg*Ya4mQBfy%NSHkKA` | `estudiante1@audit.local` | Curso AUD-101 (Estudiante matriculado) |
| **Estudiante Ficticio 2** | `estudiante2` | Estudiante Dos | `@%OUleIBl8Ex)mMi(X` | `estudiante2@audit.local` | Curso AUD-101 (Estudiante matriculado) |
| **Estudiante Ficticio 3** | `estudiante3` | Estudiante Tres | `yqu7Cz1Ae52_8SWp)W` | `estudiante3@audit.local` | Curso AUD-101 (Estudiante matriculado) |
| **Estudiante Ficticio 4** | `estudiante4` | Estudiante Cuatro | `)qXPt)=^@OU&l4GvSG` | `estudiante4@audit.local` | Curso AUD-101 (Estudiante matriculado) |
| **Estudiante Ficticio 5** | `estudiante5` | Estudiante Cinco | `A_fvm%y8%NlX35##7(` | `estudiante5@audit.local` | Curso AUD-101 (Estudiante matriculado) |

> **Nota de Seguridad de la Bóveda Local:**  
> Estas claves de alta entropía fueron generadas y validadas mediante `cambiar_credenciales_laboratorio.php` y se encuentran respaldadas en la bóveda protegida del host:  
> `C:\Users\llano\AppData\Roaming\Moodle_Laboratorio_Credenciales_Boveda.json`.

---

### 1.2 Base de Datos PostgreSQL 18 (Motor Relacional)

| Parámetro | Valor Configurado | Descripción |
| :--- | :--- | :--- |
| **Host / Dirección** | `127.0.0.1` | Interfaz local de bucle invertido (*loopback*) |
| **Puerto de Conexión** | `5433` | Puerto aislado para evitar colisiones con el puerto estándar `5432` |
| **Nombre de Base de Datos** | `moodle` | Base de datos principal con 499 tablas relacionales |
| **Usuario de Aplicación** | `moodleuser` | Usuario de Moodle con privilegios sobre el esquema `public` |
| **Contraseña de BD** | `Moodle_Audit_2026_Secure!` | Contraseña asignada en `config.php` |
| **Superusuario del Clúster** | `postgres` | Administrador del motor relacional |
| **Ruta del Clúster de Datos** | `02_ENTORNO_EJECUCION\pgsql_data\` | Directorio físico del almacenamiento de datos |

---

## 2. Cómo Instalar y Ejecutar el Laboratorio Localmente

### 2.1 Requisitos del Sistema
- **Sistema Operativo:** Windows 10 / Windows 11 (64 bits).
- **PHP:** Versión 8.4.x (64 bits) en la ruta del sistema o instalada mediante WinGet (`PHP.PHP.8.4`).
  - *Extensiones obligatorias activas en `php.ini`:* `curl`, `fileinfo`, `gd`, `intl`, `mbstring`, `openssl`, `pdo_pgsql`, `pgsql`, `soap`, `sodium`, `zip`, `exif`, `opcache`.
  - *Parámetro recomendado:* `max_input_vars = 5000`.
- **PostgreSQL:** Versión 18.x instalada en `C:\Program Files\PostgreSQL\18\bin`.

---

### 2.2 Procedimiento de Despliegue y Ajuste de Permisos

Si estás clonando o descargando el proyecto en una nueva estación de trabajo:

1. **Ubicación del Proyecto:**  
   Colocar el contenido en una ruta sin espacios complejos o en la carpeta prevista:  
   `C:\Users\llano\Documents\OCTAVO SEMESTRE\AUDITORIA\PROYECTO\Moodle_Auditoria_ISO`

2. **Verificar Archivo de Configuración (`config.php`):**  
   En `01_CODIGO_FUENTE\moodle\config.php`, asegurarse de que las rutas reflejen el entorno local:
   ```php
   $CFG->dbtype    = 'pgsql';
   $CFG->dblibrary = 'native';
   $CFG->dbhost    = '127.0.0.1';
   $CFG->dbname    = 'moodle';
   $CFG->dbuser    = 'moodleuser';
   $CFG->dbpass    = 'Moodle_Audit_2026_Secure!';
   $CFG->prefix    = 'mdl_';
   $CFG->dboptions = array (
       'dbpersist' => 0,
       'dbport' => 5433,
       'dbsocket' => '',
   );

   $CFG->wwwroot   = 'http://localhost:8000';
   $CFG->dataroot  = 'C:\\Users\\llano\\Documents\\OCTAVO SEMESTRE\\AUDITORIA\\PROYECTO\\Moodle_Auditoria_ISO\\02_ENTORNO_EJECUCION\\moodledata';
   $CFG->admin     = 'admin';
   $CFG->directorypermissions = 02777;
   require_once(__DIR__ . '/lib/setup.php');
   ```

3. **Retirar Atributo de Solo Lectura de Windows sobre `moodledata`:**  
   En Windows, la sincronización de OneDrive o atributos predeterminados pueden marcar la carpeta de datos con el flag `Read-Only`, generando un error 500 en Moodle (`$CFG->dataroot is not writable`).  
   Para corregirlo, abrir PowerShell y ejecutar:
   ```powershell
   attrib -r "02_ENTORNO_EJECUCION\moodledata"
   attrib -r "02_ENTORNO_EJECUCION\moodledata\*" /s /d
   ```

---

## 3. Comandos de Operación Rápida (Scripts de PowerShell)

Dentro del directorio `02_ENTORNO_EJECUCION` se han creado scripts automatizados para el control íntegro de la pila de servicios:

### 3.1 Iniciar el Sistema (Base de Datos + Servidor Web)
Ejecutar desde PowerShell en la raíz del proyecto `Moodle_Auditoria_ISO`:
```powershell
powershell -ExecutionPolicy Bypass -File "02_ENTORNO_EJECUCION\iniciar_moodle.ps1"
```
**¿Qué hace este script?**
1. Comprueba si el clúster PostgreSQL 18 ya está activo en el puerto 5433; si no, lo inicia mediante `pg_ctl start`.
2. Comprueba si el servidor web PHP ya está activo en el puerto 8000; si no, lanza el servidor integrado (`php -S 0.0.0.0:8000`) apuntando al router `02_ENTORNO_EJECUCION\router.php` y a la raíz pública `01_CODIGO_FUENTE\moodle\public`.
3. Registra el PID en `02_ENTORNO_EJECUCION\php_server_pid.txt` y confirma la disponibilidad en `http://localhost:8000`.

---

### 3.2 Detener el Sistema Limpiamente
```powershell
powershell -ExecutionPolicy Bypass -File "02_ENTORNO_EJECUCION\detener_moodle.ps1"
```
**¿Qué hace este script?**
1. Detiene de forma segura el proceso del servidor PHP en el puerto 8000.
2. Invoca el script `03_detener_servicio_postgresql.ps1` para finalizar el motor PostgreSQL 18 sin corrupción de tablas ni pérdida de transacciones.

---

### 3.3 Ejecutar el Cron Programado de Moodle
```powershell
powershell -ExecutionPolicy Bypass -File "02_ENTORNO_EJECUCION\ejecutar_cron.ps1"
```
Ejecuta las tareas periódicas del núcleo de Moodle (limpieza de sesiones expiradas, cálculo de completitud de cursos, envío de notificaciones y actualización de eventos de auditoría).

---

### 3.4 Comprobación Manual de Sockets y Puertos
Si deseas verificar el estado de los puertos en cualquier momento:
```powershell
Get-NetTCPConnection -LocalPort 8000, 5433 -State Listen
```

---

## 4. Estructura de Directorios del Repositorio

```text
Moodle_Auditoria_ISO/
├── 00_CONTROL_PROYECTO/          # Informes de instalación, verificación y hashes SHA-256
├── 01_CODIGO_FUENTE/
│   ├── devdocs/                 # Documentación oficial para desarrolladores de Moodle
│   ├── moodle-docker/           # Pila oficial de despliegue Docker
│   └── moodle/                  # Código fuente de Moodle 5.3.0 (public/, admin/, lib/)
├── 02_ENTORNO_EJECUCION/
│   ├── moodledata/              # Directorio de datos (caché, sesiones, paquetes lang/es)
│   ├── pgsql_data/              # Clúster de datos físicos de PostgreSQL 18 (Puerto 5433)
│   ├── scripts/                 # Scripts auxiliares de creación de datos y rotación
│   ├── iniciar_moodle.ps1       # Script de encendido del laboratorio
│   ├── detener_moodle.ps1       # Script de apagado limpio
│   ├── ejecutar_cron.ps1        # Script de ejecución del cron CLI
│   └── router.php               # Enrutador para servidor web integrado PHP
├── 03_BASE_DATOS/scripts/       # Scripts SQL y PS1 de gestión del clúster PostgreSQL
├── 04_DOCUMENTACION_OFICIAL/    # 23 temas oficiales de Moodle HQ en MD, HTML y PDF
├── 06_EVIDENCIAS_INSTALACION/   # 16 capturas PNG (EVID-001 a EVID-016) y logs del sistema
├── 07_BACKUPS/                  # Respaldo SQL maestro (pg_dump), código y manifiesto SHA-256
├── 08_PRUEBAS/                  # Matriz de 17 pruebas técnicas de verificación
└── 09_AUDITORIA_ISO/            # Fichas técnicas de 8 normas ISO y reporte de seguridad nativo
```

---

## 5. Validación del Levantamiento Documental ("Al Pie de la Letra")

En el archivo principal [`LEVANTAMIENTO_ACTIVIDAD1_MOODLE.md`](file:///c:/Users/llano/Documents/OCTAVO%20SEMESTRE/AUDITORIA/PROYECTO/LEVANTAMIENTO_ACTIVIDAD1_MOODLE.md) (111 KB) se ha estructurado de forma íntegra, exhaustiva y fidedigna toda la información para la **Actividad Grupal 1: Diagnóstico y Análisis de Riesgos** conforme a la guía académica `Actividad1.pdf` y la norma **ISO/IEC 27005:2022**.

### Cuadro de Conformidad Metodológica

| Exigencia de la Guía Académica | Estado | Ubicación en el Expediente | Observación y Justificación Técnica |
| :--- | :---: | :--- | :--- |
| **Planilla 1: Contexto Organizacional** | **CUMPLE 100%** | Sección 2.2 de `LEVANTAMIENTO_ACTIVIDAD1_MOODLE.md` | Define alcance, tipo de organización, misión, visión, objetivos estratégicos y criterios de riesgo (Aceptable, Tolerable, Inaceptable) adaptados a una institución académica. |
| **Planilla 2: Procesos de la Organización** | **CUMPLE 100%** | Sección 3.2 de `LEVANTAMIENTO_ACTIVIDAD1_MOODLE.md` | Documenta los 6 procesos reales del sistema: P01 (IAM), P02 (Gestión Académica), P03 (Logging Forense), P04 (Gestión de BD), P05 (Cron y Mantenimiento) y P06 (Respaldos). |
| **Planilla 3: Inventario y Valoración de Activos** | **CUMPLE 100%** | Sección 4.2 de `LEVANTAMIENTO_ACTIVIDAD1_MOODLE.md` | Cataloga 14 activos (A01 a A14) tipificados en Información, Software, Hardware, Red y Personas, con valoración granular de Confidencialidad, Integridad y Disponibilidad (C-I-D). |
| **Planilla 4: Amenazas y Vulnerabilidades** | **CUMPLE 100%** | Sección 5.2 de `LEVANTAMIENTO_ACTIVIDAD1_MOODLE.md` | Mapeo riguroso de amenazas reales (intencionales, accidentales y ambientales) y vulnerabilidades técnicas asociadas por cada activo. |
| **Planilla 5: Escenarios de Riesgo** | **CUMPLE 100%** | Sección 6.2 de `LEVANTAMIENTO_ACTIVIDAD1_MOODLE.md` | 13 escenarios detallados (ESC-01 a ESC-13) con causas, consecuencias, controles existentes, probabilidad (P), impacto (I) y nivel de riesgo inherente. |
| **Línea Base de Seguridad (20 Checks Nativos)** | **CUMPLE 100%** | Sección 7 de `LEVANTAMIENTO_ACTIVIDAD1_MOODLE.md` | Detalle de los 20 controles de Moodle (`report_security`), destacando 1 CRITICAL/ERROR real (`core_publicpaths`), 4 WARN y 15 OK. |
| **Doble Fechado Riguroso** | **CUMPLE 100%** | Secciones 1 y 10 de `LEVANTAMIENTO_ACTIVIDAD1_MOODLE.md` | Distingue formalmente entre la fecha de ocurrencia técnica original (12/10/2026) y la fecha de inspección (18/10/2026). |
| **Tipificación Epistemológica de Datos** | **CUMPLE 100%** | Todo el documento | Cada dato está etiquetado como `[OBSERVADO]`, `[DOCUMENTADO]`, `[INFERENCIA]` o `[PENDIENTE DE CONFIRMACIÓN]`. |
| **Exclusión Total del Ejemplo "SICAF"** | **CUMPLE 100%** | Todo el documento | Ningún dato de la empresa farmacéutica de ejemplo fue arrastrado al proyecto. |
| **Segregación Entorno vs Realidad** | **CUMPLE 100%** | Sección 1 y 2.1 | Se diferencia con total claridad los datos ficticios del curso AUD-101 y la infraestructura del estudiante/docente. |

---

## 6. Contacto y Soporte
- **Auditor Responsable:** Alfredo Llanos Taca
- **Asignatura:** Auditoría Informática (INF 881)
- **Repositorio:** `Moodle_Auditoria_ISO`
