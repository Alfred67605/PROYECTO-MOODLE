const fs = require('fs');
const path = require('path');
const { execSync } = require('child_process');

const mdPath = path.join(__dirname, 'INFORME_VERIFICACION_PREAUDITORIA.md');
const htmlPath = path.join(__dirname, 'INFORME_VERIFICACION_PREAUDITORIA.html');
const pdfPath = path.join(__dirname, 'INFORME_VERIFICACION_PREAUDITORIA.pdf');

const mdContent = fs.readFileSync(mdPath, 'utf8');

function markdownToHtml(md) {
    let lines = md.split(/\r?\n/);
    let html = '';
    let inTable = false;
    let tableRows = [];
    let inAlert = false;
    let alertContent = [];

    for (let i = 0; i < lines.length; i++) {
        let line = lines[i];

        // Alert blockquotes
        if (line.startsWith('> [!IMPORTANT]')) {
            inAlert = true;
            alertContent = [];
            continue;
        } else if (inAlert && line.startsWith('>')) {
            alertContent.push(line.replace(/^>\s*/, ''));
            continue;
        } else if (inAlert && !line.startsWith('>')) {
            inAlert = false;
            html += `<div class="alert alert-important">\n<div class="alert-title">AVISO METODOLÓGICO DE AUDITORÍA</div>\n`;
            html += alertContent.map(l => formatInline(l)).join('<br>\n');
            html += `\n</div>\n`;
        }

        // Tables
        if (line.trim().startsWith('|') && line.trim().endsWith('|')) {
            if (!inTable) {
                inTable = true;
                tableRows = [];
            }
            tableRows.push(line.trim());
            continue;
        } else if (inTable) {
            inTable = false;
            html += renderTable(tableRows);
            tableRows = [];
        }

        // Headings
        if (line.startsWith('# ')) {
            html += `<h1>${formatInline(line.substring(2))}</h1>\n`;
        } else if (line.startsWith('## ')) {
            html += `<h2>${formatInline(line.substring(3))}</h2>\n`;
        } else if (line.startsWith('### ')) {
            html += `<h3>${formatInline(line.substring(4))}</h3>\n`;
        } else if (line.trim() === '---') {
            html += `<hr>\n`;
        } else if (line.trim().startsWith('- ')) {
            html += `<ul>\n<li>${formatInline(line.trim().substring(2))}</li>\n</ul>\n`;
        } else if (line.trim().length > 0) {
            html += `<p>${formatInline(line)}</p>\n`;
        }
    }

    if (inAlert) {
        html += `<div class="alert alert-important">\n<div class="alert-title">AVISO METODOLÓGICO DE AUDITORÍA</div>\n`;
        html += alertContent.map(l => formatInline(l)).join('<br>\n');
        html += `\n</div>\n`;
    }
    if (inTable) {
        html += renderTable(tableRows);
    }

    // Combine consecutive <ul> tags
    html = html.replace(/<\/ul>\s*<ul>/g, '\n');

    return html;
}

function renderTable(rows) {
    if (rows.length < 2) return '';
    let out = '<table>\n<thead>\n<tr>\n';
    let headers = rows[0].split('|').map(c => c.trim()).filter((c, idx, arr) => idx > 0 && idx < arr.length - 1);
    headers.forEach(h => {
        out += `<th>${formatInline(h)}</th>\n`;
    });
    out += '</tr>\n</thead>\n<tbody>\n';

    for (let r = 2; r < rows.length; r++) {
        let cells = rows[r].split('|').map(c => c.trim()).filter((c, idx, arr) => idx > 0 && idx < arr.length - 1);
        if (cells.length === 0) continue;
        out += '<tr>\n';
        cells.forEach(c => {
            out += `<td>${formatInline(c)}</td>\n`;
        });
        out += '</tr>\n';
    }
    out += '</tbody>\n</table>\n';
    return out;
}

