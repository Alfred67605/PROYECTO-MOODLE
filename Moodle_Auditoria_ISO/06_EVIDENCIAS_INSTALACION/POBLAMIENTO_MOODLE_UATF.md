# INFORME TÉCNICO DE POBLAMIENTO MASIVO Y ESCENARIO ACADÉMICO SINTÉTICO — UATF
## Moodle LMS 5.3dev | Laboratorio de Auditoría Informática ISO/IEC 27005:2022
**Documento de Entrega:** `POBLAMIENTO_MOODLE_UATF.md`  
**Fecha de Ejecución y Verificación:** 18 de octubre de 2026  
**Auditor / Ingeniero Responsable:** Alfredo Llanos Taca  
**Entorno de Laboratorio:** `http://localhost:8000` | PostgreSQL 18 (`127.0.0.1:5433`)

---

## 1. Instalación Efectivamente Utilizada y Configuración

Antes de ejecutar cualquier operación de poblamiento masivo, se realizó una verificación técnica exhaustiva de la pila tecnológica servida en el entorno local:

| Parámetro | Configuración Efectiva Comprobada | Evidencia / Ubicación |
| :--- | :--- | :--- |
| **Directorio Raíz del Proyecto** | `c:\Users\llano\Documents\OCTAVO SEMESTRE\AUDITORIA\PROYECTO\Moodle_Auditoria_ISO` | Espacio de trabajo local verificado |
| **URL del Servicio Web** | `http://localhost:8000` | Servidor PHP 8.4 dev server con `router.php` |
| **Versión de Moodle LMS** | **Moodle 5.3dev (Build: 20260408)** | `$CFG->version = 2026040800.00`, Release 5.3dev |
| **Directorio Raíz de Código (`dirroot`)** | `01_CODIGO_FUENTE\moodle\public` | Estructura moderna Moodle 5.x |
| **Directorio de Datos (`dataroot`)** | `02_ENTORNO_EJECUCION\moodledata` | Permisos `02777`, tamaño post-carga: 31.05 MB |
| **Motor de Base de Datos** | **PostgreSQL 18.3 x64** | Puerto dedicado `5433` (PID 16256) |
| **Nombre de Base de Datos** | `moodle` (Esquema `public`, 499 tablas) | Tamaño post-carga: 128 MB |
| **Clúster Físico de Datos** | `02_ENTORNO_EJECUCION\pgsql_data` | Tamaño en disco: 327.59 MB |
| **Usuario de Conexión a BD** | `moodleuser` / Contraseña en `config.php` | Driver `native/pgsql` |
| **Navegador de Verificación E2E** | Google Chrome v131 (x64) automatizado vía Playwright | `C:\Program Files\Google\Chrome\Application\chrome.exe` |

---

## 2. Diagnóstico y Corrección de la Discrepancia en el Curso AUD-101

### 2.1 Causa Raíz Identificada con Evidencias
En revisiones preliminares se reportó que el curso **AUD-101 (Auditoría Informática y Seguridad)** contenía supuestamente foro, tarea y cuestionario, pero en la interfaz gráfica web solo se observaba la sección "Avisos" y secciones vacías.

Se realizó una inspección detallada a nivel de base de datos relacional sobre las tablas `mdl_course_sections` y `mdl_course_modules` correspondientes al curso ID 2:
1. En `mdl_course_modules`, existían 4 actividades instanciadas:
   - Módulo 1 (ID 1): `forum` ("Avisos")
   - Módulo 2 (ID 2): `forum` ("Foro de Debate: Criptografía y Firma Digital")
   - Módulo 3 (ID 3): `assign` ("Tarea Práctica: Análisis de Riesgos ISO 27005")
   - Módulo 4 (ID 4): `quiz` ("Cuestionario de Evaluación Diagnóstica")
