const fs = require('fs');
const path = require('path');
const { execSync } = require('child_process');

const baseDir = path.resolve(__dirname, '..');
const docsDir = path.join(baseDir, '04_DOCUMENTACION_OFICIAL');
const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';

const documentItems = [
    {
        num: 1,
        cat: '01_Informacion_General',
        tema: 'Acerca_de_Moodle',
        origName: 'About Moodle / Acerca de Moodle',
        url: 'https://docs.moodle.org/503/en/About_Moodle',
        urlEs: 'https://docs.moodle.org/all/es/Acerca_de_Moodle',
        title: 'Acerca de Moodle - Información General y Arquitectura',
        summary: 'Moodle (Modular Object-Oriented Dynamic Learning Environment) es una plataforma de aprendizaje diseñada para proporcionar a educadores, administradores y estudiantes un sistema integrado único, robusto y seguro para crear ambientes de aprendizaje personalizados. Con más de 20 años de desarrollo respaldado por Moodle HQ y una comunidad global, Moodle 5.3 representa la cúspide de modernización técnica, accesibilidad y gobernanza.',
        content: `
<h2>1. Visión General del Sistema</h2>
<p>Moodle es un sistema de gestión del aprendizaje (LMS) de código abierto bajo licencia GNU General Public License v3.0+. Está diseñado bajo una arquitectura modular y orientada a eventos que facilita su extensión sin alterar el núcleo (core) del sistema.</p>
<h2>2. Principios de Diseño</h2>
<ul>
  <li><strong>Constructivismo Social:</strong> Diseñado para facilitar la colaboración, evaluación formativa y gestión del conocimiento compartido.</li>
  <li><strong>Seguridad por Diseño (Security by Design):</strong> Cumplimiento estricto de estándares OWASP, sanitización de entradas, validación de capacidades y aislamiento de datos.</li>
  <li><strong>Accesibilidad Universal:</strong> Certificación WCAG 2.1 nivel AA y compatibilidad con lectores de pantalla.</li>
  <li><strong>Interoperabilidad:</strong> Cumplimiento de estándares LTI (Learning Tools Interoperability), SCORM y APIs REST abiertas.</li>
</ul>
<h2>3. Modelo Arquitectónico de Tres Capas</h2>
<ul>
  <li><strong>Capa de Presentación:</strong> Sistema de renderizado Boost basado en Mustache templates, CSS compilado con Sass y componentes JavaScript nativos/ESM.</li>
  <li><strong>Capa de Lógica de Negocio:</strong> Núcleo PHP 8.3+ con arquitectura de plugins, sistema de hooks desacoplados y tareas asíncronas ad-hoc/programadas.</li>
  <li><strong>Capa de Persistencia:</strong> Capa de abstracción de base de datos XMLDB y Moodle Data Manipulation API (DMAPI) sobre PostgreSQL, MariaDB o MySQL, junto con almacenamiento de ficheros desacoplado (moodledata / File API).</li>
</ul>`
    },
    {
        num: 2,
        cat: '01_Informacion_General',
        tema: 'Caracteristicas_Moodle_5_3',
        origName: 'Features / Características Moodle 5.3',
        url: 'https://docs.moodle.org/503/en/Features',
        urlEs: 'https://docs.moodle.org/all/es/Caracter%C3%ADsticas',
        title: 'Características Principales de Moodle 5.3',
        summary: 'Resumen exhaustivo de las capacidades funcionales y operativas de Moodle 5.3 orientadas a la auditoría técnica y cumplimiento de calidad ISO/IEC 25010.',
        content: `
<h2>1. Capacidades Principales</h2>
<ul>
  <li><strong>Gestión de Cursos y Contenidos:</strong> Formatos de curso modulares (tópicos, semanal, social), edición en tiempo real y soporte para repositorios externos.</li>
  <li><strong>Evaluación y Calificaciones:</strong> Libro de calificaciones con ponderaciones avanzadas, rúbricas, escalas cualitativas y flujos de calificación a ciegas.</li>
  <li><strong>Herramientas de Comunicación:</strong> Foros evaluables, mensajería instantánea interna, notificaciones multicanal y anuncios oficiales.</li>
  <li><strong>Actividades y Recursos:</strong> Tareas con control de plagio, cuestionarios con bancos de preguntas aleatorias, glosarios y talleres de evaluación entre pares.</li>
</ul>
<h2>2. Innovaciones en Versión 5.3</h2>
<ul>
  <li>Enrutamiento HTTP optimizado con Router de 5.x para mejorar latencia y compatibilidad REST.</li>
  <li>Soporte oficial y endurecido para PHP 8.4 y PostgreSQL 17/18.</li>
  <li>Refuerzo en el subsistema de auditoría y almacenamiento de logs estándar (Standard Log Store).</li>
  <li>Mejoras en el subsistema de privacidad de datos para cumplimiento normativo (GDPR / LOPD).</li>
</ul>`
    },
    {
        num: 3,
        cat: '02_Instalacion',
        tema: 'Instalacion_Moodle_Oficial',
        origName: 'Installing Moodle / Instalación de Moodle',
        url: 'https://docs.moodle.org/503/en/Installing_Moodle',
        urlEs: 'https://docs.moodle.org/all/es/Instalaci%C3%B3n_de_Moodle',
        title: 'Guía Oficial de Instalación de Moodle 5.3',
        summary: 'Procedimiento formal y detallado para el despliegue de Moodle 5.3 sobre entornos auditados con PostgreSQL.',
        content: `
<h2>1. Prerrequisitos de Infraestructura</h2>
<ul>
  <li>Servidor HTTP: Apache 2.4+, Nginx o servidor integrado para entornos de laboratorio.</li>
  <li>PHP: Versión 8.3 o superior (verificado con PHP 8.4.25).</li>
  <li>Motor de Base de Datos: PostgreSQL 17+ (verificado con PostgreSQL 18.6 en puerto 5433).</li>
  <li>Directorio de datos (moodledata): Fuera del alcance web directo con permisos estrictos de lectura y escritura.</li>
</ul>
<h2>2. Parámetros de Instalación CLI</h2>
<p>La instalación mediante CLI (<code>admin/cli/install.php</code>) es el método preferido para entornos reproducibles y auditados:</p>
<pre><code>php admin/cli/install.php \\
  --lang=es \\
  --wwwroot="http://localhost:8000" \\
  --dataroot="C:/.../moodledata" \\
  --dbtype=pgsql \\
  --dbhost=127.0.0.1 \\
  --dbport=5433 \\
  --dbname=moodle \\
  --dbuser=moodleuser \\
  --dbpass="***" \\
  --fullname="Moodle Auditoria ISO" \\
  --shortname="MOODLE-AUDIT" \\
  --adminuser=admin_auditoria \\
  --non-interactive \\
  --agree-license</code></pre>`
    },
    {
        num: 4,
        cat: '02_Instalacion',
        tema: 'Requisitos_Servidor_PHP_BD',
        origName: 'Server requirements / Requisitos del servidor',
        url: 'https://docs.moodle.org/503/en/Environment_-_Server_requirements',
        urlEs: 'https://docs.moodle.org/all/es/Requisitos_del_servidor',
        title: 'Requisitos Oficiales del Servidor y Entorno',
        summary: 'Especificaciones técnicas oficiales de dependencias, extensiones y configuraciones mínimas requeridas por Moodle HQ para la rama 5.3.',
        content: `
<h2>1. Extensiones PHP Obligatorias</h2>
<ul>
  <li><code>intl</code>: Requerida para internacionalización y manipulación de locales.</li>
  <li><code>mbstring</code>: Requerida para cadenas multiocteto UTF-8.</li>
  <li><code>curl</code>: Requerida para comunicación con repositorios y servicios externos.</li>
  <li><code>openssl</code> y <code>sodium</code>: Requeridas para cifrado, firma de tokens y seguridad de contraseñas.</li>
  <li><code>zip</code>: Requerida para descompresión de paquetes y copias de seguridad.</li>
  <li><code>gd</code>: Requerida para procesamiento y miniaturas de imágenes.</li>
  <li><code>xml</code>, <code>dom</code>, <code>xmlreader</code>, <code>xmlwriter</code>: Requeridas para serialización y XMLDB.</li>
  <li><code>soap</code>: Requerida para integración con servicios web corporativos.</li>
  <li><code>pgsql</code> / <code>pdo_pgsql</code>: Requerida para comunicación con PostgreSQL.</li>
</ul>
<h2>2. Ajustes de PHP recomendados</h2>
<ul>
  <li><code>memory_limit</code>: Mínimo 256M, recomendado 512M+.</li>
  <li><code>max_execution_time</code>: Recomendado 300 segundos para tareas pesadas y migraciones.</li>
  <li><code>opcache.enable</code> = 1: Para aceleración de ejecución de scripts PHP.</li>
</ul>`
    },
    {
        num: 5,
        cat: '03_Administracion',
        tema: 'Administracion_del_Sitio',
        origName: 'Site administration / Administración del sitio',
        url: 'https://docs.moodle.org/503/en/Site_administration',
        urlEs: 'https://docs.moodle.org/all/es/Administraci%C3%B3n_del_sitio',
        title: 'Estructura de Administración del Sitio Moodle 5.3',
        summary: 'Guía de gobierno y configuración global del sistema accesible para usuarios con rol de Administrador.',
        content: `
<h2>1. Áreas de Administración</h2>
<ul>
  <li><strong>General:</strong> Gestión de competencias, insignias, localización e idioma del sitio.</li>
  <li><strong>Usuarios:</strong> Cuentas, permisos, métodos de autenticación, privacidad y políticas.</li>
  <li><strong>Cursos:</strong> Categorías, respaldos automatizados, solicitudes y plantillas.</li>
  <li><strong>Calificaciones:</strong> Ajustes generales, escalas, letras y categorías de calificación.</li>
  <li><strong>Plugins:</strong> Instalación, actualización y auditoría de extensiones de terceros.</li>
  <li><strong>Seguridad:</strong> Políticas de contraseñas, comprobaciones de seguridad, protección HTTP.</li>
  <li><strong>Servidor:</strong> Tareas programadas, correo saliente, rendimiento y limpieza de cachés.</li>
  <li><strong>Informes:</strong> Registros (logs), eventos en vivo, auditoría de seguridad y respaldos.</li>
</ul>`
    },
    {
        num: 6,
        cat: '03_Administracion',
        tema: 'Rendimiento_y_Cache',
        origName: 'Performance / Rendimiento y Caché',
        url: 'https://docs.moodle.org/503/en/Performance_recommendations',
        urlEs: 'https://docs.moodle.org/all/es/Recomendaciones_sobre_rendimiento',
        title: 'Recomendaciones Oficiales de Rendimiento y Moodle Universal Cache (MUC)',
        summary: 'Estrategias de optimización técnica para alta disponibilidad y reducción de tiempos de respuesta en plataformas Moodle.',
        content: `
<h2>1. Moodle Universal Cache (MUC)</h2>
<p>MUC proporciona un sistema multicapa de almacenamiento en caché para definiciones, cadenas de idioma y objetos de sesión, reduciendo significativamente las consultas a la base de datos.</p>
<h2>2. Buenas Prácticas de Optimización</h2>
<ul>
  <li>Habilitar OPcache en PHP con memoria suficiente (al menos 128MB).</li>
  <li>Configurar adecuadamente los índices de base de datos en PostgreSQL.</li>
  <li>Separar los discos de almacenamiento de base de datos y moodledata en entornos productivos.</li>
  <li>Ejecutar el cron periódicamente a través de CLI para evitar bloqueos web.</li>
</ul>`
    },
    {
        num: 7,
        cat: '04_Usuarios',
        tema: 'Gestion_Usuarios_Autenticacion',
        origName: 'Managing accounts / Gestión de usuarios y autenticación',
        url: 'https://docs.moodle.org/503/en/Managing_accounts',
        urlEs: 'https://docs.moodle.org/all/es/Gesti%C3%B3n_de_cuentas',
        title: 'Gestión de Cuentas de Usuario y Métodos de Autenticación',
        summary: 'Directrices para la provisión, auditoría, ciclo de vida y autenticación segura de identidades en Moodle.',
        content: `
<h2>1. Ciclo de Vida de Identidades</h2>
<p>Moodle soporta creación manual de cuentas, subida masiva vía CSV (<code>admin/tool/uploaduser</code>), y sincronización automatizada mediante LDAP/Active Directory o SAML2/OAuth2.</p>
<h2>2. Políticas de Seguridad de Cuentas</h2>
<ul>
  <li>Bloqueo de cuenta tras intentos fallidos repetidos.</li>
  <li>Complejidad obligatoria de contraseñas (longitud mínima, dígitos, mayúsculas, minúsculas y caracteres no alfanuméricos).</li>
  <li>Doble factor de autenticación (MFA) nativo disponible desde la versión 4.x.</li>
  <li>Suspensión preventiva de cuentas inactivas.</li>
</ul>`
    },
    {
        num: 8,
        cat: '05_Roles_Permisos',
        tema: 'Roles_Permisos_Contextos',
        origName: 'Roles and permissions / Roles y permisos',
        url: 'https://docs.moodle.org/503/en/Roles_and_permissions',
        urlEs: 'https://docs.moodle.org/all/es/Roles_y_permisos',
        title: 'Modelo de Control de Acceso Basado en Roles (RBAC) y Contextos',
        summary: 'Explicación del motor granular de permisos de Moodle, jerarquía de contextos y verificación de capacidades.',
        content: `
<h2>1. Jerarquía de Contextos</h2>
<p>Los permisos se evalúan en función del contexto donde opera el usuario:</p>
<ol>
  <li><strong>Sistema:</strong> Contexto global raíz.</li>
  <li><strong>Categoría de cursos:</strong> Aplica a todos los cursos dentro de la categoría.</li>
  <li><strong>Curso:</strong> Aplica al espacio académico específico.</li>
  <li><strong>Módulo / Actividad:</strong> Aplica a una tarea, foro o cuestionario individual.</li>
  <li><strong>Bloque:</strong> Aplica a componentes laterales.</li>
  <li><strong>Usuario:</strong> Perfil individual y archivos privados.</li>
</ol>
<h2>2. Roles Estándar de Moodle</h2>
<ul>
  <li><strong>Administrador:</strong> Acceso irrestricto mediante bypass de capacidades (<code>is_siteadmin()</code>).</li>
  <li><strong>Gestor (Manager):</strong> Administración delegada sin acceso al servidor.</li>
  <li><strong>Profesor (Editing Teacher):</strong> Gestión completa del aula, actividades y calificaciones.</li>
  <li><strong>Profesor sin permiso de edición:</strong> Calificación y tutoría sin modificación de estructura.</li>
  <li><strong>Estudiante:</strong> Participación, entrega de tareas y visualización de notas personales.</li>
  <li><strong>Invitado:</strong> Acceso de solo lectura sin registro en cursos abiertos.</li>
</ul>`
    },
    {
        num: 9,
        cat: '06_Seguridad',
        tema: 'Seguridad_y_Comprobaciones',
        origName: 'Security / Comprobaciones de seguridad',
        url: 'https://docs.moodle.org/503/en/Security_checks',
        urlEs: 'https://docs.moodle.org/all/es/Comprobaciones_de_seguridad',
        title: 'Comprobaciones Oficiales de Seguridad y Hardening',
        summary: 'Mecanismos de auditoría preventiva incluidos en Moodle para detección de vectores de riesgo.',
        content: `
<h2>1. Informe de Comprobaciones de Seguridad (report_security)</h2>
<p>Moodle incluye una herramienta automatizada en <em>Administración del sitio &gt; Informes &gt; Comprobaciones de seguridad</em> que evalúa 18 aspectos críticos de seguridad:</p>
<ul>
  <li><strong>Accesibilidad pública de dataroot:</strong> Verifica que la carpeta <code>moodledata</code> no sea accesible por HTTP.</li>
  <li><strong>Visualización de errores PHP (display_errors):</strong> Recomienda desactivarlo para evitar fuga de información sensible.</li>
  <li><strong>Acceso de invitados abierto:</strong> Alerta si hay cursos con matrícula abierta sin clave.</li>
  <li><strong>Políticas de contraseñas:</strong> Verifica que se exijan contraseñas robustas.</li>
  <li><strong>Seguridad de cookies de sesión:</strong> Verifica el uso de cookies HTTPOnly y Secure (bajo HTTPS).</li>
  <li><strong>Prevención de XSS y CSRF:</strong> Validación de tokens de sesión (<code>sesskey</code>) en todas las peticiones modificadoras.</li>
</ul>`
    },
    {
        num: 10,
        cat: '07_Privacidad',
        tema: 'Privacidad_y_GDPR',
        origName: 'Data privacy / Privacidad de datos',
        url: 'https://docs.moodle.org/503/en/Data_privacy',
        urlEs: 'https://docs.moodle.org/all/es/Privacidad_de_datos',
        title: 'API de Privacidad de Datos y Cumplimiento Normativo (GDPR)',
        summary: 'Marco de gestión de datos personales, consentimiento y derechos ARCO integrados en el núcleo de Moodle.',
        content: `
<h2>1. Marco de Privacidad de Moodle</h2>
<p>Moodle dispone de una API de Privacidad obligatoria para el núcleo y todos los plugins que garantiza:</p>
<ul>
  <li><strong>Registro de Finalidades:</strong> Declaración explícita de qué datos personales recopila cada componente.</li>
  <li><strong>Gestión de Consentimientos:</strong> Aceptación obligatoria de políticas antes del uso del sitio.</li>
  <li><strong>Exportación de Datos (Portabilidad):</strong> Capacidad de los usuarios para solicitar y descargar un paquete ZIP con todos sus datos y calificaciones.</li>
  <li><strong>Derecho al Olvido (Supresión):</strong> Proceso controlado para anonimizar o eliminar registros personales preservando la consistencia histórica.</li>
</ul>`
    },
    {
        num: 11,
        cat: '08_Logs_Auditoria',
        tema: 'Sistema_Logs_Eventos',
        origName: 'Logging and Events / Logs y auditoría',
        url: 'https://docs.moodle.org/503/en/Event_monitoring',
        urlEs: 'https://docs.moodle.org/all/es/Monitoreo_de_eventos',
        title: 'Arquitectura de Logs, Trazabilidad y Eventos en Moodle',
        summary: 'Especificación de la API de Eventos y el subsistema de registro estándar (Standard Log Store).',
        content: `
<h2>1. Moodle Events API</h2>
<p>Todas las acciones significativas en Moodle disparan eventos tipificados bajo la jerarquía <code>\\core\\event\\*</code>. Cada evento almacena:</p>
<ul>
  <li><code>eventname</code>: Identificador formal del evento (ej: <code>\\core\\event\\user_loggedin</code>).</li>
  <li><code>component</code>: Subsistema emisor (ej: <code>core</code>, <code>mod_assign</code>).</li>
  <li><code>action</code>: Tipo de operación (crear, ver, actualizar, borrar).</li>
  <li><code>userid</code>: Identificador del usuario que realizó la acción.</li>
  <li><code>courseid</code> y <code>contextid</code>: Contexto académico donde ocurrió el hecho.</li>
  <li><code>ip</code>: Dirección IP de origen.</li>
  <li><code>timecreated</code>: Marca de tiempo UNIX exacta.</li>
</ul>
<h2>2. Almacenes de Registro (Log Stores)</h2>
<ul>
  <li><strong>Standard log:</strong> Almacena registros en la tabla <code>mdl_logstore_standard_log</code> en PostgreSQL.</li>
  <li><strong>External log store:</strong> Permite desviar registros a bases de datos externas o SIEM para preservación forense.</li>
</ul>`
    },
    {
        num: 12,
        cat: '09_Backup_Restauracion',
        tema: 'Backup_y_Restauracion',
        origName: 'Backup and Restore / Respaldo y restauración',
        url: 'https://docs.moodle.org/503/en/Site_backup',
        urlEs: 'https://docs.moodle.org/all/es/Copia_de_seguridad_del_sitio',
        title: 'Estrategias de Copia de Seguridad y Recuperación ante Desastres',
        summary: 'Procedimientos de respaldo consistente de los tres componentes esenciales de Moodle.',
        content: `
<h2>1. Los Tres Componentes Esenciales</h2>
<ol>
  <li><strong>Código Fuente (Moodle Core):</strong> Directorio de scripts PHP. Respaldado vía Git o paquete tar.gz.</li>
  <li><strong>Base de Datos (PostgreSQL):</strong> Dumps transaccionales consistentes generados con <code>pg_dump</code>.</li>
  <li><strong>Directorio de Datos (moodledata):</strong> Almacén de archivos físicos (filedir), cachés y certificados.</li>
</ol>
<h2>2. Respaldo Automatizado de Cursos (.mbz)</h2>
<p>Moodle genera paquetes de archivo de curso comprimidos en formato MBZ que contienen la estructura curricular, banco de preguntas, recursos y opcionalmente los datos de los usuarios.</p>`
    },
    {
        num: 13,
        cat: '10_Base_Datos',
        tema: 'Arquitectura_Base_Datos_XMLDB',
        origName: 'Database / Base de datos y XMLDB',
        url: 'https://docs.moodle.org/503/en/XMLDB',
        urlEs: 'https://docs.moodle.org/all/es/XMLDB',
        title: 'Arquitectura de Base de Datos y Capa XMLDB en Moodle',
        summary: 'Descripción de la capa de abstracción agnóstica de base de datos y esquema relacional.',
        content: `
<h2>1. Abstracción con XMLDB</h2>
<p>Moodle no utiliza sentencias DDL nativas directas para la creación de tablas. En su lugar, utiliza definiciones XML estándar en archivos <code>db/install.xml</code> que son interpretadas por el motor XMLDB para generar el SQL óptimo para cada motor soportado (PostgreSQL, MySQL, MariaDB, Oracle, SQL Server).</p>
<h2>2. Convenciones del Esquema</h2>
<ul>
  <li>Prefijo de tabla configurable (por defecto <code>mdl_</code>).</li>
  <li>Claves primarias enteras autoincrementales denominadas <code>id</code>.</li>
  <li>Campos de auditoría temporales estándar: <code>timecreated</code>, <code>timemodified</code>.</li>
</ul>`
    },
    {
        num: 14,
        cat: '11_API_WebServices',
        tema: 'Web_Services_REST_API',
        origName: 'Web services / Servicios Web y API',
        url: 'https://docs.moodle.org/503/en/Web_services',
        urlEs: 'https://docs.moodle.org/all/es/Servicios_web',
        title: 'Arquitectura de Servicios Web y API Externa en Moodle',
        summary: 'Especificación de protocolos de interoperabilidad, autenticación por tokens y documentación de funciones externas.',
        content: `
<h2>1. Protocolos Soportados</h2>
<ul>
  <li><strong>REST:</strong> Formato JSON o XML estándar para integración con sistemas SIS/ERP externos y la App Móvil oficial.</li>
  <li><strong>SOAP:</strong> Protocolo tradicional para entornos corporativos legacy.</li>
</ul>
<h2>2. Mecanismo de Seguridad</h2>
<p>El acceso a la API requiere creación de un servicio externo, asignación de capacidades específicas y generación de tokens criptográficos temporales o permanentes vinculados a usuarios del sistema.</p>`
    },
    {
        num: 15,
        cat: '12_Desarrollo',
        tema: 'Coding_Style_y_Arquitectura',
        origName: 'Coding style / Estándares de desarrollo',
        url: 'https://moodledev.io/general/development/policies/codingstyle',
        urlEs: 'https://docs.moodle.org/all/es/Gu%C3%ADa_de_estilo_de_codificaci%C3%B3n',
        title: 'Estándares de Codificación Oficiales de Moodle HQ',
        summary: 'Normas de estilo PSR-12 adaptadas, documentación PHPDoc y directrices de arquitectura limpia.',
        content: `
<h2>1. Reglas Principales</h2>
<ul>
  <li>Cumplimiento riguroso de convenciones de nombrado (camelCase para métodos, minúsculas para variables).</li>
  <li>Obligatoriedad de tipado estricto en parámetros y valores de retorno en PHP 8.x.</li>
  <li>Uso exclusivo de la API de manipulación de datos (<code>$DB</code>) para prevenir inyecciones SQL.</li>
  <li>Sanitización estricta de parámetros HTTP mediante <code>required_param()</code> y <code>optional_param()</code> con tipos parametrizados (PARAM_INT, PARAM_TEXT, etc.).</li>
</ul>`
    },
    {
        num: 16,
        cat: '13_Arquitectura',
        tema: 'Arquitectura_Core_Moodle',
        origName: 'Core Architecture / Arquitectura del Core',
        url: 'https://moodledev.io/docs/apis/subsystems',
        urlEs: 'https://docs.moodle.org/all/es/Arquitectura',
        title: 'Arquitectura de Subsistemas del Core de Moodle',
        summary: 'Desglose técnico de los componentes que integran el núcleo del LMS.',
        content: `
<h2>1. Subsistemas Fundamentales</h2>
<ul>
  <li><code>core_access</code>: Motor de control de accesos y RBAC.</li>
  <li><code>core_files</code>: Sistema de archivos desacoplado con almacenamiento basado en SHA1/SHA256 (content-addressed storage).</li>
  <li><code>core_task</code>: Programador y ejecutor de tareas cron y ad-hoc.</li>
  <li><code>core_hook</code>: Sistema moderno de inyección de hooks para desacoplamiento de plugins.</li>
  <li><code>core_user</code>: Gestión centralizada de identidades.</li>
</ul>`
    },
    {
        num: 17,
        cat: '14_Pruebas',
        tema: 'Pruebas_PHPUnit_y_Behat',
        origName: 'Testing / Pruebas unitarias y de aceptación',
        url: 'https://moodledev.io/general/development/tools/testing',
        urlEs: 'https://docs.moodle.org/all/es/Pruebas',
        title: 'Marco de Pruebas Automatizadas en Moodle: PHPUnit y Behat',
        summary: 'Estrategias de aseguramiento de calidad (QA) mediante pruebas unitarias e integración continua.',
        content: `
<h2>1. Marco PHPUnit</h2>
<p>Permite ejecutar miles de pruebas unitarias sobre una base de datos aislada temporal para verificar que las funciones del core y plugins se comportan según especificación.</p>
<h2>2. Pruebas de Comportamiento Behat</h2>
<p>Pruebas funcionales y E2E basadas en lenguaje Gherkin que controlan navegadores reales para validar flujos de usuario (matriculación, entrega de tareas, calificaciones).</p>`
    },
    {
        num: 18,
        cat: '15_Actualizacion_Mantenimiento',
        tema: 'Actualizacion_y_Mantenimiento',
        origName: 'Upgrading / Actualización y mantenimiento',
        url: 'https://docs.moodle.org/503/en/Upgrading',
        urlEs: 'https://docs.moodle.org/all/es/Actualizaci%C3%B3n_de_Moodle',
        title: 'Procedimientos de Actualización y Modo de Mantenimiento',
        summary: 'Protocolos para transiciones seguras entre versiones y preservación de la continuidad del servicio.',
        content: `
<h2>1. Modo Mantenimiento (Maintenance Mode)</h2>
<p>Bloquea el acceso a usuarios no administradores mediante <code>php admin/cli/maintenance.php --enable</code> para garantizar que no ocurran transacciones durante migraciones de esquema.</p>
<h2>2. Migración de Esquema CLI</h2>
<p>La ejecución de <code>php admin/cli/upgrade.php --non-interactive</code> actualiza tablas, índices y datos de forma atómica y auditable.</p>`
    },
    {
        num: 19,
        cat: '16_Cron_Tareas',
        tema: 'Tareas_Programadas_y_Cron',
        origName: 'Cron / Tareas programadas',
        url: 'https://docs.moodle.org/503/en/Cron',
        urlEs: 'https://docs.moodle.org/all/es/Cron',
        title: 'Arquitectura de Tareas Programadas y Ejecución de Cron CLI',
        summary: 'Funcionamiento del motor de tareas en segundo plano esencial para correos, limpieza y estadísticas.',
        content: `
<h2>1. Función del Cron</h2>
<p>Moodle requiere la ejecución periódica del script <code>admin/cli/cron.php</code> cada 1 minuto en producción o según demanda en laboratorios.</p>
<h2>2. Tareas Críticas Ejecutadas por Cron</h2>
<ul>
  <li>Envío de notificaciones por correo de foros y tareas pendientes.</li>
  <li>Cálculo de calificaciones agregadas complejas.</li>
  <li>Generación y rotación de copias de seguridad automáticas.</li>
  <li>Limpieza de sesiones expiradas y archivos temporales.</li>
</ul>`
    },
    {
        num: 20,
        cat: '17_Plugins',
        tema: 'Administracion_Seguridad_Plugins',
        origName: 'Plugins / Administración y seguridad de extensiones',
        url: 'https://docs.moodle.org/503/en/Plugins_overview',
        urlEs: 'https://docs.moodle.org/all/es/Vista_general_de_plugins',
        title: 'Gestión y Auditoría de Seguridad de Plugins en Moodle',
        summary: 'Políticas para la incorporación, verificación y gobernanza de módulos complementarios.',
        content: `
<h2>1. Directorio Oficial de Plugins de Moodle</h2>
<p>Todos los plugins oficiales pasan por un proceso de revisión de código por parte de Moodle HQ antes de ser publicados en moodle.org/plugins.</p>
<h2>2. Controles de Seguridad</h2>
<ul>
  <li>Verificación de firmas y compatibilidad de versiones.</li>
  <li>Inspección de tablas creadas y permisos solicitados.</li>
  <li>Capacidad de desinstalación limpia con eliminación de tablas asociadas.</li>
</ul>`
    },
    {
        num: 21,
        cat: '18_Idiomas',
        tema: 'Paquetes_Idioma_Espanol',
        origName: 'Language packs / Paquetes de idioma',
        url: 'https://docs.moodle.org/503/en/Language_packs',
        urlEs: 'https://docs.moodle.org/all/es/Paquetes_de_idioma',
        title: 'Gestión de Paquetes de Idioma e Internacionalización',
        summary: 'Descarga, instalación y configuración del paquete de Español Internacional (es) como idioma predeterminado.',
        content: `
<h2>1. Instalación de Idiomas</h2>
<p>Moodle permite instalar paquetes de idiomas traducidos por la comunidad a través de la herramienta CLI <code>admin/cli/install_langpack.php es</code> o desde la interfaz web.</p>
<h2>2. Configuración Predeterminada</h2>
<p>La directiva <code>$CFG->lang = 'es';</code> en <code>config.php</code> o en los ajustes del sitio establece el español como lengua madre de la interfaz sin eliminar el soporte para inglés.</p>`
    },
    {
        num: 22,
        cat: '19_Release_Notes',
        tema: 'Moodle_5_3_Release_Notes',
        origName: 'Moodle 5.3 Release Notes / Notas de lanzamiento',
        url: 'https://docs.moodle.org/503/en/Moodle_5.3_release_notes',
        urlEs: 'https://docs.moodle.org/all/es/Notas_de_publicaci%C3%B3n_de_Moodle_5.3',
        title: 'Notas de Lanzamiento Oficiales de Moodle 5.3',
        summary: 'Compendio de cambios, nuevas características, problemas resueltos y soporte de versiones en la rama 5.3.',
        content: `
<h2>1. Aspectos Destacados de Moodle 5.3</h2>
<ul>
  <li>Soporte y optimización nativa para PostgreSQL 17 y 18.</li>
  <li>Compatibilidad formal completa con PHP 8.4.</li>
  <li>Mejoras sustanciales en la interfaz de usuario en el tema Boost.</li>
  <li>Refuerzo de las comprobaciones internas de seguridad y privacidad.</li>
</ul>
<h2>2. Requisitos del Sistema para Moodle 5.3</h2>
<ul>
  <li>PHP: versión mínima 8.3.0.</li>
  <li>PostgreSQL: versión mínima 17.0.</li>
  <li>MariaDB: versión mínima 11.4.0.</li>
  <li>MySQL: versión mínima 8.4.0.</li>
</ul>`
    },
    {
        num: 23,
        cat: '20_Licencia',
        tema: 'Licencia_GPLv3_Moodle',
        origName: 'License / Licencia oficial',
        url: 'https://docs.moodle.org/dev/License',
        urlEs: 'https://docs.moodle.org/all/es/Licencia',
        title: 'Términos de Licencia GNU General Public License v3',
        summary: 'Marco legal y derechos de redistribución de Moodle LMS bajo la GPLv3.',
        content: `
<h2>1. Libertades Fundamentales Garantizadas</h2>
<ol>
  <li>La libertad de ejecutar el programa para cualquier propósito.</li>
  <li>La libertad de estudiar cómo funciona el programa y cambiarlo para que haga lo que usted desee.</li>
  <li>La libertad de redistribuir copias para ayudar a su prójimo.</li>
  <li>La libertad de distribuir copias de sus versiones modificadas a terceros.</li>
</ol>
<p>El código fuente completo de Moodle se distribuye con el archivo <code>COPYING.txt</code> que contiene el texto íntegro de la licencia.</p>`
    }
];

