# Plan de Implementación: Poblamiento Masivo Moodle UATF

> **Contexto:** Simulación universitaria amplia y coherente basada en la Universidad Autónoma Tomás Frías (UATF) para el laboratorio de auditoría informática Moodle 5.3.  
> **Fecha:** 18 de octubre de 2026  
> **Objetivos:** 150 docentes ficticios, 2.500 estudiantes ficticios, 500 cursos con contenidos y actividades nativas completas, libro de calificaciones configurado, y evidencias verificadas.

---

## Tareas

- [x] **Tarea 1: Diagnóstico de Entorno, Reparación AUD-101 y Respaldo Previo**
  - [x] Verificar instalación servida en `localhost:8000` (PID 36032, `01_CODIGO_FUENTE\moodle\public`, PostgreSQL en puerto `5433`).
  - [x] Comprobar causa raíz de la discrepancia de AUD-101 (`course_sections.sequence` vacío por inserción cruda en `course_modules`).
  - [x] Reparar visibilidad en AUD-101 mediante API nativa (`reparar_curso_aud101.php`) y validar renderizado HTTP.
  - [x] Generar respaldo completo con SHA-256 en `07_BACKUPS\pre_poblamiento_uatf_20261018\`.

- [ ] **Tarea 2: Catálogo de Referencia Académica UATF y Mapeo de Categorías**
  - [ ] Consolidar catálogo de 12 Facultades + Vicerrectorado a partir de la fuente oficial `oferta.uatf.edu.bo`.
  - [ ] Diseñar taxonomía de categorías Moodle (`Facultad` -> `Carrera (Sede)` -> `Nivel Académico`).
  - [ ] Definir distribución de los 500 cursos respetando carreras anuales y semestrales.

- [ ] **Tarea 3: Generador de Docentes y Estudiantes Sintéticos con Bóveda Segura**
  - [ ] Generar 150 docentes (`docente001`..`docente150`) con nombres realistas, emails `@example.invalid`, códigos docentes.
  - [ ] Generar 2.500 estudiantes (`estudiante0001`..`estudiante2500`) con nombres realistas, emails `@example.invalid`, códigos de matrícula/RU, cohorte y carrera.
  - [ ] Guardar contraseñas en bóveda local protegida fuera del repositorio (`%APPDATA%\UATF_Credenciales_Sinteticas_Boveda.json`).
  - [ ] Ejecutar inserción mediante API nativa de Moodle (`user_create_user`).

- [ ] **Tarea 4: Lote Piloto de Cursos y Verificación de Estructura de Contenidos**
  - [ ] Crear script modular de generación de cursos con 4 secciones temáticas, 2 recursos, 1 foro, 3 tareas y 2 cuestionarios (5 preguntas c/u).
  - [ ] Ejecutar lote piloto de 10 cursos para verificar tiempos, integridad de secuencias y consumo de recursos.
  - [ ] Validar que las actividades aparezcan perfectamente visibles en la interfaz.

- [ ] **Tarea 5: Carga Masiva de los 500 Cursos Distribuidos por Facultades**
  - [ ] Ejecutar la carga por lotes de 50 o 100 cursos con progreso reanudable y control de errores.
  - [ ] Asociar cada curso a su categoría oficial de la UATF.

- [ ] **Tarea 6: Asignación Docente y Matriculación de Estudiantes**
  - [ ] Asignar los 150 docentes con rol `editingteacher` en sus materias correspondientes.
  - [ ] Matricular a los 2.500 estudiantes en 4 a 6 asignaturas compatibles con su carrera y nivel (sin duplicados).

- [ ] **Tarea 7: Participación Sintética, Calificaciones y Libro de Notas**
  - [ ] Configurar libro de calificaciones en una muestra representativa con ponderaciones (40% Tareas, 40% Cuestionarios, 20% Participación).
  - [ ] Generar entregas de tareas, notas con retroalimentación, publicaciones en foros e intentos de cuestionarios.

- [ ] **Tarea 8: Verificación Visual, Capturas y Documentación de Entrega**
  - [ ] Realizar pruebas de navegación con rol Administrador, Docente y Estudiante.
  - [ ] Capturar evidencias reales PNG.
  - [ ] Redactar `POBLAMIENTO_MOODLE_UATF.md`, `RESUMEN_POBLAMIENTO.csv`, `MANIFIESTO_CARGA` y `DATOS_PARA_ACTUALIZAR_ANALISIS_RIESGOS.md`.
