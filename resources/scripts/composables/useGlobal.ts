import {reactive, ref} from 'vue'
import {FriendshipStatus, User} from '@/scripts/types/basic'
import {Group} from '@/scripts/types/userRelationships'

const state = reactive<{
    user?: User,
    friends?: (User & { friendshipState: FriendshipStatus })[]
    groups?: Group[],
    events?: Event[],
}>({})

const useGlobal = () => state
export default useGlobal

export const isLoggedIn = () => !!state.user
