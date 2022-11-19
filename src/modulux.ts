
import { PlaywrightCrawler, ProxyConfiguration } from 'crawlee';
import { router } from './routes.js';

const startUrls = ['https://apps.htw-dresden.de/app-modulux/frontend/module/'];

const crawler = new PlaywrightCrawler({
    requestHandler: router,
});

await crawler.run(startUrls);
