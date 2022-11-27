import {Method} from '@inertiajs/inertia'
import useGlobal from '@/scripts/composables/useGlobal'
import {useValidatableForm, useWrappedForm} from '@/scripts/helpers/formUtil'
import {wrappedCall} from '@/scripts/helpers/callUtil'


// #region auth
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

export const useVerifyEmailForm = () => useWrappedForm('verification.send', Method.POST, {})

export const useForgotPasswordForm = () => useWrappedForm('password.email', Method.POST, {
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

export const useConfirmPasswordForm = () => useWrappedForm('password.confirm', Method.POST, {
    password: '',
})


export const useUpdateProfileForm = () => {
    const user = useGlobal().user
    return useValidatableForm('profile.update', Method.PATCH, {
        name: user!.name,
        email: user!.email,
    })
}

export const useDeleteProfileForm = () => useWrappedForm('profile.destroy', Method.DELETE, {
    password: '',
})
// #endregion


// #region relationships
export const useRequestFriendshipForm = () => useValidatableForm('friendship.request', Method.POST, {
    name: '',
})

export const acceptFriendshipCall = wrappedCall<{ friend_id: number }>('friendship.accept', Method.PUT)

export const removeFriendshipCall = wrappedCall<{ friend_id: number }>('friendship.remove', Method.DELETE)
// #endregion
