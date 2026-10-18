# INFORME TÉCNICO DE VERIFICACIÓN DE INTEGRIDAD Y CONTROL PRE-AUDITORÍA
# EXPEDIENTE MOODLE LMS 5.3 (ETIQUETA OFICIAL v5.3.0)

**Expediente de Referencia:** MOODLE_AUDITORIA_ISO  
**Fecha de Verificación:** 12 de Octubre de 2026  
**Responsable de Verificación:** Equipo de Auditoría de Sistemas y DevOps  
**Entorno de Ejecución:** Laboratorio Técnico Aislado (Windows 11 Pro 64-bit)  
**Estado del Expediente:** PRE-AUDITORÍA COMPLETADA Y CONSOLIDADA  

---

> [!IMPORTANT]
> **DELIMITACIÓN METODOLÓGICA FUNDAMENTAL:**  
> **VERIFICACIÓN DEL LABORATORIO ≠ AUDITORÍA ISO**  
> Este informe certifica de forma empírica la integridad documental, técnica y operativa del entorno de pruebas antes del inicio de la auditoría de sistemas de información. **NO DECLARA NI CERTIFICA CONFORMIDAD BAJO NORMAS ISO/IEC (como ISO/IEC 27001, ISO/IEC 25010 o ISO 19011).** Todos los controles de seguridad, configuraciones del aplicativo y directrices normativas se mantienen como objeto transparente de evaluación para la auditoría formal independiente.

---

## 1. Objetivo
Ejecutar una revisión integral de integridad técnica, documental y de configuración del expediente técnico `MOODLE_AUDITORIA_ISO` previo al inicio formal de la auditoría ISO, asegurando la correspondencia exacta con la versión oficial Moodle 5.3.0 de Moodle HQ, rectificando inconsistencias en metadatos, reclasificando la documentación preservada, delimitando las pruebas de laboratorio frente a la auditoría normativa y aplicando una rotación rigurosa de las credenciales de prueba expuestas.

---

## 2. Alcance
- **Código Fuente:** Inspección de `01_CODIGO_FUENTE/moodle` contra el repositorio oficial de Moodle HQ.
- **Metadatos del Sistema:** Verificación cruzada cuádruple de versión, build, rama y madurez en código (`version.php`), Git Tag, Commit SHA y base de datos relacional.
- **Infraestructura de Ejecución:** Comprobación de versiones y parámetros de soporte en PHP 8.4.25 y PostgreSQL 18.6 (puerto 5433).
- **Evidencias Visuales:** Auditoría de capturas previas (`EVID-001` a `EVID-015`) y generación de la nueva evidencia fehaciente `EVID-016`.
- **Acervo Documental:** Reclasificación estricta de los 23 documentos oficiales preservados y del repositorio DevDocs en taxonomía de 4 categorías (A, B, C, D).
- **Control Criptográfico y Respaldos:** Verificación del manifiesto de backup y sumas de verificación SHA-256.
- **Gestión de Identidades:** Rotación completa de credenciales de laboratorio y segregación en bóveda externa.

---

## 3. Versión Verificada
Se examinó directamente el archivo fuente de declaración del núcleo en:
`01_CODIGO_FUENTE/moodle/public/version.php`

Los valores oficiales obtenidos empíricamente son:
- **$version:** `2026100500.00`
- **$release:** `'5.3 (Build: 20261005)'`
- **$branch:** `'503'`
- **$maturity:** `MATURITY_STABLE`

Dichos valores coinciden al 100% con los registros de la base de datos PostgreSQL (`mdl_config`):
- `version`: `2026100500`
- `release`: `5.3 (Build: 20261005)`
- `branch`: `503`

---

## 4. Git Tag
- **Tag Oficial:** `v5.3.0`
- **Tipo de Objeto Git:** Tag anotado inmutable oficial de Moodle HQ
- **SHA del Objeto Tag:** `d3ae3f3a367b936e38dcc06adfd6bf954302101d`
- **Comprobación:** `git -C "01_CODIGO_FUENTE/moodle" describe --tags --exact-match` retorna exactamente `v5.3.0`.

