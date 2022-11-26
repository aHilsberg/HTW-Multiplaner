import {watch} from 'vue'
import {Inertia, Method} from '@inertiajs/inertia'
import {InertiaFormProps} from '@inertiajs/inertia-vue3'

export function usePrevalidate(form: InertiaFormProps<{ [key: string]: any }>, {
    method,
    url,
}: { method: Method, url: string }) {
    let touchedFields = new Set()
    let needsValidation = false

    watch(() => form.data(), (newData, oldData) => {
        let changedFields = Object.keys(newData).filter(field => newData[field] !== oldData[field])

        touchedFields = new Set([...changedFields, ...touchedFields])

        needsValidation = true
    })

    function validate() {
        if(!needsValidation)
            return

        Inertia.visit(url, {
            method: method,
            data: {
                ...form.data(),
                prevalidate: true,
            },
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                return form.clearErrors()
            },
            onError: (errors) => {
                console.log(JSON.stringify(errors))
                Object.keys(errors)
                    .filter(field => !touchedFields.has(field))
                    .forEach(field => delete errors[field])

                form.clearErrors().setError(errors)
            },
        })
    }

    return {validate}
}