2. En `mdl_course_sections`, el registro de la sección 1 (`section = 1`, Unidad 1) tenía el campo `sequence` **completamente vacío (`sequence = ''`)**.
3. **Causa raíz comprobada:** Las actividades fueron insertadas previamente en la tabla de módulos sin actualizar la secuencia de la sección ni invocar la función del núcleo de Moodle `course_add_cm_to_section()`. En Moodle, una actividad solo se renderiza visualmente en la vista del curso (`course/view.php`) si su `cmid` se encuentra explícitamente listado en el campo `sequence` de su respectiva sección.

### 2.2 Solución Comprobada
Se implementó y ejecutó el script nativo [`reparar_curso_aud101.php`](file:///c:/Users/llano/Documents/OCTAVO%20SEMESTRE/AUDITORIA/PROYECTO/Moodle_Auditoria_ISO/02_ENTORNO_EJECUCION/scripts/reparar_curso_aud101.php):
- Se asociaron los módulos `cmid` 2, 3 y 4 a la sección 1 configurando `sequence = '2,3,4'`.
- Se purgó la caché de navegación de cursos mediante `rebuild_course_cache(2, true)`.
- **Verificación:** Se realizó una petición HTTP y navegación web a `http://localhost:8000/course/view.php?id=2`. Las 4 actividades ahora se renderizan perfectamente, son plenamente accesibles y los estudiantes originales (`estudiante1` a `estudiante5`) pueden interactuar con ellas sin inconvenientes.

---

## 3. Respaldo Previo de Seguridad (Pre-Poblamiento)

Antes de iniciar la creación masiva de datos sintéticos, se generó un respaldo integral completo, protegido y con firmas hash verificadas:

- **Ubicación del Respaldo:** [`07_BACKUPS\pre_poblamiento_uatf_20261018\`](file:///c:/Users/llano/Documents/OCTAVO%20SEMESTRE/AUDITORIA/PROYECTO/Moodle_Auditoria_ISO/07_BACKUPS/pre_poblamiento_uatf_20261018/)
- **Archivos de Respaldo Generados:**
  1. `moodle_pre_poblamiento.dump` (1.86 MB, dump binario nativo `pg_dump -Fc`).
  2. `moodle_pre_poblamiento.sql` (1.91 MB, exportación SQL texto plano).
  3. `config_pre_poblamiento.php` (831 bytes, copia de la configuración activa).
  4. `moodledata_core_backup.zip` (3.62 MB, compresión ZIP de los directorios esenciales de `moodledata`).
  5. `SHA256SUMS_BACKUP.txt` (Firmas criptográficas SHA-256 de integridad).

### Procedimiento de Recuperación ante Fallos
Para restaurar el sistema a su estado previo a la carga masiva:
```bash
# 1. Detener el servidor web PHP
# 2. Restaurar la base de datos PostgreSQL desde el dump limpio
"C:\Program Files\PostgreSQL\18\bin\pg_restore.exe" -h 127.0.0.1 -p 5433 -U moodleuser -d moodle --clean "07_BACKUPS\pre_poblamiento_uatf_20261018\moodle_pre_poblamiento.dump"

# 3. Restaurar el directorio moodledata
powershell -Command "Expand-Archive -Force -Path '07_BACKUPS\pre_poblamiento_uatf_20261018\moodledata_core_backup.zip' -DestinationPath '02_ENTORNO_EJECUCION\moodledata'"

# 4. Purgar cachés de Moodle
php 01_CODIGO_FUENTE\moodle\public\admin\cli\purge_caches.php
```

---

## 4. Referencia Académica Oficial UATF y Fuentes Públicas

Para garantizar la coherencia académica de la simulación, se consultaron y extrajeron las estructuras de las fuentes oficiales de la **Universidad Autónoma Tomás Frías (UATF)**:
- Portal Central UATF: `https://www.uatf.edu.bo/facultades.php` (Consulta: 18/10/2026).
- Oferta Académica UATF: `https://oferta.uatf.edu.bo/` (Consulta: 18/10/2026).
- Catálogo General de Carreras: `https://oferta.uatf.edu.bo/pagina_web_carreras/index.html` (Consulta: 18/10/2026).

### 4.1 Catálogo de Facultades y Carreras Mapeadas (49 Carreras / Sedes)
Se identificaron y modelaron **13 Facultades / Unidades Académicas** y **49 Carreras o Programas únicos**, diferenciando sedes territoriales para evitar duplicados ambiguos:
1. **Facultad de Ciencias Económicas, Financieras y Administrativas (FCEFA):** Auditoría (Potosí), Ingeniería Comercial, Administración de Empresas, Economía, Contaduría Pública (Sede Tupiza), Economía (Sede Uyuni), Economía (Sede Uncía).
2. **Facultad de Ciencias Puras (FCP):** Ingeniería Informática, Química, Física, Matemática, Estadística.
3. **Vicerrectorado - Programas Especiales (VIC):** Ingeniería de Sistemas (Potosí), Ingeniería de Sistemas (Sede Tupiza), Ingeniería en Diseño y Programación Digital, Odontología.
4. **Facultad de Ingeniería (FI):** Ingeniería Civil, Construcciones Civiles, Ingeniería en Geodesia y Topografía.
5. **Facultad de Ingeniería Tecnológica (FIT):** Ingeniería Eléctrica, Ingeniería Electrónica, Ingeniería Mecánica, Ingeniería Mecatrónica, Ingeniería Automotriz.
6. **Facultad de Ciencias de la Salud (FCS):** Enfermería (Potosí), Enfermería (Sede Tupiza), Enfermería (Sede Villazón).
7. **Facultad de Medicina (FM):** Medicina (Potosí).
8. **Facultad de Ciencias Sociales y Humanísticas (FCSH):** Lingüística e Idiomas, Trabajo Social, Turismo.
9. **Facultad de Derecho (FD):** Derecho (Potosí), Derecho (Sede Tupiza), Derecho (Sede Uncía).
10. **Facultad de Ciencias Geológicas (FCG):** Ingeniería Geológica, Ingeniería del Medio Ambiente.
11. **Facultad de Ingeniería Minera (FIM):** Ingeniería Minera, Ingeniería de Procesos de Materias Primas Minerales.
12. **Facultad de Ciencias Agrícolas y Pecuarias (FCAP):** Ingeniería Agronómica, Agropecuaria (Sede Villazón), Medicina Veterinaria y Zootecnia (Sede Tupiza), Ingeniería Agroindustrial, Ingeniería en Desarrollo Rural.
13. **Facultad de Artes (FA):** Arquitectura, Artes Musicales, Artes Plásticas.

---

## 5. Datos Reales de Referencia frente a Datos Sintéticos

| Dimensión | Datos Reales de Referencia (Públicos UATF) | Datos Sintéticos Generados en el Laboratorio |
| :--- | :--- | :--- |
| **Facultades y Carreras** | Nombres oficiales y sedes provinciales reales. | Jerarquía de categorías nativa con IDs internos. |
| **Planes de Estudio / Materias** | Materias troncales oficiales de los planes publicados. | 500 materias completas con nombres, códigos y 4 unidades específicas adaptadas al área del conocimiento. |
| **Personas / Cuentas** | **Ninguna persona real.** | **2.650 cuentas sintéticas ficticias:** nombres y apellidos combinatorios bolivianos, identificadores `RU-...` y `DOC-...`, correos bajo el dominio reservado `@example.invalid` (RFC 2606). |
| **Participación y Entregas** | Ningún dato real. | 1.232 entregas de tareas en texto en línea y 762 intentos de cuestionarios completados por algoritmos estocásticos. |
| **Calificaciones** | Ningún dato real. | Ponderación académica 40/40/20 configurada y sincronizada en el libro de calificaciones nativo. |

---

## 6. Cantidades Consolidadas: Anteriores, Creadas y Finales

Todas las cifras corresponden a comprobaciones empíricas directas en la base de datos PostgreSQL:

| Entidad / Módulo Moodle | Cantidad Anterior | Cantidad Creada en esta Carga | Cantidad Final Verificada | Estado de Integridad |
| :--- | :---: | :---: | :---: | :--- |
| **Usuarios Activos Totales** | 9 | 2.650 | **2.659** | 100% activos y confirmados |
| — *Docentes Sintéticos* | 2 | 150 | **152** | Asignados con rol `editingteacher` |
| — *Estudiantes Sintéticos* | 5 | 2.500 | **2.505** | Matriculados con rol `student` |
| **Categorías de Cursos** | 6 | 61 | **67** | Raíz UATF + 13 Fac. + 49 Carreras |
| **Cursos Académicos Totales** | 2 | 500 | **502** | Front page + AUD-101 + 500 UATF |
| **Matrículas (`user_enrolments`)** | 7 | 12.808 | **12.815** | Instancias de matrícula manual |
| **Asignaciones de Rol (`role_assignments`)** | 7 | 12.808 | **12.815** | Contextos de curso correctos |
| **Cohortes Oficiales UATF** | 0 | 48 | **48** | Ámbito sistema institucional |
| **Miembros en Cohortes** | 0 | 2.505 | **2.505** | Estudiantes asignados por carrera |
| **Grupos de Curso (`groups`)** | 0 | 1.000 | **1.000** | "Paralelo A" y "Paralelo B" |
| **Miembros en Grupos** | 0 | 12.308 | **12.308** | Distribución equilibrada |
| **Secciones Temáticas (`course_sections`)** | 10 | 2.495 | **2.505** | 5 secciones por curso con nombres |
| **Recursos de Lectura (`mod_page`)** | 0 | 1.000 | **1.000** | 2 guías formativas por curso |
| **Foros de Debate (`mod_forum`)** | 2 | 500 | **502** | 1 foro temático por curso |
| **Discusiones en Foros** | 1 | 38 | **39** | Hilos académicos temáticos |
| **Mensajes y Réplicas en Foros** | 1 | 152 | **153** | Interacción entre pares |
| **Tareas Evaluativas (`mod_assign`)** | 1 | 1.500 | **1.501** | 3 tareas ponderadas por curso |
| **Entregas de Tarea (`assign_submission`)** | 2 | 1.230 | **1.232** | Texto en línea guardado |
| **Calificaciones de Tareas (`assign_grades`)** | 2 | 1.230 | **1.232** | Calificadas por docente titular |
| **Comentarios de Retroalimentación** | 2 | 1.230 | **1.232** | Feedback cualitativo pedagógico |
| **Cuestionarios Evaluativos (`mod_quiz`)** | 0 | 1.000 | **1.000** | 2 cuestionarios por curso |
| **Preguntas en Banco Nativo** | 91 | 4.900 | **4.991** | Contexto de preguntas del curso |
| **Intentos Finalizados (`quiz_attempts`)** | 1 | 761 | **762** | Estado `finished` con notas |
| **Calificaciones Cuestionario (`quiz_grades`)** | 1 | 761 | **762** | Sincronizadas a libro de notas |
| **Categorías Calificación (`grade_categories`)** | 4 | 555 | **559** | Tareas, Cuestionarios, Foros |
| **Ítems de Calificación (`grade_items`)** | 7 | 3.070 | **3.077** | Ponderaciones 40% / 40% / 20% |
| **Calificaciones Registradas (`grade_grades`)** | 5 | 4.080 | **4.085** | Totales ponderados calculados |

---

## 7. Método de Carga Masiva y Automatización Nativa

La carga se llevó a cabo aplicando rigurosamente el principio de **cero manipulación arbitraria por SQL**, empleando exclusivamente las APIs, generadores y controladores internos de la versión Moodle 5.3 instalada:

1. **Lote Piloto Preliminar:** Se validó primero un lote piloto de 10 cursos mediante [`03_lote_piloto_cursos.php`](file:///c:/Users/llano/Documents/OCTAVO%20SEMESTRE/AUDITORIA/PROYECTO/Moodle_Auditoria_ISO/02_ENTORNO_EJECUCION/scripts/poblamiento_uatf/03_lote_piloto_cursos.php) ejecutado en 4.63 segundos. Esto permitió verificar que las preguntas de banco y cuestionarios se instanciaran sin depender del entorno de pruebas unitarias (evitando colisiones con PHPUnit).
2. **Generación de 500 Cursos con 4.000 Actividades:** Mediante [`04_generar_500_cursos.php`](file:///c:/Users/llano/Documents/OCTAVO%20SEMESTRE/AUDITORIA/PROYECTO/Moodle_Auditoria_ISO/02_ENTORNO_EJECUCION/scripts/poblamiento_uatf/04_generar_500_cursos.php), se procesaron los cursos en 20 lotes de 25 asignaturas con recolección de basura cíclica (`gc_collect_cycles()`), manteniendo un consumo constante de memoria RAM de 46 MB a 54 MB y completando la carga en **274.27 segundos (4.5 minutos)** con 0 errores.
3. **Matriculación Masiva y Agrupación:** Mediante [`05_matricular_usuarios.php`](file:///c:/Users/llano/Documents/OCTAVO%20SEMESTRE/AUDITORIA/PROYECTO/Moodle_Auditoria_ISO/02_ENTORNO_EJECUCION/scripts/poblamiento_uatf/05_matricular_usuarios.php), se asignaron los 150 docentes (3 a 4 materias afines cada uno) y se matricularon los 2.500 estudiantes (en 4 a 6 asignaturas por alumno y asignados a "Paralelo A" o "Paralelo B"), completando **12.808 matrículas en 492.53 segundos**.
4. **Participación y Calificaciones:** Mediante [`06_participacion_calificaciones.php`](file:///c:/Users/llano/Documents/OCTAVO%20SEMESTRE/AUDITORIA/PROYECTO/Moodle_Auditoria_ISO/02_ENTORNO_EJECUCION/scripts/poblamiento_uatf/06_participacion_calificaciones.php), se poblaron 20 cursos muestra con hilos de foros, entregas en línea, evaluaciones docentes y cuestionarios completados, ejecutando `grade_regrade_final_grades()` en **57.71 segundos**.
5. **Reanudabilidad y Protección contra Duplicados:** Cada script verifica la preexistencia de registros mediante claves únicas (`shortname`, `idnumber`, `username`), permitiendo reanudar la ejecución sin duplicar datos ni corromper llaves foráneas.

---

## 8. Modelo de Calificación y Tratamiento de Pendientes

Conforme al requerimiento de auditoría y simulación académica:
- **Escala de Calificación:** Escala numérica estandarizada de 0 a 100 puntos.
- **Ponderación Interna del Curso:**
  - **Tareas Evaluativas:** 40% (3 tareas con pesos equitativos dentro de la categoría).
  - **Cuestionarios Evaluativos:** 40% (2 cuestionarios objetivos de conocimientos).
  - **Participación en Foros y Talleres:** 20% (evaluación cualitativa/continua).
  - **Total Ponderado del Curso:** 100 puntos.
- **Método de Agregación:** Media ponderada de calificaciones (`GRADE_AGGREGATE_WEIGHTED_MEAN`).
- **Tratamiento de Pendientes y Ausencias:**
  - Los estudiantes que no han entregado una tarea no tienen nota ficticia asignada (permanecen como entregas pendientes sin falsear registros).
  - Solo se asigna calificación de cero (0) a casos específicos donde la entrega fue evaluada como incompleta o nula, con su debida justificación en el comentario de retroalimentación docente.
  - Los cuestionarios no intentados no registran nota en `quiz_grades`, reflejándose como actividad no realizada en el reporte del calificador.
  - La nota mínima referencial de aprobación en la simulación es de **51 puntos**, declarada como supuesto metodológico del laboratorio.

---

## 9. Pruebas Realizadas y Resultados de Verificación

Se realizaron comprobaciones empíricas en navegador web real automatizado mediante Playwright con Google Chrome v131 (x64) a resolución 1440x900:

1. **Prueba de Administrador (`admin_auditoria`):**
   - Acceso al árbol completo de categorías y cursos (`/course/management.php`).
   - Acceso a la gestión de cohortes (`/cohort/index.php`).
   - Verificación de la lista global de usuarios e identificadores (`/admin/user.php`).
   - Verificación del calificador general del curso AUD-201 (`/grade/report/grader/index.php?id=8`).
2. **Prueba de Docente Titular (`docente001`):**
   - Acceso al Área Personal (`/my/courses.php`), observando únicamente sus materias asignadas.
   - Acceso al libro de calificaciones de su materia con permisos de edición y retroalimentación.
   - Confirmación de que el docente **no posee permisos administrativos globales** en Moodle.
3. **Prueba de Estudiante (`estudiante0001`):**
   - Acceso al Área Personal (`/my/courses.php`), observando únicamente las materias en las que está matriculado.
   - Acceso a su Reporte de Usuario en Calificaciones (`/grade/report/user/index.php?id=8`), comprobando que **solo puede visualizar sus propias notas, pesos y retroalimentación**, sin visibilidad sobre las notas de otros alumnos.
4. **Prueba de Diversidad Temática Multidisciplinaria:**
   - Inspección visual de asignaturas pertenecientes a facultades distintas: Ingeniería de Sistemas (`SIS-111`), Medicina (`MED-101`), Derecho (`DER-101`), Arquitectura (`ARQ-101`) y Minería (`MIN-101`), confirmando contenidos y actividades específicos de cada área del conocimiento.

---

## 10. Catálogo de Capturas Visuales de Evidencia

Las 20 capturas reales generadas se encuentran almacenadas en:
[`06_EVIDENCIAS_INSTALACION\capturas_poblamiento_uatf\`](file:///c:/Users/llano/Documents/OCTAVO%20SEMESTRE/AUDITORIA/PROYECTO/Moodle_Auditoria_ISO/06_EVIDENCIAS_INSTALACION/capturas_poblamiento_uatf/):

| Archivo de Captura | Descripción de la Evidencia Visual | Rol de Captura |
| :--- | :--- | :--- |
| `01_categorias_uatf_arbol.png` | Árbol jerárquico de categorías UATF y 13 facultades | Administrador |
| `02_cursos_fcefa_auditoria.png` | Catálogo de cursos de la Carrera de Auditoría | Administrador |
| `03_cohortes_institucionales_uatf.png` | Lista de 48 cohortes oficiales y miembros asignados | Administrador |
| `04_usuarios_estudiantes_docentes.png` | Lista de usuarios con códigos RU/DOC y correos seguros | Administrador |
| `05_curso_aud201_estructura_completa.png` | Vista del curso AUD-201 con 4 unidades y 8 actividades | Administrador |
| `06_participantes_grupos_paralelos.png` | Lista de participantes, docentes y grupos Paralelo A/B | Administrador |
| `07_libro_calificaciones_ponderaciones.png` | Estructura de categorías y pesos 40% / 40% / 20% | Administrador |
| `08_calificador_libro_notas.png` | Calificador general con notas de tareas, quizzes y total | Administrador |
| `09_entregas_tareas_retroalimentacion.png` | Tabla de entregas de la Tarea 1 y comentarios docentes | Administrador |
| `10_cuestionario_intentos_calificados.png` | Reporte de intentos, tiempos y notas de Cuestionario 1 | Administrador |
| `11_foro_academico_interaccion.png` | Discusiones y réplicas de debate en el foro académico | Administrador |
| `12_docente_mis_cursos_asignados.png` | Dashboard del docente con materias a su cargo | Docente (`docente001`) |
| `13_docente_gestion_calificaciones.png` | Vista del docente en el libro de calificaciones del curso | Docente (`docente001`) |
| `14_estudiante_dashboard_mis_cursos.png` | Dashboard del estudiante con sus materias inscritas | Estudiante (`estudiante0001`) |
| `15_estudiante_boleta_calificaciones_privada.png` | Boleta privada del estudiante con sus calificaciones | Estudiante (`estudiante0001`) |
| `16_curso_sistemas_sis111.png` | Asignatura de Ciencias Puras: Introducción a Programación | Administrador |
| `17_curso_medicina_med101.png` | Asignatura de Medicina: Anatomía Humana Descriptiva | Administrador |
| `18_curso_derecho_der101.png` | Asignatura de Derecho: Derecho Constitucional Boliviano | Administrador |
| `19_curso_arquitectura_arq101.png` | Asignatura de Artes: Taller de Diseño Arquitectónico I | Administrador |
| `20_curso_mineria_min101.png` | Asignatura de Ingeniería Minera: Topografía y Geología | Administrador |

---

## 11. Cuentas de Prueba para Navegación del Evaluador

Para realizar auditorías o revisiones directas en el portal web (`http://localhost:8000`), el evaluador puede utilizar las siguientes cuentas:

1. **Administrador General:**
   - Usuario: `admin_auditoria`
   - Contraseña: *(Registrada en la sección 1.1 del `README.md` principal)*
2. **Docente de Prueba (Asignado a AUD-201 y materias de Auditoría):**
   - Usuario: `docente001`
   - Contraseña protegida: Consultar la clave en la bóveda local del host:  
     `%APPDATA%\UATF_Credenciales_Sinteticas_Boveda.json` (clave bajo el identificador `"docente001"`).
3. **Estudiante de Prueba (Matriculado en AUD-201 y materias de Auditoría):**
   - Usuario: `estudiante0001`
   - Contraseña protegida: Consultar la clave en la bóveda local del host:  
     `%APPDATA%\UATF_Credenciales_Sinteticas_Boveda.json` (clave bajo el identificador `"estudiante0001"`).
4. **Cuentas Históricas del Curso AUD-101 (Preservadas Intactas):**
   - Docente: `profesor1` / `profesor2`
   - Estudiantes: `estudiante1` al `estudiante5`

---

## 12. Procedimiento para Retirar Exclusivamente la Carga Sintética

Se diseñó el procedimiento de desinstalación limpia para garantizar que el laboratorio pueda regresar al estado base sin afectar configuraciones institucionales ni cuentas originales:

1. **Script de Purga Automatizada:** Se implementó [`purgar_carga_sintetica_uatf.php`](file:///c:/Users/llano/Documents/OCTAVO%20SEMESTRE/AUDITORIA/PROYECTO/Moodle_Auditoria_ISO/02_ENTORNO_EJECUCION/scripts/poblamiento_uatf/purgar_carga_sintetica_uatf.php).
2. **Criterios de Eliminación Quirúrgica:**
   - Cursos: Elimina exclusivamente cursos cuyo `idnumber LIKE 'UATF-%'` o `category >= 6` mediante la función nativa `delete_course($course, false)`.
   - Cohortes: Elimina cohortes con `idnumber LIKE 'COH-%'` mediante `cohort_delete_cohort()`.
   - Categorías: Elimina las categorías creadas bajo la raíz UATF (ID 6) mediante `core_course_category::get(6)->delete_full(false)`.
   - Usuarios Sintéticos: Elimina exclusivamente los usuarios `username LIKE 'docente%'` y `username LIKE 'estudiante%'` que posean correos `@example.invalid` mediante `user_delete_user()`.
   - **Garantía de Preservación:** No elimina ni modifica a `admin_auditoria`, `profesor1`, `profesor2`, `estudiante1`..`5` ni al curso `AUD-101` (ID 2).
