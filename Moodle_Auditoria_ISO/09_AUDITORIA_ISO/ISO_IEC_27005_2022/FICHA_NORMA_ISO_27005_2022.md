# FICHA TÉCNICA Y REFERENCIA OFICIAL: ISO/IEC 27005:2022

## 1. Identificación de la Norma
- **Código:** ISO/IEC 27005:2022
- **Título Oficial:** Information security, cybersecurity and privacy protection — Guidance on managing information security risks
- **Organización Emisora:** ISO/IEC JTC 1/SC 27
- **Estado:** Estándar internacional vigente
- **Enlace Oficial:** https://www.iso.org/standard/75827.html

## 2. Alcance y Aplicación
Esta norma proporciona directrices para la gestión del riesgo de seguridad de la información. Apoya los conceptos generales especificados en ISO/IEC 27001 y está diseñada para ayudar a la implementación satisfactoria de la seguridad de la información basada en un enfoque de gestión de riesgos.

## 3. Aplicación a la Plataforma Educativa Moodle 5.3
- **Identificación de Activos Críticos:**
  - Código fuente de Moodle (Integridad).
  - Base de datos PostgreSQL (Confidencialidad, Integridad y Disponibilidad de calificaciones y registros académicos).
  - Directorio `moodledata` (Almacenamiento de archivos de usuarios, tareas, exámenes y evidencias).
  - Registros de auditoría (Trazabilidad y no repudio).
- **Identificación de Amenazas y Vulnerabilidades:**
  - Acceso indebido a cuentas administrativas o de profesorado.
  - Exposición indebida del directorio `moodledata` a través del servidor web.
  - Ataques por inyección SQL, Cross-Site Scripting (XSS) o Cross-Site Request Forgery (CSRF).
  - Falla en la ejecución del cron periódico afectando notificaciones y tareas de mantenimiento.
  - Pérdida de datos por falta de copias de seguridad consistentes y verificadas.

## 4. Clasificación Legal y Derechos de Autor
> **AVISO DE CUMPLIMIENTO LEGAL:** Documento de referencia metodológica sin duplicación de textos normativos protegidos por derechos de autor de ISO/IEC.
