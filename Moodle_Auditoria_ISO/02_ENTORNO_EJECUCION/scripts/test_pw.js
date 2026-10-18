const { chromium } = require('playwright');

(async () => {
  try {
    const browser = await chromium.launch({
      executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
      headless: true
    });
    const page = await browser.newPage();
    await page.goto('http://localhost:8000');
    console.log('Page title:', await page.title());
    await browser.close();
    console.log('Playwright Chrome test OK!');
  } catch (err) {
    console.error('Playwright error:', err);
  }
})();
