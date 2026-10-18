# INVENTARIO OFICIAL DE CÓDIGO FUENTE - MOODLE 5.3

**Proyecto:** Expediente de Instalación y Línea Base ISO Moodle 5.3  
**Auditoría:** Control de Versiones e Integridad de Código Fuente  
**Fecha de Emisión:** 12 de Octubre de 2026  

---

## 1. Resumen de Repositorios Oficiales Catalogados

| Componente | Repositorio Oficial | Rama / Tag | Commit SHA | Fecha del Commit | Licencia | Ubicación Local |
| :--- | :--- | :---: | :---: | :---: | :---: | :--- |
| **Moodle Core** | `https://github.com/moodle/moodle.git` | `v5.3.0` (Tag inmutable) | `42622298fe06f9626d988d60b2bf589bd8f850e8` | Octubre 2026 | GPL-3.0-or-later | `01_CODIGO_FUENTE/moodle` |
| **Moodle Docker** | `https://github.com/moodlehq/moodle-docker.git` | `master` | `f4c2324d32fb74d7753264381f0a9b418b6034b2` | 30/07/2026 08:45:28 +0700 | GPL-3.0 | `01_CODIGO_FUENTE/moodle-docker` |
| **Developer Docs** | `https://github.com/moodle/devdocs.git` | `main` | `9535991acdb89aa7722f4e4d26ea43ed5eb2768e` | 07/10/2026 05:38:50 +0000 | GPL-3.0-or-later | `01_CODIGO_FUENTE/devdocs` |

---

## 2. Fichas Técnicas Individuales

### A. Moodle Core (Núcleo del Sistema)
- **Producto:** Moodle Learning Management System (LMS)
- **Versión de Auditoría:** 5.3.0
- **Etiqueta Oficial (Tag):** `v5.3.0`
- **Identificador de Objeto Tag:** `d3ae3f3a367b936e38dcc06adfd6bf954302101d`
- **Commit SHA Apuntado por HEAD:** `42622298fe06f9626d988d60b2bf589bd8f850e8`
- **Origen Remoto (Remote Origin):** `https://github.com/moodle/moodle.git`
- **Espejo Oficial:** `https://git.moodle.org/moodle.git`
- **Ruta Local:** `Moodle_Auditoria_ISO/01_CODIGO_FUENTE/moodle`
- **Licencia:** GNU General Public License versión 3 o posterior (GPL-3.0-or-later)
- **Estado del Repositorio:** Limpio, inmutable, clonado directamente desde la fuente oficial sin parches ni modificaciones no autorizadas.

### B. Moodle Docker (Entorno Oficial de Desarrollo / Pruebas)
- **Producto:** Moodle Docker Environment
- **Organización:** Moodle HQ (`moodlehq`)
- **Repositorio Oficial:** `https://github.com/moodlehq/moodle-docker.git`
- **Rama:** `master`
- **Commit SHA:** `f4c2324d32fb74d7753264381f0a9b418b6034b2`
- **Autor del Commit:** Huong Nguyen & Paul Holden (Moodle HQ)
- **Mensaje del Commit:** `Merge pull request #352 from paulholden/mdl-5.3: Update default dependencies per Moodle 5.3 requirements.`
- **Ruta Local:** `Moodle_Auditoria_ISO/01_CODIGO_FUENTE/moodle-docker`
- **Licencia:** GNU General Public License versión 3 (GPL-3.0)
- **Finalidad en Auditoría:** Especificación de referencia de contenedores y servicios para Moodle 5.3.

### C. Developer Documentation (devdocs)
- **Producto:** Moodle Developer Documentation Source
- **Organización:** Moodle HQ (`moodle`)
- **Repositorio Oficial:** `https://github.com/moodle/devdocs.git`
- **Rama:** `main`
- **Commit SHA:** `9535991acdb89aa7722f4e4d26ea43ed5eb2768e`
- **Autor del Commit:** Sara Arjona (Moodle HQ)
- **Mensaje del Commit:** `Merge pull request #1721 from paulholden/wp-minors: Workplace version data for October '26 minors.`
- **Ruta Local:** `Moodle_Auditoria_ISO/01_CODIGO_FUENTE/devdocs`
- **Licencia:** GNU General Public License versión 3 o posterior
- **Finalidad en Auditoría:** Repositorio completo local de guías de arquitectura, estándares de codificación, APIs de subsistemas y pruebas para consulta offline.

---

## 3. Criterio de Inmutabilidad
Ninguno de los repositorios clonados ha recibido modificaciones sobre sus árboles de trabajo originales. Todo ajuste de configuración del entorno se gestiona a través de archivos desacoplados en `02_ENTORNO_EJECUCION/` y `03_BASE_DATOS/`.
