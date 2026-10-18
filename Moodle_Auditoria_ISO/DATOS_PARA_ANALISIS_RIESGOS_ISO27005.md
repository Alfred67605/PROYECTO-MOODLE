# DATOS PARA ANÁLISIS DE RIESGOS DE SEGURIDAD DE LA INFORMACIÓN (ISO/IEC 27005)
## EXPEDIENTE DE EVIDENCIAS Y RECOPILACIÓN TÉCNICA - MOODLE LMS 5.3

**Proyecto Evaluado:** Moodle Auditoria ISO (`MOODLE-AUDIT`)  
**Estándar Metodológico:** ISO/IEC 27005:2022 (*Guidance on managing information security risks*)  
**Finalidad del Documento:** Proveer datos técnicos contrastados y contexto verificable para completar la planilla de gestión de riesgos en Excel.  
**Fecha de Recopilación:** 12 de Octubre de 2026  
**Carácter de la Inspección:** Evaluación no destructiva de solo lectura sobre el entorno de laboratorio desplegado.

---

## 1. Contexto y alcance

- **Nombre del proyecto y finalidad:**
  - *Nombre:* Moodle Auditoria ISO (Nombre corto: `MOODLE-AUDIT`).
  - *Finalidad:* Laboratorio experimental y banco de pruebas académico para prácticas de auditoría técnica de sistemas de información y análisis de riesgos bajo normas de la familia ISO/IEC 27000.
  - *Evidencia:* [README_PROYECTO.md](README_PROYECTO.md), sección 1 y 3; tabla `mdl_course` (registro `fullname`).

- **Organización y contexto académico:**
  - *Institución / Facultad:* «Facultad de Auditoría y Seguridad de la Información» (definida formalmente en la categoría raíz `FAC-AUD`).
  - *Asignatura:* `AUD-101 Auditoría de Sistemas de Información` (Octavo Semestre).
  - *Evidencia:* Base de datos `moodle`, tabla `mdl_course_categories` (`name = 'Facultad de Auditoría y Seguridad de la Información'`), tabla `mdl_course` (`shortname = 'AUD-101'`).

- **Estado real del entorno:**
  - *Estado:* Entorno de **laboratorio local y pruebas académicas** (no es un sistema de producción).
  - *Datos:* 100% datos ficticios simulados (cuentas de usuario ficticias, enunciados de prueba, foro de debate y cuestionario diagnóstico simulados). Sin datos personales ni académicos reales.
  - *Evidencia:* Script de aprovisionamiento `02_ENTORNO_EJECUCION/scripts/crear_datos_auditoria.php`; [INFORME_INSTALACION_MOODLE.md](00_CONTROL_PROYECTO/INFORME_INSTALACION_MOODLE.md), sección 14.

- **Componentes de software y versiones verificadas:**
  - *Moodle Core:* **Moodle 5.3.0 oficial** (Build: `20261005`, versión interna `$version = 2026100500.00`, rama `503`, madurez `MATURITY_STABLE`, Tag Git oficial `v5.3.0`, Commit SHA `42622298fe06f9626d988d60b2bf589bd8f850e8`). *Estado:* **Verificado** (`version.php`, Git CLI y tabla `mdl_config`).
  - *Sistema Operativo:* **Microsoft Windows 11 Pro 64-bit** (Versión 10.0.26300, Compilación/Build 26300, arquitectura x86_64). *Estado:* **Verificado** (`cmd /c ver`, `Get-ComputerInfo`).
  - *Servidor Web:* **PHP Built-in CLI Web Server** (servidor monohilo embebido de desarrollo) ejecutado mediante el script enrutador `02_ENTORNO_EJECUCION/router.php`. *Estado:* **Verificado** (proceso en ejecución en PID local escuchando en `127.0.0.1:8000`).
  - *Intérprete PHP:* **PHP 8.4.25 (cli)** (compilado el 25 de agosto de 2026, ZTS Visual C++ 2022 x64, 64-bit real con `PHP_INT_SIZE = 8`). Directivas verificadas: `memory_limit = 512M`, `max_input_vars = 5000`, `max_execution_time = 300`. *Estado:* **Verificado** (`php -v`, `php -i`, `EVID-006_Informacion_PHP.png`).
  - *Base de Datos:* **PostgreSQL 18.6** (x86_64-windows, compiled by msvc-19.44.35228, 64-bit) en clúster local dedicado en puerto TCP **5433**. Base de datos `moodle`, codificación `UTF-8`, colación `C`, con 499 tablas nativas. *Estado:* **Verificado** (`SELECT version();`, API interna `check_moodle_environment()` con resultado PASS y 0 advertencias de incompatibilidad).
  - *Complementos y Módulos:* Módulos estándar nativos del Core de Moodle 5.3 activos: `mod_assign` (Tareas), `mod_quiz` (Cuestionarios), `mod_forum` (Foros), `core_check` / `report_security` (Comprobaciones de seguridad), `logstore_standard` (Almacén de logs). No existen plugins comunitarios ni extensiones de terceros instaladas. *Estado:* **Verificado** (inspección de `01_CODIGO_FUENTE/moodle/public/mod/` y tabla `mdl_modules`).

- **Arquitectura básica y dependencias:**
  - *Topología:* Despliegue monolítico local confinado a una única estación de trabajo física (`DESKTOP-FJP4IH3`).
  - *Separación de Raíz Pública:* Implementación de la nueva arquitectura de Moodle 5.3 donde la raíz pública expuesta al servidor web es `01_CODIGO_FUENTE/moodle/public`, manteniendo el código del núcleo, scripts de CLI (`admin/cli`), librerías internas y configuración fuera del acceso web directo.
  - *Almacenamiento de Datos (`dataroot`):* Directorio `02_ENTORNO_EJECUCION/moodledata/` ubicado físicamente fuera de la raíz web, impidiendo la descarga no autenticada de archivos adjuntos y sesiones.
  - *Almacenamiento de Base de Datos:* Directorio `02_ENTORNO_EJECUCION/pgsql_data/` gestionado por el motor PostgreSQL en puerto 5433.
  - *Dependencias del entorno:* Intérprete PHP 8.4 en el `PATH`, librerías dinámicas de PostgreSQL (`libpq.dll`), sistema de archivos NTFS en unidad `C:\`.
  - *Estado:* **Verificado** (`config.php`, `router.php`, inspección del árbol de directorios).

- **Acceso real y exposición:**
  - *Conectividad:* Estrictamente **equipo local (bucle local / localhost)** en `http://127.0.0.1:8000` y `127.0.0.1:5433`.
  - *Exposición:* **No expuesto a Internet ni a la red local**. El socket del servidor web está enlazado a `127.0.0.1:8000` y PostgreSQL a `127.0.0.1:5433` (restringido en `pg_hba.conf`). No existen puertos redirigidos en enrutadores ni nombres de dominio públicos asignados.
  - *Canal de transporte:* **HTTP no cifrado** (sin certificado TLS/HTTPS activo en el servidor web local).
  - *Estado:* **Verificado** (`netstat -ano`, `config.php`, `EVID-001_Home_Publico.png`).

