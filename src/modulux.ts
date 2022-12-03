
import { PlaywrightCrawler } from 'crawlee';
import { router } from './routes';

const startUrls = ['https://apps.htw-dresden.de/app-modulux/frontend/module/'];

const crawler = new PlaywrightCrawler({
    requestHandler: router,
});

crawler.run(startUrls);
