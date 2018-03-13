import React = require("react");
import { Main } from "./../../__common/main"; // general scripts, styles
import "./../style/index.scss"; // styles for current view

// external libraries
import "./../../__common/lib/script/bootstrap-slider.min.js";

// custom modules
import { Pagination } from "./../../__common/pagination";
import { appendNode } from "./../../__common/appendNode";
import { Filter } from './filter';
import { Vacancy } from "./../template/vacancy";
import { Alert } from "./../template/alert";

Main.activePage();
Main.modalProfile();
Main.modalLogin();
Main.modalReg();
Main.dropMenu();
Main.headerDropMenu();

// ajax onscroll pagination

let w : Window = window;
let doc : HTMLElement = document.documentElement;

let MainContainer : HTMLElement = document.querySelector("main");
let vacancies : NodeListOf <HTMLElement> = document.querySelectorAll('.vacancy_block');
let vacancies_count : number = vacancies.length;
let pagination : Pagination = new Pagination('vacancy/get', 5, vacancies_count);
let modal : HTMLElement = document.querySelector("#modal __text");
let reset_filter : HTMLButtonElement = document.querySelector(".__reset-filter");

let filter : Filter = new Filter(MainContainer);
filter.slider();
filter.applyFilter();


filter.on("query_changed", () => {

    pagination.parameters = filter.queryString;    

});

filter.on("filter_applied", () => {
    
    pagination.dataLoaded = 0;
    pagination.stopLoad = false;
    pagination.getData(showError, drawData);
    
});


let drawData = () : void => {

    if(pagination.data.length > 0){

        for (const el of pagination.data) {

            console.log(el);
            
            appendNode(<Vacancy
                id          = {el.id}
                name        = {el.vacancy_name}
                company     = {el.company}
                schedule    = {el.schedule_name}
                demands     = {el.demands}
                location    = {el.location}
                date        = {el.date}
                salaryMin   = {el.salary_min}
                salaryMax   = {el.salary_max}
            />, MainContainer);
       
        }

    } else {

        let alert : HTMLElement = document.querySelector(".__alert-vacancy");
        let len : number = document.querySelectorAll('.vacancy_block').length;

        if(len == 0 && !alert){

            appendNode(<Alert/>, MainContainer);

        }

    }

}

let showError = (status : number, err : string) => {

    modal.innerHTML = err;
    $('#modal').modal('show');

}


window.onwheel = (e : WheelEvent) => {
    
    if(e.deltaY > 0) {

        if (w.pageYOffset >= doc.offsetHeight - doc.clientHeight){

            pagination.getData(showError, drawData);

        }        

    }

}

reset_filter.onclick = (e : MouseEvent) => {

    e.preventDefault();
    filter.resetForm();

}
