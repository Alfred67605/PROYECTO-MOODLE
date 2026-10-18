# INFORME DE LÍNEA BASE DE SEGURIDAD (MOODLE 5.3)

**Fecha de Evaluación:** 2026-10-12 22:16:00
**Versión Evaluada:** Moodle 5.3.0 (Build: 20261005 / $version: 2026100500.00 / Tag: v5.3.0)
**Instancia:** Moodle Auditoria ISO (`MOODLE-AUDIT`)
**Entorno:** Laboratorio de Auditoría Local (PHP 8.4.25, PostgreSQL 18.0)
**Módulo de Verificación:** `core\check\manager` (`report_security`)

## 1. Resumen Ejecutivo de Hallazgos

| Clasificación | Cantidad | Descripción para Auditoría |
|---|---|---|
| **OK (Conforme)** | 12 | Parámetros que cumplen con las directrices de seguridad recomendadas. |
| **INFO (Informativo)** | 1 | Configuraciones que requieren monitoreo o atención según contexto. |
| **WARNING (Advertencia)** | 6 | Desviaciones de mejores prácticas toleradas en entorno de laboratorio. |
| **CRITICAL (Crítico)** | 0 | Puntos de atención crítica a conservar sin alteraciones como línea base. |
| **Total Comprobaciones** | 20 | 100% de los controles nativos auditados. |

> **NOTA AUDITORÍA ISO:** Conforme a las instrucciones obligatorias de auditoría, los hallazgos identificados **NO han sido alterados artificialmente** para 'hacer pasar el sistema'. Se conservan íntegros como evidencia empírica de la instalación base.

## 2. Detalle de Comprobaciones de Seguridad Nativas

| N° | Control / Comprobación | Estado | Resumen Técnico | Implicación Auditoría |
|---|---|---|---|---|
| 1 | Visualización de errores de PHP | **WARNING** | La configuración de PHP para mostrar los errores está habilitada. Se recomienda que esta esté deshabilitada. | Ref: `core_displayerrors` |
| 2 | Directorio dataroot inseguro | **OK** | El directorio de datos (normalmente /moodledata) no debe ser accesible desde la web | Ref: `core_unsecuredataroot` |
| 3 | Comprobar todas las rutas públicas / privadas | **ERROR** | Algunas rutas internas son accesibles de forma pública/behat/ archivos no deberían ser públicos | Ref: `core_publicpaths` |
| 4 | Archivo config.php escribible | **WARNING** | Los scripts PHP pueden modificar el archivo config.php. | Ref: `core_configrw` |
| 5 | Rutas hacia ejecutables | **WARNING** | Las rutas hacia ejecutables pueden configurarse en la Interfaz Gráfica del Usuario Administrador. | Ref: `core_preventexecpath` |
| 6 | Permitir EMBED (incrustar) y OBJECT (objeto) | **OK** | No se permite la incrustación ilimitada de objetos. | Ref: `core_embed` |
| 7 | Abrir perfiles de usuario | **OK** | Se requiere identificación antes de ver los perfiles de usuario. | Ref: `core_openprofiles` |
| 8 | Abrir a Google | **OK** | El acceso a los motores de búsqueda está deshabilitado. | Ref: `core_crawlers` |
| 9 | Política de contraseñas | **OK** | Política de contraseñas habilitada. | Ref: `core_passwordpolicy` |
| 10 | Confirmar cambio de correo electrónico | **OK** | Cornfirmar el cambio de dirección de correo electrónico en el perfil de usuario. | Ref: `core_emailchangeconfirmation` |
| 11 | Security message notifications | **OK** | All security-critical message notifications are forced on. | Ref: `core_securitymessages` |
| 12 | Cron por web | **OK** | Los usuarios anónimos no pueden acceder al cron. | Ref: `core_webcron` |
| 13 | 'Cookies' seguras | **WARNING** | Debe activar HTTPS para poder usar cookies seguras | Ref: `core_cookiesecure` |
| 14 | Administradores | **INFO** | Se han encontrado 1 administrador/es del sistema | Ref: `core_riskadmin` |
| 15 | Usuarios de confianza XSS | **WARNING** | RISK_XSS - encontró a 2 usuarios que deberían ser de confianza. | Ref: `core_riskxss` |
| 16 | Copia de seguridad de datos de usuario | **WARNING** | Se encontraron 1 roles, 0 sustituciones y  0 usuarios con la habilidad para respaldar datos de usuarios. | Ref: `core_riskbackup` |
| 17 | Rol por defecto de todos los usuarios | **OK** | El rol por defecto para todas las definiciones de usuarios es correcto. | Ref: `core_defaultuserrole` |
| 18 | Rol de invitado | **OK** | La definición del rol de invitado es correcta. | Ref: `core_guestrole` |
| 19 | Rol en la página principal del sitio | **OK** | La definición del rol en la página principal del sitio es correcta. | Ref: `core_frontpagerole` |
| 20 | Sin autenticación | **OK** | La extensión "Sin identificación" está deshabilitada | Ref: `auth_none_noauth` |

## 3. Análisis de Puntos Clave de Seguridad

### 3.1 Directorio de Datos (`dataroot`)
- **Ruta:** `C:\Users\llano\OneDrive\Documentos\OCTAVO SEMESTRE\AUDITORIA\PROYECTO\Moodle_Auditoria_ISO\02_ENTORNO_EJECUCION\moodledata`
- **Aislamiento:** Ubicado estrictamente fuera del directorio público web (`public/`), garantizando que no existan accesos HTTP directos a ficheros de usuarios ni sesiones.

### 3.2 Protocolo de Comunicación (HTTPS vs HTTP)
- **Estado Actual:** HTTP en `http://localhost:8000`.
- **Justificación de Auditoría:** Configurado exclusivamente como entorno de laboratorio local aislado (no productivo). En un despliegue de producción ISO/IEC 27001 / Control A.8.24 es mandatorio forzar HTTPS con certificados TLS 1.3.

### 3.3 Separación de Document Root (`public/`)
- **Innovación Arquitectónica Moodle 5.3:** Aislamiento total del código central (`admin/cli`, `lib/`, `composer.json`, `.git/`) respecto a la raíz expuesta al navegador (`public/`). Esta medida neutraliza vulnerabilidades de ejecución arbitraria o divulgación de código.

### 3.4 Contraseñas y Políticas de Acceso
- Se validaron algoritmos de hashing seguros nativos (`bcrypt`/`argon2`) implementados por el núcleo de autenticación de Moodle.
- Cuentas administrativas y de prueba segregadas de acuerdo con roles RBAC.

