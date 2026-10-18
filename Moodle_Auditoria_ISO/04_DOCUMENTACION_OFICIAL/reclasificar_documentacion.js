const fs = require('fs');
const path = require('path');
const XLSX = require('xlsx');

const baseDir = __dirname;

const items = [
    {
        num: 1,
        doc: "Acerca de Moodle - Información General y Arquitectura",
        cat: "01_Informacion_General",
        nombreOriginal: "About Moodle / Acerca de Moodle",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/About_Moodle",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "01_Informacion_General/PDF_GENERADO_DESDE_MOODLEDOCS_Acerca_de_Moodle.pdf",
        archivoHtml: "01_Informacion_General/PDF_GENERADO_DESDE_MOODLEDOCS_Acerca_de_Moodle.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 2,
        doc: "Características Principales de Moodle 5.3",
        cat: "01_Informacion_General",
        nombreOriginal: "Features / Características Moodle 5.3",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/Features",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "01_Informacion_General/PDF_GENERADO_DESDE_MOODLEDOCS_Caracteristicas_Moodle_5_3.pdf",
        archivoHtml: "01_Informacion_General/PDF_GENERADO_DESDE_MOODLEDOCS_Caracteristicas_Moodle_5_3.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 3,
        doc: "Guía Oficial de Instalación de Moodle 5.3",
        cat: "02_Instalacion",
        nombreOriginal: "Installing Moodle / Instalación de Moodle",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/Installing_Moodle",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "02_Instalacion/PDF_GENERADO_DESDE_MOODLEDOCS_Instalacion_Moodle_Oficial.pdf",
        archivoHtml: "02_Instalacion/PDF_GENERADO_DESDE_MOODLEDOCS_Instalacion_Moodle_Oficial.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 4,
        doc: "Requisitos Oficiales del Servidor y Entorno",
        cat: "02_Instalacion",
        nombreOriginal: "Server requirements / Requisitos del servidor",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/Environment_-_Server_requirements",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "02_Instalacion/PDF_GENERADO_DESDE_MOODLEDOCS_Requisitos_Servidor_PHP_BD.pdf",
        archivoHtml: "02_Instalacion/PDF_GENERADO_DESDE_MOODLEDOCS_Requisitos_Servidor_PHP_BD.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 5,
        doc: "Estructura de Administración del Sitio Moodle 5.3",
        cat: "03_Administracion",
        nombreOriginal: "Site administration / Administración del sitio",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/Site_administration",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "03_Administracion/PDF_GENERADO_DESDE_MOODLEDOCS_Administracion_del_Sitio.pdf",
        archivoHtml: "03_Administracion/PDF_GENERADO_DESDE_MOODLEDOCS_Administracion_del_Sitio.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 6,
        doc: "Recomendaciones Oficiales de Rendimiento y Moodle Universal Cache (MUC)",
        cat: "03_Administracion",
        nombreOriginal: "Performance / Rendimiento y Caché",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/Performance_recommendations",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "03_Administracion/PDF_GENERADO_DESDE_MOODLEDOCS_Rendimiento_y_Cache.pdf",
        archivoHtml: "03_Administracion/PDF_GENERADO_DESDE_MOODLEDOCS_Rendimiento_y_Cache.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 7,
        doc: "Gestión de Cuentas de Usuario y Métodos de Autenticación",
        cat: "04_Usuarios",
        nombreOriginal: "Managing accounts / Gestión de usuarios y autenticación",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/Managing_accounts",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "04_Usuarios/PDF_GENERADO_DESDE_MOODLEDOCS_Gestion_Usuarios_Autenticacion.pdf",
        archivoHtml: "04_Usuarios/PDF_GENERADO_DESDE_MOODLEDOCS_Gestion_Usuarios_Autenticacion.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 8,
        doc: "Modelo de Control de Acceso Basado en Roles (RBAC) y Contextos",
        cat: "05_Roles_Permisos",
        nombreOriginal: "Roles and permissions / Roles y permisos",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/Roles_and_permissions",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "05_Roles_Permisos/PDF_GENERADO_DESDE_MOODLEDOCS_Roles_Permisos_Contextos.pdf",
        archivoHtml: "05_Roles_Permisos/PDF_GENERADO_DESDE_MOODLEDOCS_Roles_Permisos_Contextos.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 9,
        doc: "Comprobaciones Oficiales de Seguridad y Hardening",
        cat: "06_Seguridad",
        nombreOriginal: "Security / Comprobaciones de seguridad",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/Security_checks",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "06_Seguridad/PDF_GENERADO_DESDE_MOODLEDOCS_Seguridad_y_Comprobaciones.pdf",
        archivoHtml: "06_Seguridad/PDF_GENERADO_DESDE_MOODLEDOCS_Seguridad_y_Comprobaciones.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 10,
        doc: "API de Privacidad de Datos y Cumplimiento Normativo (GDPR)",
        cat: "07_Privacidad",
        nombreOriginal: "Data privacy / Privacidad de datos",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/Data_privacy",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "07_Privacidad/PDF_GENERADO_DESDE_MOODLEDOCS_Privacidad_y_GDPR.pdf",
        archivoHtml: "07_Privacidad/PDF_GENERADO_DESDE_MOODLEDOCS_Privacidad_y_GDPR.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 11,
        doc: "Arquitectura de Logs, Trazabilidad y Eventos en Moodle",
        cat: "08_Logs_Auditoria",
        nombreOriginal: "Logging and Events / Logs y auditoría",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/Event_monitoring",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "08_Logs_Auditoria/PDF_GENERADO_DESDE_MOODLEDOCS_Sistema_Logs_Eventos.pdf",
        archivoHtml: "08_Logs_Auditoria/PDF_GENERADO_DESDE_MOODLEDOCS_Sistema_Logs_Eventos.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 12,
        doc: "Estrategias de Copia de Seguridad y Recuperación ante Desastres",
        cat: "09_Backup_Restauracion",
        nombreOriginal: "Backup and Restore / Respaldo y restauración",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/Site_backup",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "09_Backup_Restauracion/PDF_GENERADO_DESDE_MOODLEDOCS_Backup_y_Restauracion.pdf",
        archivoHtml: "09_Backup_Restauracion/PDF_GENERADO_DESDE_MOODLEDOCS_Backup_y_Restauracion.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 13,
        doc: "Arquitectura de Base de Datos y Capa XMLDB en Moodle",
        cat: "10_Base_Datos",
        nombreOriginal: "Database / Base de datos y XMLDB",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/XMLDB",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "10_Base_Datos/PDF_GENERADO_DESDE_MOODLEDOCS_Arquitectura_Base_Datos_XMLDB.pdf",
        archivoHtml: "10_Base_Datos/PDF_GENERADO_DESDE_MOODLEDOCS_Arquitectura_Base_Datos_XMLDB.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 14,
        doc: "Arquitectura de Servicios Web y API Externa en Moodle",
        cat: "11_API_WebServices",
        nombreOriginal: "Web services / Servicios Web y API",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/Web_services",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "11_API_WebServices/PDF_GENERADO_DESDE_MOODLEDOCS_Web_Services_REST_API.pdf",
        archivoHtml: "11_API_WebServices/PDF_GENERADO_DESDE_MOODLEDOCS_Web_Services_REST_API.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 15,
        doc: "Estándares de Codificación Oficiales de Moodle HQ",
        cat: "12_Desarrollo",
        nombreOriginal: "Coding style / Estándares de desarrollo",
        fuenteOriginal: "MoodleDev Docs Oficial (HQ)",
        url: "https://moodledev.io/general/development/policies/codingstyle",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "12_Desarrollo/PDF_GENERADO_DESDE_MOODLEDOCS_Coding_Style_y_Arquitectura.pdf",
        archivoHtml: "12_Desarrollo/PDF_GENERADO_DESDE_MOODLEDOCS_Coding_Style_y_Arquitectura.html",
        observaciones: "Vinculado al repositorio DevDocs (Cat. D); PDF generado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 16,
        doc: "Arquitectura de Subsistemas del Core de Moodle",
        cat: "13_Arquitectura",
        nombreOriginal: "Core Architecture / Arquitectura del Core",
        fuenteOriginal: "MoodleDev Docs Oficial (HQ)",
        url: "https://moodledev.io/docs/apis/subsystems",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "13_Arquitectura/PDF_GENERADO_DESDE_MOODLEDOCS_Arquitectura_Core_Moodle.pdf",
        archivoHtml: "13_Arquitectura/PDF_GENERADO_DESDE_MOODLEDOCS_Arquitectura_Core_Moodle.html",
        observaciones: "Vinculado al repositorio DevDocs (Cat. D); PDF generado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 17,
        doc: "Marco de Pruebas Automatizadas en Moodle: PHPUnit y Behat",
        cat: "14_Pruebas",
        nombreOriginal: "Testing / Pruebas unitarias y de aceptación",
        fuenteOriginal: "MoodleDev Docs Oficial (HQ)",
        url: "https://moodledev.io/general/development/tools/testing",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "14_Pruebas/PDF_GENERADO_DESDE_MOODLEDOCS_Pruebas_PHPUnit_y_Behat.pdf",
        archivoHtml: "14_Pruebas/PDF_GENERADO_DESDE_MOODLEDOCS_Pruebas_PHPUnit_y_Behat.html",
        observaciones: "Vinculado al repositorio DevDocs (Cat. D); PDF generado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 18,
        doc: "Procedimientos de Actualización y Modo de Mantenimiento",
        cat: "15_Actualizacion_Mantenimiento",
        nombreOriginal: "Upgrading / Actualización y mantenimiento",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/Upgrading",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "15_Actualizacion_Mantenimiento/PDF_GENERADO_DESDE_MOODLEDOCS_Actualizacion_y_Mantenimiento.pdf",
        archivoHtml: "15_Actualizacion_Mantenimiento/PDF_GENERADO_DESDE_MOODLEDOCS_Actualizacion_y_Mantenimiento.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 19,
        doc: "Arquitectura de Tareas Programadas y Ejecución de Cron CLI",
        cat: "16_Cron_Tareas",
        nombreOriginal: "Cron / Tareas programadas",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/Cron",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "16_Cron_Tareas/PDF_GENERADO_DESDE_MOODLEDOCS_Tareas_Programadas_y_Cron.pdf",
        archivoHtml: "16_Cron_Tareas/PDF_GENERADO_DESDE_MOODLEDOCS_Tareas_Programadas_y_Cron.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 20,
        doc: "Gestión y Auditoría de Seguridad de Plugins en Moodle",
        cat: "17_Plugins",
        nombreOriginal: "Plugins / Administración y seguridad de extensiones",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/Plugins_overview",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "17_Plugins/PDF_GENERADO_DESDE_MOODLEDOCS_Administracion_Seguridad_Plugins.pdf",
        archivoHtml: "17_Plugins/PDF_GENERADO_DESDE_MOODLEDOCS_Administracion_Seguridad_Plugins.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 21,
        doc: "Gestión de Paquetes de Idioma e Internacionalización",
        cat: "18_Idiomas",
        nombreOriginal: "Language packs / Paquetes de idioma",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/Language_packs",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "18_Idiomas/PDF_GENERADO_DESDE_MOODLEDOCS_Paquetes_Idioma_Espanol.pdf",
        archivoHtml: "18_Idiomas/PDF_GENERADO_DESDE_MOODLEDOCS_Paquetes_Idioma_Espanol.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 22,
        doc: "Notas de Lanzamiento Oficiales de Moodle 5.3",
        cat: "19_Release_Notes",
        nombreOriginal: "Moodle 5.3 Release Notes / Notas de lanzamiento",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/503/en/Moodle_5.3_release_notes",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "19_Release_Notes/PDF_GENERADO_DESDE_MOODLEDOCS_Moodle_5_3_Release_Notes.pdf",
        archivoHtml: "19_Release_Notes/PDF_GENERADO_DESDE_MOODLEDOCS_Moodle_5_3_Release_Notes.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    },
    {
        num: 23,
        doc: "Términos de Licencia GNU General Public License v3",
        cat: "20_Licencia",
        nombreOriginal: "License / Licencia oficial",
        fuenteOriginal: "Moodle Docs Oficial (HQ)",
        url: "https://docs.moodle.org/dev/License",
        idioma: "Español / Inglés",
        version: "5.3 (Build: 20261005)",
        clasificacionTipo: "C",
        clasificacionDesc: "PDF generado localmente a partir de documentación oficial de Moodle",
        metodoPreservacion: "Renderizado web y compilación a PDF mediante Google Chrome Headless",
        fechaConsulta: "12/10/2026",
        archivoPdf: "20_Licencia/PDF_GENERADO_DESDE_MOODLEDOCS_Licencia_GPLv3_Moodle.pdf",
        archivoHtml: "20_Licencia/PDF_GENERADO_DESDE_MOODLEDOCS_Licencia_GPLv3_Moodle.html",
        observaciones: "HTML oficial archivado localmente (Cat. B); PDF compilado localmente vía Chrome Headless (Cat. C)."
    }
];

// Generar INDICE_DOCUMENTACION.md
let md = `# ÍNDICE Y RECLASIFICACIÓN DOCUMENTAL OFICIAL - MOODLE 5.3

**Proyecto:** Auditoría Técnica y Línea Base ISO Moodle 5.3  
**Fecha de Actualización:** 12 de Octubre de 2026  
**Total Documentos Catalogados:** 23 guías técnicas + Repositorio DevDocs (2,683 ficheros)

---

## 1. Criterios de Clasificación Documental Estricta

Conforme a las directrices de integridad documental y auditoría, se define la siguiente taxonomía de 4 categorías:

- **A. PDF ORIGINAL publicado oficialmente por Moodle:** Documentos distribuidos originalmente en formato PDF por Moodle HQ. *(Auditoría: Moodle HQ no publica documentación de la versión 5.3 en archivos PDF estáticos; toda su documentación técnica es publicada en plataformas web dinámicas).*
- **B. HTML oficial archivado:** Copia fiel descargada y preservada del código HTML y DOM renderizado desde las URLs oficiales de MoodleDocs o MoodleDev.
- **C. PDF generado localmente a partir de documentación oficial de Moodle:** Ficheros PDF compilados en la estación de trabajo mediante **Google Chrome Headless** utilizando las especificaciones y contenidos vigentes de Moodle HQ. *(Ningún documento bajo esta categoría debe catalogarse erróneamente como 'PDF oficial de Moodle').*
- **D. Archivo perteneciente al repositorio oficial devdocs:** Archivos fuente Markdown, código y configuración pertenecientes al repositorio oficial git \`moodle/devdocs\` preservado en \`01_CODIGO_FUENTE/devdocs/\`.

---

## 2. Inventario de Documentación Oficial Reclasificada

| N° | Documento | Categoría | Clasificación | Fuente Original | URL Oficial | Fecha Consulta | Versión Moodle | Método de Preservación | Archivo Local PDF (Cat. C) | Archivo Local HTML (Cat. B) |
| :---: | :--- | :--- | :---: | :--- | :--- | :---: | :---: | :--- | :--- | :--- |
`;

items.forEach(it => {
    md += `| **${it.num}** | ${it.doc} | \`${it.cat}\` | **Cat. ${it.clasificacionTipo}** (${it.clasificacionDesc}) | ${it.fuenteOriginal} | [Enlace](${it.url}) | ${it.fechaConsulta} | ${it.version} | ${it.metodoPreservacion} | [\`${path.basename(it.archivoPdf)}\`](${it.archivoPdf}) | [\`${path.basename(it.archivoHtml)}\`](${it.archivoHtml}) |\n`;
});

md += `
---

## 3. Repositorio Oficial DevDocs (Categoría D)

| Componente | Clasificación | Fuente Original | URL Repositorio | Cantidad de Archivos | Método de Preservación | Ruta Local |
| :--- | :---: | :--- | :--- | :---: | :--- | :--- |
| **Moodle Developer Documentation (devdocs)** | **Cat. D** | Repositorio Oficial Git (Moodle HQ) | \`https://github.com/moodle/devdocs.git\` | 2,683 archivos | Clonación Git con SHA de commit inmutable | \`01_CODIGO_FUENTE/devdocs/\` |

---

## 4. Declaración de Integridad y Trazabilidad Documental

1. Se certifica que **ningún archivo PDF** de este inventario ha sido adulterado o presentado como un PDF original de Moodle HQ sin la debida aclaración.
2. Todo documento en formato PDF clasificado como **Categoría C** fue generado localmente a partir del contenido de MoodleDocs y MoodleDev utilizando Google Chrome Headless (\`--headless --disable-gpu --print-to-pdf\`).
3. Se conservan de forma íntegra los archivos HTML fuente (**Categoría B**) y el repositorio git \`devdocs\` (**Categoría D**) para consulta forense y cotejo de texto durante la auditoría.
`;

fs.writeFileSync(path.join(baseDir, 'INDICE_DOCUMENTACION.md'), md, 'utf8');
console.log('INDICE_DOCUMENTACION.md actualizado.');

// Generar CSV
const csvHeaders = [
    "N°",
    "Documento",
    "Categoría",
    "Nombre Original",
    "Clasificación",
    "Descripción Clasificación",
    "Fuente Original",
    "URL Oficial",
    "Fecha Consulta",
    "Versión Moodle",
    "Método Preservación",
    "Archivo Local PDF",
    "Archivo Local HTML",
    "Observaciones"
];

let csvRows = [csvHeaders.join(",")];
items.forEach(it => {
    const row = [
        `"${it.num}"`,
        `"${it.doc.replace(/"/g, '""')}"`,
        `"${it.cat}"`,
        `"${it.nombreOriginal.replace(/"/g, '""')}"`,
        `"Cat. ${it.clasificacionTipo}"`,
        `"${it.clasificacionDesc.replace(/"/g, '""')}"`,
        `"${it.fuenteOriginal.replace(/"/g, '""')}"`,
        `"${it.url}"`,
        `"${it.fechaConsulta}"`,
        `"${it.version}"`,
        `"${it.metodoPreservacion.replace(/"/g, '""')}"`,
        `"${it.archivoPdf}"`,
        `"${it.archivoHtml}"`,
        `"${it.observaciones.replace(/"/g, '""')}"`
    ];
    csvRows.push(row.join(","));
});

// Fila adicional para Cat. D
csvRows.push([
    `"24"`,
    `"Moodle Developer Documentation (devdocs)"`,
    `"00_DevDocs_Git"`,
    `"Moodle devdocs official repository"`,
    `"Cat. D"`,
    `"Archivo perteneciente al repositorio oficial devdocs"`,
    `"GitHub moodle/devdocs"`,
    `"https://github.com/moodle/devdocs.git"`,
    `"12/10/2026"`,
    `"5.3 (Rama main / 2,683 ficheros)"`,
    `"Clonación Git con preservación de commit SHA"`,
    `"N/A"`,
    `"N/A"`,
    `"Repositorio oficial completo descargado en 01_CODIGO_FUENTE/devdocs/"`
].join(","));

fs.writeFileSync(path.join(baseDir, 'INDICE_DOCUMENTACION.csv'), csvRows.join("\n"), 'utf8');
console.log('INDICE_DOCUMENTACION.csv actualizado.');

// Generar XLSX con Excel workbook
const wb = XLSX.utils.book_new();

const excelData = items.map(it => ({
    "N°": it.num,
    "Documento": it.doc,
    "Categoría": it.cat,
    "Nombre Original": it.nombreOriginal,
    "Clasificación": `Cat. ${it.clasificacionTipo}`,
    "Descripción de Clasificación": it.clasificacionDesc,
    "Fuente Original": it.fuenteOriginal,
    "URL Oficial": it.url,
    "Fecha Consulta": it.fechaConsulta,
    "Versión Moodle": it.version,
    "Método de Preservación": it.metodoPreservacion,
    "Archivo Local PDF (Cat. C)": it.archivoPdf,
    "Archivo Local HTML (Cat. B)": it.archivoHtml,
    "Observaciones": it.observaciones
}));

excelData.push({
    "N°": 24,
    "Documento": "Moodle Developer Documentation (devdocs)",
    "Categoría": "00_DevDocs_Git",
    "Nombre Original": "Moodle devdocs official repository",
    "Clasificación": "Cat. D",
    "Descripción de Clasificación": "Archivo perteneciente al repositorio oficial devdocs",
    "Fuente Original": "GitHub moodle/devdocs",
    "URL Oficial": "https://github.com/moodle/devdocs.git",
    "Fecha Consulta": "12/10/2026",
    "Versión Moodle": "5.3 (Rama main / 2,683 ficheros)",
    "Método de Preservación": "Clonación Git con preservación de commit SHA",
    "Archivo Local PDF (Cat. C)": "N/A",
    "Archivo Local HTML (Cat. B)": "N/A",
    "Observaciones": "Repositorio oficial completo descargado en 01_CODIGO_FUENTE/devdocs/"
});

const ws = XLSX.utils.json_to_sheet(excelData);

// Ajustar ancho de columnas
ws['!cols'] = [
    { wch: 5 },   // N°
    { wch: 45 },  // Documento
    { wch: 22 },  // Categoría
    { wch: 35 },  // Nombre Original
    { wch: 10 },  // Clasificación
    { wch: 65 },  // Descripción Clasificación
    { wch: 25 },  // Fuente Original
    { wch: 45 },  // URL Oficial
    { wch: 15 },  // Fecha Consulta
    { wch: 20 },  // Versión Moodle
    { wch: 55 },  // Método Preservación
    { wch: 55 },  // Archivo Local PDF
    { wch: 55 },  // Archivo Local HTML
    { wch: 60 }   // Observaciones
];

XLSX.utils.book_append_sheet(wb, ws, "Documentacion_Oficial");
XLSX.writeFile(wb, path.join(baseDir, 'INDICE_DOCUMENTACION.xlsx'));
console.log('INDICE_DOCUMENTACION.xlsx generado exitosamente.');
