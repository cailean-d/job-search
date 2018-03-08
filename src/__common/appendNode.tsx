import ReactDOM = require("react-dom");

export const appendNode = (element : React.ReactElement<any>, parent : HTMLElement) : void => {

    let el = document.createElement("div");

    ReactDOM.render(element, el as HTMLElement);

    parent.appendChild(el.childNodes[0]);

}