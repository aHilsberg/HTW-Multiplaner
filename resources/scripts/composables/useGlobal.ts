import {reactive} from 'vue'

import {
    ExtendedUser,
    FriendshipStatus,
    Group,
    User,
    Event, StudyGroup,
} from '@/scripts/types/userRelationships'

const state = reactive<{
    user?: ExtendedUser;
    friends?: (User & { friendshipState: FriendshipStatus })[];
    groups?: Group[];
    events?: Event[];
    query?: {
        studyGroup: {
            studyGroups?: StudyGroup[]
            count: number
        }
    }
}>
({})


const useGlobal = () => state
export default useGlobal

export const isLoggedIn = () => !!state.user