- **Roles de usuario y cantidades agregadas:**
  - *Administrador del sistema:* **1 cuenta activa** (`admin_auditoria`).
  - *Docente / Profesor con permisos de edición:* **2 cuentas activas** (`profesor1`, `profesor2`).
  - *Estudiante:* **5 cuentas activas** (`estudiante1` a `estudiante5`).
  - *Cuentas estándar de sistema / Invitado:* **2 cuentas** (usuario ID 1 `$CFG->siteguest` e ID 2 de sistema).
  - *Población total de identidades en BD:* **9 cuentas registradas** en tabla `mdl_user`.
  - *Estado:* **Verificado** (consulta SQL `SELECT count(*) FROM mdl_user` y tabla `mdl_role_assignments`).

- **Tipos de información gestionada y funciones críticas:**
  - *Información:* Archivos de entregas de tareas académicas (PDF/DOCX simulados en `moodledata/filedir`), cuestionarios y banco de preguntas, libro de calificaciones numéricas (`mdl_grade_grades`), trazas cronológicas de auditoría (`mdl_logstore_standard_log`), archivos de configuración del aplicativo (`config.php`) y respaldos de base de datos (`pg_dump` SQL).
  - *Funciones críticas del laboratorio:*
    1. Autenticación y control de acceso basado en roles (RBAC).
    2. Impartición, entrega y calificación de actividades de evaluación académica.
    3. Registro forense y trazabilidad de eventos (no repudio).
    4. Disponibilidad y persistencia de la base de datos y archivos de usuario.
  - *Estado:* **Verificado** (registros observados en `mdl_course`, `mdl_assign_submission`, `mdl_grade_grades`, `mdl_logstore_standard_log`).

- **Responsables del sistema y de la evaluación:**
  - *Responsable técnico del sistema:* Registrado en informes como «Equipo DevOps / Administrador local del laboratorio». Asignación formal de persona natural: **Pendiente / No determinado**.
  - *Responsable de la evaluación de riesgos:* Registrado como «Analista técnico de auditoría de sistemas». Asignación de rol formal (ej. CISO académico o docente titular): **Pendiente / No determinado**.
  - *Estado:* **Documentado, sin verificación técnica de designación formal**.

- **Fecha de recopilación y límites de la inspección:**
  - *Fecha:* 12 de Octubre de 2026.
  - *Límites:* Examen pasivo de solo lectura sobre archivos locales, configuraciones y base de datos relacional. No se efectuaron pruebas de inyección, ataques de fuerza bruta, escaneos intrusivos de puertos ni estrés de carga.

---

## 2. A. Identificación de procesos

Para dar respuesta a los seis espacios del Excel (`PROCESOS` y `DESCRIPCIÓN`), se priorizan los seis procesos nucleares más relevantes para la seguridad de la información, la gobernanza del aplicativo y la continuidad operativa del laboratorio. Se excluyen funcionalidades secundarias nativas de Moodle (como comercio electrónico, mensajería SMS o insignias/badges) cuyo uso no se encuentra implementado ni confirmado.

### Criterio de priorización de los 6 procesos:
Se seleccionan los procesos cuya degradación, interceptación o alteración impactaría directamente sobre la confidencialidad de los datos académicos, la integridad de las evaluaciones y bitácoras, o la disponibilidad del servicio.

### Tabla A: Procesos Principales Priorizados

| ID | Proceso | Descripción y finalidad | Rol responsable | Evidencia/estado |
| :---: | :--- | :--- | :--- | :--- |
| **P01** | **Gestión de Identidades, Autenticación y Control de Acceso (IAM)** | Administración de cuentas de usuario, autenticación de identidades mediante contraseñas con hash nativo, control de sesiones web (`MoodleSession`) y asignación granular de permisos en contextos (Roles: Admin, Docente, Estudiante). Finalidad: Garantizar que solo los usuarios autorizados accedan a recursos específicos conforme al principio de mínimo privilegio. | Administrador de Auditoría (`admin_auditoria`) | **Verificado**: Tablas `mdl_user`, `mdl_role_assignments`, `mdl_role_capabilities`; interfaz de login y gestión de roles; evidencias `EVID-002_Login.png`, `EVID-008_Usuarios_Cuentas.png`, `EVID-009_Roles_Permisos.png`. |
| **P02** | **Gestión y Evaluación Académica de Cursos (Enseñanza-Aprendizaje)** | Creación y estructuración de espacios educativos (curso AUD-101), matriculación manual de participantes, publicación de tareas (`mod_assign`) y cuestionarios (`mod_quiz`), recepción de entregas estudiantiles y registro de notas en el libro de calificaciones. Finalidad: Sustentar el ciclo de vida de la evaluación formativa y sumativa garantizando la integridad de los resultados académicos. | Docente / Profesor con edición (`profesor1`, `profesor2`) | **Verificado**: Tablas `mdl_course`, `mdl_enrol`, `mdl_assign_submission`, `mdl_grade_grades`; curso AUD-101 en BD; evidencia `EVID-010_Curso_AUD101.png`. |
| **P03** | **Registro, Monitoreo y Trazabilidad de Auditoría (Logging Forense)** | Captura automática, almacenamiento estructurado y consulta cronológica de trazas de eventos del sistema (inicios de sesión, envíos de tareas, modificaciones de configuración). Finalidad: Proveer trazabilidad forense inmutable, permitir la detección de anomalías y soportar el principio de no repudio de acciones en la plataforma. | Administrador de Auditoría (`admin_auditoria`) | **Verificado**: Tabla `mdl_logstore_standard_log` (42 eventos registrados en auditoría); reporte nativo de logs; evidencia `EVID-011_Logs_Trazabilidad.png`. |
| **P04** | **Mantenimiento Operativo y Tareas Programadas del Sistema (Cron y Caché)** | Ejecución de tareas periódicas en segundo plano vía CLI (`admin/cli/cron.php` o script wrapper) para depuración de sesiones vencidas, procesamiento de colas adhoc, cálculo diferido de calificaciones y purga de caché de la plataforma (MUC). Finalidad: Mantener la estabilidad operativa, el rendimiento y la consistencia interna de la aplicación. | Administrador del Sistema / DevOps | **Verificado**: Script `02_ENTORNO_EJECUCION/ejecutar_cron.ps1`; bitácora `06_EVIDENCIAS_INSTALACION/logs/cron.log`; evidencias `EVID-014_Cron_Ejecucion.png`; advertencias de temporización en `checks.php`. |
| **P05** | **Gestión de Respaldo y Continuidad Operativa (Backup y Recuperación)** | Generación periódica y estructurada de copias de seguridad de los tres componentes esenciales: volcado SQL de la base de datos (`pg_dump`), compresión del directorio `moodledata` y archivado del código fuente, con cálculo de sumas SHA-256. Finalidad: Proteger la información contra pérdida o corrupción y permitir la restauración del entorno ante contingencias. | Administrador del Sistema / DevOps | **Verificado en generación**: Directorio `07_BACKUPS/`; `MANIFIESTO_BACKUP.txt`; evidencia `EVID-013_Backup_Ejecucion.png`. *Restauración:* **Documentado, sin verificación técnica** (no se ejecutó restauración de prueba para preservar el entorno de auditoría). |
| **P06** | **Gestión de Configuración y Seguridad de la Infraestructura (Hardening)** | Configuración, aislamiento y supervisión técnica del motor de base de datos PostgreSQL 18, intérprete PHP 8.4, servidor web embebido y parámetros de seguridad nativos (`report_security`). Finalidad: Establecer y evaluar la línea base técnica de seguridad del sistema contra directrices reconocidas. | Administrador del Sistema / DevOps | **Verificado**: Archivos `config.php`, `php.ini`, `pg_hba.conf`; reporte `09_AUDITORIA_ISO/LINEA_BASE_SEGURIDAD/REPORTE_LINEA_BASE_SEGURIDAD.md`; evidencias `EVID-007_PostgreSQL_Estado.png`, `EVID-012_Comprobaciones_Seguridad.png`, `EVID-016_Verificacion_Version_Oficial.png`. |

