export type StudyGroup = {
    id: string
}

export type Module = {
    id: string;
    faculty: string;
    level: string;
    semester_count: string;
    modulux_url: string;
    opal_url: string | undefined;
}

export type ExtendedModule = Module & {
    //TODO
}

export type PrivateEvent = {
    id: number;
    name: string;
}

export type Event = PrivateEvent & {
    resolved: boolean
}


export enum RecurrenceState {
    None = 0,
    Weekly = 1,
    Biweekly = 2,
    Monthly = 3,
}

export type Appointment = {
    id: number;
    origin_date: string;
    start_time: string;
    end_time: string;
    recurrence: RecurrenceState,
    location?: string,
    details?: string,
    info?: number,
}