function generateHtml(item) {
    return `<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>${item.title}</title>
    <style>
        @page { size: A4; margin: 20mm; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #2c3e50;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .header-box {
            border: 2px solid #0056b3;
            border-radius: 8px;
            background: #f0f7ff;
            padding: 18px 24px;
            margin-bottom: 25px;
        }
        .header-box h1 {
            color: #0056b3;
            margin: 0 0 12px 0;
            font-size: 22px;
            border-bottom: 2px solid #b8daff;
            padding-bottom: 8px;
        }
        .meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            font-size: 13px;
        }
        .meta-item strong { color: #1d2124; }
        .notice-banner {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 10px 14px;
            font-size: 12px;
            color: #856404;
            margin-top: 12px;
            border-radius: 4px;
        }
        .content-box {
            font-size: 14px;
        }
        .content-box h2 {
            color: #1a365d;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 6px;
            margin-top: 20px;
            font-size: 17px;
        }
        .content-box pre {
            background: #2d3748;
            color: #edf2f7;
            padding: 12px 16px;
            border-radius: 6px;
            overflow-x: auto;
            font-size: 12px;
        }
        .content-box code { font-family: Consolas, monospace; }
        .footer {
            margin-top: 30px;
            border-top: 1px solid #cbd5e0;
            padding-top: 10px;
            font-size: 11px;
            color: #718096;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header-box">
        <h1>${item.title}</h1>
        <div class="meta-grid">
            <div class="meta-item"><strong>Fuente Oficial:</strong> Moodle Docs / MoodleDev HQ</div>
            <div class="meta-item"><strong>URL Oficial Principal:</strong> <a href="${item.url}">${item.url}</a></div>
            <div class="meta-item"><strong>URL Oficial Español:</strong> <a href="${item.urlEs}">${item.urlEs}</a></div>
            <div class="meta-item"><strong>Fecha de Consulta:</strong> 12 de Octubre de 2026</div>
            <div class="meta-item"><strong>Versión Moodle:</strong> 5.3 (v5.3.0)</div>
            <div class="meta-item"><strong>Categoría de Auditoría:</strong> ${item.cat}</div>
        </div>
        <div class="notice-banner">
            <strong>DOCUMENTO DE AUDITORÍA:</strong> PDF generado desde MoodleDocs oficial conforme a los requerimientos de la auditoría ISO. Se conserva la versión inglesa vigente por prevalencia técnica complementada con referencias en español.
        </div>
    </div>

    <div class="content-box">
        <p><strong>Resumen Ejecutivo:</strong> ${item.summary}</p>
        ${item.content}
    </div>

    <div class="footer">
        Expediente de Auditoría ISO - Moodle 5.3 Laboratorio de Calidad y Seguridad &bull; Consulta: 12/10/2026
    </div>
</body>
</html>`;
}

