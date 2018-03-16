import { Main } from "./../../__common/main"; // general scripts, styles
import "./../style/index.scss"; // styles for current view

import { Vacancy } from "./vacancy";

Main.activePage();
Main.modalProfile();
Main.modalLogin();
Main.modalReg();
Main.dropMenu();
Main.headerDropMenu();
Vacancy.del();
Main.init();


let mistakeButtons : NodeListOf<HTMLButtonElement> = document.querySelectorAll("button.status");

for (let i = 0; i < mistakeButtons.length; i++) {
    let btn : HTMLButtonElement = mistakeButtons[i];
    let parent : Node = mistakeButtons[i].parentNode;
    let collapse : Node = parent.nextSibling.nextSibling;

    btn.onclick = () => {
        $(collapse).collapse('toggle');
    }
}