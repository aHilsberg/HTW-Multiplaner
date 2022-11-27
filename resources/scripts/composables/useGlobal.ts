import {reactive, ref} from 'vue'
import {ExtendedUser, FriendshipStatus, Group, User} from '@/scripts/types/userRelationships'

const state = reactive<{
    user?: ExtendedUser,
    friends?: (User & { friendshipState: FriendshipStatus })[]
    groups?: Group[],
    events?: Event[],
}>({})


const useGlobal = () => state
export default useGlobal

export const isLoggedIn = () => !!state.user
