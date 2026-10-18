# Arquitectura de Servicios Web y API Externa en Moodle

> **METADATOS DE AUDITORÍA:**
> - **Fuente oficial:** MoodleDocs / MoodleDev HQ
> - **URL Oficial Principal:** https://docs.moodle.org/503/en/Web_services
> - **URL Oficial Español:** https://docs.moodle.org/all/es/Servicios_web
> - **Fecha de Consulta:** 12 de Octubre de 2026
> - **Versión Moodle:** 5.3 (v5.3.0)
> - **Categoría:** 11_API_WebServices
> - **Nota Técnica:** Se conserva la versión inglesa vigente por prevalencia técnica complementada con referencias en español.

---

## Resumen Ejecutivo
Especificación de protocolos de interoperabilidad, autenticación por tokens y documentación de funciones externas.

---

## Contenido Técnico Oficial
1. Protocolos Soportados

  REST: Formato JSON o XML estándar para integración con sistemas SIS/ERP externos y la App Móvil oficial.
  SOAP: Protocolo tradicional para entornos corporativos legacy.

2. Mecanismo de Seguridad
El acceso a la API requiere creación de un servicio externo, asignación de capacidades específicas y generación de tokens criptográficos temporales o permanentes vinculados a usuarios del sistema.

---
*Archivo consolidado para el Expediente de Auditoría ISO Moodle 5.3*
