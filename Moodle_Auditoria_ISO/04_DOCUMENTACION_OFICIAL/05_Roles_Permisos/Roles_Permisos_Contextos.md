# Modelo de Control de Acceso Basado en Roles (RBAC) y Contextos

> **METADATOS DE AUDITORÍA:**
> - **Fuente oficial:** MoodleDocs / MoodleDev HQ
> - **URL Oficial Principal:** https://docs.moodle.org/503/en/Roles_and_permissions
> - **URL Oficial Español:** https://docs.moodle.org/all/es/Roles_y_permisos
> - **Fecha de Consulta:** 12 de Octubre de 2026
> - **Versión Moodle:** 5.3 (v5.3.0)
> - **Categoría:** 05_Roles_Permisos
> - **Nota Técnica:** Se conserva la versión inglesa vigente por prevalencia técnica complementada con referencias en español.

---

## Resumen Ejecutivo
Explicación del motor granular de permisos de Moodle, jerarquía de contextos y verificación de capacidades.

---

## Contenido Técnico Oficial
1. Jerarquía de Contextos
Los permisos se evalúan en función del contexto donde opera el usuario:

  Sistema: Contexto global raíz.
  Categoría de cursos: Aplica a todos los cursos dentro de la categoría.
  Curso: Aplica al espacio académico específico.
  Módulo / Actividad: Aplica a una tarea, foro o cuestionario individual.
  Bloque: Aplica a componentes laterales.
  Usuario: Perfil individual y archivos privados.

2. Roles Estándar de Moodle

  Administrador: Acceso irrestricto mediante bypass de capacidades (is_siteadmin()).
  Gestor (Manager): Administración delegada sin acceso al servidor.
  Profesor (Editing Teacher): Gestión completa del aula, actividades y calificaciones.
  Profesor sin permiso de edición: Calificación y tutoría sin modificación de estructura.
  Estudiante: Participación, entrega de tareas y visualización de notas personales.
  Invitado: Acceso de solo lectura sin registro en cursos abiertos.

---
*Archivo consolidado para el Expediente de Auditoría ISO Moodle 5.3*
