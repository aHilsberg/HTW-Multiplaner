import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import {importPageComponent} from '@/scripts/vite/import-page-component'

import weekday from 'dayjs/plugin/weekday'
import VCalendar from 'v-calendar'
import { extend as extendDayjs, locale as setDayjsLocale } from 'dayjs'
import flashPlugin from '@/scripts/plugins/flash.plugin'

createInertiaApp({
    resolve: (name) =>
        importPageComponent(name, import.meta.glob('../views/pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(() => {
                extendDayjs(weekday)
                setDayjsLocale('de')
                InertiaProgress.init({
                    delay: 0,
                    color: '#00305d',
                })
            })
            .use(VCalendar, {
                locale: 'de',
            })
            .use(flashPlugin)
            .mount(el)
    },
});
