# DATOS TÉCNICOS PARA ACTUALIZAR EL ANÁLISIS DE RIESGOS (ISO/IEC 27005:2022)
## Proyecto Moodle LMS 5.3dev — Laboratorio de Auditoría Informática
**Archivo:** `DATOS_PARA_ACTUALIZAR_ANALISIS_RIESGOS.md`  
**Fecha de Observación Empírica:** 18 de octubre de 2026  
**Entorno Observado:** `http://localhost:8000` | PostgreSQL 18.3 (`127.0.0.1:5433`)

---

## 1. Nuevos Volúmenes y Tipos de Información Identificados

Tras la ejecución del escenario universitario a gran escala (referencia UATF), la plataforma pasó de un estado embrionario de prueba a una volumetría operativa representativa. Los siguientes volúmenes fueron cuantificados directamente en la base de datos relacional y el almacenamiento físico:

| Tipo de Activo / Información | Estado Previo | Estado Posterior Observado | Delta Cuantitativo | Naturaleza de la Información |
| :--- | :---: | :---: | :---: | :--- |
| **Cuentas de Usuario Activas** | 9 | 2.659 | +2.650 | Credenciales con hash `bcrypt`, identificadores institucionales (`RU-...`, `DOC-...`), nombres y correos de prueba. |
| **Cursos Académicos Activos** | 2 | 502 | +500 | Estructuras curriculares, descripciones, metadatos de inicio/fin y parametrizaciones de visibilidad. |
| **Actividades de Aprendizaje** | 4 | 4.004 | +4.000 | 1.000 páginas de contenido, 502 foros, 1.501 tareas y 1.000 cuestionarios evaluativos. |
| **Banco de Preguntas Nativo** | 91 | 4.991 | +4.900 | Preguntas de evaluación objetiva asociadas a contextos de cursos individuales (`question_categories`). |
| **Registros de Matrícula (`user_enrolments`)** | 7 | 12.815 | +12.808 | Relaciones vinculantes estudiante-curso y docente-curso con marcas temporales de inicio de vigencia. |
| **Asignaciones de Rol (`role_assignments`)** | 7 | 12.815 | +12.808 | Privilegios de contexto: 152 asignaciones de docente con edición (`editingteacher`) y 12.505 de estudiante (`student`). |
| **Cohortes Institucionales** | 0 | 48 | +48 | Agrupaciones sistémicas para 2.505 miembros por carrera/sede. |
| **Grupos de Curso (`groups`)** | 0 | 1.000 | +1.000 | 2 paralelos por curso ("Paralelo A" y "Paralelo B") con 12.308 membresías. |
| **Entregas de Tareas (`assign_submission`)** | 2 | 1.232 | +1.230 | Archivos/textos producidos por estudiantes en formato HTML nativo (`assignsubmission_onlinetext`). |
| **Calificaciones y Feedback (`assign_grades`)** | 2 | 1.232 | +1.230 | Notas numéricas (escala 0-100) y retroalimentación cualitativa docente (`assignfeedback_comments`). |
| **Intentos de Cuestionario (`quiz_attempts`)** | 1 | 762 | +761 | Registros de sesión de examen con timestamps de inicio, finalización, respuestas y puntajes obtenidos. |
| **Libro de Calificaciones (`grade_grades`)** | 5 | 4.085 | +4.080 | Registros consolidados de notas y cálculos ponderados (40% tareas, 40% cuestionarios, 20% participación). |

---

## 2. Procesos y Roles Realmente Utilizados

Durante las pruebas de navegación automatizadas y la carga masiva, se observaron los siguientes flujos de interacción efectiva y asignación de privilegios:

### 2.1 Rol Administrador (`admin_auditoria` / Rol Contexto Sistema)
- **Capacidades observadas:** Acceso irrestricto a `/admin/`, creación y reestructuración de categorías, visualización completa del árbol de cursos, administración de cohortes a nivel sistema, inspección de tablas de calificaciones y logs de eventos.
- **Observación técnica:** La cuenta administrativa conserva acceso total sin restricciones departamentales.

### 2.2 Rol Docente con Permiso de Edición (`editingteacher` / Rol Contexto Curso)
- **Cuentas observadas:** 150 docentes sintéticos (`docente001` a `docente150`).
- **Capacidades observadas:** Cada docente visualiza en su Área Personal (`/my/courses.php`) exclusivamente los cursos en los que fue matriculado (3 a 4 materias). En dichos cursos, puede consultar la lista de participantes, calificar entregas de tareas, registrar comentarios de retroalimentación cualitativa y consultar el calificador general (`/grade/report/grader/`).
- **Límites observados:** No poseen acceso a la administración global del sitio (`/admin/`), no pueden alterar configuraciones del servidor ni modificar asignaturas de otras facultades o carreras.

### 2.3 Rol Estudiante (`student` / Rol Contexto Curso)
- **Cuentas observadas:** 2.500 estudiantes sintéticos (`estudiante0001` a `estudiante2500`).
- **Capacidades observadas:** Acceso a su Área Personal (`/my/courses.php`) mostrando sus 4 a 6 materias asignadas. Capacidad para participar en foros (iniciar debates y replicar), enviar textos en línea para tareas y completar intentos de cuestionarios.
- **Límites observados:** En el libro de calificaciones (`/grade/report/user/index.php`), el estudiante únicamente puede ver su propio desglose de notas, ponderaciones y total; no tiene acceso al reporte del calificador general (`grader report`) ni a las calificaciones de sus compañeros.

