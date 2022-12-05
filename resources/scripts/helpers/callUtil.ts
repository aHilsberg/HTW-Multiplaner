import { Inertia, Method } from "@inertiajs/inertia";
import * as InertiaTypes from "@inertiajs/inertia";

export const wrappedCall = <T>(routeName: string, method: Method) => {
    // @ts-ignore
    const url = route(routeName);

    return (options: Partial<InertiaTypes.VisitOptions> & { data: T }) => {
        Inertia.visit(url, {
            method: method,
            ...options,
        });
    };
};
