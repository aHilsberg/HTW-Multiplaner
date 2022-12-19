import {Method} from '@inertiajs/inertia'

import useGlobal from '@/scripts/composables/useGlobal'
import {wrappedCall, wrappedUpdateCall} from '@/scripts/helpers/callUtil'
import {useValidatableForm, useWrappedForm} from '@/scripts/helpers/formUtil'

// #region auth
export const useRegisterForm = () =>
    useValidatableForm('register', Method.POST, {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        terms: false,
    })

export const useLoginForm = () =>
    useValidatableForm('login', Method.POST, {
        email: '',
        password: '',
        remember: false,
    })

export const useVerifyEmailForm = () =>
    useWrappedForm('verification.send', Method.POST, {})

export const useForgotPasswordForm = () =>
    useWrappedForm('password.email', Method.POST, {
        email: '',
    })

export const useUpdatePasswordForm = () =>
    useValidatableForm('password.update', Method.PUT, {
        current_password: '',
        password: '',
        password_confirmation: '',
    })

export const useResetPasswordForm = (token: string, email: string) =>
    useValidatableForm('password.store', Method.POST, {
        token,
        email,
        password: '',
        password_confirmation: '',
    })

export const useConfirmPasswordForm = () =>
    useWrappedForm('password.confirm', Method.POST, {
        password: '',
    })

export const useUpdateProfileForm = () => {
    const user = useGlobal().user
    return useValidatableForm('profile.update', Method.PATCH, {
        name: user!.name,
        email: user!.email,
    })
}

export const useDeleteProfileForm = () =>
    useWrappedForm('profile.destroy', Method.DELETE, {
        password: '',
    })
// #endregion

// #region relationships
export const useRequestFriendshipForm = () =>
    useValidatableForm('friendship.request', Method.POST, {
        name: '',
    })

export const acceptFriendshipCall = wrappedCall<{ friend_id: number }>(
    'friendship.accept',
    Method.PUT,
)

export const removeFriendshipCall = wrappedCall<{ friend_id: number }>(
    'friendship.remove',
    Method.DELETE,
)

export const useCreateGroupForm = () =>
    useValidatableForm('group.create', Method.POST, {
        name: '',
    })

export const renameGroupCall = wrappedCall<{ group_id: number; name: string }>(
    'group.rename',
    Method.PATCH,
)

export const updateGroupCall = wrappedCall<{
    group_id: number;
    // user ids
    additional_members: number[];
}>('group.update', Method.PUT)

export const removeGroupCall = wrappedCall<{
    group_id: number;
}>('group.remove', Method.DELETE)

export const useCreateEventForm = () =>
    useValidatableForm('event.create', Method.POST, {
        name: '',
    })

export const renameEventCall = wrappedCall<{ group_id: number; name: string }>(
    'event.rename',
    Method.PATCH,
)

export const updateEventCall = wrappedCall<{
    group_id: number;
    // user ids
    additional_members: number[];
}>('event.update', Method.PUT)

export const removeEventCall = wrappedCall<{
    group_id: number;
}>('event.remove', Method.DELETE)
// #endregion

// #region appointments TODO

// search
export const queryStudyGroupCall = wrappedUpdateCall<{
    query: {
        study_group: {
            id: string,
            page_index: number, page_count: number
        }
    }
}>()
export const queryModuleCall = wrappedUpdateCall<{
    query: {
        module: {
            faculty?: string, id?: string, lecturer?: string,
            page_index: number, page_count: number
        }
    }
}>()
// export const queryExamCall = wrappedCall<{ }>('query.exam', Method.POST)

// add module page

export const addAppointmentToTimetableCall = wrappedCall<{
    appointment_id: number;
}>('appointment.update', Method.PUT)
export const removeAppointmentFromTimetableCall = wrappedCall<{
    appointment_id: number;
}>('appointment.remove', Method.DELETE)

// vote

// create appointment

// #endregion