---

## 3. B. Identificación de activos

Se identifican los activos existentes y observables en el entorno del laboratorio. Para cada activo se asigna un código permanente (`A01` a `A14`), se explica la unidad y cantidad real, se clasifica según la taxonomía de tipos de activo de ISO/IEC 27005 y se detallan sus dependencias y procesos relacionados.

### Tabla B: Inventario de Activos del Proyecto

| Código | Activo | Cantidad y unidad | Tipo de activo | Dependencias / Descripción | Procesos relacionados | Evidencia/estado |
| :---: | :--- | :--- | :--- | :--- | :---: | :--- |
| **A01** | Base de Datos Relacional `moodle` (PostgreSQL) | 1 base de datos lógica (499 tablas) | Información estructurada / Datos | Depende de: Motor PostgreSQL (A05), almacenamiento físico (A08). Almacena cuentas, contraseñas hasheadas, notas, inscripciones, metadatos de cursos y configuraciones. | P01, P02, P03, P04, P05, P06 | **Verificado**: Consulta `SELECT count(*) FROM information_schema.tables`, clúster en puerto 5433, evidencia `EVID-007_PostgreSQL_Estado.png`. |
| **A02** | Directorio de Datos de Moodle (`moodledata`) | 1 directorio en disco (18.67 MB comprimido) | Archivo de datos / Información no estructurada | Depende de: Sistema operativo (A07), almacenamiento en disco C:\ (A08). Aloja archivos subidos por estudiantes (`filedir`), archivos de sesión (`sessions`), paquetes de idioma (`lang`) y caché local. | P01, P02, P04, P05 | **Verificado**: Directorio físico `02_ENTORNO_EJECUCION/moodledata/`, variable `$CFG->dataroot` en `config.php`. |
| **A03** | Código Fuente de la Aplicación Moodle Core 5.3 | 1 árbol de código Git (~124 MB comprimido) | Software de aplicación | Depende de: Intérprete PHP (A06), sistema operativo (A07). Código oficial descargado desde repositorio oficial de Moodle HQ (Tag `v5.3.0`, Commit `42622298...`). | P01, P02, P03, P04, P06 | **Verificado**: `01_CODIGO_FUENTE/moodle/`, Git status, comprobación de integridad inmutable. |
| **A04** | Archivo de Configuración del Sitio (`config.php`) | 1 archivo de texto PHP (842 bytes) | Configuración de software / Credencial | Depende de: Intérprete PHP (A06), almacenamiento NTFS (A08). Contiene parámetros de conexión a PostgreSQL, credenciales del usuario de base de datos, rutas físicas y permisos de carpetas. | P01, P05, P06 | **Verificado**: Archivo `01_CODIGO_FUENTE/moodle/config.php` (excluido de Git por `.gitignore`). |
| **A05** | Motor de Base de Datos PostgreSQL 18.6 | 1 instancia de software (proceso local en puerto 5433) | Software de infraestructura / Servicio | Depende de: Sistema operativo Windows 11 (A07), hardware (A08). Motor RDBMS dedicado ejecutándose como servicio aislado en clúster `02_ENTORNO_EJECUCION/pgsql_data`. | P01, P02, P03, P04, P05, P06 | **Verificado**: `psql` versión 18.6, puerto 5433 activo, comprobación `check_moodle_environment` en PASS. |
| **A06** | Intérprete PHP 8.4.25 y Servidor Web Embebido | 1 entorno de ejecución y 1 proceso servidor web | Software de plataforma / Servidor web | Depende de: Sistema operativo (A07), hardware (A08). Ejecuta los scripts PHP de Moodle y atiende solicitudes HTTP en puerto local 8000 mediante router personalizado. | P01, P02, P03, P04, P06 | **Verificado**: Proceso PHP en puerto 8000, `php -v` (8.4.25 64-bit), evidencia `EVID-006_Informacion_PHP.png`. |
| **A07** | Sistema Operativo Microsoft Windows 11 Pro 64-bit | 1 sistema operativo de host (Build 26300) | Software de sistema base | Depende de: Hardware (A08). Plataforma anfitriona que gestiona control de procesos, permisos NTFS, red local loopback y servicios de seguridad. | P01 a P06 | **Verificado**: Windows 11 Pro 10.0.26300 en estación `DESKTOP-FJP4IH3`. |
| **A08** | Estación de Trabajo Anfitriona (Hardware y Disco C:\) | 1 equipo de cómputo físico (DESKTOP-FJP4IH3) | Hardware / Equipamiento físico | Depende de: Suministro de energía eléctrica local. CPU x86_64, 16 GB RAM, disco principal NTFS con espacio disponible en `C:\`. | P01 a P06 | **Verificado**: `Get-ComputerInfo`, RAM visible 15.4 GB, almacenamiento NTFS comprobado. |
| **A09** | Archivos de Respaldo del Sistema (Backups y Manifiesto) | 3 archivos de copia (.sql, .zip) + 1 manifiesto TXT | Información de respaldo | Depende de: Almacenamiento local (A08), proceso de sincronización en la nube. Copias triples en `07_BACKUPS/` (Dump BD 2.05 MB, moodledata 4.74 MB, código 151.65 MB). | P05 | **Verificado**: Directorio `07_BACKUPS/`, sumas SHA-256 en `MANIFIESTO_BACKUP.txt`. |
| **A10** | Registros de Auditoría y Bitácoras (`mdl_logstore_standard_log` y `cron.log`) | 1 tabla relacional (42 registros iniciales) y 1 archivo log | Información de trazabilidad / Evidencia forense | Depende de: Base de datos (A01), almacenamiento local (A08). Registra quién hizo qué, cuándo, desde qué IP y sobre qué recurso en Moodle. | P03, P04 | **Verificado**: Consulta SQL sobre `mdl_logstore_standard_log`, archivo `06_EVIDENCIAS_INSTALACION/logs/cron.log`. |
| **A11** | Cuentas de Acceso y Credenciales de Usuarios de Laboratorio | 8 cuentas activas + 1 bóveda de secretos externa | Datos de autenticación / Credenciales | Depende de: Base de datos (A01), bóveda externa en `AppData\Roaming`. Cuentas de prueba con contraseñas seguras rotadas y gestionadas de forma segregada. | P01, P02 | **Verificado**: Tabla `mdl_user`, script `cambiar_credenciales_laboratorio.php`, archivo externo de contraseñas. |
| **A12** | Rol Humano: Administrador del Sistema / DevOps | 1 rol funcional (1 usuario asignado) | Personal / Recurso humano | Depende de: Capacidad técnica, acceso físico y lógico a la consola del equipo. Responsable de la gestión de la plataforma y la infraestructura. | P01, P03, P04, P05, P06 | **Verificado**: Rol `Administrator` en contexto de sistema (User ID 2: `admin_auditoria`). |
| **A13** | Rol Humano: Docente / Evaluador Académico | 1 rol funcional (2 identidades: profesor1, profesor2) | Personal / Recurso humano | Depende de: Acceso al sistema, asignación de rol `editingteacher`. Responsable del diseño de tareas, cuestionarios y calificación de estudiantes. | P02 | **Verificado**: Rol `editingteacher` (Role ID 3) asignado en curso AUD-101 en tabla `mdl_role_assignments`. |
| **A14** | Rol Humano: Estudiante / Evaluado | 1 rol funcional (5 identidades: estudiante1 a estudiante5) | Personal / Recurso humano | Depende de: Acceso al sistema, rol `student`. Destinatario de los contenidos que realiza entregas de tareas y resuelve cuestionarios. | P02 | **Verificado**: Rol `student` (Role ID 5) matriculado en curso AUD-101 en tabla `mdl_role_assignments`. |

---

### Análisis de consecuencias de pérdida de dimensiones de seguridad (C/I/D) para activos críticos:

- **A01 (Base de Datos PostgreSQL):**
  - *Pérdida de Confidencialidad:* Revelación de notas de estudiantes, contenido de exámenes y estructura del sistema a usuarios no autorizados del equipo.
  - *Pérdida de Integridad:* Modificación fraudulenta de calificaciones o respuestas de cuestionarios, corrompiendo la validez del proceso evaluativo.
  - *Pérdida de Disponibilidad:* Parada total de Moodle; ningún usuario puede iniciar sesión, ver cursos ni registrar actividades.
- **A02 (Directorio `moodledata`):**
  - *Pérdida de Confidencialidad:* Acceso no autorizado a archivos de tareas subidos por estudiantes o a datos de sesión activa (`sessions`).
  - *Pérdida de Integridad:* Alteración o sustitución de archivos de tareas entregados por alumnos antes de ser calificados.
  - *Pérdida de Disponibilidad:* Imposibilidad de descargar material de estudio o de almacenar nuevas entregas de tareas académicas.
- **A04 (Archivo `config.php`):**
  - *Pérdida de Confidencialidad:* Exposición de credenciales de conexión al motor de base de datos (`moodleuser`) para cualquier usuario local del host.
  - *Pérdida de Integridad:* Desvío de la plataforma hacia otra base de datos o alteración de rutas maestras (`$CFG->wwwroot`, `$CFG->dataroot`).
  - *Pérdida de Disponibilidad:* Interrupción total e inmediata del enlace entre Moodle y PostgreSQL (pantalla de error fatal de conexión).
- **A06 (Servidor Web y PHP):**
  - *Pérdida de Confidencialidad:* Exposición de rutas internas de archivos y variables mediante la directiva activa `display_errors`.
  - *Pérdida de Integridad:* Ejecución incorrecta de scripts por incompatibilidad o mala gestión de parámetros.
  - *Pérdida de Disponibilidad:* Bloqueo del servidor web embebido monohilo ante concurrencia o errores fatales, dejando sin servicio a los usuarios.
- **A09 (Archivos de Respaldo):**
  - *Pérdida de Confidencialidad:* Copia no autorizada del dump de base de datos que contiene todos los datos del sistema.
  - *Pérdida de Integridad:* Corrupción del dump o los archivos ZIP, impidiendo una restauración fidedigna en caso de desastre.
  - *Pérdida de Disponibilidad:* Eliminación accidental de los archivos de backup en el host local, eliminando la única línea de recuperación ante desastres.
- **A10 (Registros de Auditoría):**
  - *Pérdida de Confidencialidad:* Divulgación de hábitos de navegación, marcas de tiempo y acciones operativas de los usuarios.
  - *Pérdida de Integridad:* Manipulación o borrado de la tabla de logs para encubrir actividades no autorizadas (pérdida de trazabilidad y no repudio).
  - *Pérdida de Disponibilidad:* Imposibilidad de realizar auditorías de seguridad posteriores o reconstruir incidentes pasados.

---

## 4. C. Actividades del proceso (PHVA / Planear-Hacer-Verificar-Actuar)

A continuación se organizan las actividades del ciclo PHVA para cada uno de los seis procesos identificados, desglosando Emisor, Entradas, Actividad, Salidas y Receptor conforme a los requerimientos de la planilla de Excel.

> **Nota Metodológica:** Se aclara de forma explícita cuándo una actividad corresponde a una ejecución empíricamente comprobada en el laboratorio o a una interpretación analítica de la fase PHVA en el marco de ISO/IEC 27005.

### Tabla C: Matriz de Actividades por Proceso (Ciclo PHVA)

| Proceso | Fase PHVA | Emisor | Entradas | Actividad | Salidas | Receptor | Evidencia/estado |
| :---: | :---: | :--- | :--- | :--- | :--- | :--- | :--- |
| **P01** | **Planear** | Administrador de Auditoría | Políticas institucionales de acceso y catálogo de roles RBAC | Definición de roles requeridos (`admin`, `editingteacher`, `student`) y directivas de contraseñas. | Matriz de asignación de roles y política de contraseñas definida | Sistema Moodle (A03 / A01) | **Verificado**: Roles estándar definidos en el núcleo de Moodle; política de contraseñas activada en `core_passwordpolicy`. |
| **P01** | **Hacer** | Administrador de Auditoría / Usuarios | Datos de identidad de los usuarios y credenciales | Creación de cuentas de usuario en Moodle, hash de contraseñas y asignación a contextos. | Cuentas activas en BD (`mdl_user`) y credenciales temporales | Usuarios (A12, A13, A14) | **Verificado**: 8 cuentas creadas con contraseñas hasheadas en BD (`EVID-008_Usuarios_Cuentas.png`, `EVID-009_Roles_Permisos.png`). |
| **P01** | **Verificar** | Sistema Moodle (`core_check`) | Intentos de login y directivas de seguridad | Comprobación de autenticación exitosa/fallida y verificación de robustez de políticas de acceso. | Logs de login (`mdl_logstore_standard_log`) y alertas de `report_security` | Administrador de Auditoría (A12) | **Verificado**: Trazas de login en log de auditoría; comprobación de administradores únicos en `core_riskadmin`. |
| **P01** | **Actuar** | Administrador de Auditoría / Analista | Detección de credenciales expuestas en informes | Ejecución del procedimiento de cambio de contraseñas y segregación de claves en bóveda externa. | Credenciales seguras actualizadas y revocación de claves previas | Bóveda externa y base de datos (A01) | **Verificado**: Ejecución de `cambiar_credenciales_laboratorio.php` y validación de no autenticación con claves viejas. |
| **P02** | **Planear** | Docente / Coordinación | Plan docente de la asignatura AUD-101 | Planificación de la estructura pedagógica: temas, foro de debate, tarea práctica y cuestionario evaluativo. | Programa de curso estructurado en secciones temáticas | Docente (A13) | **Verificado**: Curso AUD-101 estructurado en 4 secciones temáticas visibles en BD (`mdl_course_sections`). |
| **P02** | **Hacer** | Docente / Estudiantes | Enunciados de tareas, cuestionario y archivos de trabajo | Publicación de actividades, carga de entregas por estudiantes y resolución de cuestionarios. | Entregas registradas en `moodledata/filedir` e intentos de cuestionario | Docente y Sistema Moodle | **Verificado**: Tarea entregada por estudiante1 y cuestionario respondido en `EVID-010_Curso_AUD101.png`. |
| **P02** | **Verificar** | Docente (`profesor1`) | Entregas de estudiantes y respuestas de cuestionario | Calificación manual de tareas y cálculo automático de notas de examen con retroalimentación. | Calificaciones registradas en libro de notas (`mdl_grade_grades`) | Estudiantes (A14) | **Verificado**: Calificación de 95.00/100 asignada a estudiante1 registrada en base de datos. |
| **P02** | **Actuar** | Docente / Administrador | Reportes de notas e incidencias de entrega | *Interpretación analítica:* Ajuste de fechas de entrega o revisión de preguntas ambiguas. | Cronograma o cuestionario actualizado | Estudiantes (A14) | **No evidenciada formalmente**: No se registraron reaperturas de fechas ni ajustes post-evaluación en el laboratorio. |
| **P03** | **Planear** | Administrador del Sistema | Requisitos de auditoría y normas ISO (ISO 19011 / 27001) | Configuración del almacén de logs nativo (`logstore_standard`) y selección de eventos auditables. | Parámetros de auditoría guardados en `mdl_config_plugins` | Sistema Moodle (A03) | **Verificado**: Módulo `logstore_standard` habilitado por defecto en la instalación. |
| **P03** | **Hacer** | Sistema Moodle / Usuarios | Solicitudes HTTP e interacciones con la plataforma | Registro en tiempo real de eventos (inicios de sesión, matriculación, envíos, consultas). | Registros persistidos en tabla `mdl_logstore_standard_log` | Base de datos (A01) | **Verificado**: 42 registros generados empíricamente durante las sesiones de prueba (`EVID-011_Logs_Trazabilidad.png`). |
| **P03** | **Verificar** | Administrador de Auditoría | Filtros de consulta en interfaz de reportes (`/report/log/`) | Inspección visual de trazas forenses para verificar no repudio y cumplimiento de actividades. | Informes de actividad exportables o visualizados en pantalla | Auditor / Administrador (A12) | **Verificado**: Consulta empírica de eventos en la interfaz administrativa y exportación documental. |
| **P03** | **Actuar** | Administrador de Auditoría | Identificación de eventos sospechosos o fallos | *Interpretación analítica:* Bloqueo de cuentas o alerta ante accesos anómalos. | Medidas de contención aplicadas | Sistema Moodle (A01) | **No evidenciada formalmente**: No existen eventos de ataque reales que hayan requerido acciones reactivas. |
| **P04** | **Planear** | Administrador / DevOps | Requisitos de mantenimiento de Moodle Core | Programación de tareas críticas (cola adhoc, limpieza de sesiones, optimización de BD). | Esquema de tareas en tabla `mdl_task_scheduled` | Programador de tareas | **Verificado**: Catálogo de tareas programadas visibles en `/admin/tool/task/scheduledtasks.php`. |
| **P04** | **Hacer** | Script automatizado / Operador | Disparo periódico por CLI (`php admin/cli/cron.php`) | Ejecución de las rutinas de fondo del cron de Moodle y actualización de estados de caché. | Salida de texto en consola y bitácora `cron.log` | Archivo `cron.log` y BD (A01) | **Verificado**: Ejecución mediante script `02_ENTORNO_EJECUCION/ejecutar_cron.ps1`; evidencia `EVID-014_Cron_Ejecucion.png`. |
| **P04** | **Verificar** | Administrador / Sistema | Códigos de salida del proceso cron y comprobaciones de tareas | Verificación de tiempo transcurrido desde la última ejecución del cron mediante `checks.php`. | Alertas de advertencia de cron en panel de administración | Administrador (A12) | **Verificado**: Comprobación `checks.php` arrojó advertencia por lapso sin ejecución continua del cron. |
| **P04** | **Actuar** | Administrador / DevOps | Notificación de fallo o retraso en tareas programadas | Ejecución manual forzada del cron mediante script de PowerShell cuando se detecta retraso. | Tareas pendientes procesadas y sincronizadas | Sistema Moodle (A01) | **Verificado**: Ejecución manual correctiva documentada en bitácora de evidencias. |
| **P05** | **Planear** | Administrador / DevOps | Política de respaldo y directrices de recuperación | Definición de alcance del respaldo (BD, moodledata, código), periodicidad y algoritmo hash (SHA-256). | Script estructurado de respaldo (`ejecutar_backup_completo.ps1`) | Almacenamiento local (A08) | **Verificado**: Script documentado con control de rutas y exclusión de temporales. |
| **P05** | **Hacer** | Administrador / Script | Estado actual de PostgreSQL, carpeta moodledata y código | Generación de volcado SQL con `pg_dump`, empaquetado zip de archivos y cálculo de hashes SHA-256. | Archivos de respaldo en `07_BACKUPS/` y `MANIFIESTO_BACKUP.txt` | Carpeta de backups (A09) | **Verificado**: Tres archivos consistentes generados en `07_BACKUPS/` y firmas hash validadas. |
| **P05** | **Verificar** | Administrador / Auditor | Archivos generados y sumas de verificación del manifiesto | Comparación de tamaños de archivo y verificación de integridad criptográfica SHA-256 de los respaldos. | Hashes cotejados contra el manifiesto maestro `SHA256SUMS.txt` | Auditor / Administrador (A12) | **Verificado**: Comprobación de hashes SHA-256 mediante script `generar_sha256sums.ps1`. |
| **P05** | **Actuar** | Administrador / DevOps | Reporte de integridad de copias o contingencia simulada | *Interpretación analítica:* Restauración de prueba en entorno secundario o depuración de backups corruptos. | Confirmación de RTO/RPO de recuperación | Administrador (A12) | **No evidenciada formalmente**: No se ejecutaron pruebas de restauración para evitar alteraciones del entorno. |
| **P06** | **Planear** | Administrador de Auditoría | Estándar ISO/IEC 27001 (Control A.8.26 / A.8.24) y guías Moodle | Diseño de arquitectura segura: separación de directorio `/public`, colocación de `moodledata` fuera de la web y base de datos aislada. | Especificación técnica de instalación y rutas del sistema | DevOps / Administrador (A12) | **Verificado**: Configuración arquitectónica implementada en la estructura del workspace. |
| **P06** | **Hacer** | Administrador / DevOps | Archivos de código, permisos del host y archivos de configuración | Implementación de permisos NTFS, ajuste de `php.ini` y despliegue del router de desarrollo. | Plataforma levantada y operativa en puerto 8000 | Usuarios de la plataforma | **Verificado**: Servicios levantados exitosamente mediante scripts en `02_ENTORNO_EJECUCION/`. |
| **P06** | **Verificar** | Moodle Core (`report_security`) / Analista | Parámetros del servidor web, PHP y base de datos | Ejecución de las 20 comprobaciones nativas de seguridad de Moodle en `/report/security/`. | Matriz de comprobaciones (12 OK, 6 WARNING, 1 INFO, 1 ERROR) | Administrador / Auditor (A12) | **Verificado**: Reporte íntegro en `09_AUDITORIA_ISO/LINEA_BASE_SEGURIDAD/REPORTE_LINEA_BASE_SEGURIDAD.md`. |
| **P06** | **Actuar** | Administrador / DevOps | Hallazgos de seguridad y advertencias del entorno | Documentación de los hallazgos como «Línea Base de Seguridad» sin alteración artificial para auditoría. | Informe de línea base consolidado sin modificaciones cosméticas | Expediente de Auditoría | **Verificado**: Conservación estricta de las advertencias para evaluación transparente en la auditoría formal. |

---

## 5. D. Datos para identificar amenazas, debilidades y riesgos

La siguiente tabla recopila doce escenarios de riesgo pertinentes al entorno observado. Cada escenario está asociado unívocamente a un activo del inventario e incluye la debilidad real, la situación actual con sus controles observados, la amenaza correspondiente, la consecuencia concreta y la dimensión de seguridad afectada (Confidencialidad, Integridad o Disponibilidad).

> **Alineación con el encabezado del Excel:**  
> `Activo | Descripcion | Tipo | Vulnerabilidad | Situación actual | Amenaza | Probabiliad | Impacto | Probabilidad | Impacto | Nivel de Riesgo | nivel de riesgo | RIESGO`  
> *(No se asignan puntuaciones numéricas ni calificaciones de riesgo para respetar las instrucciones; se provee la fundamentación técnica y causal de cada campo).*

### Tabla D: Escenarios de Riesgo Identificados (ISO/IEC 27005)

| ID del escenario | Código del activo | Descripción y tipo del activo | Vulnerabilidad o debilidad | Situación actual y controles existentes | Amenaza / evento | Consecuencia concreta | Dimensión afectada (C / I / D) | Evidencia/estado |
| :---: | :---: | :--- | :--- | :--- | :--- | :--- | :---: | :--- |
| **ESC-01** | **A06** | Intérprete PHP y Servidor Web Embebido (Software de plataforma) | **Canal de comunicación web sin cifrado (HTTP plano).** Las cookies de sesión se transmiten en texto claro sin el atributo `Secure`. | Servicio enlazado exclusivamente a la interfaz local `127.0.0.1:8000` (sin acceso externo directo). Sin embargo, Moodle reporta advertencia en `core_cookiesecure` por falta de SSL/TLS. | Interceptación de tráfico local (sniffing de red local o captura de paquetes en el host por malware o usuario compartido). | Interceptación de la cookie de sesión `MoodleSession`, posibilitando el secuestro de la sesión administrativa o docente (*Session Hijacking*). | **Confidencialidad, Integridad** | **Verificado**: `REPORTE_LINEA_BASE_SEGURIDAD.md` (Comprobación 13: WARNING); URL `http://localhost:8000` en `config.php`. |
| **ESC-02** | **A06** | Intérprete PHP y Servidor Web Embebido (Software de plataforma) | **Visualización de errores en pantalla habilitada (`display_errors = On`).** | Parámetro activo para diagnóstico en el laboratorio. Comprobación nativa de Moodle emite advertencia en `core_displayerrors`. | Provocación de excepciones de ejecución en la aplicación mediante entradas imprevistas o parámetros malformados. | Divulgación de rutas físicas completas del servidor, estructura de tablas de base de datos y versiones internas (*Information Disclosure*). | **Confidencialidad** | **Verificado**: `REPORTE_LINEA_BASE_SEGURIDAD.md` (Comprobación 1: WARNING); `php.ini` directiva `display_errors`. |
| **ESC-03** | **A04** | Archivo de Configuración del Sitio (`config.php`) (Archivo de configuración) | **Permisos de escritura permisivos sobre el archivo de configuración.** El archivo es modificable por el usuario del sistema operativo y scripts PHP. | Archivo con permisos estándar de usuario en el sistema de archivos NTFS. Comprobación nativa de Moodle emite advertencia en `core_configrw`. | Modificación no autorizada o accidental del archivo `config.php` por scripts maliciosos locales o procesos con privilegios del usuario. | Alteración de los parámetros de conexión a base de datos, redirección del `$CFG->wwwroot` o caída permanente de la plataforma. | **Integridad, Disponibilidad** | **Verificado**: `REPORTE_LINEA_BASE_SEGURIDAD.md` (Comprobación 4: WARNING); propiedades NTFS del archivo. |
| **ESC-04** | **A04** | Archivo de Configuración del Sitio (`config.php`) (Archivo de configuración) | **Credenciales de base de datos almacenadas en texto plano en el archivo de configuración.** | La variable `$CFG->dbpass` contiene la contraseña de conexión al motor PostgreSQL sin cifrar en reposo. | Lectura indebida del archivo por cualquier usuario o proceso que tenga acceso al sistema de archivos local de la máquina. | Acceso directo a la base de datos PostgreSQL eludiendo por completo la capa de autenticación y permisos de Moodle. | **Confidencialidad** | **Verificado**: Inspección de `01_CODIGO_FUENTE/moodle/config.php` (líneas 11-12). |
| **ESC-05** | **A06** | Intérprete PHP y Servidor Web Embebido (Software de plataforma) | **Uso de servidor web de desarrollo no optimizado para concurrencia.** El PHP Built-in Server es monohilo y no está diseñado para producción. | Despliegue con `php -S 127.0.0.1:8000 router.php` para evitar instalar software pesado en la máquina. Moodle emite advertencias sobre el enrutador en `checks.php`. | Solicitudes simultáneas concurrentes, descargas pesadas de archivos o bucles en procesamiento de peticiones. | Bloqueo o denegación de servicio de la interfaz web, impidiendo el acceso a los estudiantes y docentes durante evaluaciones. | **Disponibilidad** | **Verificado**: Script `02_ENTORNO_EJECUCION/iniciar_moodle.ps1`; advertencia de `core_router` en `checks.php`. |
| **ESC-06** | **A09** | Archivos de Respaldo del Sistema (Información de respaldo) | **Almacenamiento de copias de seguridad en el mismo medio físico y sincronización automática en la nube.** | Los respaldos residen en `07_BACKUPS/` en la unidad C:\ y están sincronizados con OneDrive. No existe almacenamiento fuera de línea (*air-gapped*) ni en medio secundario desconectado. | Falla física del disco de la máquina, ataque de ransomware local o corrupción de archivos propagada por sincronización automática de OneDrive. | Pérdida simultánea del entorno operativo y de las copias de seguridad, provocando la pérdida total irrecuperable de la plataforma. | **Disponibilidad, Integridad** | **Verificado**: Ruta física de `07_BACKUPS/` dentro del árbol de OneDrive; `MANIFIESTO_BACKUP.txt`. |
| **ESC-07** | **A09** | Archivos de Respaldo del Sistema (Información de respaldo) | **Ausencia de pruebas de restauración de copias de seguridad verificadas periódicamente.** | Los scripts de respaldo (`ejecutar_backup_completo.ps1`) se ejecutan y validan con SHA-256, pero el procedimiento de restauración es teórico y no ha sido ensayado. | Fallo o inconsistencia no detectada en el volcado SQL (`pg_dump`) o en los archivos comprimidos al momento de requerir una restauración real. | Incapacidad de restaurar el servicio educativo en caso de incidente grave, prolongando el tiempo de caída o perdiendo datos históricos. | **Disponibilidad, Integridad** | **Documentado, sin verificación técnica**: No se realizaron ensayos de restauración para no alterar el laboratorio de auditoría. |
| **ESC-08** | **A03** | Código Fuente de la Aplicación Moodle Core (Software de aplicación) | **Interferencia del controlador de sincronización en la nube sobre archivos de código.** | El proyecto reside en una ruta gestionada por el cliente de OneDrive con filtro de archivos (`cldflt.sys` / `0x9000a01a`). | Bloqueo de archivos por el driver de sincronización en la nube o colisiones de versiones locales/remotas durante operaciones del sistema. | Errores de acceso denegado en la ejecución de scripts administrativos locales o inconsistencias temporales en el sistema de archivos. | **Disponibilidad, Integridad** | **Verificado**: Incidencia observada con atributo de bloqueo en `admin/cli/cron.php` documentada en informe de pre-auditoría. |
| **ESC-09** | **A05** | Motor de Base de Datos PostgreSQL 18.6 (Software de infraestructura) | **Comunicaciones locales entre PHP y PostgreSQL sin cifrado TLS.** | Conexión local TCP/IP a través de `127.0.0.1:5433` sin forzar SSL (`sslmode = prefer` o `disable` por omisión). | Interceptación de sockets de red locales por software malicioso con privilegios en la máquina host. | Captura de consultas SQL que contienen datos de calificaciones o contraseñas en tránsito local. | **Confidencialidad** | **Verificado**: `config.php` (sin parámetro de forzado de SSL) y configuración de escucha en puerto 5433. |
| **ESC-10** | **A10** | Registros de Auditoría y Bitácoras (Información de trazabilidad) | **Almacenamiento de trazas de auditoría en la misma base de datos de producción sin reenvío a syslog externo.** | Los logs se almacenan en la tabla `mdl_logstore_standard_log`. No hay envío de registros a un servidor SIEM o repositorio externo inmutable. | Compromiso de credenciales administrativas o acceso indebido directo a PostgreSQL por un operador malicioso. | Modificación, truncamiento o eliminación de la tabla de registros para borrar evidencia de actividades fraudulentas (*Anti-forensics*). | **Integridad** | **Verificado**: Tabla `mdl_logstore_standard_log` alojada en la BD `moodle`; sin configuración de servidor de logs externo. |
| **ESC-11** | **A13** | Rol Docente / Evaluador Académico (Personal / Recurso humano) | **Permiso `RISK_XSS` habilitado en cuentas con rol docente.** | Dos cuentas docentes (`profesor1`, `profesor2`) tienen permisos nativos para ingresar contenido HTML sin filtrar en foros y recursos. Comprobación `core_riskxss` en estado WARNING. | Cuenta docente comprometida o acción descuidada al copiar/pegar contenido web con scripts maliciosos. | Inyección de código malicioso en la interfaz de los cursos (*Stored Cross-Site Scripting*), que se ejecuta en el navegador de los estudiantes. | **Confidencialidad, Integridad** | **Verificado**: `REPORTE_LINEA_BASE_SEGURIDAD.md` (Comprobación 15: WARNING); definición del rol `editingteacher`. |
| **ESC-12** | **A08** | Estación de Trabajo Anfitriona (Hardware y Almacenamiento) | **Falta de redundancia física y ausencia de sistema de alimentación ininterrumpida (UPS).** | El laboratorio opera en una estación de trabajo de uso personal conectada a la red eléctrica residencial/convencional. | Corte intempestivo de suministro eléctrico, fluctuaciones de voltaje o fallo de hardware en la unidad de disco. | Cierre abrupto del motor PostgreSQL durante escrituras activas con riesgo de corrupción de bloques de datos en disco NTFS. | **Disponibilidad, Integridad** | **Documentado, sin verificación técnica**: Características de la estación de trabajo física sin infraestructura de centro de datos. |