function formatInline(text) {
    return text
        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
        .replace(/\*(.*?)\*/g, '<em>$1</em>')
        .replace(/`([^`]+)`/g, '<code>$1</code>')
        .replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2">$1</a>');
}

const bodyHtml = markdownToHtml(mdContent);

const fullHtml = `<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe Técnico de Verificación Pre-Auditoría - Moodle 5.3</title>
    <style>
        @page {
            size: A4;
            margin: 18mm 15mm 20mm 15mm;
            @bottom-right {
                content: "Página " counter(page) " de " counter(pages);
            }
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #1a202c;
            background-color: #ffffff;
            line-height: 1.55;
            font-size: 10.5pt;
            margin: 0;
            padding: 0;
        }
        h1 {
            font-size: 17pt;
            color: #1a365d;
            border-bottom: 2px solid #2b6cb0;
            padding-bottom: 6px;
            margin-top: 18px;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        h2 {
            font-size: 13pt;
            color: #2b6cb0;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 4px;
            margin-top: 18px;
            margin-bottom: 8px;
        }
        h3 {
            font-size: 11pt;
            color: #2d3748;
            margin-top: 12px;
            margin-bottom: 6px;
        }
        p {
            margin: 5px 0 8px 0;
        }
        hr {
            border: 0;
            height: 1px;
            background-color: #cbd5e0;
            margin: 16px 0;
        }
        ul {
            margin: 4px 0 10px 20px;
            padding: 0;
        }
        li {
            margin-bottom: 4px;
        }
        code {
            font-family: Consolas, "Courier New", monospace;
            background-color: #edf2f7;
            padding: 2px 5px;
            border-radius: 4px;
            font-size: 9.5pt;
            color: #c53030;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 12px 0 16px 0;
            font-size: 9pt;
            page-break-inside: avoid;
        }
        th, td {
            border: 1px solid #cbd5e0;
            padding: 6px 9px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #2b6cb0;
            color: #ffffff;
            font-weight: 600;
        }
        tr:nth-child(even) td {
            background-color: #f7fafc;
        }
        .alert {
            padding: 12px 16px;
            margin: 14px 0;
            border-radius: 6px;
            border-left: 5px solid #dd6b20;
            background-color: #fffaf0;
            page-break-inside: avoid;
        }
        .alert-title {
            font-weight: bold;
            color: #c05621;
            margin-bottom: 6px;
            text-transform: uppercase;
            font-size: 9.5pt;
            letter-spacing: 0.5px;
        }
        .header-box {
            background: linear-gradient(135deg, #1a365d 0%, #2b6cb0 100%);
            color: white;
            padding: 18px 22px;
            border-radius: 8px;
            margin-bottom: 18px;
        }
        .header-box h1 {
            color: white;
            border: none;
            margin: 0 0 6px 0;
            padding: 0;
            font-size: 18pt;
        }
        .header-box p {
            margin: 2px 0;
            font-size: 10pt;
            opacity: 0.95;
        }
        a {
            color: #2b6cb0;
            text-decoration: none;
        }
    </style>
</head>
<body>
    ${bodyHtml}
</body>
</html>`;

fs.writeFileSync(htmlPath, fullHtml, 'utf8');
console.log('HTML generado:', htmlPath);

// Compilar a PDF con Chrome Headless
const chromeExe = "C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe";
const chromeCmd = `"${chromeExe}" --headless --disable-gpu --no-pdf-header-footer --print-to-pdf="${pdfPath}" "${htmlPath}"`;

console.log('Compilando a PDF mediante Google Chrome Headless...');
try {
    execSync(chromeCmd, { stdio: 'inherit' });
    console.log('PDF generado exitosamente en:', pdfPath);
    const stats = fs.statSync(pdfPath);
    console.log('Tamaño del PDF generado:', stats.size, 'bytes');
} catch (e) {
    console.error('Error al generar PDF con Chrome:', e);
    process.exit(1);
}
