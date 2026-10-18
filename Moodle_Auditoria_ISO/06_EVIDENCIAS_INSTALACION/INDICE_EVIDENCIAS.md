# ÍNDICE DE EVIDENCIAS TÉCNICAS Y CAPTURAS DEL SISTEMA - MOODLE 5.3

**Proyecto:** Expediente de Instalación y Línea Base ISO Moodle 5.3  
**Fecha de Registro:** 12 de Octubre de 2026  
**Ubicación de Archivos:** `06_EVIDENCIAS_INSTALACION/capturas/`  
**Resolución:** 1440x900 / Formato PNG sin alteración ni edición.

---

## 1. Catálogo Oficial de Evidencias Visuales de Auditoría

| Código | Descripción de la Evidencia | Componente / Módulo | Archivo de Captura | Tamaño | Estado |
| :---: | :--- | :--- | :--- | :---: | :---: |
| **EVID-001** | Inicio y Pantalla Pública de Moodle en Español | Frontpage (`/`) | `EVID-001_Home_Publico.png` | 741 KB | **VERIFICADO** |
| **EVID-002** | Formulario de Inicio de Sesión (Login) | Autenticación (`/login/index.php`) | `EVID-002_Login.png` | 741 KB | **VERIFICADO** |
| **EVID-003** | Área Personal / Tablero (Dashboard) del Administrador | Dashboard (`/my/`) | `EVID-003_Dashboard.png` | 68 KB | **VERIFICADO** |
| **EVID-004** | Panel de Administración del Sitio en Español | Administración (`/admin/`) | `EVID-004_Administracion_Sitio.png` | 58 KB | **VERIFICADO** |
| **EVID-005** | Notificaciones y Verificación de Versión Moodle 5.3.0 | Núcleo (`/admin/index.php`) | `EVID-005_Version_Moodle.png` | 58 KB | **VERIFICADO** |
| **EVID-006** | Información del Entorno PHP (phpinfo) y Extensiones | Servidor (`/admin/phpinfo.php`) | `EVID-006_Informacion_PHP.png` | 105 KB | **VERIFICADO** |
| **EVID-007** | Estado y Conexión de Base de Datos PostgreSQL 18 | RDBMS / Conectividad | `EVID-007_PostgreSQL_Estado.png` | 123 KB | **VERIFICADO** |
| **EVID-008** | Gestión de Usuarios y Cuentas Ficticias Creadas | Usuarios (`/admin/user.php`) | `EVID-008_Usuarios_Cuentas.png` | 94 KB | **VERIFICADO** |
| **EVID-009** | Definición y Asignación de Roles en Contextos | Permisos (`/admin/roles/`) | `EVID-009_Roles_Permisos.png` | 108 KB | **VERIFICADO** |
| **EVID-010** | Vista del Curso AUD-101 Auditoría de Sistemas | Curso (`/course/view.php`) | `EVID-010_Curso_AUD101.png` | 87 KB | **VERIFICADO** |
| **EVID-011** | Registro de Logs y Trazabilidad de Auditoría | Reportes (`/report/log/`) | `EVID-011_Logs_Trazabilidad.png` | 66 KB | **VERIFICADO** |
| **EVID-012** | Informe de Comprobaciones de Seguridad (Línea Base) | Auditoría (`/report/security/`) | `EVID-012_Comprobaciones_Seguridad.png` | 71 KB | **VERIFICADO** |
| **EVID-013** | Ejecución de Respaldo y Manifiesto de Backup | Respaldo / Copias | `EVID-013_Backup_Ejecucion.png` | 66 KB | **VERIFICADO** |
| **EVID-014** | Ejecución de Tarea Programada / Cron CLI | Mantenimiento (`cron.php`) | `EVID-014_Cron_Ejecucion.png` | 93 KB | **VERIFICADO** |
| **EVID-015** | Configuración y Paquetes de Idioma (Español e Inglés)| Localización (`/admin/lang.php`)| `EVID-015_Idioma_Espanol.png` | 60 KB | **VERIFICADO** |
| **EVID-016** | Verificación Oficial de Versión y Entorno Moodle 5.3 (Build 20261005) | Entorno del Sistema (`/admin/environment.php`) | `EVID-016_Verificacion_Version_Oficial.png` | 164 KB | **VERIFICADO** |

---

## 2. Detalle de Nueva Evidencia Incorporada (EVID-016)

- **Identificador:** `EVID-016`
- **Nombre de Archivo:** `06_EVIDENCIAS_INSTALACION/capturas/EVID-016_Verificacion_Version_Oficial.png`
- **Fecha y Hora de Generación:** 2026-10-12 21:20:30 (Hora Local)
- **Método Utilizado:** Automatización mediante Chrome Headless CDP (Chrome DevTools Protocol), autenticación con sesión administrativa activa de `admin_auditoria`, navegación a `http://localhost:8000/admin/environment.php`, renderizado en viewport 1440x900 y captura PNG nativa.
- **Tamaño de Archivo:** 167,580 bytes.
- **Propósito:** Demostrar de forma fehaciente la verificación de compatibilidad de versión de Moodle 5.3 (Build: 20261005), estado del motor PostgreSQL y entorno PHP en la interfaz administrativa oficial, preservando íntegra la evidencia previa `EVID-005`.

---

## 3. Declaración de Autenticidad e Integridad
Todas las capturas (`EVID-001` a `EVID-016`) corresponden a ejecuciones empíricas en el entorno real del laboratorio `http://localhost:8000` con Moodle 5.3.0 oficial (Build: 20261005) y motor PostgreSQL 18 en puerto 5433. No se han aplicado filtros, recortes ni alteraciones gráficas.
