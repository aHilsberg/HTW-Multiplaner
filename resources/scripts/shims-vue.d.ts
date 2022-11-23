// This is required for Visual Studio Code to recognize
// imported .vue files
declare module '*.vue' {
    import { DefineComponent } from 'vue'
    // eslint-disable-next-line @typescript-eslint/ban-types
    const component: DefineComponent<{}, {}, any>
    export default component
}
