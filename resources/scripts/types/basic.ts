import {ButtonHTMLAttributes} from 'vue'

type PropType<TObj, TProp extends keyof TObj> = TObj[TProp];

export type ButtonType =  NonNullable<PropType<ButtonHTMLAttributes, 'type'>>
