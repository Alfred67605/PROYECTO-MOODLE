# MATRIZ DE REQUISITOS DEL ENTORNO DE EJECUCIÓN - MOODLE 5.3

**Fecha de Verificación:** 12 de Octubre de 2026  
**Auditoría Técnica:** Expediente de Instalación y Línea Base ISO  
**Plataforma Objetivo:** Moodle v5.3.0  

---

## 1. Diagnóstico del Sistema Anfitrión (Host)

| Parámetro | Valor Detectado | Requisito Moodle 5.3 | Estado |
| :--- | :--- | :--- | :---: |
| **Sistema Operativo** | Windows 11 Pro 64-bit (Build 26300) | Linux / Windows / macOS | CUMPLE |
| **Arquitectura CPU** | x86_64 (64 bits) | 64 bits recomendado | CUMPLE |
| **Memoria RAM** | 15.4 GB Total (3.5 GB Libres) | Mínimo 2 GB, 8 GB+ recomendado | CUMPLE |
| **Almacenamiento (Disco)** | C:\ 354 GB Libres / E:\ 745 GB Libres | Mínimo 5 GB para laboratorio | CUMPLE |
| **Gestor de Control de Versiones**| Git 2.55.0.windows.5 | Git 2.x+ | CUMPLE |
| **WSL2 / Docker Desktop** | WSL no habilitado / Docker no instalado | Opcional para laboratorio local | EVALUADO |

---

## 2. Requisitos de Base de Datos (RDBMS)

| Parámetro | Requisito Moodle 5.3 | Entorno Local Configurado | Estado |
| :--- | :--- | :--- | :---: |
| **Motor RDBMS** | PostgreSQL >= 17 (o MariaDB 11.4 / MySQL 8.4) | PostgreSQL 18.6 (x86_64-windows) | CUMPLE (Superior) |
| **Instancia / Puerto** | Puerto dedicado TCP/IP | Puerto 5433 (Cluster aislado de auditoría) | CUMPLE |
| **Encoding / Charset** | UTF-8 | UTF-8 | CUMPLE |
| **Collation / Locale** | C / UTF-8 | C | CUMPLE |
| **Base de Datos** | Nombre asignado | `moodle` | CUMPLE |
| **Usuario / Rol** | Rol propietario con LOGIN | `moodleuser` | CUMPLE |
| **Herramientas de Respaldo** | pg_dump / psql disponibles | PostgreSQL 18.6 bin en PATH | CUMPLE |

---

## 3. Requisitos de PHP y Extensiones

| Extensión / Parámetro | Requisito Moodle 5.3 | Detectado en PHP 8.4.25 | Estado |
| :--- | :--- | :--- | :---: |
| **Versión PHP** | PHP >= 8.3 (Recomendado 8.3 / 8.4) | PHP 8.4.25 (ZTS Visual C++ 2022 x64) | CUMPLE |
| **curl** | Obligatoria (Comunicación HTTP/API) | Habilitada (libcurl 8.21.0) | CUMPLE |
| **intl** | Obligatoria (Internacionalización) | Habilitada | CUMPLE |
| **mbstring** | Obligatoria (Manejo de cadenas UTF-8) | Habilitada | CUMPLE |
| **openssl** | Obligatoria (Criptografía y HTTPS) | Habilitada (OpenSSL 3.0.21) | CUMPLE |
| **sodium** | Obligatoria (Criptografía moderna) | Habilitada | CUMPLE |
| **zip** | Obligatoria (Empaquetado de cursos/plugins)| Habilitada (Libzip 1.11.4) | CUMPLE |
| **gd** | Obligatoria (Generación de imágenes/miniaturas)| Habilitada (bundled 2.1.0) | CUMPLE |
| **xml / dom / xmlreader** | Obligatoria (Manipulación XML / Moodle XML)| Habilitada (libxml 2.11.9) | CUMPLE |
| **soap** | Obligatoria (Servicios Web SOAP) | Habilitada | CUMPLE |
| **pgsql / pdo_pgsql** | Obligatoria (Driver de conexión PostgreSQL)| Habilitada | CUMPLE |
| **exif** | Recomendada (Metadatos de imagen) | Habilitada | CUMPLE |
| **opcache** | Altamente recomendada (Rendimiento) | Habilitada | CUMPLE |
| **memory_limit** | Mínimo 256M | Configurado en 512M | CUMPLE |
| **max_execution_time**| Mínimo 120s para instalación CLI | Configurado en 300s | CUMPLE |

---

## 4. Directorio de Datos (`moodledata`)

| Requisito | Definición en Laboratorio | Estado |
| :--- | :--- | :---: |
| **Ubicación no accesible vía Web** | `Moodle_Auditoria_ISO/02_ENTORNO_EJECUCION/moodledata` | AISLADO |
| **Permisos de Lectura/Escritura** | Permisos totales de usuario local `llano` | CUMPLE |
| **Encoding del Sistema de Archivos** | NTFS con soporte UTF-8 | CUMPLE |

---

## 5. Conclusión Técnica y Aprobación de Fase

Todas las dependencias críticas y recomendadas para la ejecución de **Moodle 5.3** con motor **PostgreSQL** han sido validadas empíricamente y se encuentran plenamente operativas en la estación de trabajo. Se autoriza el avance a la fase de instalación y configuración de la instancia.