---

## 6. Evidencias para valorar probabilidad e impacto

Esta sección resume la información comprobable y antecedentes para que el evaluador pueda justificar la asignación de probabilidades e impactos en la planilla de Excel, sin inventar puntuaciones arbitrarias.

### 1. Grado de exposición y condiciones necesarias para la ocurrencia:
- **Exposición de red:** Muy baja a nivel externo. Los servicios escuchan únicamente en `127.0.0.1` (puertos 8000 y 5433). Para que se materialicen amenazas externas de red (como ataques remotos de DoS o inyecciones web directas desde Internet), un atacante requeriría acceso previo a la red del host, ejecución de malware local o una reconfiguración de puertos en el sistema operativo.
- **Exposición local:** Moderada-alta a nivel del equipo anfitrión. Al ser una estación Windows de laboratorio, cualquier usuario con acceso a la máquina o cualquier software ejecutado en ella puede interactuar con el socket HTTP, leer los archivos del directorio de trabajo y visualizar los respaldos almacenados en disco.

### 2. Antecedentes e incidentes documentados en el proyecto:
- **Periodo observable:** Registros disponibles correspondientes a las sesiones del 12 de Octubre de 2026.
- **Incidentes reales registrados:**
  1. *Exposición de credenciales de prueba:* Las contraseñas iniciales fueron documentadas en texto plano en informes preliminares de instalación, lo que motivó la ejecución inmediata del procedimiento `CAMBIO DE CREDENCIALES PREVIO A AUDITORÍA` para rotar las 8 cuentas y protegerlas en una bóveda externa fuera del repositorio.
  2. *Bloqueo de archivos por sincronización:* El cliente de sincronización de OneDrive bloqueó mediante el controlador `cldflt.sys` la creación/modificación de ciertos archivos en la ruta de trabajo local (`admin/cli/cron.php`), generando advertencias de integridad en la gestión de versiones.
  3. *Ausencia de incidentes de seguridad externos:* No existen registros de accesos no autorizados, inyecciones de código ni denegaciones de servicio en las bitácoras forenses (`mdl_logstore_standard_log`).

