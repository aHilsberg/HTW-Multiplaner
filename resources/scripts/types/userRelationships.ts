export type User = {
    id: number;
    name: string;
};
export type ExtendedUser = User & {
    email: string;
};

export enum FriendshipStatus {
    AwaitingResponse,
    Invited,
    Befriended,
}

export type Group = {
    id: number;
    name: string;
    members: User[];
};

export type Event = {
    id: number;
    name: string;
    members: User[];
};


export type StudyGroup = {
    id: string
}
