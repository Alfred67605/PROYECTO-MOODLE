# Acerca de Moodle - Información General y Arquitectura

> **METADATOS DE AUDITORÍA:**
> - **Fuente oficial:** MoodleDocs / MoodleDev HQ
> - **URL Oficial Principal:** https://docs.moodle.org/503/en/About_Moodle
> - **URL Oficial Español:** https://docs.moodle.org/all/es/Acerca_de_Moodle
> - **Fecha de Consulta:** 12 de Octubre de 2026
> - **Versión Moodle:** 5.3 (v5.3.0)
> - **Categoría:** 01_Informacion_General
> - **Nota Técnica:** Se conserva la versión inglesa vigente por prevalencia técnica complementada con referencias en español.

---

## Resumen Ejecutivo
Moodle (Modular Object-Oriented Dynamic Learning Environment) es una plataforma de aprendizaje diseñada para proporcionar a educadores, administradores y estudiantes un sistema integrado único, robusto y seguro para crear ambientes de aprendizaje personalizados. Con más de 20 años de desarrollo respaldado por Moodle HQ y una comunidad global, Moodle 5.3 representa la cúspide de modernización técnica, accesibilidad y gobernanza.

---

## Contenido Técnico Oficial
1. Visión General del Sistema
Moodle es un sistema de gestión del aprendizaje (LMS) de código abierto bajo licencia GNU General Public License v3.0+. Está diseñado bajo una arquitectura modular y orientada a eventos que facilita su extensión sin alterar el núcleo (core) del sistema.
2. Principios de Diseño

  Constructivismo Social: Diseñado para facilitar la colaboración, evaluación formativa y gestión del conocimiento compartido.
  Seguridad por Diseño (Security by Design): Cumplimiento estricto de estándares OWASP, sanitización de entradas, validación de capacidades y aislamiento de datos.
  Accesibilidad Universal: Certificación WCAG 2.1 nivel AA y compatibilidad con lectores de pantalla.
  Interoperabilidad: Cumplimiento de estándares LTI (Learning Tools Interoperability), SCORM y APIs REST abiertas.

3. Modelo Arquitectónico de Tres Capas

  Capa de Presentación: Sistema de renderizado Boost basado en Mustache templates, CSS compilado con Sass y componentes JavaScript nativos/ESM.
  Capa de Lógica de Negocio: Núcleo PHP 8.3+ con arquitectura de plugins, sistema de hooks desacoplados y tareas asíncronas ad-hoc/programadas.
  Capa de Persistencia: Capa de abstracción de base de datos XMLDB y Moodle Data Manipulation API (DMAPI) sobre PostgreSQL, MariaDB o MySQL, junto con almacenamiento de ficheros desacoplado (moodledata / File API).

---
*Archivo consolidado para el Expediente de Auditoría ISO Moodle 5.3*
