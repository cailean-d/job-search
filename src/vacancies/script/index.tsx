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


// ajax onscroll pagination

let MainContainer : HTMLElement = document.querySelector("main");
let vacancies : NodeListOf <HTMLElement> = document.querySelectorAll('.vacancy_block');
let vacabcies_count : number = vacancies.length;
let pag : Pagination = new Pagination('vacancy/get', null, vacabcies_count);
let modal : HTMLElement = document.querySelector("#modal __text");


window.onscroll = () => {
    pag.getData((st, err) : any =>{
    
        modal.innerHTML = err;
        $('#modal').modal('show');
    
    }, () : any =>{
    
        for (const el of pag.data) {
    
            appendNode(<Vacancy
                id = {(el as any).id}
                name = {(el as any).vacancy_name}
                company = {(el as any).company}
                schedule = {(el as any).schedule_name}
                demands =  {(el as any).demands}
                location =  {(el as any).location}
                date =  {(el as any).date}
                salaryMin = {(el as any).salary_min}
                salaryMax = {(el as any).salary_max}
            />, MainContainer);
       
        }
    
    }) as any;
}