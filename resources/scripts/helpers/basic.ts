import { FriendshipStatus } from "@/scripts/types/userRelationships";

export const friendshipStatusText = (status: FriendshipStatus) => {
    switch (status) {
        case FriendshipStatus.AwaitingResponse: {
            return "Anfrage gesendet";
        }
        case FriendshipStatus.Befriended: {
            return "";
        }
        case FriendshipStatus.Invited: {
            return "Angefragt";
        }
        default: {
            return "";
        }
    }
};

export const friendshipStatusColor = (status: FriendshipStatus) => {
    switch (status) {
        case FriendshipStatus.AwaitingResponse: {
            return "text-gray-400";
        }
        case FriendshipStatus.Befriended: {
            return "text-green-400";
        }
        case FriendshipStatus.Invited: {
            return "text-orange-400";
        }
        default: {
            return "";
        }
    }
};
