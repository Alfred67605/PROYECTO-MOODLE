# PROYECTO AUDITORÍA INFORMÁTICA — MOODLE LMS 5.3
## GUÍA MAESTRA DE INSTALACIÓN, OPERACIÓN Y LEVANTAMIENTO DEL PROYECTO

> **Asignatura:** Auditoría Informática (INF 881) — Octavo Semestre  
> **Institución Académica Referencial:** Universidad Autónoma Tomás Frías (UATF)  
> **Marco Metodológico de Auditoría:** ISO/IEC 27001:2022, ISO/IEC 27002:2022, ISO/IEC 27005:2022 e ISO 19011:2026  
> **Auditor / Responsable Técnico:** Alfredo Llanos Taca  
> **Repositorio Oficial:** [https://github.com/Alfred67605/PROYECTO-MOODLE](https://github.com/Alfred67605/PROYECTO-MOODLE)  
> **URL Local de la Plataforma:** [http://localhost:8000](http://localhost:8000)  
> **Servicio de Base de Datos:** PostgreSQL 18 en `127.0.0.1:5433` (Base de datos `moodle`)

---

## 1. Resumen Ejecutivo del Entorno

Este repositorio contiene el entorno completo de laboratorio para la auditoría técnica y de seguridad de la plataforma de aprendizaje **Moodle LMS versión 5.3 (Build 20241014)**. 

El sistema ha sido poblado con un **escenario universitario a gran escala** modelado según la estructura académica real de la **Universidad Autónoma Tomás Frías (UATF)**:

* **2,659 Usuarios Activos:** 1 cuenta de auditor, 2 docentes titulares, 5 estudiantes piloto, 150 docentes universitarios distribuidos y 2,500 estudiantes matriculados.
* **67 Categorías Académicas:** Nodo raíz UATF, 13 facultades universitarias y 49 carreras/sedes de pregrado y posgrado.
* **502 Cursos Totales:** Curso central AUD-101 (Auditoría Informática) y 500 cursos de carrera completamente estructurados.
* **4,000 Actividades de Aprendizaje:** 1,000 páginas de lectura, 500 foros de discusión, 1,500 tareas con entregas y 1,000 cuestionarios evaluativos.
* **4,991 Preguntas de Banco:** Preguntas nativas de opción múltiple con respuestas y retroalimentaciones académicas.
* **12,815 Matriculaciones y Asignaciones de Rol.**
* **48 Cohortes Institucionales y 1,000 Grupos de Curso ("Paralelo A" y "Paralelo B").**
* **Libro de Calificaciones Ponderado:** Categorías de Parcial 1 (40%), Parcial 2 (40%) y Examen Final (20%) con 4,085 notas registradas.

---

## 2. Requisitos Previos del Sistema

Para levantar el laboratorio en cualquier máquina con Windows (10 u 11, 64 bits):

1. **PHP 8.4 (o 8.2+):**  
   Disponible en el `PATH` del sistema.  
   *Extensiones requeridas habilitadas en `php.ini`:*  
   `curl`, `fileinfo`, `gd`, `intl`, `mbstring`, `openssl`, `pdo_pgsql`, `pgsql`, `soap`, `sodium`, `zip`, `exif`, `opcache`.  
   *Configuración recomendada:* `max_input_vars = 5000`.

2. **PostgreSQL 18 (o 16+):**  
   Instalado en el sistema (por ejemplo, en `C:\Program Files\PostgreSQL\18\bin`).

3. **Git para Windows:**  
   Para la sincronización del repositorio y componentes.

---

## 3. Cómo Levantar el Proyecto (Despliegue Rápido en 1 Clic)

Una vez clonado el repositorio:

```bash
git clone https://github.com/Alfred67605/PROYECTO-MOODLE.git
cd PROYECTO-MOODLE
```

### Método 1: Despliegue Automatizado Maestro (Recomendado)

Abre una terminal de **PowerShell** en la carpeta `Moodle_Auditoria_ISO` y ejecuta:

```powershell
cd Moodle_Auditoria_ISO
powershell -ExecutionPolicy Bypass -File "desplegar_laboratorio_completo.ps1"
```

**¿Qué hace automáticamente este script?**
1. **Fase 1 (Núcleo Moodle):** Comprueba si el código de Moodle 5.3 está descargado; si falta, clona la versión oficial de Moodle HQ (tag `v5.3.0`) y enlaza el archivo de configuración portable `config.php`.
2. **Fase 2 (Base de Datos):** Inicia PostgreSQL en el puerto `5433`, crea el rol `moodleuser` y la base de datos `moodle`, y restaura el dump relacional completo `03_BASE_DATOS\moodle_uatf_poblado.dump` (499 tablas y 2,659 usuarios).
3. **Fase 3 (Servidor Web):** Lanza el servidor web PHP en `http://localhost:8000` con el enrutador para Moodle.
4. **Finalización:** Deja el sistema 100% operativo y listo para iniciar sesión en el navegador.

---

### Método 2: Control Manual Paso a Paso

Si prefieres ejecutar cada componente de forma individual:

#### Paso 1: Preparar el código fuente de Moodle 5.3
```powershell
powershell -ExecutionPolicy Bypass -File "Moodle_Auditoria_ISO\01_CODIGO_FUENTE\preparar_moodle_core.ps1"
```

#### Paso 2: Restaurar la base de datos poblada de UATF
```powershell
powershell -ExecutionPolicy Bypass -File "Moodle_Auditoria_ISO\03_BASE_DATOS\scripts\04_restaurar_base_datos_poblada.ps1"
```

#### Paso 3: Iniciar los servicios (PostgreSQL + Servidor Web PHP)
```powershell
powershell -ExecutionPolicy Bypass -File "Moodle_Auditoria_ISO\02_ENTORNO_EJECUCION\iniciar_moodle.ps1"
```

#### Paso 4: Abrir en el Navegador
Ingresa a: **[http://localhost:8000](http://localhost:8000)**

---

## 4. Credenciales de Acceso Verificadas (100% Funcionales)

Todas las contraseñas están almacenadas mediante el algoritmo nativo `bcrypt` de Moodle y verificadas:

### 4.1 Cuentas del Entorno Web Moodle

| Rol Institucional | Usuario (`username`) | Nombre Completo | Contraseña Activa | Correo Registrado | Acceso / Ámbito |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Administrador General** | `admin_auditoria` | Admin User | `X%RDN5bnFyqPG@6+U&` | `admin@audit.local` | Acceso total a Administración del Sitio |
| **Docente Titular (Auditoría)** | `profesor1` | Docente Uno | `=YKvHz$nxsws5b@VYI` | `profesor1@audit.local` | Edición y Calificaciones en AUD-101 |
| **Docente Titular 2** | `profesor2` | Docente Dos | `1F4h30LgRcUPwNJE7r` | `profesor2@audit.local` | Edición y Calificaciones en AUD-101 |
| **Estudiante Piloto 1** | `estudiante1` | Estudiante Uno | `Zg*Ya4mQBfy%NSHkKA` | `estudiante1@audit.local` | Alumno matriculado en AUD-101 |
| **Estudiante Piloto 2** | `estudiante2` | Estudiante Dos | `@%OUleIBl8Ex)mMi(X` | `estudiante2@audit.local` | Alumno matriculado en AUD-101 |
| **Docentes UATF (Sintéticos)** | `docente001` a `docente150` | Varios docentes | Clave en bóveda local | `docenteXXX@uatf.edu.bo` | Docentes de 500 asignaturas |
| **Estudiantes UATF (Sintéticos)** | `estudiante0001` a `estudiante2500` | Estudiantes UATF | Clave en bóveda local | `estudianteXXXX@uatf.edu.bo` | Estudiantes matriculados por carrera |

### 4.2 Base de Datos PostgreSQL 18

| Parámetro | Valor Configurado | Descripción |
| :--- | :--- | :--- |
| **Host** | `127.0.0.1` | Loopback local |
| **Puerto** | `5433` | Puerto dedicado para evitar conflicto con el puerto por defecto 5432 |
| **Base de Datos** | `moodle` | Base de datos principal con 499 tablas relacionales |
| **Usuario Moodle** | `moodleuser` | Usuario de aplicación |
| **Contraseña BD** | `Moodle_Audit_2026_Secure!` | Contraseña asignada en `config.php` |
| **Superusuario** | `postgres` | Administrador del clúster PostgreSQL |

---

## 5. Comandos de Operación y Mantenimiento

Desde el directorio `Moodle_Auditoria_ISO`:

* **Detener los servicios de forma limpia (PHP y PostgreSQL):**
  ```powershell
  powershell -ExecutionPolicy Bypass -File "02_ENTORNO_EJECUCION\detener_moodle.ps1"
  ```

* **Ejecutar el Cron de Moodle (CLI):**
  ```powershell
  powershell -ExecutionPolicy Bypass -File "02_ENTORNO_EJECUCION\ejecutar_cron.ps1"
  ```

* **Verificar puertos activos en Windows:**
  ```powershell
  Get-NetTCPConnection -LocalPort 8000, 5433 -State Listen
  ```

* **Permisos de escritura sobre `moodledata` (si OneDrive bloquea en Windows):**
  ```powershell
  attrib -r "02_ENTORNO_EJECUCION\moodledata"
  attrib -r "02_ENTORNO_EJECUCION\moodledata\*" /s /d
  ```

---

## 6. Estructura del Repositorio `Moodle_Auditoria_ISO`

```text
Moodle_Auditoria_ISO/
├── desplegar_laboratorio_completo.ps1    # Script maestro de despliegue en 1 clic
├── POBLAMIENTO_MOODLE_UATF.md           # Informe ejecutivo del poblamiento masivo
├── RESUMEN_POBLAMIENTO.csv              # Métricas académicas por facultad y carrera
├── MANIFIESTO_CARGA.md / .json          # Manifiesto técnico con IDs y registros
├── DATOS_PARA_ACTUALIZAR_ANALISIS_RIESGOS.md # Impacto para la matriz de riesgos ISO 27005
├── 00_CONTROL_PROYECTO/                 # Informes de instalación, verificación y hashes SHA-256
├── 01_CODIGO_FUENTE/
│   ├── config.php                       # Configuración maestra portable con rutas relativas
│   ├── preparar_moodle_core.ps1         # Descarga y enlace del núcleo de Moodle 5.3
│   ├── devdocs/                         # Documentación oficial para desarrolladores
│   └── moodle-docker/                   # Pila oficial de contenedores Docker
├── 02_ENTORNO_EJECUCION/
│   ├── iniciar_moodle.ps1               # Encendido del servidor PHP y PostgreSQL
│   ├── detener_moodle.ps1               # Apagado ordenado sin corrupción de datos
│   ├── ejecutar_cron.ps1                # Ejecutor CLI del cron programado
│   ├── router.php                       # Enrutador para servidor web integrado PHP
│   └── scripts/                         # Scripts de análisis y rotación de credenciales
├── 03_BASE_DATOS/
│   ├── moodle_uatf_poblado.dump         # Respaldo relacional completo UATF (4.73 MB, 499 tablas)
│   └── scripts/
│       ├── 01_crear_base_datos_usuario.sql
│       ├── 02_iniciar_servicio_postgresql.ps1
│       ├── 03_detener_servicio_postgresql.ps1
│       └── 04_restaurar_base_datos_poblada.ps1 # Restauración automática de la BD
├── 04_DOCUMENTACION_OFICIAL/            # 20 carpetas temáticas oficiales de Moodle HQ (MD, HTML, PDF)
├── 06_EVIDENCIAS_INSTALACION/
│   ├── capturas/                        # 16 capturas iniciales de verificación (EVID-001 a EVID-016)
│   ├── capturas_poblamiento_uatf/       # 20 capturas reales del escenario UATF poblado
│   └── comandos/                        # Historial y bitácora de comandos ejecutados
├── 08_PRUEBAS/                          # Matriz de 17 pruebas de aceptación y verificación
└── 09_AUDITORIA_ISO/                    # Fichas técnicas de 8 normas ISO y análisis de riesgos
```

---

## 7. Evidencias Visuales Disponibles

En la carpeta [`06_EVIDENCIAS_INSTALACION/capturas_poblamiento_uatf/`](file:///c:/Users/llano/Documents/OCTAVO%20SEMESTRE/AUDITORIA/PROYECTO/Moodle_Auditoria_ISO/06_EVIDENCIAS_INSTALACION/capturas_poblamiento_uatf) se encuentran las 20 capturas de pantalla reales capturadas directamente desde el navegador Chrome:

1. `01_categorias_uatf_arbol.png` — Árbol completo de 67 categorías y subcategorías UATF.
2. `02_cursos_fcefa_auditoria.png` — Asignaturas de la carrera de Auditoría y Ciencias Económicas.
3. `03_cohortes_institucionales_uatf.png` — 48 cohortes con 2,505 estudiantes agrupados.
4. `04_usuarios_estudiantes_docentes.png` — Listado de cuentas reales y roles asignados.
5. `05_curso_aud201_estructura_completa.png` — Curso con secciones, tareas, cuestionario y foros.
6. `06_participantes_grupos_paralelos.png` — Paralelo A y B con docentes y estudiantes.
7. `07_libro_calificaciones_ponderaciones.png` — Ponderaciones oficiales 40% / 40% / 20%.
8. `08_calificador_libro_notas.png` — Calificador con notas y retroalimentaciones registradas.
9. `09_entregas_tareas_retroalimentacion.png` — Envíos de tareas y estados de calificación.
10. `10_cuestionario_intentos_calificados.png` — Cuestionario completado con intentos evaluados.
11. `11_foro_academico_interaccion.png` — Debates e intervenciones en foros académicos.
12. `12_docente_mis_cursos_asignados.png` — Vista del docente con sus cursos asignados.
13. `13_docente_gestion_calificaciones.png` — Panel del docente gestionando notas de alumnos.
14. `14_estudiante_dashboard_mis_cursos.png` — Vista del estudiante con asignaturas activas.
15. `15_estudiante_boleta_calificaciones_privada.png` — Boleta privada de notas del estudiante.
16. `16_curso_sistemas_sis111.png` — Asignatura de Ing. de Sistemas con actividades.
17. `17_curso_medicina_med101.png` — Asignatura de Medicina con actividades.
18. `18_curso_derecho_der101.png` — Asignatura de Derecho con actividades.
19. `19_curso_arquitectura_arq101.png` — Asignatura de Arquitectura con actividades.
20. `20_curso_mineria_min101.png` — Asignatura de Ing. Minera con actividades.

---

## 8. Autoría y Soporte Técnico

* **Responsable:** Alfredo Llanos Taca
* **Carrera:** Auditoría / Ingeniería de Sistemas — INF 881
* **Repositorio:** [https://github.com/Alfred67605/PROYECTO-MOODLE](https://github.com/Alfred67605/PROYECTO-MOODLE)
