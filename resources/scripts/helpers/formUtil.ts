import * as InertiaTypes from "@inertiajs/inertia";
import { Method, Inertia } from "@inertiajs/inertia";
import { InertiaFormProps, useForm } from "@inertiajs/inertia-vue3";
import { watch } from "vue";

export const useWrappedForm = <T extends { [key: string]: any }>(
    routeName: string,
    method: Method,
    initialData: T
) => {
    // @ts-ignore
    const url = route(routeName);
    const form = useForm(initialData);

    const submit = (options?: Partial<InertiaTypes.VisitOptions>) =>
        form.submit(method, url, {
            ...options,
            onError: (errors) => {
                form.clearErrors().setError(errors as any);

                if (options?.onError) options.onError(errors);
            },
        });

    return { form, url, submit };
};

export function usePrevalidate(
    form: InertiaFormProps<{ [key: string]: any }>,
    { method, url }: { method: Method; url: string }
) {
    let touchedFields = new Set();
    let needsValidation = false;

    watch(
        () => form.data(),
        (newData, oldData) => {
            const changedFields = Object.keys(newData).filter(
                (field) => newData[field] !== oldData[field]
            );

            touchedFields = new Set([...changedFields, ...touchedFields]);

            needsValidation = true;
        }
    );

    function validate() {
        if (!needsValidation) return;

        Inertia.visit(url, {
            method: method,
            data: {
                ...form.data(),
                prevalidate: true,
            },
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                return form.clearErrors();
            },
            onError: (errors) => {
                console.log(JSON.stringify(errors));
                for (const field of Object.keys(errors).filter(
                    (field) => !touchedFields.has(field)
                ))
                    delete errors[field];

                form.clearErrors().setError(errors);
            },
        });
    }

    return { validate };
}

export const useValidatableForm = <T extends { [key: string]: any }>(
    routeName: string,
    method: Method,
    initialData: T
) => {
    const { form, submit, url } = useWrappedForm(
        routeName,
        method,
        initialData
    );
    const { validate } = usePrevalidate(form, { method, url });

    return { form, validate, submit };
};