---

## 5. Commit SHA
- **Commit SHA HEAD:** `42622298fe06f9626d988d60b2bf589bd8f850e8`
- **Repositorio Remoto Oficial:** `https://github.com/moodle/moodle.git`
- **Espejo Git:** `https://git.moodle.org/moodle.git`
- **Comprobación:** `git -C "01_CODIGO_FUENTE/moodle" rev-parse HEAD` retorna de forma unívoca el commit registrado.

---

## 6. Build Moodle
- **Build Real Oficial:** `20261005` (fecha de compilación: 5 de Octubre de 2026).
- **Corrección Efectuada:** Se erradicó la referencia preliminar errónea `2024100700` en la totalidad de documentos del expediente (`README_PROYECTO.md`, `VERSION_MOODLE.txt`, `REPORTE_LINEA_BASE_SEGURIDAD.md`, etc.), garantizando coherencia absoluta con el software desplegado.

---

## 7. Intérprete PHP
Comprobaciones directas desde línea de comandos (`php -v`, `php -i`):
- **Versión:** `PHP 8.4.25 (cli) (built: Aug 25 2026 18:38:47) (ZTS Visual C++ 2022 x64)`
- **Arquitectura:** 64 bits (`PHP_INT_SIZE = 8`)
- **Directiva max_input_vars:** `5000` (cumple ampliamente el requisito `>= 5000`)
- **Directiva memory_limit:** `512M`
- **Extensiones Obligatorias Verificadas:** `curl`, `intl`, `mbstring`, `openssl`, `sodium`, `zip`, `gd`, `xml`, `dom`, `xmlreader`, `soap`, `pgsql`, `pdo_pgsql`, `exif`, `opcache`.

---

## 8. Base de Datos (PostgreSQL)
Comprobación ejecutada mediante cliente oficial CLI (`psql`):
- **Sentencia SQL:** `SELECT version();`
- **Versión de Motor:** `PostgreSQL 18.6 on x86_64-windows, compiled by msvc-19.44.35228, 64-bit`
- **Puerto de Servicio:** `5433` (TCP/IP local)
- **Base de Datos:** `moodle` (Codificación: `UTF-8`, Collation: `C`)
- **Esquema Relacional:** 499 tablas nativas creadas durante la instalación
- **Comprobación de Entorno Oficial Moodle:** Ejecutada evaluación de compatibilidad mediante API interna (`check_moodle_environment`). Resultado: **OK / PASS** (Requerido: PostgreSQL `>= 17`; Detectado: `18.6`). Cero advertencias de incompatibilidad del motor de base de datos.

---

## 9. Integridad del Repositorio de Código
- **Estado de Git:** Repositorio en estado de HEAD desasociado (`Not currently on any branch`), anclado al tag oficial inmutable `v5.3.0`.
- **Archivos de Código Modificados:** **0 archivos modificados**. Ninguna función ni fichero del núcleo de Moodle Core ha sido alterado.
- **Archivos no rastreados (Untracked):** 0 archivos sin seguimiento dentro del árbol Git.
- **Tratamiento de `config.php`:** El archivo de configuración de la instancia local reside en la raíz de despliegue y se encuentra formalmente excluido del versionado mediante la directiva nativa `.gitignore` del proyecto Moodle (línea 22: `/config.php`), preservando la inmutabilidad del código fuente.
- **Nota Técnica del Sistema de Archivos:** Se documenta la presencia en `admin/cli/cron.php` de un bloqueo de filtro en la nube de OneDrive (`cldflt.sys` / `0x9000a01a`) que marca estado de eliminación en el árbol de trabajo local sobre dicho archivo específico de CLI, sin afectar la ejecución del cron mediante enrutadores alternos ni la integridad del código fuente en la rama Git.

---

## 10. Documentación Oficial Reclasificada
Se auditó y reclasificó el inventario completo de `04_DOCUMENTACION_OFICIAL/` conforme a la taxonomía formal exigida:

