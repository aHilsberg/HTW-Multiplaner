import { App, onBeforeMount, readonly, ref } from "vue";

let cuid = 0;

export const useUid = () => {
    const uid = ref<number>(-1)


    onBeforeMount(() => {
        cuid += 1;
        uid.value = cuid;
    })

    return readonly(uid)
};

export default {
    install: (app: App<Element>) => {
        app.directive("autofocus", {
            mounted(el) {
                el.focus();
            },
        });
    },
};