### 3. Controles existentes observados y evidencia de su funcionamiento:
- **Separación de raíz web (`/public`):** Verificado. El código del núcleo (`admin/cli`, `lib/`, `config.php`) está fuera de la raíz web, mitigando la divulgación directa de código ante fallos de configuración.
- **Aislamiento de `moodledata`:** Verificado. Ubicado fuera de la raíz pública, impidiendo el acceso URL directo a archivos de sesión o tareas.
- **Política de contraseñas de Moodle:** Verificado. Activa mediante comprobación `core_passwordpolicy` (mínimo 8 caracteres, mayúsculas, minúsculas, dígitos y símbolos).
- **Control de acceso basado en roles (RBAC):** Verificado. Contextualización clara entre roles de Administrador, Docente y Estudiante comprobada en la base de datos relacional.
- **Respaldos íntegros:** Verificado en generación. Creación exitosa de volcados SQL y empaquetados zip con firmas criptográficas SHA-256 en `MANIFIESTO_BACKUP.txt`.

### 4. Población, información y procesos afectados:
- **Usuarios afectados:** 8 cuentas de laboratorio (1 Administrador, 2 Docentes, 5 Estudiantes).
- **Procesos afectados:** En caso de caída de la base de datos (A01) o del servidor web (A06), se paralizan simultáneamente los procesos P01 (Autenticación), P02 (Evaluación de cursos), P03 (Logging) y P04 (Cron).
- **Información comprometida:** 499 tablas relacionales, 42 eventos de auditoría y archivos de entregas de tareas académicas.