---

## 3. Evidencias de Permisos y Calificaciones

1. **Separación de Privilegios Verificada:**
   - En las pruebas de navegación E2E con Google Chrome automatizado, se constató que la sesión de `estudiante0001` deniega el acceso a rutas de gestión docente (`/grade/report/grader/`) y que la sesión de `docente001` solo lista los cursos de su especialidad asignada.
2. **Cálculo Ponderado en el Libro de Calificaciones:**
   - Se verificó que el cálculo del total del curso opera mediante agregación nativa ponderada (`GRADE_AGGREGATE_WEIGHTED_MEAN`).
   - Las categorías hijas `Tareas (40%)`, `Cuestionarios (40%)` y `Participación en Foros (20%)` consolidan sus notas y se reflejan en la columna "Total del curso" sobre 100 puntos sin requerir anulaciones manuales forzadas.
3. **Persistencia de Retroalimentación:**
   - Las calificaciones docentes incluyen comentarios cualitativos en la tabla `mdl_assignfeedback_comments`, visibles para el estudiante al consultar el estado de su entrega.

---

## 4. Métricas de Almacenamiento Físico y Base de Datos

Las siguientes mediciones fueron registradas empíricamente el 18 de octubre de 2026 tras finalizar la carga:

| Recurso / Componente | Medición Pre-Poblamiento | Medición Post-Poblamiento | Crecimiento Registrado |
| :--- | :---: | :---: | :---: |
| **Base de Datos PostgreSQL (`moodle`)** | ~25 MB | **128 MB** (133.838.527 bytes) | +103 MB (~512%) |
| **Directorio de Datos del Clúster (`pgsql_data`)** | ~220 MB | **327.59 MB** (343.499.756 bytes) | +107.59 MB |
| **Directorio de Datos de Moodle (`moodledata`)** | 3.62 MB | **31.05 MB** (32.562.530 bytes) | +27.43 MB |
| **Archivo de Respaldo Previo (Dump + Zip)** | - | **7.06 MB** (7.398.817 bytes) | Respaldo íntegro preservado |

---

## 5. Duración de la Carga e Incidencias Observadas

### 5.1 Tiempos de Ejecución Registrados
1. **Generación de 2.650 Usuarios:** 18.2 segundos.
2. **Creación de 61 Categorías Jerárquicas:** 2.1 segundos.
3. **Lote Piloto (10 cursos, 80 actividades, 100 preguntas):** 4.63 segundos.
4. **Generación Masiva de 490 Cursos (3.920 actividades, 4.900 preguntas):** 274.27 segundos (4.57 minutos).
5. **Asignación Docente y Matriculación de 2.500 Estudiantes:** 492.53 segundos (8.2 minutos).
6. **Participación y Calificaciones en 20 Cursos Muestra:** 57.71 segundos.
7. **Captura Visual Automatizada E2E (20 pantallas en Chrome):** 62.4 segundos.
- **Tiempo Total de Carga y Verificación:** **~14.5 minutos**.

### 5.2 Incidencias Técnicas Registradas y Solución Aplicada
1. **Librería de Generación de Preguntas:** La inclusión inicial de `question/tests/generator/lib.php` requería la suite PHPUnit. Se reemplazó por la llamada nativa a `question_bank::get_qtype('truefalse')->save_question()` y `quiz_add_quiz_question()`, resolviendo la dependencia sin alterar el núcleo.
2. **Aviso de Dirección No Reply en Matrículas:** Moodle emitió advertencias `Invalid address: (From): noreply@localhost` al matricular debido a que el servidor de correo local no está configurado. La excepción fue capturada y descartada por Moodle, garantizando que **no se enviaran correos a direcciones reales** y completando las 12.815 matrículas exitosamente.
3. **Restricción Not-Null en `mdl_forum_posts.mailnow`:** Al insertar debates en foros mediante `forum_add_discussion()`, el campo `mailnow` requirió asignación explícita `0` para cumplir con el esquema estricto de PostgreSQL 18.

---

## 6. Cambios Relevantes para el Inventario de Activos y Análisis de Riesgos

La incorporación de este escenario universitario modifica sustancialmente el perfil de activos del sistema para los evaluadores de riesgos ISO 27005:

1. **Multiplicación de la Superficie de Datos:**
   - La base de datos pasó de 9 cuentas y 2 cursos a 2.659 usuarios, 502 cursos y 4.004 actividades interactivas. El inventario de activos de software y datos debe registrar este nuevo orden de magnitud.
2. **Complejidad en Políticas de Control de Acceso (AC):**
   - Con 12.815 asignaciones de rol y 1.000 grupos de curso, los controles de aislamiento horizontal (estudiante a estudiante) y vertical (docente a funciones de administración) cobran relevancia práctica auditable.
3. **Tráfico y Gestión de Concurrencia:**
   - El volumen de transacciones de evaluación (4.085 calificaciones registradas) evidencia la necesidad de dimensionar adecuadamente parámetros de conexión PostgreSQL (`max_connections`) y memoria compartida (`shared_buffers`) en caso de migraciones a entornos de producción.
4. **Plan de Continuidad y Respaldos:**
   - Con una base de datos de 128 MB y un clúster físico de 327 MB, los tiempos de generación de respaldos lógicos (`pg_dump`) aumentan de milisegundos a ~8-12 segundos, lo que debe considerarse al planificar ventanas de mantenimiento y políticas de RPO/RTO.
