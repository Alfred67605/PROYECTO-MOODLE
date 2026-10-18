# FICHA TÉCNICA Y REFERENCIA OFICIAL: ISO/IEC/IEEE 12207:2026

## 1. Identificación de la Norma
- **Código:** ISO/IEC/IEEE 12207:2026
- **Título Oficial:** Systems and software engineering — Software life cycle processes
- **Organización Emisora:** ISO/IEC JTC 1/SC 7 y IEEE Computer Society
- **Estado:** Estándar internacional vigente
- **Enlace Oficial:** https://www.iso.org/standard/63711.html

## 2. Alcance y Procesos del Ciclo de Vida
Establece un marco común para los procesos del ciclo de vida del software, con una terminología bien definida que puede ser referenciada por la industria del software. Contiene procesos, actividades y tareas aplicables durante la adquisición, suministro, desarrollo, operación, mantenimiento y retiro de productos de software.

Grupos de Procesos Clave:
1. **Procesos de Acuerdo (Acquisition, Supply)**.
2. **Procesos Organizacionales que habilitan el proyecto (Life Cycle Model Management, Infrastructure, Quality Management)**.
3. **Procesos Técnicos y de Gestión de Proyectos (Project Planning, Risk Management, Configuration Management, Measurement)**.
4. **Procesos Técnicos (Stakeholder Needs, Requirements Analysis, Architecture Definition, Implementation, Integration, Verification, Transition, Operation, Maintenance)**.

## 3. Aplicación a la Auditoría de Despliegue de Moodle 5.3
- **Proceso de Transición e Instalación:** Despliegue repetible y reproducible del entorno Moodle + PostgreSQL.
- **Gestión de Configuración:** Control de versiones inmutable (Git tag `v5.3.0`, SHA del commit, inventario de código en `INVENTARIO_CODIGO.md`).
- **Verificación y Validación:** Pruebas funcionales integrales de roles (admin, profesor, estudiante) y actividades (tarea, foro, cuestionario).
- **Proceso de Mantenimiento:** Ejecución periódica del cron, respaldo consistente de base de datos y moodledata.

## 4. Clasificación Legal y Derechos de Autor
> **AVISO DE CUMPLIMIENTO LEGAL:** No se distribuyen textos normativos completos de la norma. Se registran las referencias formales conforme a las reglas del proyecto.
