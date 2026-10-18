# MATRIZ DE PRUEBAS DE ACEPTACIÓN TÉCNICA DEL LABORATORIO - MOODLE 5.3

> [!IMPORTANT]
> **DELIMITACIÓN METODOLÓGICA FUNDAMENTAL:**  
> **VERIFICACIÓN DEL LABORATORIO ≠ AUDITORÍA ISO**  
> Las 17 verificaciones realizadas corresponden exclusivamente a **PRUEBAS DE ACEPTACIÓN TÉCNICA DEL LABORATORIO**.  
> **NO SON PRUEBAS DE CONFORMIDAD ISO NI CERTIFICACIÓN DE SEGURIDAD.**  
> Su objetivo exclusivo es validar que la plataforma Moodle 5.3 y su infraestructura base (PHP 8.4, PostgreSQL 18) se encuentran operativas y aptas como objeto de auditoría. La conformidad formal será evaluada y determinada durante la auditoría ISO posterior.

**Proyecto:** Expediente de Instalación y Línea Base Técnica - Moodle 5.3 (Build: 20261005 / Tag: v5.3.0)  
**Fecha de Evaluación:** 12 de Octubre de 2026  
**Criterio de Aceptación:** Evidencia empírica verificada antes de marcar cada ítem (Cero afirmaciones no verificadas).  
**Resultado Global:** **17 / 17 PRUEBAS DE LABORATORIO VERIFICADAS**

---

## 1. Lista de Control de Aceptación Técnica del Laboratorio

| Ítem | Componente / Funcionalidad | Método de Verificación Empírica | Estado Técnico | Evidencia Asociada |
| :---: | :--- | :--- | :---: | :--- |
| **01** | **Página Responde (HTTP)** | Solicitud HTTP GET a `http://localhost:8000/` retorna código 200/303 hacia login | **VERIFICADO** | `06_EVIDENCIAS_INSTALACION/capturas/EVID-001_Home_Publico.png` |
| **02** | **Login Funciona** | Autenticación real con usuario `admin_auditoria` genera sesión válida `MoodleSession` | **VERIFICADO** | `06_EVIDENCIAS_INSTALACION/capturas/EVID-002_Login.png` |
| **03** | **Español Funciona** | Paquete oficial `es.zip` (Moodle 5.3) instalado en `moodledata/lang/es`; `$CFG->lang = 'es'` activo | **VERIFICADO** | `06_EVIDENCIAS_INSTALACION/capturas/EVID-015_Idioma_Espanol.png` |
| **04** | **PostgreSQL Conectado** | Conexión TCP a `127.0.0.1:5433`, 499 tablas creadas en base de datos `moodle` | **VERIFICADO** | `06_EVIDENCIAS_INSTALACION/capturas/EVID-007_PostgreSQL_Estado.png` |
| **05** | **Admin Funciona** | Acceso concedido al panel `/admin/` para el usuario administrador local | **VERIFICADO** | `06_EVIDENCIAS_INSTALACION/capturas/EVID-004_Administracion_Sitio.png` |
| **06** | **Profesor Funciona** | Usuarios `profesor1` y `profesor2` creados y asignados con rol `editingteacher` (Role ID 3) | **VERIFICADO** | `06_EVIDENCIAS_INSTALACION/capturas/EVID-009_Roles_Permisos.png` |
| **07** | **Estudiante Funciona** | Usuarios `estudiante1` al `estudiante5` creados con rol `student` (Role ID 5) | **VERIFICADO** | `06_EVIDENCIAS_INSTALACION/capturas/EVID-008_Usuarios_Cuentas.png` |
| **08** | **Curso Puede Crearse** | Curso `AUD-101 Auditoría de Sistemas de Información` creado en categoría `Facultad de Auditoría` | **VERIFICADO** | `06_EVIDENCIAS_INSTALACION/capturas/EVID-010_Curso_AUD101.png` |
| **09** | **Usuario Puede Crearse** | Alta confirmada de 1 Admin, 2 Profesores y 5 Estudiantes ficticios mediante API nativa | **VERIFICADO** | `06_EVIDENCIAS_INSTALACION/capturas/EVID-008_Usuarios_Cuentas.png` |
| **10** | **Matriculación Funciona** | Matrícula manual de 7 usuarios en curso AUD-101 (`enrol_manual`) confirmada en BD | **VERIFICADO** | `06_EVIDENCIAS_INSTALACION/capturas/EVID-010_Curso_AUD101.png` |
| **11** | **Tarea Funciona** | Módulo `mod_assign` creado ("Tarea 1: Matriz de Control de Riesgos"), entrega registrada | **VERIFICADO** | `06_EVIDENCIAS_INSTALACION/capturas/EVID-010_Curso_AUD101.png` |
| **12** | **Cuestionario Funciona** | Módulo `mod_quiz` creado ("Cuestionario Diagnóstico: Principios de Auditoría") en sección 3 | **VERIFICADO** | `06_EVIDENCIAS_INSTALACION/capturas/EVID-010_Curso_AUD101.png` |
| **13** | **Calificación Funciona** | Calificación (95.00/100) asignada por `profesor1` a `estudiante1` en `assign_grades` | **VERIFICADO** | `06_EVIDENCIAS_INSTALACION/capturas/EVID-010_Curso_AUD101.png` |
| **14** | **Logs Funcionan** | Eventos `course_viewed`, `user_enrolled`, `submission_created` auditados en log nativo | **VERIFICADO** | `06_EVIDENCIAS_INSTALACION/capturas/EVID-011_Logs_Trazabilidad.png` |
| **15** | **Cron Funciona** | Ejecución por CLI de `admin/cli/cron.php` sin errores fatales, registrado en bitácora | **VERIFICADO** | `06_EVIDENCIAS_INSTALACION/logs/cron.log` |
| **16** | **Backup Funciona** | Respaldo triple completado: BD SQL (`pg_dump`), `moodledata.zip` y `moodle_codigo.zip` | **VERIFICADO** | `07_BACKUPS/MANIFIESTO_BACKUP.txt` |
| **17** | **Security Checks Funcionan** | Subsistema `report_security` ejecutado, registrando línea base técnica con 20 comprobaciones | **VERIFICADO** | `09_AUDITORIA_ISO/LINEA_BASE_SEGURIDAD/REPORTE_LINEA_BASE_SEGURIDAD.md` |

---

## 2. Conclusión Técnica de Aceptación del Laboratorio
El laboratorio local cumple íntegramente con los requisitos técnicos y operativos para Moodle 5.3 (Build: 20261005) en plataforma Windows 11 Pro con PostgreSQL 18.0. La infraestructura y datos experimentales han superado las pruebas de aceptación técnica del laboratorio, quedando listos para ser objeto de evaluación en la auditoría formal independiente.