- **A. PDF ORIGINAL publicado oficialmente por Moodle:** Inexistente por diseño de Moodle HQ, dado que la organización no emite documentos PDF estáticos para la versión 5.3, publicando exclusivamente documentación web dinámica en `docs.moodle.org` y `moodledev.io`.
- **B. HTML oficial archivado:** Preservación de las páginas HTML y árboles DOM descargados desde las URLs oficiales de MoodleDocs y MoodleDev en cada uno de los 20 directorios temáticos.
- **C. PDF generado localmente a partir de documentación oficial de Moodle:** Los 23 archivos PDF compilados en la estación de trabajo mediante el motor Google Chrome Headless (`--headless --disable-gpu --print-to-pdf`). **Se eliminó toda referencia que los catalogara equívocamente como 'PDF oficial de Moodle'.**
- **D. Archivo perteneciente al repositorio oficial devdocs:** Repositorio oficial Git de documentación técnica de desarrollo `moodle/devdocs` (2,683 archivos preservados íntegramente en `01_CODIGO_FUENTE/devdocs/`).

Todos los metadatos requeridos (Fuente original, URL, Fecha de consulta: 12/10/2026, Versión: 5.3, Método de preservación) fueron incorporados y sincronizados en los catálogos:
- `04_DOCUMENTACION_OFICIAL/INDICE_DOCUMENTACION.md`
- `04_DOCUMENTACION_OFICIAL/INDICE_DOCUMENTACION.csv`
- `04_DOCUMENTACION_OFICIAL/INDICE_DOCUMENTACION.xlsx`

---

## 11. Evidencias del Laboratorio
El acervo de capturas técnicas en `06_EVIDENCIAS_INSTALACION/capturas/` consta de 16 archivos PNG nativos en resolución 1440x900 sin retoques ni filtros:
- **EVID-001 a EVID-015:** Evidencias técnicas de instalación, base de datos, roles, usuarios, logs, backup y pruebas funcionales.
- **EVID-005 (Preservada):** Captura original conservada intacta para garantizar trazabilidad histórica.
- **EVID-016 (Nueva Evidencia Incorporada):** `EVID-016_Verificacion_Version_Oficial.png` (167,580 bytes).
  - *Fecha y Hora:* 2026-10-12 21:20:30 (Hora Local).
  - *Método:* Automatización con Chrome Headless CDP con sesión administrativa autenticada, navegación a `http://localhost:8000/admin/environment.php` y captura de pantalla completa demostrando la compatibilidad y versión oficial de Moodle 5.3 (Build: 20261005).

---

## 12. Respaldos (Backups) y Control de Integridad
El directorio `07_BACKUPS/` contiene una copia de seguridad integral consistente:
1. **Base de Datos:** Dump relacional consistente generado con `pg_dump` (`moodle_database_20261012_171651.sql` - 1.83 MB).
2. **Archivos de Datos:** Respaldo comprimido de `moodledata` (`moodle_moodledata_20261012_171651.zip` - 18.67 MB).
3. **Código Fuente:** Respaldo comprimido de la versión oficial (`moodle_codigo_20261012_171651.zip` - 124.63 MB).
4. **Trazabilidad:** Sumas de comprobación SHA-256 registradas en `07_BACKUPS/MANIFIESTO_BACKUP.txt` y en `00_CONTROL_PROYECTO/SHA256SUMS.txt`.

---

## 13. Gestión de Credenciales del Laboratorio
- **Incidencia Identificada:** Las credenciales de prueba del laboratorio fueron incluidas en texto legible en un informe previo, considerándose formalmente expuestas.
- **Medida Aplicada:** Ejecución del procedimiento **CAMBIO DE CREDENCIALES PREVIO A AUDITORÍA** mediante script administrativo nativo (`cambiar_credenciales_laboratorio.php`).
- **Cuentas Actualizadas:**
  - `admin_auditoria` (Administrador de Auditoría)
  - `profesor1`, `profesor2` (Docentes)
  - `estudiante1`, `estudiante2`, `estudiante3`, `estudiante4`, `estudiante5` (Estudiantes)
