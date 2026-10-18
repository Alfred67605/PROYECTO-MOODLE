# Gestión de Cuentas de Usuario y Métodos de Autenticación

> **METADATOS DE AUDITORÍA:**
> - **Fuente oficial:** MoodleDocs / MoodleDev HQ
> - **URL Oficial Principal:** https://docs.moodle.org/503/en/Managing_accounts
> - **URL Oficial Español:** https://docs.moodle.org/all/es/Gesti%C3%B3n_de_cuentas
> - **Fecha de Consulta:** 12 de Octubre de 2026
> - **Versión Moodle:** 5.3 (v5.3.0)
> - **Categoría:** 04_Usuarios
> - **Nota Técnica:** Se conserva la versión inglesa vigente por prevalencia técnica complementada con referencias en español.

---

## Resumen Ejecutivo
Directrices para la provisión, auditoría, ciclo de vida y autenticación segura de identidades en Moodle.

---

## Contenido Técnico Oficial
1. Ciclo de Vida de Identidades
Moodle soporta creación manual de cuentas, subida masiva vía CSV (admin/tool/uploaduser), y sincronización automatizada mediante LDAP/Active Directory o SAML2/OAuth2.
2. Políticas de Seguridad de Cuentas

  Bloqueo de cuenta tras intentos fallidos repetidos.
  Complejidad obligatoria de contraseñas (longitud mínima, dígitos, mayúsculas, minúsculas y caracteres no alfanuméricos).
  Doble factor de autenticación (MFA) nativo disponible desde la versión 4.x.
  Suspensión preventiva de cuentas inactivas.

---
*Archivo consolidado para el Expediente de Auditoría ISO Moodle 5.3*