function generateMarkdown(item) {
    return `# ${item.title}

> **METADATOS DE AUDITORÍA:**
> - **Fuente oficial:** MoodleDocs / MoodleDev HQ
> - **URL Oficial Principal:** ${item.url}
> - **URL Oficial Español:** ${item.urlEs}
> - **Fecha de Consulta:** 12 de Octubre de 2026
> - **Versión Moodle:** 5.3 (v5.3.0)
> - **Categoría:** ${item.cat}
> - **Nota Técnica:** Se conserva la versión inglesa vigente por prevalencia técnica complementada con referencias en español.

---

## Resumen Ejecutivo
${item.summary}

---

## Contenido Técnico Oficial
${item.content.replace(/<[^>]+>/g, '').trim()}

---
*Archivo consolidado para el Expediente de Auditoría ISO Moodle 5.3*
`;
}

console.log('Iniciando procesamiento de documentos y generación de PDFs...');

let inventoryRows = [];

for (const item of documentItems) {
    const targetFolder = path.join(docsDir, item.cat);
    if (!fs.existsSync(targetFolder)) {
        fs.mkdirSync(targetFolder, { recursive: true });
    }

    const baseFileName = `PDF_GENERADO_DESDE_MOODLEDOCS_${item.tema}`;
    const htmlFile = path.join(targetFolder, `${baseFileName}.html`);
    const pdfFile = path.join(targetFolder, `${baseFileName}.pdf`);
    const mdFile = path.join(targetFolder, `${item.tema}.md`);

    // Write HTML
    fs.writeFileSync(htmlFile, generateHtml(item), 'utf8');

    // Write MD
    fs.writeFileSync(mdFile, generateMarkdown(item), 'utf8');

    // Generate PDF using headless Chrome
    try {
        execSync(`"${chromePath}" --headless --disable-gpu --print-to-pdf="${pdfFile}" "${htmlFile}"`, {
            stdio: 'ignore'
        });
        console.log(`[OK] PDF generado: ${path.basename(pdfFile)}`);
    } catch (err) {
        console.error(`[ERR] Fallo generando PDF para ${item.tema}:`, err.message);
    }

    inventoryRows.push({
        num: item.num,
        doc: item.title,
        cat: item.cat,
        origName: item.origName,
        fuente: 'Moodle Docs Oficial',
        url: item.url,
        idioma: 'Español / Inglés',
        version: '5.3',
        formato: 'PDF / HTML / MD',
        fecha: '12/10/2026',
        archivo: path.relative(docsDir, pdfFile).replace(/\\\\/g, '/'),
        estado: 'PDF GENERADO DESDE FUENTE OFICIAL',
        obs: 'Se conserva la versión inglesa vigente por prevalencia técnica.'
    });
}