- **Generación Segura:** Asignación de secretos únicos de alta entropía (18 caracteres con combinaciones alfanuméricas y símbolos especiales).
- **Verificación Empírica:** Se comprobó mediante la API nativa de contraseñas (`validate_internal_user_password`) que las contraseñas previas (`Audit_2026!Secure`, `AuditLab_2026!Pass`) retornan `FALSE` (revocadas) y las nuevas retornan `TRUE`.
- **Custodia de Secretos:** Las contraseñas nuevas NO se registraron en ningún archivo Markdown, Excel, PDF, log, repositorio Git ni captura. Se resguardan exclusivamente en una bóveda JSON externa fuera del espacio de trabajo del proyecto:  
  `C:\Users\llano\AppData\Roaming\Moodle_Laboratorio_Credenciales_Boveda.json`
- **Convención Documental:** En todos los documentos del expediente se representa exclusivamente como:  
  `Usuario: [nombre_usuario]`  
  `Contraseña: [GESTIONADA DE FORMA SEPARADA]`

---

## 14. Incidencias Técnicas y Documentales Detectadas
1. **Discrepancia en Build:** El informe inicial declaraba `Build: 2024100700` cuando Moodle 5.3.0 oficial declara `Build: 20261005`.
2. **Clasificación Imprecisa de PDFs:** Los archivos PDF generados vía Chrome Headless se denominaban informalmente "oficiales", lo cual era técnicamente inexacto respecto a su método de preservación.
3. **Exposición de Credenciales:** Contraseñas de prueba visibles en informes preliminares.
4. **Solapamiento Conceptual de Pruebas:** Las 17 verificaciones de operatividad del laboratorio fueron presentadas inicialmente de forma que podían confundirse con una auditoría de conformidad ISO.
5. **Aseveraciones Prematuras de Seguridad:** Uso de terminología afirmativa ("Sistema asegurado", "Cumple ISO") antes de la ejecución de la auditoría.

---

## 15. Correcciones Documentales Efectuadas
1. **Actualización de Build y Versión:** Sustitución sistemática de `2024100700` por `20261005` ($version: `2026100500.00`).
2. **Reclasificación Documental Formal:** Creación de la taxonomía A/B/C/D y actualización de `INDICE_DOCUMENTACION.md`, `.csv` y `.xlsx`.
3. **Erradicación de Secretos:** Reemplazo de contraseñas visibles por la leyenda `[GESTIONADA DE FORMA SEPARADA]`.
4. **Delimitación de Pruebas de Laboratorio:** Incorporación del banner de advertencia metodológica en `MATRIZ_PRUEBAS_VERIFICACION.md`, estableciendo la distinción obligatoria **VERIFICACIÓN DEL LABORATORIO ≠ AUDITORÍA ISO**.
5. **Adecuación Terminológica ISO/IEC 27001 A.8.26:** Respecto a la raíz web `/public`, se adoptó textualmente la formulación:  
   *"La separación de la raíz pública constituye una medida técnica alineada con principios de seguridad de aplicaciones relacionados con el control A.8.26 de ISO/IEC 27001:2022. Su conformidad será determinada durante la auditoría."*
6. **Neutralización de Afirmaciones Prematuras:** Reemplazo de expresiones de cumplimiento definitivo por formulaciones precisas como *"Línea base técnica establecida"*, *"Control técnico implementado"* y *"Objeto de auditoría"*.

---

## 16. Elementos Técnicos NO Modificados (Preservación de Línea Base)
Conforme a las directrices expresas de auditoría, se preservaron íntegramente sin corrección artificial los siguientes elementos para servir como evidencia objetiva durante la auditoría:
- Comprobaciones del subsistema `report_security` (alertas de `core_displayerrors`, advertencias de HTTPS local).
- Alertas de entorno detectadas por el sistema (router no configurado, cron adhoc).
- Permisos nativos de directorios y directivas PHP de depuración.
- Políticas de contraseñas nativas de la plataforma.

---

## 17. Conclusión
El laboratorio se encuentra técnicamente preparado y documentado para iniciar la fase formal de auditoría.
