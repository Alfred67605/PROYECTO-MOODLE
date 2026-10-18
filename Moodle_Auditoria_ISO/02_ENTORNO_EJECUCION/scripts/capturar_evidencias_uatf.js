const { chromium } = require('playwright');
const path = require('path');
const fs = require('fs');

const OUT_DIR = path.resolve(__dirname, '../../06_EVIDENCIAS_INSTALACION/capturas_poblamiento_uatf');
const VAULT_PATH = path.join(process.env.APPDATA, 'UATF_Credenciales_Sinteticas_Boveda.json');
let vault = {};
if (fs.existsSync(VAULT_PATH)) {
  vault = JSON.parse(fs.readFileSync(VAULT_PATH, 'utf8'));
}

async function run() {
  console.log('Capturando vistas de Docente y Estudiante...');

  const browser = await chromium.launch({
    executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
    headless: true
  });

  // 1. SESIÓN DOCENTE (docente001)
  try {
    const docContext = await browser.newContext({ viewport: { width: 1440, height: 900 } });
    const page = await docContext.newPage();
    const docPass = vault['docente001'];
    console.log('Iniciando sesión docente001...');
    await page.goto('http://localhost:8000/login/index.php');
    await page.fill('#username', 'docente001');
    await page.fill('#password', docPass);
    await page.click('#loginbtn');
    await page.waitForLoadState('networkidle');

    // 12. Mis Cursos Asignados Docente
    await page.goto('http://localhost:8000/my/courses.php');
    await page.waitForLoadState('networkidle');
    await page.screenshot({ path: path.join(OUT_DIR, '12_docente_mis_cursos_asignados.png') });
    console.log('  [CAPTURADO] 12_docente_mis_cursos_asignados.png');

    // 13. Calificador visto por Docente
    await page.goto('http://localhost:8000/grade/report/grader/index.php?id=8');
    await page.waitForLoadState('networkidle');
    await page.screenshot({ path: path.join(OUT_DIR, '13_docente_gestion_calificaciones.png') });
    console.log('  [CAPTURADO] 13_docente_gestion_calificaciones.png');

    await docContext.close();
  } catch (err) {
    console.error('Error en docente:', err);
  }

  // 2. SESIÓN ESTUDIANTE (estudiante0001)
  try {
    const estContext = await browser.newContext({ viewport: { width: 1440, height: 900 } });
    const page = await estContext.newPage();
    const estPass = vault['estudiante0001'];
    console.log('Iniciando sesión estudiante0001...');
    await page.goto('http://localhost:8000/login/index.php');
    await page.fill('#username', 'estudiante0001');
    await page.fill('#password', estPass);
    await page.click('#loginbtn');
    await page.waitForLoadState('networkidle');

    // 14. Dashboard Estudiante
    await page.goto('http://localhost:8000/my/courses.php');
    await page.waitForLoadState('networkidle');
    await page.screenshot({ path: path.join(OUT_DIR, '14_estudiante_dashboard_mis_cursos.png') });
    console.log('  [CAPTURADO] 14_estudiante_dashboard_mis_cursos.png');

    // 15. Boleta de Calificaciones Privada
    await page.goto('http://localhost:8000/grade/report/user/index.php?id=8');
    await page.waitForLoadState('networkidle');
    await page.screenshot({ path: path.join(OUT_DIR, '15_estudiante_boleta_calificaciones_privada.png') });
    console.log('  [CAPTURADO] 15_estudiante_boleta_calificaciones_privada.png');

    await estContext.close();
  } catch (err) {
    console.error('Error en estudiante:', err);
  }

  await browser.close();
  console.log('Capturas complementarias finalizadas con éxito.');
}

run();