### 5. Capacidad de recuperación y posible pérdida de datos (RPO y RTO):
- **Punto Objetivo de Recuperación (RPO - Recovery Point Objective):** Dado que los respaldos se ejecutan de forma manual mediante script (`ejecutar_backup_completo.ps1`), el RPO del laboratorio equivale al tiempo transcurrido desde el último volcado ejecutado (aproximadamente 24 horas si se asume una frecuencia diaria, o pérdida de todos los cambios de la sesión si no se ejecuta el script tras realizar cambios).
- **Tiempo Objetivo de Recuperación (RTO - Recovery Time Objective):** No existe automatización de alta disponibilidad ni orquestación de recuperación. El RTO depende del tiempo que tarde el administrador en reimportar manualmente el volcado SQL con `psql` y descomprimir los archivos ZIP (estimado empíricamente en 15 a 30 minutos).

### 6. Criterios de valoración y notas sobre la planilla de Excel:
- **Existencia de escalas en el proyecto:** Al inspeccionar los documentos y carpetas del proyecto (`00_CONTROL_PROYECTO`, `09_AUDITORIA_ISO`), **no se encontraron matrices predefinidas con escalas cuantitativas (ej. 1 a 5) ni umbrales de aceptación de riesgo formales definidos por la cátedra**.
- **Duplicidad de columnas en la planilla:** La plantilla de Excel presenta encabezados duplicados:
  `Probabiliad | Impacto | Probabilidad | Impacto | Nivel de Riesgo | nivel de riesgo | RIESGO`
  *Interpretación técnica:* Esta estructura corresponde habitualmente a la evaluación secuencial de:
  - Primer par: **Riesgo Inherente** (probabilidad e impacto antes de considerar controles existentes).
  - Segundo par: **Riesgo Residual** (probabilidad e impacto tras la aplicación de controles existentes).
  - Columnas de nivel: Matriz resultante y priorización cualitativa (ej. Bajo, Medio, Alto, Crítico).
  *Nota obligatoria:* No se inventan puntuaciones numéricas en este informe; la parametrización final de valores numéricos o cualitativos debe aplicarse según la escala que defina la pauta de la actividad académica.

