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
