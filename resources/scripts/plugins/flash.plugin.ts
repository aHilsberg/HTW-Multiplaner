import { App, SetupContext, ref, readonly, Ref, InjectionKey } from "vue";

import AlertMessage from "@/views/components/flash/alert.vue";
import ErrorMessage from "@/views/components/flash/error.vue";
import InfoMessage from "@/views/components/flash/info.vue";
import SuccessMessage from "@/views/components/flash/success.vue";

export type FlashMessageProps = {
    header: string;
    text: string;
};

export interface FlashMessage {
    component: any;
    attrs: SetupContext["attrs"];
    lifetime: number;
}

export interface ActiveFlashMessage extends FlashMessage {
    id: number;
    lifeline?: number;
}

const defaultMessages: { prefix: string; message: FlashMessage }[] = [
    {
        prefix: "+",
        message: { component: SuccessMessage, attrs: {}, lifetime: 5000 },
    },
    {
        prefix: "!",
        message: { component: AlertMessage, attrs: {}, lifetime: 10_000 },
    },
    {
        prefix: "-",
        message: { component: ErrorMessage, attrs: {}, lifetime: 8000 },
    },
    {
        prefix: "i",
        message: { component: InfoMessage, attrs: {}, lifetime: -1 },
    },
];

let cMessages = 0;
const messages = ref<ActiveFlashMessage[]>([]);

export interface FlashProvides {
    activeMessages: Readonly<Ref<ActiveFlashMessage[]>>;
    createFlashMessage: (flashString: string) => void;
    initFlashMessage: (msg: FlashMessage) => void;
    createErrorMessage: (errors: any | { [key in string]: string }) => void;
    closeFlash: (id: number) => void;
}

export const flashKey: InjectionKey<FlashProvides> = Symbol("flash:plugin");

function activateMessage(message: FlashMessage) {
    const activeMessage = message as ActiveFlashMessage;
    activeMessage.id = cMessages++;

    if (activeMessage.lifetime > 0) {
        // + to convert to primitive (number)
        activeMessage.lifeline = +setTimeout(() => {
            removeMessage(activeMessage);
        }, activeMessage.lifetime);
    }
    messages.value.push(activeMessage);
    return activeMessage;
}

function removeMessage(message: ActiveFlashMessage) {
    const i = messages.value.findIndex((m) => m.id == message.id);

    if (i < 0) return;

    clearTimeout(message.id);
    messages.value.splice(i, 1);
}

// plugins interface
export default {
    install: (app: App<Element>) => {
        //type header \n text
        const addFlashString = (text: string) => {
            //check all default prefixes
            if (
                defaultMessages.every((defaultMessage) => {
                    if (text.startsWith(defaultMessage.prefix)) {
                        const message = { ...defaultMessage.message };
                        message.attrs = { ...message.attrs };
                        const iBody = text.indexOf("\n");

                        if (iBody == -1) {
                            message.attrs.header = text.slice(
                                defaultMessage.prefix.length
                            );
                        } else {
                            message.attrs.header = text.slice(
                                defaultMessage.prefix.length,
                                iBody
                            );
                            message.attrs.text = text.slice(iBody + 1);
                        }
                        activateMessage(message);
                        return false;
                    }
                    return true;
                })
            ) {
                //none default info
                activateMessage({
                    component: InfoMessage,
                    attrs: { header: text },
                    lifetime: 5000,
                });
            }
        };

        const closeFlash = (id: number) => {
            const message = activeMessages.value.find((m) => m.id == id);
            if (message == undefined) return;

            removeMessage(message);
        };

        const flashErrors = (errors: any | { [key in string]: string }) => {
            let flashString = "-";
            if (typeof errors == "object") {
                flashString += "Fehler\n";
                flashString += Object.keys(errors)
                    .map((key) => errors[key].toString())
                    .join("\\-");
            } else flashString += errors.toString();

            addFlashString(flashString);
        };

        const activeMessages = readonly(messages);

        app.provide<FlashProvides>(flashKey, {
            activeMessages: activeMessages as Readonly<
                Ref<ActiveFlashMessage[]>
            >,
            createFlashMessage: addFlashString,
            initFlashMessage: activateMessage,
            createErrorMessage: flashErrors,
            closeFlash,
        });
    },
};