---

## 7. Información pendiente

La siguiente tabla resume los datos faltantes que no pudieron verificarse empíricamente y que se requieren para completar con rigor la planilla de análisis de riesgos ISO/IEC 27005:

| Dato pendiente | Apartado del Excel que afecta | Por qué se necesita | Quién puede confirmarlo o dónde obtenerlo |
| :--- | :---: | :--- | :--- |
| **Escala de valoración y matriz de riesgos de la cátedra** (tablas de probabilidad 1-5, impacto 1-5 y fórmula de cálculo). | D. Identificación de riesgos (Columnas de Probabilidad, Impacto y Nivel de Riesgo). | Sin una escala oficial o guía de la asignatura, cualquier valor numérico (1 a 5) o cualitativo (Bajo, Medio, Alto) sería una suposición arbitraria. | Docente de la asignatura AUD-101 / Guía de la actividad académica de ISO 27005. |
| **Significado formal de las columnas duplicadas en la planilla** (confirmación de modelo Inherente vs. Residual). | D. Identificación de riesgos (Encabezados repetidos de Probabilidad e Impacto). | Confirmar si la primera valoración corresponde a riesgo inherente y la segunda a riesgo residual, o si una es cuantitativa y la otra cualitativa. | Docente de la asignatura / Instrucciones de la planilla de Excel. |
| **Criterio de Aceptación del Riesgo Institucional** (apetito de riesgo y umbrales de tratamiento). | D. Identificación de riesgos (Columna final «RIESGO» / Aceptable o Inaceptable). | Determinar a partir de qué nivel un riesgo debe ser mitigado obligatoriamente o puede ser aceptado por la administración. | Docente de la asignatura / Guía de laboratorio de Auditoría. |
| **Designación formal de responsables nominales** (Propietario del Riesgo / Dueño de los activos). | 1. Contexto / 2. Procesos / 3. Activos. | Asignar personas naturales específicas con autoridad para aprobar el tratamiento de los riesgos (ej. Director de Carrera, Administrador del Servidor). | Contexto de la práctica académica (determinar si se usan nombres de los estudiantes o cargos ficticios). |
| **Evidencia de pruebas de restauración de copias de seguridad.** | B. Activos (A09) / D. Amenazas (ESC-07) / Evidencias de recuperación. | Comprobar empíricamente que el archivo dump SQL y los ZIPs pueden restaurar la plataforma sin pérdida de datos en caso de contingencia. | Administrador técnico mediante ejecución de un simulacro de restauración en un ambiente alterno. |

---

## Localización del Archivo Generado

El presente informe ha sido guardado en la raíz de la carpeta del proyecto:
`c:\Users\llano\OneDrive\Documentos\OCTAVO SEMESTRE\AUDITORIA\PROYECTO\Moodle_Auditoria_ISO\DATOS_PARA_ANALISIS_RIESGOS_ISO27005.md`
