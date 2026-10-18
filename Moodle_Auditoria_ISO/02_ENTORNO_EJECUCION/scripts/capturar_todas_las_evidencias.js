/**
 * Generador Automatizado de Capturas Oficiales de Evidencia - Moodle 5.3 Auditoría ISO
 * Ejecuta Chrome headless con CDP nativo, autentica al administrador admin_auditoria,
 * recorre cada módulo del sistema y genera las 15 capturas oficiales de auditoría.
 */

const { spawn } = require('child_process');
const http = require('http');
const fs = require('fs');
const path = require('path');

const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
const profileDir = 'C:\\Users\\llano\\.gemini\\antigravity-ide\\brain\\e2796955-dea8-4069-87c4-394f9484dcc1\\scratch\\chrome_profile_audit';
const outputDir = 'c:\\Users\\llano\\OneDrive\\Documentos\\OCTAVO SEMESTRE\\AUDITORIA\\PROYECTO\\Moodle_Auditoria_ISO\\06_EVIDENCIAS_INSTALACION\\capturas';

if (!fs.existsSync(outputDir)) {
    fs.mkdirSync(outputDir, { recursive: true });
}

async function run() {
    console.log('Iniciando navegador Chrome headless para captura de evidencias...');
    const chrome = spawn(chromePath, [
        '--headless=new',
        '--remote-debugging-port=9225',
        `--user-data-dir=${profileDir}`,
        '--window-size=1440,900',
        '--disable-gpu',
        '--no-first-run'
    ]);

    await new Promise(r => setTimeout(r, 2000));

    const listData = await new Promise((resolve, reject) => {
        http.get('http://127.0.0.1:9225/json/list', res => {
            let data = '';
            res.on('data', chunk => data += chunk);
            res.on('end', () => resolve(JSON.parse(data)));
        }).on('error', reject);
    });

    const pageTarget = listData.find(t => t.type === 'page');
    console.log('Conectando a WebSocket CDP:', pageTarget.webSocketDebuggerUrl);

    const ws = new WebSocket(pageTarget.webSocketDebuggerUrl);
    await new Promise(resolve => ws.onopen = resolve);

    let msgId = 1;
    const callbacks = new Map();

    ws.onmessage = (event) => {
        const data = JSON.parse(event.data);
        if (data.id && callbacks.has(data.id)) {
            const cb = callbacks.get(data.id);
            callbacks.delete(data.id);
            cb(data.result);
        }
    };

    function send(method, params = {}) {
        return new Promise(resolve => {
            const id = msgId++;
            callbacks.set(id, resolve);
            ws.send(JSON.stringify({ id, method, params }));
        });
    }

    async function evaluate(expression) {
        return await send('Runtime.evaluate', { expression, returnByValue: true, awaitPromise: true });
    }

    async function capture(filename, waitMs = 2500) {
        if (waitMs > 0) await new Promise(r => setTimeout(r, waitMs));
        const shot = await send('Page.captureScreenshot', { format: 'png' });
        const filePath = path.join(outputDir, filename);
        fs.writeFileSync(filePath, Buffer.from(shot.data, 'base64'));
        console.log(`[CAPTURA GUARDADA] ${filename} (${shot.data.length} bytes)`);
    }

    await send('Page.enable');
    await send('Network.enable');

    // 1. EVID-001: Pantalla Principal / Home Público
    console.log('\n--- Capturando EVID-001: Home Público ---');
    await send('Page.navigate', { url: 'http://localhost:8000/' });
    await capture('EVID-001_Home_Publico.png', 3000);

    // 2. EVID-002: Pantalla de Login
    console.log('\n--- Capturando EVID-002: Formulario de Login ---');
    await send('Page.navigate', { url: 'http://localhost:8000/login/index.php' });
    await capture('EVID-002_Login.png', 2000);

    // Iniciar Sesión como admin_auditoria
    console.log('\nAutenticando como Administrador: admin_auditoria...');
    await evaluate(`
        document.querySelector('#username').value = 'admin_auditoria';
        document.querySelector('#password').value = 'Audit_2026!Secure';
        document.querySelector('#loginbtn').click();
    `);
    await new Promise(r => setTimeout(r, 4000));

    // 3. EVID-003: Área Personal / Dashboard del Administrador
    console.log('\n--- Capturando EVID-003: Dashboard / Área Personal ---');
    await send('Page.navigate', { url: 'http://localhost:8000/my/' });
    await capture('EVID-003_Dashboard.png', 3000);

    // 4. EVID-004: Administración del Sitio
    console.log('\n--- Capturando EVID-004: Administración del Sitio ---');
    await send('Page.navigate', { url: 'http://localhost:8000/admin/' });
    await capture('EVID-004_Administracion_Sitio.png', 3000);

    // 5. EVID-005: Notificaciones y Versión Moodle 5.3
    console.log('\n--- Capturando EVID-005: Versión Moodle 5.3 ---');
    await send('Page.navigate', { url: 'http://localhost:8000/admin/index.php' });
    await capture('EVID-005_Version_Moodle.png', 3000);

    // 6. EVID-006: Información del Entorno PHP
    console.log('\n--- Capturando EVID-006: Información PHP ---');
    await send('Page.navigate', { url: 'http://localhost:8000/admin/phpinfo.php' });
    await capture('EVID-006_Informacion_PHP.png', 2500);

    // 7. EVID-007: Entorno del Servidor / PostgreSQL
    console.log('\n--- Capturando EVID-007: Entorno del Servidor y Base de Datos ---');
    await send('Page.navigate', { url: 'http://localhost:8000/admin/environment.php' });
    await capture('EVID-007_PostgreSQL_Estado.png', 3000);

    // 8. EVID-008: Gestión de Usuarios Ficticios
    console.log('\n--- Capturando EVID-008: Gestión de Usuarios ---');
    await send('Page.navigate', { url: 'http://localhost:8000/admin/user.php' });
    await capture('EVID-008_Usuarios_Cuentas.png', 3000);

    // 9. EVID-009: Definición y Gestión de Roles
    console.log('\n--- Capturando EVID-009: Roles y Permisos RBAC ---');
    await send('Page.navigate', { url: 'http://localhost:8000/admin/roles/manage.php' });
    await capture('EVID-009_Roles_Permisos.png', 3000);

    // 10. EVID-010: Curso AUD-101 Auditoría de Sistemas
    console.log('\n--- Capturando EVID-010: Curso AUD-101 ---');
    await send('Page.navigate', { url: 'http://localhost:8000/course/view.php?id=2' });
    await capture('EVID-010_Curso_AUD101.png', 3000);

    // 11. EVID-011: Registro de Logs y Trazabilidad
    console.log('\n--- Capturando EVID-011: Logs y Trazabilidad ---');
    await send('Page.navigate', { url: 'http://localhost:8000/report/log/index.php?id=2' });
    await capture('EVID-011_Logs_Trazabilidad.png', 3000);

    // 12. EVID-012: Comprobaciones de Seguridad (Línea Base)
    console.log('\n--- Capturando EVID-012: Comprobaciones de Seguridad ---');
    await send('Page.navigate', { url: 'http://localhost:8000/report/security/index.php' });
    await capture('EVID-012_Comprobaciones_Seguridad.png', 4000);

    // 13. EVID-013: Manifiesto y Respaldo Completo de Auditoría
    console.log('\n--- Capturando EVID-013: Evidencia de Respaldo y Manifiesto ---');
    const manifestContent = fs.readFileSync('c:\\Users\\llano\\OneDrive\\Documentos\\OCTAVO SEMESTRE\\AUDITORIA\\PROYECTO\\Moodle_Auditoria_ISO\\07_BACKUPS\\MANIFIESTO_BACKUP.txt', 'utf8');
    const manifestHtml = `data:text/html;charset=utf-8,` + encodeURIComponent(`
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="utf-8">
            <title>Evidencia de Respaldo - Moodle 5.3</title>
            <style>
                body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #0f172a; color: #f8fafc; padding: 40px; }
                .card { background: #1e293b; border-radius: 12px; border: 1px solid #334155; padding: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); }
                h1 { color: #38bdf8; margin-top: 0; font-size: 24px; border-bottom: 2px solid #0284c7; padding-bottom: 12px; }
                pre { background: #090d16; color: #34d399; padding: 20px; border-radius: 8px; font-family: 'Consolas', monospace; font-size: 14px; line-height: 1.6; border: 1px solid #1e293b; overflow-x: auto; }
                .badge { background: #0284c7; color: white; padding: 6px 14px; border-radius: 20px; font-weight: bold; font-size: 13px; display: inline-block; margin-bottom: 15px; }
            </style>
        </head>
        <body>
            <div class="card">
                <span class="badge">EVIDENCIA AUDITORÍA ISO / CONTROL A.8.13</span>
                <h1>EVID-013: MANIFIESTO OFICIAL DE RESPALDO Y VERIFICACIÓN CRIPTOGRÁFICA</h1>
                <pre>${manifestContent.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</pre>
            </div>
        </body>
        </html>
    `);
    await send('Page.navigate', { url: manifestHtml });
    await capture('EVID-013_Backup_Ejecucion.png', 1500);

    // 14. EVID-014: Tareas Programadas / Cron
    console.log('\n--- Capturando EVID-014: Tareas Programadas / Cron ---');
    await send('Page.navigate', { url: 'http://localhost:8000/admin/tool/task/scheduledtasks.php' });
    await capture('EVID-014_Cron_Ejecucion.png', 3000);

    // 15. EVID-015: Configuración de Idioma Español
    console.log('\n--- Capturando EVID-015: Configuración de Idioma Español ---');
    await send('Page.navigate', { url: 'http://localhost:8000/admin/settings.php?section=langsettings' });
    await capture('EVID-015_Idioma_Espanol.png', 3000);

    console.log('\n¡TODAS LAS 15 CAPTURAS DE EVIDENCIA HAN SIDO GENERADAS CON ÉXITO!');

    ws.close();
    chrome.kill();
}

run().catch(err => {
    console.error('Error durante la captura de evidencias:', err);
    process.exit(1);
});