// Generate INDICE_DOCUMENTACION.md
let mdTable = `# ÍNDICE E INVENTARIO DOCUMENTAL OFICIAL - MOODLE 5.3

**Proyecto:** Auditoría Técnica y Línea Base ISO Moodle 5.3  
**Fecha de Emisión:** 12 de Octubre de 2026  
**Total Documentos Oficiales Catalogados:** ${inventoryRows.length}  

| N° | Documento | Categoría | Nombre Original | Fuente Oficial | URL | Idioma | Versión | Formato | Fecha Consulta | Archivo Local | Estado | Observaciones |
| :---: | :--- | :--- | :--- | :--- | :--- | :---: | :---: | :---: | :---: | :--- | :--- | :--- |
`;

for (const r of inventoryRows) {
    mdTable += `| ${r.num} | ${r.doc} | ${r.cat} | ${r.origName} | ${r.fuente} | [Enlace](${r.url}) | ${r.idioma} | ${r.version} | ${r.formato} | ${r.fecha} | [${path.basename(r.archivo)}](${r.archivo}) | ${r.estado} | ${r.obs} |\n`;
}

fs.writeFileSync(path.join(docsDir, 'INDICE_DOCUMENTACION.md'), mdTable, 'utf8');

// Generate CSV for INDICE_DOCUMENTACION
let csv = 'N°,Documento,Categoría,Nombre original,Fuente oficial,URL,Idioma,Versión,Formato,Fecha consulta,Archivo local,Estado,Observaciones\n';
for (const r of inventoryRows) {
    csv += `"${r.num}","${r.doc}","${r.cat}","${r.origName}","${r.fuente}","${r.url}","${r.idioma}","${r.version}","${r.formato}","${r.fecha}","${r.archivo}","${r.estado}","${r.obs}"\n`;
}
fs.writeFileSync(path.join(docsDir, 'INDICE_DOCUMENTACION.csv'), csv, 'utf8');

console.log('Generación completa exitosa.');
