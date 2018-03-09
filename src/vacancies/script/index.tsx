import React = require("react");
import { Main } from "./../../__common/main"; // general scripts, styles
import "./../style/index.scss"; // styles for current view

// external libraries
import "./../../__common/lib/script/bootstrap-slider.min.js";

// custom modules
import { Pagination } from "./../../__common/pagination";
import { appendNode } from "./../../__common/appendNode";
import { Filter } from "./filter";
import { Vacancy } from "./../template/vacancy";


Main.activePage();
Main.modalProfile();
Main.modalLogin();
Main.modalReg();
Main.dropMenu();
Main.headerDropMenu();
Filter.slider();


let pag : Pagination = new Pagination('vacancies');

let MainContainer : HTMLElement = document.querySelector("main");

window.onscroll = () => {
    pag.getData((st, err) : any =>{
    
        console.log("error");
    
    }, () : any =>{
    
        for (const el of pag.data) {
    
            appendNode(<Vacancy
                        id = {13}
                        name = "aa"
                        company = "aa"
                        schedule = "aa"
                        demands =  "aa"
                        location =  "aa"
                        date =  "aa"
                        salaryMin = "aa"
                        salaryMax = "aa"
                        />, MainContainer);
       
        }
    
    }) as any;
}