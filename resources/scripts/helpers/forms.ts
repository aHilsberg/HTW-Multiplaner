import {useForm} from '@inertiajs/inertia-vue3'
import {usePrevalidate} from '@/scripts/helpers/formValidation'
import * as Inertia from '@inertiajs/inertia'
import {Method} from '@inertiajs/inertia'
import useGlobal from '@/scripts/composables/useGlobal'

const useValidatableForm = (routeName: string, method: Method, initialData: { [key: string]: any }) => {
    // @ts-ignore
    const url = route(routeName)
    const form = useForm(initialData)

    const {validate} = usePrevalidate(form, {method, url})

    const submit = (options?: Partial<Inertia.VisitOptions>) => form.submit(method, url, {
        ...options,
        onError: (errors) => {
            console.log({errors})
            form.clearErrors().setError(errors)

            if (options?.onError)
                options.onError(errors)
        },
    })

    return {form, validate, submit}
}


export const useRegisterForm = () => useValidatableForm('register', Method.POST, {
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
})

export const useLoginForm = () => useValidatableForm('login', Method.POST, {
    email: '',
    password: '',
    remember: false,
})

export const useVerifyEmailForm = () => useValidatableForm('verification.send', Method.POST, {})

export const useForgotPasswordForm = () => useValidatableForm('password.email', Method.POST, {
    email: '',
})

export const useUpdatePasswordForm = () => useValidatableForm('password.update', Method.PUT, {
    current_password: '',
    password: '',
    password_confirmation: '',
})

export const useResetPasswordForm = (token: string, email: string) => useValidatableForm('password.store', Method.POST, {
    token,
    email,
    password: '',
    password_confirmation: '',
})

export const useConfirmPasswordForm = () => useValidatableForm('password.confirm', Method.POST, {
    password: '',
})


export const useUpdateProfileForm = () => {
    const user = useGlobal().user
    return useValidatableForm('profile.update', Method.PATCH, {
        name: user!.name,
        email: user!.email,
    })
}

export const useDeleteProfileForm = () => useValidatableForm('profile.destroy', Method.DELETE, {
    password: '',
})
