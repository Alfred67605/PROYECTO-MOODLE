<?php
/**
 * Catálogo Académico Curado: 500 Materias UATF
 * Moodle 5.3 Laboratorio de Auditoría ISO
 */

function get_uatf_courses_catalog() {
    $courses = [];

    // 1. FCEFA (60 Cursos)
    $fcefaSubjects = [
        // Auditoría - Contaduría Pública (Potosí) - 15 materias
        ['FCEFA-AUD', 'AUD-102', 'Contabilidad Básica', ['Ecuación Contable', 'Libro Diario y Mayor', 'Balance de Comprobación', 'Estados Financieros Básicos']],
        ['FCEFA-AUD', 'AUD-103', 'Contabilidad Intermedia', ['Tratamiento de Activos', 'Tratamiento de Pasivos', 'Patrimonio Neto', 'Ajustes Contables']],
        ['FCEFA-AUD', 'AUD-201', 'Auditoría Financiera I', ['Marco Teórico', 'Control Interno', 'Procedimientos de Auditoría', 'Papeles de Trabajo']],
        ['FCEFA-AUD', 'AUD-202', 'Auditoría Financiera II', ['Auditoría de Activos', 'Auditoría de Pasivos', 'Auditoría de Resultados', 'Dictamen del Auditor']],
        ['FCEFA-AUD', 'AUD-301', 'Auditoría Tributaria', ['Código Tributario Boliviano', 'Impuesto al Valor Agregado', 'Impuesto a las Utilidades', 'Fiscalizaciones y Recursos']],
        ['FCEFA-AUD', 'AUD-302', 'Contabilidad de Costos I', ['Elementos del Costo', 'Materia Prima y Mano de Obra', 'Costos Indirectos', 'Sistemas por Órdenes']],
        ['FCEFA-AUD', 'AUD-303', 'Contabilidad de Costos II', ['Costos por Procesos', 'Costos Estándar', 'Costeo ABC', 'Punto de Equilibrio']],
        ['FCEFA-AUD', 'AUD-401', 'Auditoría Operativa y de Gestión', ['Eficiencia y Eficacia', 'Indicadores de Gestión', 'Examen Operacional', 'Informe de Auditoría Operativa']],
        ['FCEFA-AUD', 'AUD-402', 'Auditoría Forense y Delitos Financieros', ['Tipologías de Fraude', 'Evidencia Forense Digital', 'Lavado de Dinero', 'Peritaje Contable Judicial']],
        ['FCEFA-AUD', 'AUD-403', 'Gabinete de Auditoría', ['Planificación Estratégica', 'Ejecución de Pruebas', 'Hallazgos de Auditoría', 'Emisión de Dictamen']],
        ['FCEFA-AUD', 'AUD-501', 'Normas Internacionales de Información Financiera (NIIF)', ['Marco Conceptual NIIF', 'NIIF para PYMES', 'Instrumentos Financieros', 'Consolidación de Balances']],
        ['FCEFA-AUD', 'AUD-502', 'Auditoría Ambiental y Social', ['Norma ISO 14001', 'Responsabilidad Social Empresarial', 'Pasivos Ambientales', 'Dictamen Socioambiental']],
        ['FCEFA-AUD', 'AUD-503', 'Contabilidad Gubernamental Integrada', ['Ley 1178 (SAFCO)', 'Subsistema de Presupuesto', 'Contabilidad Integrada', 'Auditoría Gubernamental']],
        ['FCEFA-AUD', 'AUD-504', 'Auditoría de Sistemas Contables', ['Control Interno en TI', 'Riesgos Tecnológicos', 'Pruebas Asistidas por Computador', 'Seguridad de Datos Contables']],
        ['FCEFA-AUD', 'AUD-505', 'Ética Profesional y Deontología Contable', ['Código de Ética IFAC', 'Independencia del Auditor', 'Secreto Profesional', 'Responsabilidad Civil y Penal']],

        // Administración de Empresas (Potosí) - 12 materias
        ['FCEFA-ADM', 'ADM-101', 'Teoría General de la Administración', ['Escuelas Clásicas', 'Enfoque Humanístico', 'Enfoque Contingencial', 'Tendencias Modernas']],
        ['FCEFA-ADM', 'ADM-102', 'Administración Pública', ['Modelos de Estado', 'Gestión por Resultados', 'Contrataciones Estatales', 'Políticas Públicas']],
        ['FCEFA-ADM', 'ADM-201', 'Gestión del Talento Humano I', ['Reclutamiento y Selección', 'Diseño de Puestos', 'Evaluación del Desempeño', 'Capacitación']],
        ['FCEFA-ADM', 'ADM-202', 'Gestión del Talento Humano II', ['Compensaciones y Salarios', 'Clima Organizacional', 'Relaciones Laborales', 'Desarrollo Organizacional']],
        ['FCEFA-ADM', 'ADM-301', 'Organización y Métodos', ['Estructuras Organizativas', 'Manuales Administrativos', 'Flujogramación de Procesos', 'Reingeniería']],
        ['FCEFA-ADM', 'ADM-302', 'Dirección Estratégica', ['Diagnóstico Estratégico (FODA)', 'Formulación de Estrategias', 'Implementación Estratégica', 'Control Estratégico']],
        ['FCEFA-ADM', 'ADM-401', 'Mercadotecnia Estratégica', ['Investigación de Mercados', 'Segmentación y Posicionamiento', 'Marketing Mix (4P)', 'Marketing Digital']],
        ['FCEFA-ADM', 'ADM-402', 'Administración de Operaciones y Producción', ['Planificación de la Capacidad', 'Control de Inventarios (JIT)', 'Gestión de Calidad (ISO 9001)', 'Mantenimiento y Seguridad']],
        ['FCEFA-ADM', 'ADM-403', 'Finanzas Corporativas', ['Análisis de Estados Financieros', 'Capital de Trabajo', 'Estructura de Capital', 'Valoración de Empresas']],
        ['FCEFA-ADM', 'ADM-501', 'Preparación y Evaluación de Proyectos', ['Estudio de Mercado', 'Estudio Técnico y Organizacional', 'Evaluación Financiera (VAN, TIR)', 'Análisis de Sensibilidad']],
        ['FCEFA-ADM', 'ADM-502', 'Comportamiento Organizacional', ['Percepción y Motivación', 'Liderazgo y Poder', 'Dinámica de Grupos', 'Gestión del Cambio']],
        ['FCEFA-ADM', 'ADM-503', 'Negociación y Resolución de Conflictos', ['Modelos de Negociación', 'Técnicas de Mediación', 'Comunicación Asertiva', 'Acuerdos Comerciales']],

        // Economía (Potosí) - 10 materias
        ['FCEFA-ECO', 'ECO-101', 'Microeconomía I', ['Teoría del Consumidor', 'Preferencias y Utilidad', 'Demanda del Mercado', 'Elasticidades']],
        ['FCEFA-ECO', 'ECO-102', 'Microeconomía II', ['Teoría de la Producción', 'Costos de Producción', 'Competencia Perfecta', 'Monopolio y Oligopolio']],
        ['FCEFA-ECO', 'ECO-201', 'Macroeconomía I', ['Cuentas Nacionales', 'Modelo IS-LM', 'Demanda Agregada', 'Inflación y Desempleo']],
        ['FCEFA-ECO', 'ECO-202', 'Macroeconomía II', ['Economía Abierta (Mundell-Fleming)', 'Políticas Fiscal y Monetaria', 'Teorías del Crecimiento', 'Ciclos Económicos']],
        ['FCEFA-ECO', 'ECO-301', 'Econometría I', ['Modelo Lineal Clásico', 'Mínimos Cuadrados Ordinarios', 'Inferencia Estadística', 'Pruebas de Hipótesis']],
        ['FCEFA-ECO', 'ECO-302', 'Econometría II', ['Heterocedasticidad y Autocorrelación', 'Multicolinealidad', 'Series de Tiempo', 'Modelos ARIMA']],
        ['FCEFA-ECO', 'ECO-401', 'Comercio Internacional', ['Ventajas Comparativas (Ricardianas)', 'Modelo Heckscher-Ohlin', 'Aranceles y Protección', 'Integración Económica Regional']],
        ['FCEFA-ECO', 'ECO-402', 'Economía del Desarrollo', ['Pobreza y Desigualdad', 'Capital Humano', 'Instituciones y Desarrollo', 'Políticas de Desarrollo en AL']],
        ['FCEFA-ECO', 'ECO-501', 'Política Económica Boliviana', ['Modelo Económico Plural', 'Industrialización de Recursos', 'Sector Hidrocarburos y Litio', 'Balanza de Pagos']],
        ['FCEFA-ECO', 'ECO-502', 'Historia Económica de Bolivia', ['Minería Colonial y Republicana', 'Nacionalización de Minas (1952)', 'El Modelo Neoliberal (DS 21060)', 'Economía Actual']],

        // Ingeniería Comercial (Potosí) - 8 materias
        ['FCEFA-ICO', 'ICO-101', 'Fundamentos de Comercio Exterior', ['Términos Internacionales (INCOTERMS)', 'Régimen Aduanero', 'Transporte y Logística Internacional', 'Financiamiento del Comercio']],
        ['FCEFA-ICO', 'ICO-201', 'Investigación de Mercados Cuantitativa', ['Muestreo Estadístico', 'Diseño de Encuestas', 'Análisis Multivariado', 'Interpretación de Datos']],
        ['FCEFA-ICO', 'ICO-301', 'Gestión de Ventas y Canales de Distribución', ['Estructura de la Fuerza de Ventas', 'Cadena de Suministro', 'E-commerce y B2B', 'Fidelización de Clientes']],
        ['FCEFA-ICO', 'ICO-302', 'Publicidad y Promoción Comercial', ['Estrategia Creativa', 'Medios Publicitarios', 'Métricas de Alcance y ROI', 'Campañas Omnicanal']],
        ['FCEFA-ICO', 'ICO-401', 'Comercio Electrónico y Plataformas Digitales', ['Pasarelas de Pago', 'Experiencia de Usuario (UX/UI)', 'Analítica Web', 'Legislación del Comercio Digital']],
        ['FCEFA-ICO', 'ICO-402', 'Inteligencia de Negocios y Big Data Comercial', ['Data Warehousing', 'Dashboards Comerciales', 'Modelos Predictivos de Venta', 'Herramientas BI']],
        ['FCEFA-ICO', 'ICO-501', 'Simulación de Negocios Internacionales', ['Escenarios Globales', 'Toma de Decisiones Competitivas', 'Estrategias de Precios', 'Evaluación de Rendimiento']],
        ['FCEFA-ICO', 'ICO-502', 'Marketing Internacional y Exportaciones', ['Entorno Cultural y Legal', 'Estrategias de Entrada', 'Branding Global', 'Promoción de Exportaciones']],

        // Sedes Desconcentradas FCEFA - 15 materias
        ['FCEFA-CT-TUP', 'CTT-101', 'Contabilidad General Aplicada (Tupiza)', ['Principios Contables', 'Registro Transaccional', 'Plan de Cuentas', 'Balance Inicial']],
        ['FCEFA-CT-TUP', 'CTT-201', 'Costos Agropecuarios (Tupiza)', ['Costeo Agrícola', 'Costeo Ganadero', 'Mermas y Rendimientos', 'Margen Bruto']],
        ['FCEFA-CT-TUP', 'CTT-301', 'Auditoría de Cooperativas (Tupiza)', ['Marco Regulatorio AFCOOP', 'Control Interno', 'Fondos de Reserva', 'Informe de Auditoría']],
        ['FCEFA-CT-TUP', 'CTT-401', 'Contabilidad Minera Regional (Tupiza)', ['Regalías Mineras', 'Costos de Exploración', 'Costos de Extracción', 'Tributación Minera']],
        ['FCEFA-CT-TUP', 'CTT-501', 'Taller de Práctica Contable (Tupiza)', ['Simulación Integral', 'Libros Electrónicos', 'Declaraciones Juradas SIAT', 'Cierre Contable']],

        ['FCEFA-EC-UYU', 'ECU-101', 'Introducción a la Economía Regional (Uyuni)', ['Geografía Económica', 'Circuito Turístico Uyuni', 'Sector Litio y Evaporíticos', 'Economía Local']],
        ['FCEFA-EC-UYU', 'ECU-201', 'Economía de los Recursos Evaporíticos (Uyuni)', ['Cadena del Litio', 'Mercado Global de Baterías', 'Impacto Fiscal y Regalías', 'Sostenibilidad Ambiental']],
        ['FCEFA-EC-UYU', 'ECU-301', 'Microeconomía Turística (Uyuni)', ['Oferta Hotelera y Gastronómica', 'Demanda Turística Internacional', 'Elasticidad de Precios', 'Externalidades']],
        ['FCEFA-EC-UYU', 'ECU-401', 'Formulación de Proyectos Turísticos (Uyuni)', ['Estudio de Factibilidad', 'Inversión en Infraestructura', 'Impacto Socioeconómico', 'Financiamiento']],
        ['FCEFA-EC-UYU', 'ECU-501', 'Planificación del Desarrollo Local (Uyuni)', ['Planes Municipales (PTDI)', 'Participación Comunitaria', 'Diversificación Productiva', 'Evaluación Ex-Post']],

        ['FCEFA-EC-UNC', 'ECN-101', 'Fundamentos de Economía Minera (Uncía)', ['Historia Minera de Llallagua-Uncía', 'Comercialización de Concentrados', 'Cotizaciones Internacionales', 'Minería Cooperativa']],
        ['FCEFA-EC-UNC', 'ECN-201', 'Economía Laboral y Sindical (Uncía)', ['Mercado de Trabajo Minero', 'Salarios y Beneficios', 'Legislación Laboral', 'Seguridad Social']],
        ['FCEFA-EC-UNC', 'ECN-301', 'Finanzas Públicas Municipales (Uncía)', ['Recursos de Coparticipación', 'Impuestos Municipales', 'Gasto Social', 'Control Fiscal']],
        ['FCEFA-EC-UNC', 'ECN-401', 'Economía Solidaria y Comunitaria (Uncía)', ['Organizaciones Económicas Campesinas', 'Comercio Justo', 'Microcrédito Rural', 'Soberanía Alimentaria']],
        ['FCEFA-EC-UNC', 'ECN-501', 'Seminario de Grado en Economía Regional (Uncía)', ['Metodología de Investigación', 'Diseño de Tesis', 'Análisis de Datos', 'Defensa']]
    ];

    foreach ($fcefaSubjects as $s) {
        $courses[] = ['car_code' => $s[0], 'code' => $s[1], 'name' => $s[2], 'units' => $s[3], 'summary' => "Estudio integral de {$s[2]} conforme al plan curricular de la Facultad de Ciencias Económicas, Financieras y Administrativas."];
    }

    // 2. FCP - Ciencias Puras (50 Cursos)
    $fcpSubjects = [
        // Informática (Potosí) - 15 materias
        ['FCP-INF', 'INF-111', 'Arquitectura de Computadoras', ['Sistemas Numéricos', 'Procesador y ALU', 'Memoria y Caché', 'Buses y Periféricos']],
        ['FCP-INF', 'INF-112', 'Programación Básica', ['Variables y Tipos', 'Control de Flujo', 'Funciones y Recursión', 'Punteros y Memoria']],
        ['FCP-INF', 'INF-121', 'Estructuras de Datos Discretas', ['Grafos y Árboles', 'Combinatoria y Recurrencias', 'Lógica de Predicados', 'Autómatas Finitos']],
        ['FCP-INF', 'INF-122', 'Programación Orientada a Objetos', ['Clases y Objetos', 'Herencia y Polimorfismo', 'Sobrecarga y Genéricos', 'Patrones de Diseño']],
        ['FCP-INF', 'INF-231', 'Sistemas Operativos', ['Gestión de Procesos y Hilos', 'Sincronización y Deadlocks', 'Gestión de Memoria Virtual', 'Sistemas de Archivos']],
        ['FCP-INF', 'INF-232', 'Base de Datos I', ['Modelo Entidad-Relación', 'Álgebra Relacional', 'SQL Avanzado', 'Normalización (1FN-BCNF)']],
        ['FCP-INF', 'INF-241', 'Base de Datos II', ['Transacciones y Concurrencia', 'Índices B-Tree y Hash', 'Bases NoSQL (MongoDB)', 'Seguridad y Replicación']],
        ['FCP-INF', 'INF-242', 'Redes de Computadoras I', ['Modelo OSI y TCP/IP', 'Capa de Enlace y Ethernet', 'Enrutamiento IPv4/IPv6', 'Capa de Transporte (TCP/UDP)']],
        ['FCP-INF', 'INF-351', 'Redes de Computadoras II', ['Protocolos de Aplicación (DNS, HTTP)', 'Seguridad en Redes (Firewalls/IPsec)', 'Redes Inalámbricas', 'SDN y Virtualización']],
        ['FCP-INF', 'INF-352', 'Ingeniería de Software I', ['Ciclos de Vida y Metodologías Ágiles', 'Ingeniería de Requisitos', 'Modelado UML', 'Arquitectura de Software']],
        ['FCP-INF', 'INF-361', 'Ingeniería de Software II', ['Pruebas Unitarias y E2E', 'Integración Continua (CI/CD)', 'Métricas de Software', 'Mantenimiento y Refactorización']],
        ['FCP-INF', 'INF-362', 'Inteligencia Artificial', ['Búsqueda Heurística (A*)', 'Juegos y Minimax', 'Sistemas Expertos', 'Lógica Difusa']],
        ['FCP-INF', 'INF-471', 'Aprendizaje Automático (Machine Learning)', ['Regresión y Clasificación', 'Árboles de Decisión y Random Forest', 'Redes Neuronales Artificiales', 'Clustering y K-Means']],
        ['FCP-INF', 'INF-472', 'Seguridad en Sistemas Informáticos', ['Criptografía Simétrica y Asimétrica', 'Autenticación y RBAC', 'Análisis de Vulnerabilidades (OWASP)', 'Forense Digital']],
        ['FCP-INF', 'INF-581', 'Taller de Grado en Informática', ['Definición del Problema', 'Estado del Arte', 'Desarrollo de la Solución', 'Evaluación de Resultados']],

        // Química (Potosí) - 10 materias
        ['FCP-QMC', 'QMC-101', 'Química General I', ['Estructura Atómica', 'Tabla Periódica', 'Enlace Químico', 'Estequiometría']],
        ['FCP-QMC', 'QMC-102', 'Química Inorgánica', ['Compuestos de Coordinación', 'Química de Elementos Representativos', 'Metales de Transición', 'Reactividad Inorgánica']],
        ['FCP-QMC', 'QMC-201', 'Química Orgánica I', ['Hidrocarburos Alifáticos', 'Esterioquímica', 'Grupos Funcionales', 'Mecanismos de Reacción']],
        ['FCP-QMC', 'QMC-202', 'Química Orgánica II', ['Compuestos Aromáticos', 'Aldehídos y Cetonas', 'Ácidos Carboxílicos', 'Biomoléculas']],
        ['FCP-QMC', 'QMC-301', 'Fisicoquímica I', ['Termodinámica Química', 'Entalpía y Entropía', 'Equilibrio de Fases', 'Soluciones']],
        ['FCP-QMC', 'QMC-302', 'Fisicoquímica II', ['Cinética Química', 'Electroquímica', 'Fenómenos de Superficie', 'Catálisis']],
        ['FCP-QMC', 'QMC-401', 'Química Analítica Cualitativa', ['Equilibrio Iónico', 'Marchas Analíticas', 'Precipitación Fraccionada', 'Complejometría']],
        ['FCP-QMC', 'QMC-402', 'Química Analítica Cuantitativa', ['Gravimetría', 'Volumetría Ácido-Base', 'Redoximetría', 'Tratamiento de Datos']],
        ['FCP-QMC', 'QMC-501', 'Análisis Instrumental', ['Espectrofotometría UV-Vis', 'Espectrometría de Absorción Atómica', 'Cromatografía de Gases', 'HPLC']],
        ['FCP-QMC', 'QMC-502', 'Química Ambiental', ['Contaminación del Agua', 'Química de la Atmósfera', 'Desechos Químicos', 'Remediación Química']],

        // Física (Potosí) - 9 materias
        ['FCP-FIS', 'FIS-101', 'Física General I (Mecánica)', ['Cinemática', 'Dinámica y Leyes de Newton', 'Trabajo y Energía', 'Dinámica de Rotación']],
        ['FCP-FIS', 'FIS-102', 'Física General II (Termodinámica y Fluidos)', ['Estática de Fluidos', 'Dinámica de Fluidos', 'Calor y Temperatura', 'Leyes de la Termodinámica']],
        ['FCP-FIS', 'FIS-201', 'Física General III (Electromagnetismo)', ['Campo Eléctrico y Ley de Gauss', 'Potencial Eléctrico', 'Leyes de Ampere y Faraday', 'Ecuaciones de Maxwell']],
        ['FCP-FIS', 'FIS-202', 'Física General IV (Ondas y Óptica)', ['Movimiento Armónico Simple', 'Ondas Mecánicas y Sonoras', 'Óptica Geométrica', 'Interferencia y Difracción']],
        ['FCP-FIS', 'FIS-301', 'Mecánica Clásica', ['Coordenadas Generalizadas', 'Ecuaciones de Lagrange', 'Formalismo Hamiltoniano', 'Oscilaciones Acopladas']],
        ['FCP-FIS', 'FIS-302', 'Electrodinámica Clásica', ['Electrostática en Dieléctricos', 'Magnetostática', 'Radiación Electromagnética', 'Teoría Especial de Relatividad']],
        ['FCP-FIS', 'FIS-401', 'Mecánica Cuántica I', ['Dualidad Onda-Partícula', 'Ecuación de Schrödinger', 'Pozos y Barreras de Potencial', 'Oscilador Armónico Cuántico']],
        ['FCP-FIS', 'FIS-402', 'Física Estadística', ['Conjunto Microcanónico', 'Conjunto Canónico', 'Estadísticas de Fermi-Dirac y Bose-Einstein', 'Transiciones de Fase']],
        ['FCP-FIS', 'FIS-501', 'Física del Estado Sólido', ['Estructura Cristalina', 'Fonones y Vibraciones de Red', 'Teoría de Bandas', 'Semiconductores']],

        // Matemática (Potosí) - 8 materias
        ['FCP-MAT', 'MAT-101', 'Álgebra Superior', ['Conjuntos y Relaciones', 'Estructuras Algebraicas', 'Polinomios', 'Teoría de Números']],
        ['FCP-MAT', 'MAT-102', 'Cálculo Diferencial e Integral I', ['Límites y Continuidad', 'Derivadas y Aplicaciones', 'Integrales Indefinidas', 'Teorema Fundamental del Cálculo']],
        ['FCP-MAT', 'MAT-201', 'Cálculo Multivariable', ['Cálculo Vectorial', 'Derivadas Parciales', 'Integrales Múltiples', 'Teoremas de Green, Stokes y Gauss']],
        ['FCP-MAT', 'MAT-202', 'Álgebra Lineal', ['Espacios Vectoriales', 'Transformaciones Lineales', 'Autovalores y Autovectores', 'Diagonalización']],
        ['FCP-MAT', 'MAT-301', 'Ecuaciones Diferenciales Ordinarias', ['Ecuaciones de Primer Orden', 'Ecuaciones Lineales de Orden Superior', 'Transformada de Laplace', 'Sistemas de EDO']],
        ['FCP-MAT', 'MAT-302', 'Análisis Real', ['Topología de la Recta Real', 'Sucesiones y Series', 'Convergencia Uniforme', 'Integral de Riemann']],
        ['FCP-MAT', 'MAT-401', 'Variable Compleja', ['Funciones Holomorfas', 'Ecuaciones de Cauchy-Riemann', 'Series de Taylor y Laurent', 'Teorema del Residuo']],
        ['FCP-MAT', 'MAT-501', 'Análisis Numérico', ['Solución de Ecuaciones No Lineales', 'Interpolación y Ajuste', 'Diferenciación e Integración Numérica', 'Solución Numérica de EDO']],

        // Estadística (Potosí) - 8 materias
        ['FCP-EST', 'EST-101', 'Estadística Descriptiva', ['Medidas de Tendencia Central', 'Medidas de Dispersión', 'Tablas de Frecuencia', 'Gráficos Estadísticos']],
        ['FCP-EST', 'EST-102', 'Probabilidades', ['Espacios Muestrales', 'Variables Aleatorias', 'Distribuciones Discretas', 'Distribuciones Continuas']],
        ['FCP-EST', 'EST-201', 'Inferencia Estadística I', ['Distribuciones Muestrales', 'Estimación Puntual', 'Estimación por Intervalos', 'Propiedades de los Estimadores']],
        ['FCP-EST', 'EST-202', 'Inferencia Estadística II', ['Pruebas de Hipótesis Paramétricas', 'Pruebas No Paramétricas', 'Análisis de Varianza (ANOVA)', 'Bondad de Ajuste']],
        ['FCP-EST', 'EST-301', 'Modelos Lineales y Regresión', ['Regresión Lineal Simple', 'Regresión Múltiple', 'Diagnóstico de Modelos', 'Regresión Logística']],
        ['FCP-EST', 'EST-302', 'Diseño de Experimentos', ['Diseño Completamente al Azar', 'Diseño en Bloques', 'Experimentos Factoriales', 'Superficies de Respuesta']],
        ['FCP-EST', 'EST-401', 'Muestreo Estadístico', ['Muestreo Aleatorio Simple', 'Muestreo Estratificado', 'Muestreo por Conglomerados', 'Errores de Muestreo']],
        ['FCP-EST', 'EST-501', 'Minería de Datos Estadísticos', ['Preprocesamiento de Datos', 'Reducción de Dimensionalidad (PCA)', 'Reglas de Asociación', 'Modelos Predictivos']]
    ];

    foreach ($fcpSubjects as $s) {
        $courses[] = ['car_code' => $s[0], 'code' => $s[1], 'name' => $s[2], 'units' => $s[3], 'summary' => "Estudio riguroso de {$s[2]} correspondiente a la carrera de Ciencias Puras."];
    }

    // 3. VIC - Vicerrectorado (45 Cursos)
    $vicSubjects = [
        // Sistemas Potosí - 15 materias
        ['VIC-SIS', 'SIS-111', 'Introducción a la Programación', ['Lógica Algorítmica', 'Estructuras de Control', 'Modularidad y Funciones', 'Arreglos y Matrices']],
        ['VIC-SIS', 'SIS-211', 'Estructura de Datos', ['Listas Enlazadas', 'Pilas y Colas', 'Árboles Binarios y AVL', 'Grafos y Algoritmos']],
        ['VIC-SIS', 'SIS-221', 'Base de Datos Transaccionales', ['Modelo Relacional', 'Normalización', 'Procedimientos Almacenados y Triggers', 'Seguridad en BD']],
        ['VIC-SIS', 'SIS-222', 'Análisis y Diseño de Sistemas', ['Modelado de Negocio', 'Requisitos de Software', 'Diseño de Arquitectura', 'Prototipado UI/UX']],
        ['VIC-SIS', 'SIS-311', 'Redes de Datos y Comunicaciones', ['Topologías y Cableado', 'Enrutamiento y Conmutación', 'Protocolos IP', 'Servicios de Red']],
        ['VIC-SIS', 'SIS-312', 'Programación Web y Móvil', ['Frontend Moderno', 'Backend y APIs REST', 'Desarrollo Híbrido Móvil', 'Despliegue Cloud']],
        ['VIC-SIS', 'SIS-321', 'Sistemas de Información Empresarial (ERP/CRM)', ['Arquitectura ERP', 'Procesos de Cadena de Suministro', 'Gestión de Clientes', 'Integración de Datos']],
        ['VIC-SIS', 'SIS-322', 'Ingeniería de Requisitos y Calidad', ['Técnicas de Elicitación', 'Historias de Usuario', 'Modelos CMMI e ISO 25010', 'Pruebas de Aceptación']],
        ['VIC-SIS', 'SIS-411', 'Gestión de Proyectos de Software (PMI/Scrum)', ['Fundamentos Scrum', 'Estimación y Planificación de Sprints', 'Gestión de Riesgos', 'Monitoreo de Proyectos']],
        ['VIC-SIS', 'SIS-412', 'Auditoría y Seguridad de Sistemas', ['Normas ISO 27001 e ISO 19011', 'Gestión de Riesgos ISO 27005', 'Controles Técnicos y Físicos', 'Dictamen de Auditoría']],
        ['VIC-SIS', 'SIS-421', 'Inteligencia de Negocios y Analítica', ['ETL y Almacenes de Datos', 'Modelos Multidimensionales (OLAP)', 'Minería de Datos', 'Visualización Ejecutiva']],
        ['VIC-SIS', 'SIS-422', 'Computación en la Nube y DevOps', ['Infraestructura como Código', 'Contenedores Docker y Kubernetes', 'Pipelines CI/CD', 'Monitoreo Cloud']],
        ['VIC-SIS', 'SIS-511', 'Gobernanza de TI (COBIT/ITIL)', ['Marco COBIT', 'Gestión de Servicios ITIL', 'Alineación Estratégica', 'Métricas de Gobernanza']],
        ['VIC-SIS', 'SIS-512', 'Ciberseguridad y Hacking Ético', ['Fases de Pentesting', 'Ataques Web y de Red', 'Defensa en Profundidad', 'Respuesta a Incidentes']],
        ['VIC-SIS', 'SIS-521', 'Taller de Graduación en Sistemas', ['Diseño Metodológico', 'Implementación de Prototipo', 'Validación Técnica', 'Sustentación de Tesis']],

        // Sistemas Tupiza - 10 materias
        ['VIC-SIS-TUP', 'SST-101', 'Algoritmos y Programación (Tupiza)', ['Variables y Lógica', 'Control de Flujo', 'Funciones', 'Estructuras Básicas']],
        ['VIC-SIS-TUP', 'SST-102', 'Bases de Datos para Aplicaciones (Tupiza)', ['Diseño Entidad-Relación', 'Consultas SQL', 'Integridad Referencial', 'Vistas y Triggers']],
        ['VIC-SIS-TUP', 'SST-201', 'Programación Orientada a Objetos (Tupiza)', ['Clases y Métodos', 'Encapsulamiento', 'Polimorfismo', 'Interfaces Gráficas']],
        ['VIC-SIS-TUP', 'SST-202', 'Redes de Área Local (Tupiza)', ['Direccionamiento IP', 'Configuración de Switches y Routers', 'VLANs', 'Seguridad Perimetral']],
        ['VIC-SIS-TUP', 'SST-301', 'Desarrollo Web Fullstack (Tupiza)', ['Arquitectura MVC', 'Servicios Web', 'Autenticación JWT', 'Despliegue']],
        ['VIC-SIS-TUP', 'SST-302', 'Sistemas de Información Geográfica (Tupiza)', ['Datos Espaciales', 'QGIS y PostGIS', 'Análisis Territorial', 'Cartografía Digital']],
        ['VIC-SIS-TUP', 'SST-401', 'Sistemas Agroinformáticos (Tupiza)', ['Sensores IoT para Riego', 'Monitoreo de Cultivos', 'Telemetría', 'Gestión de Datos Agrícolas']],
        ['VIC-SIS-TUP', 'SST-402', 'Gestión y Mantenimiento de TI (Tupiza)', ['Soporte Técnico', 'Mesa de Ayuda', 'Planes de Contingencia', 'Políticas de Respaldo']],
        ['VIC-SIS-TUP', 'SST-501', 'Comercio Electrónico Regional (Tupiza)', ['Plataformas de Pago QR', 'Tiendas en Línea', 'Marketing Digital Local', 'Logística']],
        ['VIC-SIS-TUP', 'SST-502', 'Proyecto Integrador de Sistemas (Tupiza)', ['Identificación de Necesidad', 'Construcción del Sistema', 'Pruebas con Usuarios', 'Documentación']],

        // Diseño y Programación Digital - 10 materias
        ['VIC-IDP', 'IDP-101', 'Fundamentos del Diseño Digital', ['Teoría del Color', 'Tipografía y Composición', 'Semiótica Visual', 'Herramientas Vectoriales']],
        ['VIC-IDP', 'IDP-102', 'Programación Creativa y Frontend', ['HTML5 Semántico', 'CSS3 Avanzado y Flexbox/Grid', 'JavaScript Interactivo', 'Animaciones Web']],
        ['VIC-IDP', 'IDP-201', 'Diseño de Experiencia de Usuario (UX)', ['Investigación con Usuarios', 'Mapas de Empatía', 'Arquitectura de Información', 'User Journey']],
        ['VIC-IDP', 'IDP-202', 'Diseño de Interfaces de Usuario (UI)', ['Design Systems', 'Prototipado Interactivo (Figma)', 'Microinteracciones', 'Accesibilidad Web']],
        ['VIC-IDP', 'IDP-301', 'Animación Digital 2D y Motion Graphics', ['Principios de la Animación', 'After Effects y Keyframing', 'Kinetic Typography', 'Renderizado']],
        ['VIC-IDP', 'IDP-302', 'Modelado y Animación 3D', ['Geometría y Mallas 3D', 'Texturizado y Materiales', 'Iluminación y Cámaras', 'Render en Blender']],
        ['VIC-IDP', 'IDP-401', 'Desarrollo de Videojuegos I', ['Motores de Juego (Unity/Unreal)', 'Física en Juegos', 'Scripting de Mecánicas', 'Diseño de Niveles']],
        ['VIC-IDP', 'IDP-402', 'Realidad Aumentada y Virtual (AR/VR)', ['Tecnología Inmersiva', 'Tracking Espacial', 'Interacciones en 3D', 'Aplicaciones Educativas']],
        ['VIC-IDP', 'IDP-501', 'Producción Multimedia Interactiva', ['Audio Digital y Edición', 'Video y Postproducción', 'Integración Multimedia', 'Narrativas Digitales']],
        ['VIC-IDP', 'IDP-502', 'Portafolio Profesional y Emprendimiento Digital', ['Identidad de Marca', 'Creación de Portafolio', 'Metodologías de Pitch', 'Propiedad Intelectual']],

        // Odontología (Potosí - Anual) - 10 materias
        ['VIC-ODO', 'ODO-101', 'Anatomía Dental y Oclusión', ['Morfología de Dientes Anteriores', 'Morfología de Dientes Posteriores', 'Oclusión y Articulación', 'Encerado Diagnóstico']],
        ['VIC-ODO', 'ODO-102', 'Histología y Embriología Bucomaxilofacial', ['Esmalte y Dentina', 'Pulpa Dental y Periodonto', 'Desarrollo Craneofacial', 'Glándulas Salivales']],
        ['VIC-ODO', 'ODO-201', 'Materiales Dentales y Biomateriales', ['Resinas Compuestas', 'Cementos Dentales', 'Materiales de Impresión', 'Aleaciones Metálicas']],
        ['VIC-ODO', 'ODO-202', 'Microbiología e Inmunología Oral', ['Flora Bucal Normal', 'Bacteriología de la Caries', 'Microbiología Periodontal', 'Bioseguridad en Odontología']],
        ['VIC-ODO', 'ODO-301', 'Operatoria Dental I', ['Clasificación de Cavidades', 'Técnicas Adhesivas', 'Restauraciones Estéticas', 'Protección Dentinopulpar']],
        ['VIC-ODO', 'ODO-302', 'Periodoncia I', ['Diagnóstico Periodontal', 'Enfermedad Gingival', 'Periodontitis', 'Terapia Periodontal Básica']],
        ['VIC-ODO', 'ODO-401', 'Endodoncia I', ['Patología Pulpar y Periapical', 'Apertura Cameral', 'Instrumentación de Conductos', 'Obturación Endodóntica']],
        ['VIC-ODO', 'ODO-402', 'Cirugía Bucal I', ['Anestesia Local y Técnicas', 'Exodoncia Simple y Compleja', 'Accidentes y Complicaciones', 'Manejo Postoperatorio']],
        ['VIC-ODO', 'ODO-501', 'Prótesis Dental Fija y Removible', ['Principios de Tallado', 'Impresiones Definitivas', 'Diseño de Prótesis Removible', 'Instalación y Ajustes']],
        ['VIC-ODO', 'ODO-502', 'Odontopediatría y Ortodoncia Preventiva', ['Manejo de Conducta Infantil', 'Terapia Pulpar en Dentición Temporal', 'Mantenedores de Espacio', 'Prevención de Maloclusiones']]
    ];

    foreach ($vicSubjects as $s) {
        $courses[] = ['car_code' => $s[0], 'code' => $s[1], 'name' => $s[2], 'units' => $s[3], 'summary' => "Formación académica de {$s[2]} dependiente de los programas de Vicerrectorado de la UATF."];
    }

    // 4. Facultad de Ingeniería (40 Cursos)
    $fiSubjects = [
        // Civil (Potosí) - 20 materias
        ['FI-CIV', 'CIV-101', 'Topografía General', ['Medición de Distancias', 'Nivelación Geométrica', 'Teodolito y Estación Total', 'Planos Topográficos']],
        ['FI-CIV', 'CIV-102', 'Geología Aplicada a la Ingeniería Civil', ['Minerales y Rocas', 'Estructuras Geológicas', 'Riesgos Geológicos', 'Mapeo para Obras']],
        ['FI-CIV', 'CIV-211', 'Resistencia de Materiales I', ['Esfuerzo y Deformación', 'Cargas Axiales', 'Torsión', 'Flexión en Vigas']],
        ['FI-CIV', 'CIV-212', 'Resistencia de Materiales II', ['Flexión Compuesta', 'Círculo de Mohr', 'Columnas y Pandeo', 'Energía de Deformación']],
        ['FI-CIV', 'CIV-221', 'Mecánica de Fluidos', ['Propiedades de Fluidos', 'Estática de Fluidos', 'Cinemática de Fluidos', 'Ecuación de Bernoulli']],
        ['FI-CIV', 'CIV-222', 'Hidráulica General', ['Flujo en Tuberías', 'Pérdidas de Carga', 'Sistemas de Bombeo', 'Golpe de Ariete']],
        ['FI-CIV', 'CIV-311', 'Mecánica de Suelos I', ['Propiedades Índice', 'Clasificación de Suelos (USCS/AASHTO)', 'Compactación de Suelos', 'Permeabilidad']],
        ['FI-CIV', 'CIV-312', 'Mecánica de Suelos II', ['Consolidación Unidimensional', 'Resistencia al Corte', 'Empuje de Tierras', 'Estabilidad de Taludes']],
        ['FI-CIV', 'CIV-321', 'Análisis Estructural I', ['Estructuras Isostáticas', 'Deformaciones en Vigas', 'Método de las Fuerzas', 'Líneas de Influencia']],
        ['FI-CIV', 'CIV-322', 'Análisis Estructural II', ['Método de Pendiente-Deflexión', 'Método de Cross', 'Método Matricial de Rigidez', 'Modelado Computacional']],
        ['FI-CIV', 'CIV-411', 'Hormigón Armado I', ['Propiedades del Hormigón', 'Diseño por Flexión (ACI 318)', 'Diseño por Cortante', 'Adherencia y Anclaje']],
        ['FI-CIV', 'CIV-412', 'Hormigón Armado II', ['Columnas y Flexocompresión', 'Zapatas Aisladas y Combinadas', 'Losas en Dos Direcciones', 'Muros de Contención']],
        ['FI-CIV', 'CIV-421', 'Ingeniería Sanitaria I (Agua Potable)', ['Demanda de Agua', 'Redes de Distribución', 'Tratamiento de Agua Potable', 'Estanques de Almacenamiento']],
        ['FI-CIV', 'CIV-422', 'Ingeniería Sanitaria II (Alcantarillado)', ['Redes Sanitarias y Pluviales', 'Tratamiento de Aguas Residuales', 'Lagunas de Oxidación', 'Lodos Activados']],
        ['FI-CIV', 'CIV-511', 'Carreteras y Pavimentos I', ['Diseño Geométrico Vial', 'Curvas Horizontales y Verticales', 'Movimiento de Tierras', 'Drenaje Vial']],
        ['FI-CIV', 'CIV-512', 'Carreteras y Pavimentos II', ['Pavimentos Flexibles (AASHTO 93)', 'Pavimentos Rígidos', 'Ensayos de Asfalto', 'Mantenimiento Vial']],
        ['FI-CIV', 'CIV-521', 'Estructuras Metálicas y de Madera', ['Propiedades del Acero Estructural', 'Diseño de Conexiones', 'Vigas y Columnas Metálicas', 'Estructuras de Madera']],
        ['FI-CIV', 'CIV-522', 'Puentes y Estructuras Especiales', ['Tipos de Puentes', 'Cargas Viales (AASHTO LRFD)', 'Diseño de Superestructura', 'Infraestructura y Estribos']],
        ['FI-CIV', 'CIV-523', 'Presas y Obras Hidráulicas', ['Tipos de Presas', 'Aliviaderos y Disipadores', 'Obras de Toma', 'Canales de Riego']],
        ['FI-CIV', 'CIV-524', 'Dirección y Supervisión de Obras', ['Planificación con MS Project', 'Presupuestos y APUs', 'Supervisión Técnica', 'Seguridad en Construcción']],

        // Construcciones Civiles - 10 materias
        ['FI-CCV', 'CCV-101', 'Materiales de Construcción', ['Áridos y Aglomerantes', 'Cementos Portland', 'Cerámicos y Vidrios', 'Ensayos de Laboratorio']],
        ['FI-CCV', 'CCV-102', 'Dibujo Técnico y Planos de Construcción', ['Simbología y Escalas', 'Planos de Arquitectura', 'Planos Estructurales', 'Planos de Instalaciones']],
        ['FI-CCV', 'CCV-201', 'Tecnología del Hormigón', ['Diseño de Mezclas', 'Aditivos Químicos', 'Colocación y Curado', 'Control de Calidad']],
        ['FI-CCV', 'CCV-202', 'Instalaciones Hidrosanitarias en Edificaciones', ['Agua Fría y Caliente', 'Desagüe Sanitario', 'Sistemas Hidroneumáticos', 'Normas Sanitarias']],
        ['FI-CCV', 'CCV-301', 'Instalaciones Eléctricas en Edificaciones', ['Circuitos Eléctricos Domiciliarios', 'Tableros de Distribución', 'Cálculo de Cargas', 'Puesta a Tierra']],
        ['FI-CCV', 'CCV-302', 'Cómputos Métricos y Presupuestos', ['Medición de Obra Gruesa', 'Medición de Obra Fina', 'Análisis de Precios Unitarios', 'Presupuesto General']],
        ['FI-CCV', 'CCV-401', 'Técnicas de Construcción en Obra Gruesa', ['Excavaciones y Fundaciones', 'Muros y Columnas', 'Encofrados', 'Vaciado de Losas']],
        ['FI-CCV', 'CCV-402', 'Técnicas de Construcción en Obra Fina', ['Revoques y Enlucidos', 'Pisos y Revestimientos', 'Cielorrasos', 'Carpintería y Pintura']],
        ['FI-CCV', 'CCV-501', 'Seguridad Industrial y Salud en la Construcción', ['EPP y Protección Colectiva', 'Trabajo en Alturas', 'Norma OHSAS / ISO 45001', 'Planes de Emergencia']],
        ['FI-CCV', 'CCV-502', 'Fiscalización y Control de Obras', ['Libro de Órdenes', 'Planillas de Avance', 'Modificaciones de Contrato', 'Recepción de Obra']],

        // Geodesia y Topografía - 10 materias
        ['FI-GYT', 'GYT-101', 'Topografía Aplicada a Obras', ['Replanteo de Ejes', 'Control Vertical', 'Curvas de Nivel', 'Perfiles Longitudinales']],
        ['FI-GYT', 'GYT-102', 'Trigonometría Esférica y Geometría', ['Sistemas de Coordenadas', 'Triangulación', 'Poligonales de Precisión', 'Cálculo de Áreas']],
        ['FI-GYT', 'GYT-201', 'Geodesia Satelital y GNSS/GPS', ['Sistemas GPS/GLONASS', 'Posicionamiento Estático y RTK', 'Estaciones de Referencia Continua', 'Postprocesamiento']],
        ['FI-GYT', 'GYT-202', 'Fotogrametría y Drones', ['Planificación de Vuelo Fotogramétrico', 'Puntos de Control Terrestre (GCP)', 'Ortomosaicos', 'Modelos Digitales de Elevación']],
        ['FI-GYT', 'GYT-301', 'Cartografía y Sistemas de Proyección', ['Elipsoides de Referencia (WGS84)', 'Proyección UTM', 'Escalas y Generalización', 'Edición de Mapas']],
        ['FI-GYT', 'GYT-302', 'Geodesia Física y Gravimetría', ['Campo Gravitatorio Terrestre', 'Geoide y Alturas Ortométricas', 'Anomalías de Gravedad', 'Nivelación de Alta Precisión']],
        ['FI-GYT', 'GYT-401', 'Topografía Subterránea y Minera', ['Orientación de Pozos y Galerías', 'Poligonales Subterráneas', 'Giroscopio Topográfico', 'Planes de Laboreo']],
        ['FI-GYT', 'GYT-402', 'Catastro Urbano y Rural', ['Levantamientos Catastrales', 'Saneamiento de Tierras (INRA)', 'Sistemas de Información Catastral', 'Valuación Fiscal']],
        ['FI-GYT', 'GYT-501', 'Teledetección Espacial e Imágenes Satelitales', ['Sensores Remotos', 'Índices de Vegetación (NDVI)', 'Clasificación Supervisada', 'Monitoreo Ambiental']],
        ['FI-GYT', 'GYT-502', 'Geodesia Aplicada a Grandes Obras', ['Control de Deformación de Presas', 'Topografía para Túneles', 'Alineamiento de Puentes', 'Redes Geodésicas Locales']]
    ];

    foreach ($fiSubjects as $s) {
        $courses[] = ['car_code' => $s[0], 'code' => $s[1], 'name' => $s[2], 'units' => $s[3], 'summary' => "Estudio técnico y práctico de {$s[2]} en la Facultad de Ingeniería de la UATF."];
    }

    // 5. Facultad de Ingeniería Tecnológica (45 Cursos)
    $fitSubjects = [
        // Eléctrica (10 materias)
        ['FIT-ELE', 'ELE-101', 'Circuitos Eléctricos I', ['Variables Eléctricas y Ley de Ohm', 'Leyes de Kirchhoff', 'Teoremas de Redes', 'Circuitos Transitorios']],
        ['FIT-ELE', 'ELE-102', 'Circuitos Eléctricos II', ['Análisis Senoidal en CA', 'Potencia Activa, Reactiva y Aparente', 'Factor de Potencia', 'Sistemas Trifásicos']],
        ['FIT-ELE', 'ELE-201', 'Electromagnetismo y Máquinas Eléctricas I', ['Circuitos Magnéticos', 'Transformadores Monofásicos y Trifásicos', 'Ensayos de Transformadores', 'Regulación y Rendimiento']],
        ['FIT-ELE', 'ELE-202', 'Máquinas Eléctricas II', ['Generadores Síncronos', 'Motores de Inducción', 'Máquinas de Corriente Continua', 'Control de Velocidad']],
        ['FIT-ELE', 'ELE-301', 'Sistemas Eléctricos de Potencia I', ['Modelado de Líneas de Transmisión', 'Flujo de Carga (Newton-Raphson)', 'Control de Tensión y Frecuencia', 'Estabilidad del Sistema']],
        ['FIT-ELE', 'ELE-302', 'Protección de Sistemas Eléctricos', ['Transformadores de Medida (TC/TT)', 'Relés de Sobrecorriente', 'Protección Diferencial', 'Protección de Distancia']],
        ['FIT-ELE', 'ELE-401', 'Subestaciones Eléctricas', ['Configuraciones de Barra', 'Interruptores y Seccionadores', 'Mallas de Puesta a Tierra', 'Servicios Auxiliares']],
        ['FIT-ELE', 'ELE-402', 'Instalaciones Eléctricas Industriales', ['Alimentadores y Tableros', 'Iluminación Industrial', 'Arranque de Motores', 'Compensación de Reactivos']],
        ['FIT-ELE', 'ELE-501', 'Energías Renovables y Generación Distribuida', ['Sistemas Fotovoltaicos', 'Energía Eólica', 'Pequeñas Centrales Hidroeléctricas', 'Almacenamiento de Energía']],
        ['FIT-ELE', 'ELE-502', 'Mercados Eléctricos y Regulación', ['Estructura del SIN en Bolivia', 'Tarifas y Costos Marginales', 'Despacho Económico', 'Calidad de Suministro']],

        // Mecánica (9 materias)
        ['FIT-MEC', 'MEC-101', 'Termodinámica Técnica', ['Primera Ley de la Termodinámica', 'Segunda Ley y Entropía', 'Ciclos de Gas (Otto, Diesel)', 'Ciclos de Vapor (Rankine)']],
        ['FIT-MEC', 'MEC-102', 'Mecanismos y Máquinas', ['Cinemática de Mecanismos', 'Trenes de Engranajes', 'Levas y Seguidores', 'Equilibrado de Rotores']],
        ['FIT-MEC', 'MEC-201', 'Diseño de Elementos de Máquinas I', ['Teorías de Falla por Fatiga', 'Diseño de Ejes y Chavetas', 'Tornillos y Uniones Atornilladas', 'Soldadura en Estructuras']],
        ['FIT-MEC', 'MEC-202', 'Diseño de Elementos de Máquinas II', ['Rodamientos y Cojinetes', 'Engranajes Cilíndricos y Cónicos', 'Transmisiones por Correas y Cadenas', 'Frenos y Embragues']],
        ['FIT-MEC', 'MEC-301', 'Transferencia de Calor', ['Conducción Unidimensional', 'Convección Forzada y Natural', 'Radiación Térmica', 'Intercambiadores de Calor']],
        ['FIT-MEC', 'MEC-302', 'Turbomáquinas y Máquinas Hidráulicas', ['Bombas Centrífugas', 'Turbinas Pelton, Francis y Kaplan', 'Cavitación y NPSH', 'Ventiladores Industriales']],
        ['FIT-MEC', 'MEC-401', 'Tecnología de Materiales Mecánicos', ['Diagrama Hierro-Carbono', 'Tratamientos Térmicos', 'Ensayos Mecánicos', 'Aleaciones no Ferrosas']],
        ['FIT-MEC', 'MEC-402', 'Procesos de Manufactura Mecánica', ['Mecanizado por Torneado y Fresado', 'Fundición y Moldeo', 'Conformado Plástico', 'Soldadura Avanzada']],
        ['FIT-MEC', 'MEC-501', 'Mantenimiento Mecánico Industrial', ['Mantenimiento Preventivo y RCM', 'Análisis de Vibraciones', 'Termografía Infrarroja', 'Tribología y Lubricación']],

        // Automotriz (8 materias)
        ['FIT-AUT', 'AUT-101', 'Motores de Combustión Interna I', ['Ciclo Teórico y Real', 'Sistemas de Distribución', 'Sistema de Lubricación', 'Sistema de Refrigeración']],
        ['FIT-AUT', 'AUT-102', 'Sistemas de Transmisión Automotriz', ['Embragues y Volantes', 'Cajas Manuales y Automáticas', 'Diferencial y Palieres', 'Tracción 4x4']],
        ['FIT-AUT', 'AUT-201', 'Sistemas de Frenos, Dirección y Suspensión', ['Frenos Hidráulicos y ABS', 'Dirección Asistida y EPS', 'Sistemas de Suspensión', 'Alineación y Balanceo']],
        ['FIT-AUT', 'AUT-202', 'Electricidad y Electrónica del Automóvil', ['Baterías y Sistemas de Carga', 'Sistema de Arranque', 'Redes Multiplexadas CAN Bus', 'Iluminación y Confort']],
        ['FIT-AUT', 'AUT-301', 'Sistemas de Inyección Electrónica Gasolina', ['Sensores y Actuadores', 'Unidad de Control (ECU)', 'Diagnóstico OBD-II', 'Inyección Directa (GDI)']],
        ['FIT-AUT', 'AUT-302', 'Sistemas de Inyección Electrónica Diesel', ['Sistemas Common Rail', 'Inyectores Piezoeléctricos', 'Filtros DPF y AdBlue', 'Turbocompresores e Intercooler']],
        ['FIT-AUT', 'AUT-401', 'Vehículos Híbridos y Eléctricos', ['Baterías de Tracción Litio-Ion', 'Motores Eléctricos Síncronos', 'Inversores de Potencia', 'Seguridad en Alta Tensión']],
        ['FIT-AUT', 'AUT-501', 'Laboratorio de Diagnóstico Automotriz', ['Uso de Escáner y Osciloscopio', 'Análisis de Emisiones', 'Pruebas en Banco Dinamométrico', 'Reparación de Averías']],

        // Mecatrónica (9 materias)
        ['FIT-MCT', 'MCT-101', 'Sensores y Acondicionamiento de Señales', ['Sensores Resistivos y Capacitivos', 'Amplificadores Operacionales', 'Filtros Activos', 'Conversores ADC/DAC']],
        ['FIT-MCT', 'MCT-102', 'Actuadores y Accionamientos Eléctricos', ['Motores Paso a Paso', 'Servomotores Industriales', 'Drivers de Potencia', 'Sistemas Neumáticos y Electroneumáticos']],
        ['FIT-MCT', 'MCT-201', 'Microcontroladores y Sistemas Embebidos', ['Arquitectura ARM y AVR', 'Programación en C Embebido', 'Timers e Interrupciones', 'Comunicaciones UART, I2C, SPI']],
        ['FIT-MCT', 'MCT-202', 'Teoría de Control Automático', ['Modelado en Transformada de Laplace', 'Respuesta Temporal y Frecuencial', 'Criterio de Routh-Hurwitz', 'Controladores PID']],
        ['FIT-MCT', 'MCT-301', 'Automatización Industrial con PLCs', ['Lenguajes IEC 61131-3 (Ladder)', 'Instrucciones Lógicas y Temporizadores', 'Entradas/Salidas Analógicas', 'Redes Industriales (Modbus/Profinet)']],
        ['FIT-MCT', 'MCT-302', 'Sistemas SCADA e Interfaces HMI', ['Diseño de Pantallas HMI', 'Adquisición de Datos en Tiempo Real', 'Gestión de Alarmas y Tendencias', 'Bases de Datos Industriales']],
        ['FIT-MCT', 'MCT-401', 'Robótica Industrial', ['Cinemática Directa e Inversa (Denavit-Hartenberg)', 'Dinámica de Manipuladores', 'Generación de Trayectorias', 'Programación de Robots Industriales']],
        ['FIT-MCT', 'MCT-402', 'Visión Artificial para Robótica', ['Procesamiento Digital de Imágenes', 'Detección de Bordes y Formas', 'Reconocimiento de Patrones (OpenCV)', 'Guiado de Robots por Visión']],
        ['FIT-MCT', 'MCT-501', 'Diseño de Sistemas Mecatrónicos Integrados', ['Ingeniería Concurrente', 'Prototipado Rápido', 'Pruebas Integradas', 'Validación del Producto']],

        // Electrónica (9 materias)
        ['FIT-ELT', 'ELT-101', 'Dispositivos y Circuitos Electrónicos I', ['Diodos Semiconductores', 'Transistores Bipolares (BJT)', 'Transistores de Efecto de Campo (FET)', 'Polarización y Amplificación']],
        ['FIT-ELT', 'ELT-102', 'Electrónica Analógica II', ['Amplificadores Multietapa', 'Realimentación Negativa', 'Osciladores y Generadores de Señal', 'Fuentes de Alimentación Reguladas']],
        ['FIT-ELT', 'ELT-201', 'Electrónica Digital I', ['Compuertas Lógicas y Álgebra Booleana', 'Circuitos Combinacionales (Multiplexores)', 'Flip-Flops y Registros', 'Contadores Síncronos y Asíncronos']],
        ['FIT-ELT', 'ELT-202', 'Electrónica Digital II y FPGAs', ['Lenguajes HDL (VHDL/Verilog)', 'Máquinas de Estado Finito', 'Dispositivos Lógicos Programables', 'Diseño en FPGA']],
        ['FIT-ELT', 'ELT-301', 'Electrónica de Potencia', ['Tiristores y Triacs', 'Rectificadores Controlados', 'Convertidores DC-DC (Buck/Boost)', 'Inversores PWM']],
        ['FIT-ELT', 'ELT-302', 'Sistemas de Telecomunicaciones', ['Modulaciones Analógicas (AM/FM)', 'Modulaciones Digitales (QPSK/QAM)', 'Líneas de Transmisión y Antenas', 'Propagación de Ondas Electromagnéticas']],
        ['FIT-ELT', 'ELT-401', 'Procesamiento Digital de Señales (DSP)', ['Transformada Z', 'Transformada Rápida de Fourier (FFT)', 'Filtros Digitales FIR e IIR', 'Arquitecturas DSP']],
        ['FIT-ELT', 'ELT-402', 'Instrumentación Electrónica', ['Puentes de Medida', 'Transductores y Calibración', 'Osciloscopios Digitales', 'Sistemas de Instrumentación Virtual']],
        ['FIT-ELT', 'ELT-501', 'Internet de las Cosas (IoT) y Redes Inalámbricas', ['Protocolos IoT (MQTT, CoAP)', 'Módulos WiFi/LoRa/ZigBee', 'Nube para Dispositivos Conectados', 'Seguridad en Dispositivos IoT']]
    ];

    foreach ($fitSubjects as $s) {
        $courses[] = ['car_code' => $s[0], 'code' => $s[1], 'name' => $s[2], 'units' => $s[3], 'summary' => "Estudio especializado de {$s[2]} en la Facultad de Ingeniería Tecnológica de la UATF."];
    }

    // 6. Facultad de Ingeniería Minera (30 Cursos)
    $fimSubjects = [
        ['FIM-MIN', 'MIN-101', 'Introducción a la Minería y Geología Minera', ['Historia Minera de Potosí', 'Yacimientos Minerales', 'Métodos de Exploración', 'Ciclo Minero']],
        ['FIM-MIN', 'MIN-102', 'Topografía Minera Subterránea', ['Alineamientos Bajo Tierra', 'Levantamiento de Chimeneas y Tajos', 'Planimetría Minera', 'Leyes Mineras']],
        ['FIM-MIN', 'MIN-201', 'Mecánica de Rocas I', ['Propiedades Físicas y Mecánicas', 'Clasificación Geomecánica (RMR, Q)', 'Tensiones In Situ', 'Rotura de Macizos Rocosos']],
        ['FIM-MIN', 'MIN-202', 'Mecánica de Rocas II', ['Sostenimiento con Pernos y Mallas', 'Shotcrete y Arcos de Acero', 'Monitoreo de Convergencias', 'Subsidencia Minera']],
        ['FIM-MIN', 'MIN-301', 'Perforación y Voladura de Rocas I', ['Equipos de Perforación', 'Explosivos Industriales (ANFO, Dinamita)', 'Accesorios de Voladura', 'Cálculo de Malla de Perforación']],
        ['FIM-MIN', 'MIN-302', 'Perforación y Voladura de Rocas II', ['Voladura Controlada', 'Vibraciones y Onda Aérea', 'Optimización de Fragmentación', 'Seguridad con Explosivos']],
        ['FIM-MIN', 'MIN-303', 'Explotación de Minas Subterráneas I', ['Corte y Relleno Ascendente', 'Tajeo por Subniveles', 'Hundimiento por Bloques', 'Diseño de Rampas y Piques']],
        ['FIM-MIN', 'MIN-304', 'Explotación de Minas Subterráneas II', ['Cámaras y Pilares', 'Hundimiento por Subniveles', 'Sistemas de Extracción', 'Planificación del Minado']],
        ['FIM-MIN', 'MIN-401', 'Ventilación de Minas', ['Atmósfera de la Mina', 'Gases Tóxicos y Polvo', 'Circuitos de Ventilación', 'Ventiladores Principales y Secundarios']],
        ['FIM-MIN', 'MIN-402', 'Carguío y Transporte Minero', ['Equipos LHD (Scooptrams)', 'Dumpers de Bajo Perfil', 'Transporte por Cintas y Locomotoras', 'Costos de Transporte']],
        ['FIM-MIN', 'MIN-403', 'Explotación de Minas a Cielo Abierto (Open Pit)', ['Diseño de Bancos y Bermas', 'Rampas de Acceso', 'Optimización de Pit (Lerchs-Grossmann)', 'Flotas de Camión y Pala']],
        ['FIM-MIN', 'MIN-404', 'Drenaje y Bombeo en Minas', ['Hidrología Subterránea', 'Cálculo de Caudales de Infiltración', 'Estaciones de Bombeo', 'Tratamiento de Aguas Ácidas']],
        ['FIM-MIN', 'MIN-501', 'Seguridad y Salud Ocupacional en Minería', ['Normativa Minera Boliviana', 'Identificación de Peligros (IPERC)', 'Prevención de Derrumbes', 'Comités Mixtos']],
        ['FIM-MIN', 'MIN-502', 'Evaluación de Yacimientos y Geoestadística', ['Modelamiento de Bloques', 'Variografía y Kriging', 'Estimación de Reservas', 'Curvas Tonelaje-Ley']],
        ['FIM-MIN', 'MIN-503', 'Economía Minera y Legislación', ['Código de Minería Boliviano', 'Contratos Mineros con AJAM', 'Regalías e Impuestos Mineros', 'Factibilidad Económica']],

        // Procesos de Materias Primas Minerales (15 materias)
        ['FIM-PMM', 'PMM-101', 'Química Metalúrgica', ['Termodinámica Metalúrgica', 'Diagramas de Pourbaix y Ellingham', 'Reacciones Redox en Metalurgia', 'Soluciones Acuosas']],
        ['FIM-PMM', 'PMM-102', 'Conminución y Molienda de Minerales', ['Chancado Primario y Secundario', 'Leyes de Trituración (Rittinger/Bond)', 'Molinos de Bolas y Barras', 'Clasificación en Hidrociclones']],
        ['FIM-PMM', 'PMM-201', 'Flotación de Minerales I', ['Fisicoquímica de Superficies', 'Reactivos de Flotación (Colectores/Espumantes)', 'Cinética de Flotación', 'Celdas de Flotación']],
        ['FIM-PMM', 'PMM-202', 'Flotación de Minerales II (Sulfuros Complejos)', ['Flotación Diferencial Plomo-Zinc-Plata', 'Flotación de Estaño', 'Control de pH y Depresores', 'Circuitos Rougher, Cleaner y Scavenger']],
        ['FIM-PMM', 'PMM-301', 'Concentración Gravimétrica y Magnética', ['Mesas Concentradoras Wilfley', 'Jigs y Espirales', 'Separación Magnética de Alta Intensidad', 'Concentradores Centrífugos (Knelson)']],
        ['FIM-PMM', 'PMM-302', 'Hidrometalurgia I (Lixiviación)', ['Cinética de Disolución', 'Lixiviación en Pilas y Tanques', 'Lixiviación Ácida de Cobre y Zinc', 'Factores de Extracción']],
        ['FIM-PMM', 'PMM-303', 'Hidrometalurgia II (Extracción por Solventes y EW)', ['Extracción por Solventes (SX)', 'Fase Orgánica y Acuosa', 'Electroobtención (EW)', 'Refinación Electrolítica']],
        ['FIM-PMM', 'PMM-401', 'Pirometalurgia I (Tostación y Fusión)', ['Secado y Calcinación', 'Tostación de Sulfuros', 'Fusión en Hornos Flash y Reverbero', 'Mata y Escoria']],
        ['FIM-PMM', 'PMM-402', 'Pirometalurgia II (Conversión y Refinación Fuego)', ['Conversión de Matas', 'Refinación a Fuego de Metales', 'Volatilización de Estaño', 'Hornos de Afino']],
        ['FIM-PMM', 'PMM-403', 'Metalurgia del Oro y la Plata', ['Cianuración de Metales Preciosos', 'Proceso Merrill-Crowe', 'Adsorción en Carbón Activado (CIP/CIL)', 'Fundición de Metal Doré']],
        ['FIM-PMM', 'PMM-404', 'Separación Sólido-Líquido', ['Espesamiento y Floculantes', 'Filtración por Presión y Vacío', 'Secado de Concentrados', 'Manejo de Efluentes']],
        ['FIM-PMM', 'PMM-501', 'Tratamiento y Disposición de Colas y Relaves', ['Diseño de Diques de Relaves', 'Relaves Espesados y Filtrados', 'Prevención de Drenaje Ácido (DAM)', 'Cierre Ambiental de Relaveras']],
        ['FIM-PMM', 'PMM-502', 'Control y Automatización de Plantas Metalúrgicas', ['Sensores de Densidad y Flujo', 'Analizadores en Línea (XRF)', 'Sistemas de Control Distribuido', 'Optimización de Recuperación']],
        ['FIM-PMM', 'PMM-503', 'Metalurgia de Minerales No Metálicos y Evaporíticos', ['Procesamiento de Ulexita y Boro', 'Cristalización Fraccionada de Salmueras', 'Extracción de Sulfato de Potasio', 'Carbonato de Litio']],
        ['FIM-PMM', 'PMM-504', 'Diseño de Plantas Concentradoras', ['Balances de Materia y Metalúrgicos', 'Selección y Dimensionamiento de Equipos', 'Distribución de Planta (Layout)', 'Evaluación Técnico-Económica']]
    ];

    foreach ($fimSubjects as $s) {
        $courses[] = ['car_code' => $s[0], 'code' => $s[1], 'name' => $s[2], 'units' => $s[3], 'summary' => "Especialidad en {$s[2]} para la formación en la Facultad de Ingeniería Minera de la UATF."];
    }

    // 7. Facultad de Ingeniería Geológica (30 Cursos)
    $figSubjects = [
        // Geológica (15 materias)
        ['FIG-GEO', 'GEO-101', 'Geología General', ['Origen de la Tierra', 'Tectónica de Placas', 'Procesos Endógenos y Exógenos', 'Tiempo Geológico']],
        ['FIG-GEO', 'GEO-102', 'Mineralogía General y Descriptiva', ['Cristalografía', 'Propiedades Físicas de Minerales', 'Sistemática Mineral', 'Asociaciones Minerales']],
        ['FIG-GEO', 'GEO-201', 'Petrología Ígnea y Metamórfica', ['Magmas y Vulcanismo', 'Rocas Ígneas Plutónicas', 'Procesos Metamórficos', 'Facies Metamórficas']],
        ['FIG-GEO', 'GEO-202', 'Estratigrafía y Sedimentología', ['Facies Sedimentarias', 'Ambientes de Sedimentación', 'Columnas Estratigráficas', 'Correlación de Estratos']],
        ['FIG-GEO', 'GEO-301', 'Geología Estructural', ['Esfuerzo y Deformación en Rocas', 'Fallas y Fracturas', 'Pliegues y Cabalgamientos', 'Análisis Cinemático']],
        ['FIG-GEO', 'GEO-302', 'Paleontología General', ['Fosilización y Tafonomía', 'Invertebrados Fósiles', 'Microfósiles', 'Bioestratigrafía']],
        ['FIG-GEO', 'GEO-303', 'Geomorfología y Fotointerpretación', ['Formas del Relieve', 'Procesos de Ladera y Fluviales', 'Interpretación de Fotografías Aéreas', 'Modelos Digitales de Terreno']],
        ['FIG-GEO', 'GEO-401', 'Geología de Yacimientos Minerales I (Metálicos)', ['Fluidos Hidrotermales', 'Yacimientos Epi-Meso-Hipotermales', 'Pórfidos y Skarns', 'Yacimientos Polimetálicos del Altiplano']],
        ['FIG-GEO', 'GEO-402', 'Geología de Yacimientos Minerales II (No Metálicos)', ['Evaporitas y Salmueras', 'Arcillas y Rocas Industriales', 'Gemas y Rocas Ornamentales', 'Recursos Energéticos']],
        ['FIG-GEO', 'GEO-403', 'Prospección Geoquímica', ['Dispersión Geoquímica', 'Muestreo de Suelos y Sedimentos', 'Análisis Multielemental', 'Anomalías Geoquímicas']],
        ['FIG-GEO', 'GEO-404', 'Prospección Geofísica', ['Métodos Sísmicos de Refracción/Reflexión', 'Métodos Eléctricos y Resistividad', 'Gravimetría y Magnetometría', 'Radiometría']],
        ['FIG-GEO', 'GEO-501', 'Hidrogeología', ['Acuíferos y Porosidad', 'Ley de Darcy y Flujo Subterráneo', 'Ensayos de Bombeo', 'Química de Aguas Subterráneas']],
        ['FIG-GEO', 'GEO-502', 'Geología de Bolivia', ['Fisiografía y Zonas Morfoestructurales', 'Estratigrafía del Paleozoico y Mesozoico', 'Vulcanismo Cenozoico', 'Evolución de la Cordillera de los Andes']],
        ['FIG-GEO', 'GEO-503', 'Geotecnia y Geología de Obras', ['Ensayos In Situ (SPT)', 'Clasificación de Macizos Rocosos', 'Taludes en Obras Civiles', 'Fundaciones en Suelos Complejos']],
        ['FIG-GEO', 'GEO-504', 'Sondeos y Perforación Geológica', ['Métodos de Perforación Diamantina', 'Recuperación de Testigos', 'Mapeo Geotécnico de Testigos (RQD)', 'Ensayos Down-Hole']],

        // Medio Ambiente (15 materias)
        ['FIG-AMB', 'AMB-101', 'Ecología General y Ecosistemas', ['Estructura y Función de Ecosistemas', 'Flujo de Energía y Ciclos Biogeoquímicos', 'Poblaciones y Comunidades', 'Ecosistemas Andinos']],
        ['FIG-AMB', 'AMB-102', 'Química y Microbiología Ambiental', ['Reacciones en Suelo y Agua', 'Microorganismos Degradadores', 'Bioindicadores Ambientales', 'Ensayos de Toxicidad']],
        ['FIG-AMB', 'AMB-201', 'Contaminación y Calidad del Aire', ['Contaminantes Criterio y Emisiones', 'Dispersión de Plumas Atmosféricas', 'Monitoreo de Calidad del Aire', 'Tecnologías de Control de Emisiones']],
        ['FIG-AMB', 'AMB-202', 'Contaminación y Tratamiento de Aguas', ['Parámetros Fisicoquímicos y Bacteriológicos', 'Tratamiento Primario, Secundario y Terciario', 'Tratamiento de Drenaje Ácido de Mina', 'Reúso de Aguas']],
        ['FIG-AMB', 'AMB-301', 'Gestión Integral de Residuos Sólidos', ['Generación y Caracterización de Residuos', 'Recolección y Transporte', 'Rellenos Sanitarios y Lixiviados', 'Economía Circular y Reciclaje']],
        ['FIG-AMB', 'AMB-302', 'Evaluación de Impacto Ambiental (EIA)', ['Ley 1333 de Medio Ambiente', 'Matrices de Causa-Efecto (Leopold)', 'Línea Base Ambiental', 'Planes de Manejo y Mitigación']],
        ['FIG-AMB', 'AMB-303', 'Sistemas de Información Geográfica Ambiental', ['Cartografía de Cobertura Vegetal', 'Zonificación de Riesgos Ambientales', 'Análisis Espacial de Cuencas', 'Modelamiento de Contaminación']],
        ['FIG-AMB', 'AMB-401', 'Remediación de Suelos Contaminados', ['Contaminación por Metales Pesados', 'Biorremediación y Fitorremediación', 'Estabilización y Encapsulamiento', 'Cierre de Sitios Mineros']],
        ['FIG-AMB', 'AMB-402', 'Auditoría Ambiental y Normas ISO 14001', ['Principios de la Auditoría Ambiental', 'Revisión Documental y de Campo', 'No Conformidades y Hallazgos', 'Planes de Adecuación y Seguimiento']],
        ['FIG-AMB', 'AMB-403', 'Manejo Integral de Cuencas Hidrográficas', ['Morfometría de Cuencas', 'Balance Hídrico', 'Control de Erosión y Sedimentación', 'Gobernanza del Agua']],
        ['FIG-AMB', 'AMB-404', 'Toxicología Ambiental y Salud Pública', ['Vías de Exposición y Dosis-Respuesta', 'Bioacumulación y Biomagnificación', 'Riesgos por Plomo, Arsénico y Mercurio', 'Vigilancia Epidemiológica Ambiental']],
        ['FIG-AMB', 'AMB-501', 'Energías Limpias y Mitigación del Cambio Climático', ['Gases de Efecto Invernadero (GEI)', 'Huella de Carbono', 'Estrategias de Adaptación Climática', 'Mecanismos de Desarrollo Limpio']],
        ['FIG-AMB', 'AMB-502', 'Legislación y Derecho Ambiental Boliviano', ['Derechos de la Madre Tierra (Ley 071/300)', 'Reglamentos de Prevención y Control Ambiental', 'Delitos Ambientales', 'Procedimientos Administrativos']],
        ['FIG-AMB', 'AMB-503', 'Economía Ambiental y Valoración de Servicios Ecosistémicos', ['Costos Ambientales y Externalidades', 'Métodos de Valoración Económica', 'Pago por Servicios Ambientales', 'Financiamiento Verde']],
        ['FIG-AMB', 'AMB-504', 'Planificación y Ordenamiento Territorial Ambiental', ['Diagnóstico Territorial', 'Capacidad de Carga y Vulnerabilidad', 'Zonificación Ecológica y Económica', 'Instrumentos de Gestión Territorial']]
    ];

    foreach ($figSubjects as $s) {
        $courses[] = ['car_code' => $s[0], 'code' => $s[1], 'name' => $s[2], 'units' => $s[3], 'summary' => "Estudio científico y aplicado de {$s[2]} en la Facultad de Ingeniería Geológica de la UATF."];
    }

    // 8. Facultad de Ciencias de la Salud (35 Cursos)
    $fcsSubjects = [
        // Enfermería Potosí (20 materias)
        ['FCS-ENF', 'ENF-101', 'Bases Conceptuales de Enfermería', ['Historia y Filosofía de la Enfermería', 'Modelos y Teorías (Nightingale, Orem)', 'Proceso de Atención de Enfermería (PAE)', 'Código Deontológico']],
        ['FCS-ENF', 'ENF-102', 'Anatomía y Fisiología Humana para Enfermería', ['Sistemas Esquelético y Muscular', 'Sistemas Cardiovascular y Respiratorio', 'Aparato Digestivo y Renal', 'Sistema Endocrino y Nervioso']],
        ['FCS-ENF', 'ENF-201', 'Farmacología Clínica para Enfermería', ['Farmacocinética y Farmacodinamia', 'Reglas de Administración Segura', 'Antibióticos y Analgésicos', 'Cálculo de Dosis y Goteo']],
        ['FCS-ENF', 'ENF-202', 'Microbiología y Parasitología Clínica', ['Bacterias Patógenas de Importancia Médica', 'Infecciones Asociadas a la Salud (IAAS)', 'Técnicas Asépticas y Esterilización', 'Parásitos Intestinales y Tisulares']],
        ['FCS-ENF', 'ENF-203', 'Enfermería en Salud Comunitaria I', ['Determinantes Sociales de la Salud', 'Atención Primaria de Salud (SAFCI)', 'Educación para la Salud', 'Visitas Domiciliarias']],
        ['FCS-ENF', 'ENF-301', 'Enfermería Médico-Quirúrgica I', ['Cuidados Preoperatorios e Intraoperatorios', 'Cuidados Postoperatorios Inmediatos', 'Manejo de Heridas y Drenajes', 'Atención al Paciente con Dolor']],
        ['FCS-ENF', 'ENF-302', 'Enfermería Médico-Quirúrgica II', ['Alteraciones Cardiovasculares y Respiratorias', 'Alteraciones Renales y Diálisis', 'Cuidados en Oncología', 'Cuidados Paliativos']],
        ['FCS-ENF', 'ENF-303', 'Enfermería Gineco-Obstétrica', ['Atención Prenatal y Control del Embarazo', 'Fisiología del Parto y Puerperio', 'Complicaciones Obstétricas', 'Salud Sexual y Reproductiva']],
        ['FCS-ENF', 'ENF-401', 'Enfermería Pediátrica y del Adolescente', ['Crecimiento y Desarrollo Infantil', 'Enfermedades Prevalentes de la Infancia (AIEPI)', 'Inmunizaciones y Cadena de Frío', 'Nutrición Infantil']],
        ['FCS-ENF', 'ENF-402', 'Enfermería en Salud Mental y Psiquiatría', ['Trastornos del Estado de Ánimo y Ansiedad', 'Manejo de Crisis Emocionales', 'Adicciones y Drogodependencias', 'Rehabilitación Psicosocial']],
        ['FCS-ENF', 'ENF-403', 'Enfermería en Urgencias y Cuidados Críticos', ['Soporte Vital Básico y Avanzado (BLS/ACLS)', 'Triage Hospitalario y Extra-hospitalario', 'Monitoreo Hemodinámico', 'Ventilación Mecánica Básica']],
        ['FCS-ENF', 'ENF-404', 'Enfermería en Salud Comunitaria II', ['Epidemiología Aplicada a Enfermería', 'Programas Nacionales de Salud en Bolivia', 'Salud Escolar y Laboral', 'Gestión de Redes de Salud']],
        ['FCS-ENF', 'ENF-501', 'Administración y Gestión de Servicios de Enfermería', ['Planificación Estratégica en Hospitales', 'Organización de Personal y Turnos', 'Supervisión y Liderazgo en Salud', 'Auditoría de Calidad en Enfermería']],
        ['FCS-ENF', 'ENF-502', 'Bioética y Legislación en Salud', ['Consentimiento Informado', 'Derechos del Paciente', 'Dilemas Éticos al Final de la Vida', 'Responsabilidad Legal del Profesional']],
        ['FCS-ENF', 'ENF-503', 'Investigación en Enfermería', ['Metodología Cuantitativa y Cualitativa', 'Diseño de Protocolos de Investigación', 'Recolección y Análisis de Datos', 'Divulgación Científica']],
        ['FCS-ENF', 'ENF-504', 'Nutrición y Dietoterapia', ['Evaluación del Estado Nutricional', 'Dietas Terapéuticas Hospitalarias', 'Nutrición Enteral y Parenteral', 'Trastornos de la Conducta Alimentaria']],
        ['FCS-ENF', 'ENF-505', 'Enfermería Geriátrica y Gerontológica', ['Proceso de Envejecimiento Fisiológico', 'Síndromes Geriátricos', 'Cuidados en Demencias y Alzheimer', 'Promoción del Envejecimiento Activo']],
        ['FCS-ENF', 'ENF-506', 'Salud Intercultural y Medicina Tradicional', ['Cosmovisión Andina de la Salud', 'Medicina Tradicional en Bolivia', 'Interculturalidad en la Práctica Clínica', 'Diálogo de Saberes en Salud']],
        ['FCS-ENF', 'ENF-507', 'Taller de Práctica Hospitalaria Integrada', ['Rotación por Especialidades', 'Simulación Clínica de Alta Fidelidad', 'Planes de Cuidado Complejos', 'Evaluación de Competencias']],
        ['FCS-ENF', 'ENF-508', 'Internado Rotatorio de Enfermería', ['Servicio Rural de Salud', 'Servicio de Medicina Interna', 'Servicio de Cirugía y Emergencias', 'Servicio de Pediatría y Neonatología']],

        // Enfermería Villazón (15 materias)
        ['FCS-ENF-VIL', 'EVL-101', 'Introducción a la Enfermería Fronteriza (Villazón)', ['Perfil Epidemiológico de Frontera', 'Rol del Profesional en Zonas Limítrofes', 'Atención Primaria', 'Salud Familiar']],
        ['FCS-ENF-VIL', 'EVL-102', 'Morfofisiología Humana (Villazón)', ['Célula y Tejidos', 'Sistemas Orgánicos Integrados', 'Homeostasis y Regulación', 'Fisiología del Esfuerzo']],
        ['FCS-ENF-VIL', 'EVL-201', 'Farmacología Básica y Aplicada (Villazón)', ['Grupos Farmacológicos', 'Vías de Administración', 'Reacciones Adversas', 'Farmacovigilancia']],
        ['FCS-ENF-VIL', 'EVL-202', 'Enfermería en Atención Primaria (Villazón)', ['Modelo SAFCI', 'Censo Comunitario de Salud', 'Vacunación y PAI', 'Control de Enfermedades Transmisibles']],
        ['FCS-ENF-VIL', 'EVL-203', 'Bioseguridad y Control de Infecciones (Villazón)', ['Precauciones Universales', 'Manejo de Residuos Biocontaminados', 'Técnicas de Aislamiento', 'Desinfección de Áreas Críticas']],
        ['FCS-ENF-VIL', 'EVL-301', 'Cuidados Médico-Quirúrgicos del Adulto (Villazón)', ['Valoración Preoperatoria', 'Cuidado de Heridas Quirúrgicas', 'Monitoreo de Signos Vitales', 'Oxigenoterapia']],
        ['FCS-ENF-VIL', 'EVL-302', 'Salud Materno-Infantil en Zonas Fronterizas (Villazón)', ['Control Prenatal y Puerperio', 'Parto Humanizado', 'Lactancia Materna Exclusiva', 'Atención Inmediata del Recién Nacido']],
        ['FCS-ENF-VIL', 'EVL-303', 'Enfermería Pediátrica Comunitaria (Villazón)', ['Desarrollo Psicomotor', 'Desnutrición Infantil', 'Infecciones Respiratorias y Diarreicas', 'Salud Escolar']],
        ['FCS-ENF-VIL', 'EVL-401', 'Enfermería en Urgencias y Desastres (Villazón)', ['Primeros Auxilios Avanzados', 'Inmovilización y Traslado', 'Atención de Politraumatizados', 'Planes de Contingencia en Frontera']],
        ['FCS-ENF-VIL', 'EVL-402', 'Epidemiología de Enfermedades Transfronterizas (Villazón)', ['Vigilancia Epidemiológica de Frontera', 'Dengue, Chagas y Zoonosis', 'Flujos Migratorios y Salud', 'Reglamento Sanitario Internacional']],
        ['FCS-ENF-VIL', 'EVL-403', 'Salud Ocupacional y del Trabajador (Villazón)', ['Riesgos Ergonómicos y Físicos', 'Enfermedades Laborales', 'Exámenes Médicos Ocupacionales', 'Prevención de Accidentes']],
        ['FCS-ENF-VIL', 'EVL-501', 'Gestión de Centros de Salud de Primer Nivel (Villazón)', ['Organización de Puestos de Salud', 'Gestión de Medicamentos e Insumos', 'Indicadores de Cobertura', 'Liderazgo Comunitario']],
        ['FCS-ENF-VIL', 'EVL-502', 'Ética y Deontología en Salud (Villazón)', ['Valores y Principios en Enfermería', 'Derechos de los Pacientes Migrantes', 'Secreto Médico y Confidencialidad', 'Dilemas Éticos']],
        ['FCS-ENF-VIL', 'EVL-503', 'Investigación en Salud Comunitaria (Villazón)', ['Diagnóstico de Salud Local', 'Formulación de Proyectos de Intervención', 'Análisis Epidemiológico', 'Socialización de Resultados']],
        ['FCS-ENF-VIL', 'EVL-504', 'Internado Rotatorio en Red Rural (Villazón)', ['Rotación en Hospital San Roque de Villazón', 'Centros de Salud de Área Fronteriza', 'Atención a Poblaciones Vulnerables', 'Evaluación de Desempeño']]
    ];

    foreach ($fcsSubjects as $s) {
        $courses[] = ['car_code' => $s[0], 'code' => $s[1], 'name' => $s[2], 'units' => $s[3], 'summary' => "Formación integral en {$s[2]} para el cuidado de la salud en la UATF."];
    }

    // 9. Facultad de Medicina (35 Cursos - Régimen Anual)
    $medSubjects = [
        ['MED-MED', 'MED-101', 'Anatomía Humana Descriptiva y Topográfica', ['Osteología y Artrología', 'Miología y Vascularización', 'Topografía de Cabeza y Cuello', 'Topografía de Tórax, Abdomen y Extremidades']],
        ['MED-MED', 'MED-102', 'Histología, Embriología y Genética Médica', ['Tejidos Básicos', 'Organogénesis y Desarrollo Fetal', 'Bases Cromosómicas de la Herencia', 'Malformaciones Congénitas']],
        ['MED-MED', 'MED-103', 'Fisiología Médica General y de Sistemas', ['Fisiología Celular y Neuromuscular', 'Fisiología Cardiovascular y Respiratoria', 'Fisiología Renal y Digestiva', 'Fisiología Endocrina y Reproductora']],
        ['MED-MED', 'MED-104', 'Bioquímica y Biología Molecular Médica', ['Estructura y Función de Proteínas', 'Bioenergética y Metabolismo de Glúcidos', 'Metabolismo de Lípidos y Proteínas', 'Expresión Génica y Replicación']],
        ['MED-MED', 'MED-105', 'Bioética, Humanismo Médico y Deontología', ['Historia de la Medicina', 'Relación Médico-Paciente', 'Dilemas Bioéticos Contemporáneos', 'Legislación Sanitaria Boliviana']],
        ['MED-MED', 'MED-201', 'Microbiología y Parasitología Médica', ['Bacteriología Médica y Resistencia Antimicrobiana', 'Virología Clínica', 'Micología Médica', 'Protozoos y Helmintos de Importancia Médica']],
        ['MED-MED', 'MED-202', 'Farmacología Médica General y Terapéutica', ['Farmacocinética y Farmacodinamia', 'Fármacos del Sistema Nervioso Autónomo', 'Fármacos Cardiovasculares y Renales', 'Antimicrobianos y Antineoplásicos']],
        ['MED-MED', 'MED-203', 'Anatomía Patológica General y Especial', ['Lesión y Muerte Celular', 'Inflamación y Reparación Tisular', 'Patología de Órganos y Sistemas', 'Neoplasias y Carcinogénesis']],
        ['MED-MED', 'MED-204', 'Inmunología Médica', ['Inmunidad Innata y Adaptativa', 'Antígenos y Anticuerpos', 'Hipersensibilidad y Autoinmunidad', 'Inmunodeficiencias y Vacunas']],
        ['MED-MED', 'MED-205', 'Semiología Médica y Propedéutica Clínica', ['Historia Clínica y Anamnesis', 'Examen Físico General y Regional', 'Semiología de Aparatos Respiratorio y Cardiovascular', 'Semiología Abdominal y Neurológica']],
        ['MED-MED', 'MED-301', 'Medicina Interna I (Cardiología y Neumología)', ['Insuficiencia Cardíaca y Cardiopatía Isquémica', 'Hipertensión Arterial y Arritmias', 'Neumonía, Asma y EPOC', 'Tuberculosis Pulmonar y Tromboembolismo']],
        ['MED-MED', 'MED-302', 'Medicina Interna II (Gastroenterología y Nefrología)', ['Úlcera Péptica y Hemorragia Digestiva', 'Cirrosis Hepática y Hepatitis', 'Insuficiencia Renal Aguda y Crónica', 'Glomerulopatías y Litiasis Renal']],
        ['MED-MED', 'MED-303', 'Cirugía General I y Patología Quirúrgica', ['Asepsia, Antisepsia y Cicatrización', 'Abdomen Agudo Quirúrgico y Apendicitis', 'Patología Biliar Quirúrgica (Colecistitis)', 'Hernias de la Pared Abdominal']],
        ['MED-MED', 'MED-304', 'Ginecología y Reproducción Humana', ['Ciclo Ovárico y Trastornos Menstruales', 'Infecciones de Transmisión Sexual', 'Patología Cervical y Cáncer de Cuello Uterino', 'Planificación Familiar']],
        ['MED-MED', 'MED-305', 'Obstetricia Fisiológica y Patológica', ['Diagnóstico y Control del Embarazo', 'Mecanismo del Parto y Puerperio', 'Hemorragias de la Primera y Segunda Mitad del Embarazo', 'Trastornos Hipertensivos del Embarazo']],
        ['MED-MED', 'MED-401', 'Pediatría y Puericultura', ['Recién Nacido Normal y Patológico', 'Crecimiento, Desarrollo y Nutrición', 'Enfermedades Respiratorias y Diarreicas Agudas', 'Urgencias Pediátricas']],
        ['MED-MED', 'MED-402', 'Cirugía General II y Especialidades Quirúrgicas', ['Trauma y Politraumatismo (ATLS)', 'Oclusión Intestinal y Peritonitis', 'Cirugía Laparoscópica Básica', 'Cirugía Oncológica']],
        ['MED-MED', 'MED-403', 'Neurología y Neurocirugía', ['Enfermedad Vascular Cerebral (ACV)', 'Epilepsia y Síndromes Convulsivos', 'Traumatismo Craneoencefálico (TCE)', 'Enfermedades Desmielinizantes']],
        ['MED-MED', 'MED-404', 'Traumatología y Ortopedia', ['Fracturas de Miembros Superiores e Inferiores', 'Luxaciones y Esguinces', 'Infecciones Óseas y Osteomielitis', 'Deformidades de la Columna']],
        ['MED-MED', 'MED-405', 'Psiquiatría y Salud Mental', ['Trastornos Psicóticos y Esquizofrenia', 'Trastornos del Humor y Bipolaridad', 'Trastornos de Ansiedad y Fobias', 'Psicofarmacología Clínica']],
        ['MED-MED', 'MED-406', 'Dermatología Clínica', ['Lesiones Elementales de la Piel', 'Dermatosis Inflamatorias e Infecciosas', 'Enfermedades Ampollosas', 'Tumores Benignos y Malignos de la Piel']],
        ['MED-MED', 'MED-407', 'Oftalmología', ['Agudeza Visual y Vicios de Refracción', 'Catarata y Glaucoma', 'Infecciones y Traumatismos Oculares', 'Retinopatías Sistémicas']],
        ['MED-MED', 'MED-408', 'Otorrinolaringología', ['Patología de Oído y Otitis', 'Rinosinusitis y Epistaxis', 'Faringoamigdalitis y Patología Laríngea', 'Hipoacusias y Vértigo']],
        ['MED-MED', 'MED-409', 'Urología', ['Infecciones Urinarias Altas y Bajas', 'Hiperplasia Prostática Benigna y Cáncer de Próstata', 'Cólico Renal y Litiasis', 'Urgencias Urológicas']],
        ['MED-MED', 'MED-410', 'Epidemiología y Salud Pública', ['Método Epidemiológico y Vigilancia', 'Estudios Observacionales y Experimentales', 'Salud Comunitaria y Modelo SAFCI', 'Políticas de Salud en Bolivia']],
        ['MED-MED', 'MED-501', 'Medicina Legal y Toxicología Forense', ['Tanatología y Fenómenos Cadavéricos', 'Lesionología Forense', 'Asfixiología y Sexología Forense', 'Intoxicaciones por Fármacos y Metales']],
        ['MED-MED', 'MED-502', 'Infectología Clínica y Enfermedades Tropicales', ['Enfermedad de Chagas y Leishmaniasis', 'Fiebre Amarilla y Dengue', 'VIH/SIDA y Coinfecciones', 'Infecciones por Gérmenes Multirresistentes']],
        ['MED-MED', 'MED-503', 'Endocrinología y Enfermedades Metabólicas', ['Diabetes Mellitus Tipo 1 y 2', 'Patología Tiroidea (Hipo/Hipertiroidismo)', 'Patología Suprarrenal e Hipofisaria', 'Metabolismo Óseo y Calcio']],
        ['MED-MED', 'MED-504', 'Hematología y Oncología Médica', ['Anemias Carenciales y Hemolíticas', 'Leucemias y Linfomas', 'Trastornos de la Hemostasia y Coagulación', 'Bases de la Terapia Antineoplásica']],
        ['MED-MED', 'MED-505', 'Reumatología y Enfermedades Autoinmunes', ['Artritis Reumatoide', 'Lupus Eritematoso Sistémico', 'Espondiloartropatías y Artrosis', 'Vasculitis Sistémicas']],
        ['MED-MED', 'MED-506', 'Medicina de Urgencias y Terapia Intensiva', ['Shock y Reanimación Cardiopulmonar', 'Insuficiencia Respiratoria Aguda y SDRA', 'Manejo del Paciente Crítico', 'Sepsis y Disfunción Multiorgánica']],
        ['MED-MED', 'MED-507', 'Diagnóstico por Imágenes (Radiología)', ['Radiografía de Tórax y Abdomen', 'Ecografía Médica General', 'Tomografía Axial Computarizada (TAC)', 'Resonancia Magnética (RMN)']],
        ['MED-MED', 'MED-508', 'Medicina Familiar y Comunitaria', ['Enfoque Biopsicosocial', 'Ciclo Vital Familiar', 'Atención Domiciliaria del Paciente Crónico', 'Promoción y Prevención en Salud']],
        ['MED-MED', 'MED-509', 'Geriatría Clínica', ['Evaluación Geriátrica Integral', 'Fragilidad y Caídas en el Adulto Mayor', 'Polifarmacia en Geriatría', 'Manejo de Patologías Crónicas en la Senectud']],
        ['MED-MED', 'MED-510', 'Taller de Razonamiento Clínico e Integración', ['Resolución de Casos Clínicos Complejos', 'Medicina Basada en Evidencia', 'Algoritmos Diagnósticos y Terapéuticos', 'Simulación de Situaciones Críticas']]
    ];

    foreach ($medSubjects as $s) {
        $courses[] = ['car_code' => $s[0], 'code' => $s[1], 'name' => $s[2], 'units' => $s[3], 'summary' => "Cátedra anual de {$s[2]} en la Facultad de Medicina de la UATF."];
    }

    // 10. Facultad de Derecho (40 Cursos - Régimen Anual)
    $derSubjects = [
        // Derecho Potosí (20 materias)
        ['DER-DER', 'DER-101', 'Derecho Constitucional Boliviano', ['Bases Fundamentales del Estado', 'Estructura y Organización del Poder', 'Derechos, Deberes y Garantías', 'Acciones de Defensa Constitucional']],
        ['DER-DER', 'DER-102', 'Introducción al Derecho y Teoría General', ['Concepto y Fines del Derecho', 'Fuentes del Derecho', 'Norma Jurídica y Ordenamiento', 'Interpretación y Aplicación']],
        ['DER-DER', 'DER-103', 'Derecho Romano e Historia del Derecho', ['Personas y Familia en Roma', 'Derechos Reales y Posesión', 'Obligaciones y Contratos Romanos', 'Recepción del Derecho Romano']],
        ['DER-DER', 'DER-104', 'Sociología Jurídica y Pluralismo Jurídico', ['Derecho y Sociedad', 'Justicia Indígena Originaria Campesina', 'Conflicto y Control Social', 'Pluralismo Jurídico en Bolivia']],
        ['DER-DER', 'DER-201', 'Derecho Civil I (Personas y Derechos Reales)', ['Persona Natural y Colectiva', 'Capacidad y Estado Civil', 'La Propiedad y la Posesión', 'Usufructo, Servidumbres y Garantías Reales']],
        ['DER-DER', 'DER-202', 'Derecho Penal I (Parte General)', ['Teoría del Delito y Tipicidad', 'Antijuricidad y Culpabilidad', 'Grados de Participación y Tentativa', 'Penas y Medidas de Seguridad']],
        ['DER-DER', 'DER-203', 'Derecho Administrativo y Procedimiento Administrativo', ['Función Administrativa del Estado', 'Acto Administrativo', 'Procedimiento Administrativo (Ley 2341)', 'Contratación Estatal y Control Fiscal']],
        ['DER-DER', 'DER-204', 'Derecho Internacional Público', ['Sujetos del Derecho Internacional', 'Tratados Internacionales', 'Solución Pacífica de Controversias', 'Derecho Internacional Humanitario']],
        ['DER-DER', 'DER-301', 'Derecho Civil II (Obligaciones y Contratos)', ['Teoría General de las Obligaciones', 'Fuentes y Efectos de las Obligaciones', 'Teoría General del Contrato', 'Contratos en Particular (Compraventa, Arrendamiento)']],
        ['DER-DER', 'DER-302', 'Derecho Penal II (Parte Especial)', ['Delitos Contra la Vida e Integridad', 'Delitos Contra el Patrimonio', 'Delitos Contra la Administración Pública', 'Delitos Contra la Seguridad del Estado']],
        ['DER-DER', 'DER-303', 'Derecho Procesal Orgánico y Teoría del Proceso', ['Jurisdicción y Competencia', 'La Acción y la Pretensión Procesal', 'Actos y Notificaciones Procesales', 'Teoría General de la Prueba']],
        ['DER-DER', 'DER-304', 'Derecho Comercial y Societario', ['Actos de Comercio y Comerciante', 'Sociedades Comerciales (SRL, SA)', 'Títulos Valores (Cheque, Pagaré)', 'Concursos y Quiebras']],
        ['DER-DER', 'DER-401', 'Derecho Procesal Civil', ['Procesos de Conocimiento (Ordinario/Extraordinario)', 'Procesos de Estructura Monitoria', 'Medidas Cautelares', 'Recursos Procesales (Apelación y Casación)']],
        ['DER-DER', 'DER-402', 'Derecho Procesal Penal', ['Etapa Preparatoria del Juicio', 'Medidas Cautelares Personales y Reales', 'Juicio Oral, Público y Contradictorio', 'Salidas Alternativas y Recursos']],
        ['DER-DER', 'DER-403', 'Derecho Laboral y Seguridad Social', ['Principios del Derecho Laboral', 'Contrato Individual de Trabajo', 'Beneficios Sociales y Despido', 'Régimen de la Seguridad Social']],
        ['DER-DER', 'DER-404', 'Derecho Minero e Hidrocarburífero', ['Dominio Originario del Estado', 'Contratos de Interés Minero con AJAM', 'Consulta Previa a Comunidades', 'Régimen de Hidrocarburos (YPFB)']],
        ['DER-DER', 'DER-501', 'Derecho de Familia y Procedimiento Familiar', ['Matrimonio y Unión Libre', 'Filiación y Asistencia Familiar', 'Adopción y Tutela', 'Procesos Familiares (Código de Familias)']],
        ['DER-DER', 'DER-502', 'Derecho Agrario y Ambiental', ['Régimen de la Propiedad Agraria (INRA)', 'Saneamiento y Distribución de Tierras', 'Delitos Ambientales', 'Justicia Agroambiental']],
        ['DER-DER', 'DER-503', 'Derecho Tributario y Aduanero', ['Principios Constitucionales Tributarios', 'Determinación de la Deuda Tributaria', 'Ilícitos Tributarios y Contrabando', 'Proceso Contencioso Tributario']],
        ['DER-DER', 'DER-504', 'Práctica Forense y Clínica Jurídica', ['Redacción de Memoriales y Demandas', 'Litigación Oral Civil y Penal', 'Simulación de Juicios', 'Deontología Jurídica y Conciliación']],

        // Derecho Uncía (10 materias)
        ['DER-DER-UNC', 'DNC-101', 'Derecho Indígena Originario Campesino (Uncía)', ['Normativa Constitucional e Internacional (OIT 169)', 'Jurisdicción Indígena Originaria', 'Ley de Deslinde Jurisdiccional', 'Resolución Tradicional de Conflictos']],
        ['DER-DER-UNC', 'DNC-102', 'Derecho Civil: Bienes y Derechos Reales (Uncía)', ['Propiedad Individual y Comunitaria', 'Posesión y Usucapión', 'Protección de la Posesión', 'Registro de Derechos Reales']],
        ['DER-DER-UNC', 'DNC-201', 'Derecho Penal Aplicado a la Región Minera (Uncía)', ['Delitos Mineros (Robo de Minerales / Jukeo)', 'Delitos Contra el Medio Ambiente', 'Responsabilidad Penal de Empresas', 'Tipos Penales Especiales']],
        ['DER-DER-UNC', 'DNC-202', 'Derecho Laboral Minero y Cooperativo (Uncía)', ['Relaciones Laborales en Minería', 'Régimen de Cooperativas Mineras (Ley 356)', 'Higiene y Seguridad Minera', 'Enfermedades Profesionales (Silicosis)']],
        ['DER-DER-UNC', 'DNC-301', 'Derecho Administrativo Municipal (Uncía)', ['Autonomías Municipales (Ley 031)', 'Potestad Sancionadora Municipal', 'Contrataciones Estatales SICOES', 'Servicios Públicos Locales']],
        ['DER-DER-UNC', 'DNC-302', 'Derecho Procesal Civil y Oralidad (Uncía)', ['Principios de la Oralidad Procesal', 'Audiencia Preliminar y Complementaria', 'Prueba Testifical y Pericial', 'Ejecución de Sentencia']],
        ['DER-DER-UNC', 'DNC-401', 'Derecho de Familias y Protección Integral (Uncía)', ['Derechos de la Niñez y Adolescencia', 'Procesos de Asistencia Familiar', 'Prevención de Violencia Familiar (Ley 348)', 'Defensorías de la Niñez']],
        ['DER-DER-UNC', 'DNC-402', 'Derecho de la Seguridad Social Minera (Uncía)', ['Seguros a Corto y Largo Plazo', 'Rentas de Invalidez y Vejez', 'Caja Nacional de Salud', 'Régimen de Accidentes de Trabajo']],
        ['DER-DER-UNC', 'DNC-501', 'MASC: Conciliación y Arbitraje (Uncía)', ['Fundamentos de la Ley 708', 'Procedimiento Conciliatorio', 'Arbitraje Institucional y Ad-Hoc', 'Laudo Arbitral y Homologación']],
        ['DER-DER-UNC', 'DNC-502', 'Clínica Forense y Práctica Judicial (Uncía)', ['Atención de Casos Reales', 'Defensa Pública y Asistencia Social', 'Audiencias Judiciales Reales', 'Informe de Práctica']],

        // Derecho Tupiza (10 materias)
        ['DER-DER-TUP', 'DTP-101', 'Derecho Fronterizo e Integración Regional (Tupiza)', ['Régimen Jurídico de Fronteras', 'Libre Circulación y Migración', 'Mercosur y CAN', 'Tratados de Doble Tributación']],
        ['DER-DER-TUP', 'DTP-102', 'Derecho Civil: Contratos Comerciales (Tupiza)', ['Contratos de Transporte Terrestre', 'Contratos de Distribución Comercial', 'Garantías y Cartas de Crédito', 'Resolución de Contratos']],
        ['DER-DER-TUP', 'DTP-201', 'Derecho Aduanero y Régimen de Exportación (Tupiza)', ['Ley General de Aduanas', 'Delitos Aduaneros y Contrabando', 'Valoración Aduanera (OMC)', 'Procedimiento Contencioso Aduanero']],
        ['DER-DER-TUP', 'DTP-202', 'Derecho Penal y Tráfico Ilícito Transfronterizo (Tupiza)', ['Delitos Conexos y Tráfico de Bienes', 'Trata y Tráfico de Personas', 'Cooperación Judicial Internacional', 'Extradición']],
        ['DER-DER-TUP', 'DTP-301', 'Derecho Ambiental y Recursos Hídricos (Tupiza)', ['Cuencas Transfronterizas', 'Derecho al Agua y Uso Agrícola', 'Impacto Ambiental en la Producción', 'Procedimientos Administrativos Ambientales']],
        ['DER-DER-TUP', 'DTP-302', 'Derecho Procesal Penal y Litigación Oral (Tupiza)', ['Técnicas de Litigación Oral', 'Interrogatorio y Contrainterrogatorio', 'Alegatos de Apertura y Clausura', 'Objeciones Procesales']],
        ['DER-DER-TUP', 'DTP-401', 'Derecho Notarial y Registral (Tupiza)', ['Ley del Notariado Plurinacional', 'Documentos Notariales y Protocolizaciones', 'Fe Pública y Responsabilidad Notarial', 'Inscripciones Registrales']],
        ['DER-DER-TUP', 'DTP-402', 'Derecho Tributario Municipal y Regional (Tupiza)', ['Tasas y Patentes Municipales', 'Procedimiento de Cobro Coactivo', 'Exenciones Tributarias', 'Defensa del Contribuyente']],
        ['DER-DER-TUP', 'DTP-501', 'Derechos Humanos y Protección Internacional (Tupiza)', ['Sistema Interamericano de DDHH (CIDH)', 'Convención Americana sobre DDHH', 'Jurisprudencia de la Corte IDH', 'Protección de Grupos Vulnerables']],
        ['DER-DER-TUP', 'DTP-502', 'Taller de Práctica Jurídica Forense (Tupiza)', ['Simulación de Audiencias Cautelares', 'Elaboración de Contratos Complejos', 'Consultorio Jurídico Popular', 'Evaluación Final']]
    ];

    foreach ($derSubjects as $s) {
        $courses[] = ['car_code' => $s[0], 'code' => $s[1], 'name' => $s[2], 'units' => $s[3], 'summary' => "Cátedra anual de {$s[2]} impartida en la Facultad de Derecho de la UATF."];
    }

    // 11. Facultad de Ciencias Sociales y Humanísticas (45 Cursos)
    $fcshSubjects = [
        // Turismo Potosí (10 materias)
        ['FCSH-TUR', 'TUR-101', 'Introducción al Turismo y Patrimonio', ['Teoría del Turismo', 'Patrimonio Histórico de Potosí', 'Sostenibilidad', 'Destinos']],
        ['FCSH-TUR', 'TUR-102', 'Geografía Turística de Bolivia', ['Circuitos Andinos', 'Salar de Uyuni y Lagunas de Colores', 'Valles y Amazonía', 'Mapas Turísticos']],
        ['FCSH-TUR', 'TUR-201', 'Gestión Hotelera y Hospitalidad', ['Operaciones de Hospedaje', 'Front Office y Reservas', 'Calidad en el Servicio', 'Revenue Management']],
        ['FCSH-TUR', 'TUR-202', 'Agencias de Viajes y Operación Turística', ['Diseño de Paquetes Turísticos', 'Sistemas GDS (Amadeus/Sabre)', 'Guiado y Conducción de Grupos', 'Costeo de Tours']],
        ['FCSH-TUR', 'TUR-301', 'Turismo Cultural y Patrimonio de la Humanidad', ['UNESCO y Potosí Patrimonio Mundial', 'Centros Históricos', 'Rutas Culturales Coloniales', 'Conservación del Patrimonio']],
        ['FCSH-TUR', 'TUR-302', 'Ecoturismo y Áreas Protegidas', ['Parques Nacionales (Torotoro/Eduardo Avaroa)', 'Interpretación Ambiental', 'Capacidad de Carga Ecoturística', 'Turismo Comunitario']],
        ['FCSH-TUR', 'TUR-401', 'Marketing Turístico y Promoción Digital', ['Estrategias de Branding de Destino', 'Redes Sociales y OTAs', 'Influencers y Contenido Turístico', 'Ferias Internacionales']],
        ['FCSH-TUR', 'TUR-402', 'Planificación y Políticas del Turismo', ['Planes de Desarrollo Turístico', 'Infraestructura y Conectividad', 'Legislación Turística Boliviana', 'Soberanía Turística']],
        ['FCSH-TUR', 'TUR-501', 'Turismo de Aventura y Deportes Extremos', ['Seguridad en Montañismo y Trekking', 'Turismo en Salares', 'Logística de Expediciones', 'Primeros Auxilios en Áreas Remotas']],
        ['FCSH-TUR', 'TUR-502', 'Proyecto de Grado en Turismo', ['Investigación de Mercado Turístico', 'Diseño de Producto Innovador', 'Evaluación de Factibilidad', 'Plan de Negocio Turístico']],

        // Turismo Uyuni (5 materias)
        ['FCSH-TUR-UYU', 'TUY-101', 'Turismo en Ecosistemas Extremos (Uyuni)', ['Geomorfología del Salar', 'Atractivos Geotérmicos', 'Manejo de Flora y Fauna Altiplánica', 'Seguridad en Zonas de Gran Altura']],
        ['FCSH-TUR-UYU', 'TUY-201', 'Operaciones Turísticas en el Salar de Uyuni', ['Rutas 4x4 y Logística Altiplánica', 'Hospedajes de Sal', 'Astroturismo y Cielos Limpios', 'Coordinación con Comunidades Locales']],
        ['FCSH-TUR-UYU', 'TUY-301', 'Inglés Técnico para Guías de Uyuni', ['Vocabulario Turístico Avanzado', 'Atención de Emergencias en Inglés', 'Explicación del Paisaje Cultural', 'Técnicas de Oratoria']],
        ['FCSH-TUR-UYU', 'TUY-401', 'Sostenibilidad y Conservación del Salar', ['Impacto del Turismo Masivo', 'Manejo de Residuos en Áreas Protegidas', 'Mitigación de Huella Ecológica', 'Reglamentación para Operadores']],
        ['FCSH-TUR-UYU', 'TUY-501', 'Gestión de Empresas de Turismo Altiplánico', ['Costeo de Circuitos del Salar', 'Comercialización en Mercados Emisores', 'Alianzas Estratégicas', 'Calidad Certificada']],

        // Lingüística e Idiomas Potosí (10 materias)
        ['FCSH-LIN', 'LIN-101', 'Lingüística General y Teoría del Lenguaje', ['Signo Lingüístico (Saussure)', 'Niveles de Análisis Lingüístico', 'Gramática Generativa', 'Pragmática y Contexto']],
        ['FCSH-LIN', 'LIN-102', 'Fonética y Fonología del Español', ['Aparato Fonador y Articulación', 'Sistema Fonológico del Español', 'Transcripción Fonética (AFI)', 'Variedades Dialectales']],
        ['FCSH-LIN', 'LIN-201', 'Morfosintaxis del Español', ['Categorías Gramaticales', 'Estructura del Sintagma', 'Oración Simple y Compuesta', 'Análisis Sintáctico']],
        ['FCSH-LIN', 'LIN-202', 'Lengua Quechua I (Fonología y Gramática)', ['Alfabeto Quechua Normalizado', 'Estructura Aglutinante', 'Sufijos Nominales', 'Conjugación Verbal Básica']],
        ['FCSH-LIN', 'LIN-301', 'Lengua Quechua II (Conversación y Redacción)', ['Textos Narrativos Quechuas', 'Sufijos Derivativos', 'Expresiones Idiomáticas', 'Diálogo Intercultural']],
        ['FCSH-LIN', 'LIN-302', 'Lengua Inglesa Avanzada I', ['Estructuras Gramaticales Complejas', 'Comprensión Lectora y Ensayos', 'Fonética Inglesa', 'Producción Oral Fluida']],
        ['FCSH-LIN', 'LIN-401', 'Lengua Inglesa Avanzada II', ['Discurso Académico y Profesional', 'Argumentación y Debate', 'Literatura Anglófona', 'Análisis Crítico de Textos']],
        ['FCSH-LIN', 'LIN-402', 'Teoría y Práctica de la Traducción', ['Modelos de Traducción', 'Traducción Directa e Inversa', 'Herramientas CAT (Trados/OmegaT)', 'Traducción Literaria y Técnica']],
        ['FCSH-LIN', 'LIN-501', 'Sociolingüística y Contacto de Lenguas', ['Bilingüismo y Diglosia', 'Lenguas Indígenas en Bolivia', 'Actitudes y Políticas Lingüísticas', 'Revitalización Lingüística']],
        ['FCSH-LIN', 'LIN-502', 'Metodología de la Enseñanza de Lenguas', ['Enfoque Comunicativo', 'Planificación de Clases', 'Diseño de Material Didáctico', 'Evaluación de Competencias']],

        // Lingüística Uyuni (5 materias)
        ['FCSH-LIN-UYU', 'LUY-101', 'Inglés Aplicado al Sector Servicios (Uyuni)', ['Atención al Cliente Internacional', 'Reservas y Negociación', 'Redacción de Correos Comerciales', 'Expresiones Clave']],
        ['FCSH-LIN-UYU', 'LUY-201', 'Francés para Fines Turísticos (Uyuni)', ['Fonética Francesa Básica', 'Saludos y Presentaciones', 'Descripción de Servicios y Lugares', 'Comprensión Oral']],
        ['FCSH-LIN-UYU', 'LUY-301', 'Quechua Altiplánico y Toponimia (Uyuni)', ['Topónimos del Salar y Altiplano', 'Tradición Oral de Lípez', 'Léxico de la Geografía y el Clima', 'Interacción en Comunidades']],
        ['FCSH-LIN-UYU', 'LUY-401', 'Traducción de Guías e Información Turística', ['Adaptación Cultural de Contenidos', 'Traducción de Señalética', 'Folletos y Portales Web', 'Revisión y Corrección de Estilo']],
        ['FCSH-LIN-UYU', 'LUY-501', 'Interculturalidad y Comunicación en Turismo', ['Barreras Culturales en la Comunicación', 'Etiqueta Internacional', 'Resolución de Malentendidos', 'Capacitación a Comunidades']],

        // Trabajo Social Potosí (10 materias)
        ['FCSH-TSO', 'TSO-101', 'Fundamentos del Trabajo Social', ['Evolución Histórica de la Profesión', 'Métodos Tradicionales y Contemporáneos', 'Principios Éticos', 'Rol en el Desarrollo Social']],
        ['FCSH-TSO', 'TSO-102', 'Teoría Social y Enfoques de Desarrollo', ['Estructura Social Boliviana', 'Teorías de la Pobreza y Vulnerabilidad', 'Desarrollo Humano', 'Políticas Sociales']],
        ['FCSH-TSO', 'TSO-201', 'Trabajo Social con Familias', ['Estructura y Tipologías Familiares', 'Dinámica y Comunicación Familiar', 'Intervención en Crisis Familiar', 'Violencia Intrafamiliar']],
        ['FCSH-TSO', 'TSO-202', 'Trabajo Social de Grupo', ['Dinámica y Procesos Grupales', 'Liderazgo y Participación', 'Técnicas de Intervención Grupal', 'Evaluación de Procesos Grupales']],
        ['FCSH-TSO', 'TSO-301', 'Trabajo Social Comunitario', ['Diagnóstico Comunitario Participativo', 'Organización y Desarrollo Comunal', 'Planes de Acción Comunitaria', 'Redes de Apoyo Social']],
        ['FCSH-TSO', 'TSO-302', 'Planificación y Gestión de Proyectos Sociales', ['Marco Lógico para Proyectos Sociales', 'Diseño de Programas de Intervención', 'Presupuesto y Cronograma', 'Monitoreo y Evaluación Social']],
        ['FCSH-TSO', 'TSO-401', 'Trabajo Social en el Ámbito Judicial y Peritaje', ['Peritaje Social en Procesos de Familia', 'Informes Psicosociales para Adopciones', 'Trabajo Social en Régimen Penitenciario', 'Justicia Juvenil']],
        ['FCSH-TSO', 'TSO-402', 'Políticas Públicas y Bienestar Social', ['Sistemas de Protección Social en Bolivia', 'Políticas para la Niñez, Mujer y Adulto Mayor', 'Programas de Transferencia Condicionada', 'Evaluación de Políticas']],
        ['FCSH-TSO', 'TSO-501', 'Trabajo Social en Salud y Hospitales', ['Equipos Interdisciplinarios de Salud', 'Atención Social al Paciente Hospitalizado', 'Salud Mental y Apoyo Psicosocial', 'Acompañamiento en Duelo']],
        ['FCSH-TSO', 'TSO-502', 'Práctica Preprofesional y Sistematización', ['Inserción Institucional', 'Ejecución del Plan de Intervención', 'Sistematización de la Experiencia', 'Informe Final de Práctica']],

        // Ciencias de la Comunicación (5 materias)
        ['FCSH-COM', 'COM-101', 'Teorías de la Comunicación y la Información', ['Modelos Lineales y Funcionalistas', 'Escuela Crítica de Frankfurt', 'Estudios Culturales', 'Comunicación Digital y Redes']],
        ['FCSH-COM', 'COM-201', 'Periodismo Informativo y Redacción', ['Géneros Periodísticos (Noticia/Crónica)', 'Técnicas de Entrevista', 'Fuentes de Información y Verificación', 'Periodismo Digital']],
        ['FCSH-COM', 'COM-301', 'Producción Radiofónica y Podcast', ['Lenguaje Radiofónico y Sonido', 'Guion y Formatos Radiales', 'Locución y Edición de Audio', 'Estrategias de Podcasting']],
        ['FCSH-COM', 'COM-401', 'Producción Audiovisual y Televisiva', ['Lenguaje Audiovisual y Planos', 'Guion y Producción de Video', 'Cámara e Iluminación', 'Montaje y Postproducción Digital']],
        ['FCSH-COM', 'COM-501', 'Comunicación Estratégica y Organizacional', ['Identidad e Imagen Corporativa', 'Relaciones Públicas y Medios', 'Gestión de Crisis de Comunicación', 'Campañas de Comunicación Pública']]
    ];

    foreach ($fcshSubjects as $s) {
        $courses[] = ['car_code' => $s[0], 'code' => $s[1], 'name' => $s[2], 'units' => $s[3], 'summary' => "Cátedra universitaria de {$s[2]} impartida en la Facultad de Ciencias Sociales y Humanísticas de la UATF."];
    }

    // 12. Facultad de Ciencias Agrícolas y Pecuarias (30 Cursos)
    $fcapSubjects = [
        // Agronomía Potosí (10 materias)
        ['FCAP-AGR', 'AGR-101', 'Botánica General y Sistemática', ['Morfología Vegetal', 'Fisiología de las Plantas', 'Taxonomía y Familias Botánicas', 'Flora Andina y Cultivos Nativos']],
        ['FCAP-AGR', 'AGR-102', 'Edafología y Fertilidad de Suelos', ['Génesis y Clasificación de Suelos', 'Propiedades Físico-Químicas del Suelo', 'Nutrientes y Enmiendas', 'Análisis de Suelos y Fertirriego']],
        ['FCAP-AGR', 'AGR-201', 'Fisiología Vegetal', ['Fotosíntesis y Respiración', 'Relaciones Hídricas y Transpiración', 'Fitohormonas y Crecimiento', 'Estrés Hídrico y Salino']],
        ['FCAP-AGR', 'AGR-202', 'Agrometeorología y Climatología', ['Variables Climáticas (Radiación/Temperatura)', 'Evapotranspiración y Balance de Agua', 'Heladas y Sequías en el Altiplano', 'Modelos de Pronóstico Agrícola']],
        ['FCAP-AGR', 'AGR-301', 'Sistemas de Riego y Drenaje Agrícola', ['Riego por Goteo y Aspersión', 'Riego por Gravedad y Canales', 'Diseño Hidráulico de Parcelas', 'Eficiencia en el Uso del Agua']],
        ['FCAP-AGR', 'AGR-302', 'Entomología Agrícola y Manejo de Plagas', ['Morfología y Ciclo de Vida de Insectos', 'Plagas de Cultivos Altiplánicos (Papa/Quinua)', 'Manejo Integrado de Plagas (MIP)', 'Control Biológico']],
        ['FCAP-AGR', 'AGR-401', 'Fitopatología Agrícola', ['Enfermedades por Hongos y Bacterias', 'Virosis Vegetales', 'Epidemiología de Enfermedades', 'Fungicidas y Métodos Preventivos']],
        ['FCAP-AGR', 'AGR-402', 'Producción de Cultivos Andinos (Papa y Granos)', ['Variedades Nativas y Mejoradas', 'Siembra y Labores Culturales', 'Cosecha y Poscosecha', 'Manejo de Semillas Certificadas']],
        ['FCAP-AGR', 'AGR-501', 'Genética Vegetal y Mejoramiento Genético', ['Leyes de Mendel en Plantas', 'Selección y Cruzamientos', 'Biotecnología Agrícola y Marcadores', 'Conservación de Germoplasma']],
        ['FCAP-AGR', 'AGR-502', 'Agroecología y Producción Orgánica', ['Principios Agroecológicos', 'Abonos Orgánicos y Compostaje', 'Certificación Orgánica de Cultivos', 'Mercados Sostenibles']],

        // Agropecuaria Villazón (5 materias)
        ['FCAP-AGP-VIL', 'AGV-101', 'Sistemas de Producción en Valles Templados (Villazón)', ['Edafología de Valles', 'Cultivos Hortícolas', 'Manejo de Frutales de Pepita y Carozo', 'Riego Tecnificado']],
        ['FCAP-AGP-VIL', 'AGV-201', 'Producción y Sanidad Pecuaria (Villazón)', ['Manejo de Ganado Bovino y Caprino', 'Nutrición y Forrajes', 'Enfermedades Infecciosas en Animales', 'Vacunación y Bioseguridad']],
        ['FCAP-AGP-VIL', 'AGV-301', 'Producción Forrajera y Pasturas (Villazón)', ['Alfalfa y Pastos Cultivados', 'Ensilaje y Henificación', 'Capacidad de Carga de Potreros', 'Manejo de Pastoreo']],
        ['FCAP-AGP-VIL', 'AGV-401', 'Horticultura Intensiva y Bajo Carpa (Villazón)', ['Diseño de Invernaderos', 'Producción de Tomate y Hortalizas', 'Control Climático', 'Manejo Fitosanitario en Ambiente Protegido']],
        ['FCAP-AGP-VIL', 'AGV-501', 'Gestión de Agronegocios en Zonas Fronterizas (Villazón)', ['Comercialización de Productos Agropecuarios', 'Logística de Exportación', 'Cálculo de Rentabilidad', 'Organización de Productores']],

        // Veterinaria Tupiza (5 materias)
        ['FCAP-MVZ-TUP', 'MVZ-101', 'Anatomía Veterinaria Comparada (Tupiza)', ['Osteología y Miología Animal', 'Órganos Internos de Rumiantes y No Rumiantes', 'Sistema Circulatorio y Nervioso', 'Topografía Quirúrgica']],
        ['FCAP-MVZ-TUP', 'MVZ-201', 'Fisiología de la Reproducción Animal (Tupiza)', ['Ciclo Estral en Hembras', 'Inseminación Artificial', 'Diagnóstico de Gestación', 'Biotecnología Reproductiva']],
        ['FCAP-MVZ-TUP', 'MVZ-301', 'Farmacología y Terapéutica Veterinaria (Tupiza)', ['Antibióticos y Antiparasitarios Veterinarios', 'Anestésicos y Analgésicos', 'Vías de Administración', 'Residuos en Alimentos']],
        ['FCAP-MVZ-TUP', 'MVZ-401', 'Clínica y Cirugía de Grandes Animales (Tupiza)', ['Semiología Veterinaria', 'Patologías Digestivas en Rumiantes', 'Cirugía de Urgencia en Campo', 'Manejo Obstétrico']],
        ['FCAP-MVZ-TUP', 'MVZ-501', 'Salud Pública Veterinaria y Zoonosis (Tupiza)', ['Rabia, Brucelosis y Tuberculosis Bovina', 'Inspección de Carnes en Mataderos', 'Inocuidad de Alimentos de Origen Animal', 'Epidemiología Veterinaria']],

        // Agroindustrial Potosí (5 materias)
        ['FCAP-AGI', 'AGI-101', 'Química y Bioquímica de Alimentos', ['Agua y Actividad de Agua en Alimentos', 'Lípidos, Carbohidratos y Proteínas', 'Enzimas y Reacciones de Pardeamiento', 'Propiedades Sensoriales']],
        ['FCAP-AGI', 'AGI-201', 'Microbiología Industrial de Alimentos', ['Microorganismos Alterantes y Patógenos', 'Fermentaciones Industriales', 'Conservación por Calor y Frío', 'Análisis Microbiológico']],
        ['FCAP-AGI', 'AGI-301', 'Operaciones Unitarias Agroindustriales I', ['Mecánica de Fluidos para Alimentos', 'Transferencia de Calor y Pasteurización', 'Evaporación y Concentración', 'Refrigeración y Congelación']],
        ['FCAP-AGI', 'AGI-401', 'Tecnología de Granos y Tubérculos Andinos', ['Industrialización de la Quinua (Desaponificación)', 'Procesamiento de Harinas Compuestas', 'Tecnología del Chuño y Tunta', 'Extrusión de Alimentos']],
        ['FCAP-AGI', 'AGI-501', 'Control de Calidad e Inocuidad (HACCP/BPM)', ['Buenas Prácticas de Manufactura (BPM)', 'Sistema de Análisis de Peligros y Puntos Críticos (HACCP)', 'Normas ISO 22000', 'Trazabilidad Alimentaria']],

        // Desarrollo Rural (5 materias)
        ['FCAP-IDR', 'IDR-101', 'Sistemas Agrarios y Campesinados Andinos', ['Historia Agraria de Bolivia', 'Organización de Comunidades Originarias', 'Economía Familiar Campesina', 'Sistemas de Producción Tradicional']],
        ['FCAP-IDR', 'IDR-201', 'Extensión y Comunicación para el Desarrollo', ['Metodologías Participativas (Campesino a Campesino)', 'Escuelas de Campo (ECA)', 'Diseño de Medios de Difusión Rural', 'Facilitación de Talleres']],
        ['FCAP-IDR', 'IDR-301', 'Seguridad y Soberanía Alimentaria Rural', ['Disponibilidad, Acceso y Consumo de Alimentos', 'Soberanía Alimentaria en Políticas Públicas', 'Bancos Comunales de Semillas', 'Nutrición en Familias Rurales']],
        ['FCAP-IDR', 'IDR-401', 'Políticas Agrarias y Legislación Rural', ['Reforma Agraria y Ley INRA', 'Ley de Revolución Productiva (Ley 144)', 'Acceso al Crédito y Fondos de Desarrollo (FDI)', 'Conflictos por Recursos Naturales']],
        ['FCAP-IDR', 'IDR-501', 'Diseño y Evaluación de Proyectos de Desarrollo Rural', ['Diagnóstico Comunal Integral', 'Marco Lógico y Matriz de Planificación', 'Evaluación Social y Ambiental', 'Sostenibilidad de Proyectos Comunitarios']]
    ];

    foreach ($fcapSubjects as $s) {
        $courses[] = ['car_code' => $s[0], 'code' => $s[1], 'name' => $s[2], 'units' => $s[3], 'summary' => "Formación académica de {$s[2]} en la Facultad de Ciencias Agrícolas y Pecuarias de la UATF."];
    }

    // 13. Facultad de Artes (15 Cursos)
    $faSubjects = [
        // Arquitectura Potosí (5 materias)
        ['FA-ARQ', 'ARQ-101', 'Taller de Diseño Arquitectónico I', ['Espacio, Forma y Función', 'Escala y Proporción', 'Maquetería y Modelado', 'Concepto Arquitectónico']],
        ['FA-ARQ', 'ARQ-201', 'Historia de la Arquitectura y Urbanismo I', ['Arquitectura Clásica y Renacentista', 'Arquitectura Colonial Potosina', 'Barroco Andino y Portadas Coloniales', 'Evolución de la Trama Urbana']],
        ['FA-ARQ', 'ARQ-301', 'Construcciones y Tecnologías Arquitectónicas', ['Sistemas Constructivos Tradicionales (Adobe/Piedra)', 'Sistemas Estructurales Modernos', 'Instalaciones Integradas al Diseño', 'Detalles Constructivos']],
        ['FA-ARQ', 'ARQ-401', 'Restauración y Conservación de Monumentos', ['Teoría de la Restauración (Cartas de Venecia/Cracovia)', 'Patología de Edificaciones Históricas', 'Técnicas de Consolidación de Muros', 'Puesta en Valor de Inmuebles Patrimoniales']],
        ['FA-ARQ', 'ARQ-501', 'Urbanismo y Planificación Territorial', ['Morfología y Usos de Suelo Urbano', 'Movilidad y Espacio Público', 'Planes de Ordenamiento Urbano', 'Reglamentación del Centro Histórico de Potosí']],

        // Artes Musicales Potosí (5 materias)
        ['FA-ARM', 'ARM-101', 'Teoría de la Música y Solfeo I', ['Lectura Rítmica y Entonación', 'Intervalos y Escalas Diatónicas', 'Dictado Musical a Una Voz', 'Notación Musical']],
        ['FA-ARM', 'ARM-201', 'Armonía Tradicional y Funcional', ['Acordes Triadas y Cuatríadas', 'Cadencias y Progresiones Armónicas', 'Modulaciones Cercanas y Lejanas', 'Análisis Armónico de Obras']],
        ['FA-ARM', 'ARM-301', 'Historia de la Música Universal y Boliviana', ['Música del Barroco y Clasicismo', 'Música Virreinal de las Misiones y Charcas', 'Compositores Nacionales', 'Música Tradicional y Folclórica Andina']],
        ['FA-ARM', 'ARM-401', 'Contrapunto y Fuga', ['Contrapunto a Dos y Tres Voces', 'Especies Contrapuntísticas', 'Imitación y Canon', 'Estructura de la Fuga']],
        ['FA-ARM', 'ARM-501', 'Dirección Coral y Ensamble Instrumental', ['Técnica Gestual de Dirección', 'Ensayo y Preparación de Coros', 'Orquestación y Arreglos Musicales', 'Concierto de Graduación']],

        // Artes Plásticas Potosí (5 materias)
        ['FA-ARP', 'ARP-101', 'Dibujo Artístico y Expresión Gráfica', ['Línea, Valor y Sombreado', 'Anatomía Artística y Figura Humana', 'Perspectiva y Encuadre', 'Técnicas Secas (Grafito, Carboncillo)']],
        ['FA-ARP', 'ARP-201', 'Pintura y Teoría del Color', ['Comportamiento Físico y Emocional del Color', 'Técnicas al Óleo y Acrílico', 'Bodegón y Paisaje', 'Composición Pictórica']],
        ['FA-ARP', 'ARP-301', 'Escultura y Modelado Tridimensional', ['Modelado en Arcilla y Plastilina', 'Técnicas de Vaciado en Yeso y Resina', 'Talla en Madera y Piedra', 'Escultura Contemporánea e Instalación']],
        ['FA-ARP', 'ARP-401', 'Grabado y Artes Gráficas', ['Xilografía y Linograbado', 'Calcografía y Aguafuerte', 'Serigrafía Artística', 'Estampación y Edición de Obra Gráfica']],
        ['FA-ARP', 'ARP-501', 'Historia y Crítica del Arte Contemporáneo', ['Vanguardias del Siglo XX', 'Arte Latinoamericano y Boliviano', 'Estética y Semiótica del Arte', 'Montaje y Curaduría de Exposiciones']]
    ];

    foreach ($faSubjects as $s) {
        $courses[] = ['car_code' => $s[0], 'code' => $s[1], 'name' => $s[2], 'units' => $s[3], 'summary' => "Estudio creativo y técnico de {$s[2]} en la Facultad de Artes de la UATF."];
    }

    return $courses;
}
