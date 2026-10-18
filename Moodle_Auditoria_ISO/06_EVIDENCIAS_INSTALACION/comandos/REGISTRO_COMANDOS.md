# REGISTRO CRONOLÓGICO Y BITÁCORA DE COMANDOS DE INSTALACIÓN Y AUDITORÍA

**Proyecto:** Moodle 5.3 Laboratorio de Auditoría ISO  
**Estación de Trabajo:** Windows 11 Pro 64-bit (Build 26300)  
**Usuario Ejecutor:** llano (Administrador local de laboratorio)  
**Fecha de Inicio:** 12 de Octubre de 2026  

---

## Etapa 1: Diagnóstico de Hardware y Entorno Anfitrión
- **Fecha y Hora:** 12/10/2026 16:20:50 -04:00
- **Comandos Ejecutados:**
  ```powershell
  Get-CimInstance Win32_OperatingSystem | Select-Object Caption, Version, OSArchitecture, BuildNumber, TotalVisibleMemorySize, FreePhysicalMemory
  Get-PSDrive -PSProvider FileSystem | Select-Object Root, Free, Used
  git --version
  docker --version
  wsl -l -v
  php -v
  psql --version
  ```
- **Resultado:**
  - SO: Windows 11 Pro 64-bit (Build 26300)
  - RAM: 15.4 GB visible (3.45 GB libre)
  - Espacio: C:\ 354 GB libres, E:\ 745 GB libres
  - Git: 2.55.0.windows.5
  - Docker / WSL2: No instalados en el host
  - PHP: 8.4.25 (WinGet package)
  - PostgreSQL: 18.6 instalado en `C:\Program Files\PostgreSQL\18\bin`
  - Puerto 5432: En uso por servicio preexistente `postgresql-x64-18`

---

## Etapa 2: Aislamiento y Configuración de PostgreSQL 18 para Auditoría
- **Fecha y Hora:** 12/10/2026 16:26:04 -04:00
- **Comandos Ejecutados:**
  ```powershell
  # Inicialización de cluster aislado en 02_ENTORNO_EJECUCION/pgsql_data
  & "C:\Program Files\PostgreSQL\18\bin\initdb.exe" -D "...\pgsql_data" -U postgres -E UTF8 --locale=C -A trust

  # Ajuste de puerto a 5433 en postgresql.conf (UTF-8 sin BOM)
  # Inicio del cluster
  & "C:\Program Files\PostgreSQL\18\bin\postgres.exe" -D "...\pgsql_data"

  # Creación de usuario y base de datos
  & "C:\Program Files\PostgreSQL\18\bin\psql.exe" -U postgres -p 5433 -h 127.0.0.1 -c "CREATE ROLE moodleuser WITH LOGIN PASSWORD '***' CREATEDB;"
  & "C:\Program Files\PostgreSQL\18\bin\psql.exe" -U postgres -p 5433 -h 127.0.0.1 -c "CREATE DATABASE moodle WITH OWNER moodleuser ENCODING 'UTF8';"
  & "C:\Program Files\PostgreSQL\18\bin\psql.exe" -U postgres -p 5433 -h 127.0.0.1 -c "GRANT ALL PRIVILEGES ON DATABASE moodle TO moodleuser;"
  ```
- **Resultado:**
  - Cluster PostgreSQL 18.6 operando en puerto 5433 de forma completamente aislada sin colisionar con el servicio de puerto 5432.
  - Base de datos `moodle` creada con encoding UTF-8 y propietario `moodleuser`.

---

## Etapa 3: Hardening y Configuración de PHP 8.4
- **Fecha y Hora:** 12/10/2026 16:25:50 -04:00
- **Comandos Ejecutados:**
  ```powershell
  # Adición de PostgreSQL bin al User PATH para resolución de libpq.dll
  [Environment]::SetEnvironmentVariable("Path", "$userPath;C:\Program Files\PostgreSQL\18\bin", "User")

  # Habilitación de extensiones en php.ini
  extension=intl
  extension=soap
  extension=sodium
  extension=exif
  zend_extension=opcache
  memory_limit = 512M
  max_execution_time = 300
  ```
- **Resultado:**
  - Comprobación exitosa: `intl`, `soap`, `sodium`, `exif`, `pgsql`, `pdo_pgsql`, `curl`, `mbstring`, `zip`, `gd`, `xml` cargadas limpiamente al 100% sin advertencias.
  - Conexión PDO validada exitosamente: `CONNECTED_OK`.

---

## Etapa 4: Descarga de Fuentes Oficiales (Git)
- **Fecha y Hora:** 12/10/2026 16:31:30 -04:00
- **Comandos Ejecutados:**
  ```powershell
  # Moodle-Docker oficial
  git clone https://github.com/moodlehq/moodle-docker.git "...\01_CODIGO_FUENTE\moodle-docker"

  # DevDocs oficial
  git clone https://github.com/moodle/devdocs.git "...\01_CODIGO_FUENTE\devdocs"

  # Moodle Core oficial etiqueta v5.3.0
  git clone --branch v5.3.0 --single-branch https://github.com/moodle/moodle.git moodle
  ```
- **Resultado:**
  - `moodle-docker`: Clonado en commit `f4c2324d32fb74d7753264381f0a9b418b6034b2`.
  - `devdocs`: Clonado con 2683 archivos actualizados.
  - `moodle`: Clonado en tag oficial inmutable `v5.3.0`.

---

## Etapa 5: Generación de Documentación Oficial y PDFs de Auditoría
- **Fecha y Hora:** 12/10/2026 16:45:50 -04:00
- **Comandos Ejecutados:**
  ```powershell
  node "...\04_DOCUMENTACION_OFICIAL\generar_documentacion_y_pdfs.js"
  ```
- **Resultado:**
  - 23 documentos técnicos en Markdown y HTML generados con encabezados formales.
  - 23 archivos PDF generados mediante motor de renderizado de Google Chrome headless.
  - `INDICE_DOCUMENTACION.md` e `INDICE_DOCUMENTACION.xlsx` creados con catalogación completa.
