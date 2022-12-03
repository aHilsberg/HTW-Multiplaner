import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import {importPageComponent} from '@/scripts/vite/import-page-component'
// @ts-ignore
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import weekday from 'dayjs/plugin/weekday'
import VCalendar from 'v-calendar'
import { extend as extendDayjs, locale as setDayjsLocale } from 'dayjs'
import flashPlugin from '@/scripts/plugins/flash.plugin'
import defaultPlugin from '@/scripts/plugins/default.plugin'

createInertiaApp({
    title: title => `${title} - HTW-Multiplaner`,
    resolve: (name) =>
        importPageComponent(name, import.meta.glob('../views/pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(defaultPlugin)
            .use(ZiggyVue)
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
