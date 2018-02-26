declare module "*.html" {
    const content: string;
    export default content;
}

declare module "*.s?css" {
    const content: any;
    export default content;
}
