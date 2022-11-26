import {ref} from 'vue'
import {User} from '@/scripts/types/basic'

const state = ref<User>()

const useUser = () => state
export default useUser

export const isLoggedIn = () => !!state.value
