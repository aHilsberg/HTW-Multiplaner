import {reactive} from 'vue'

import {
    ExtendedUser,
    FriendshipStatus,
    Group,
    User,
    Event,
} from '@/scripts/types/userRelationships'
import {Module, StudyGroup} from '@/scripts/types/datatypes'

const state = reactive<{
    user?: ExtendedUser;
    friends?: (User & { friendshipState: FriendshipStatus })[];
    groups?: Group[];
    events?: Event[];
    query?: {
        studyGroup: {
            studyGroups?: StudyGroup[]
            count: number
        },
        module: {
            modules: Module[];
            count: number;
        }
    };
    faculties?: string[]
}>
({})


const useGlobal = () => state
export default useGlobal

export const isLoggedIn = () => !!state.user
