var page = window.location.pathname;

var regexp_vacancy_add = /vacancy\/add$/;
var regexp_resume = /resume(\/?(add|edit))?$/;
var regexp_vacancy = /vacancy$/;


if(page.indexOf("/") == 0 && page.length == 1){

    if(document.getElementById("index_page")){
        document.getElementById("index_page").classList.add("active");
    }

} else if(regexp_vacancy_add.test(page)){

    if(document.getElementById("add_vacancy_page")){
        document.getElementById("add_vacancy_page").classList.add("active");
    }

} else if(regexp_resume.test(page)){

    if(document.getElementById("resume_page")){
        document.getElementById("resume_page").classList.add("active");
    }

} else if(regexp_vacancy.test(page)){

    if(document.getElementById("my_vacancies_page")){
        document.getElementById("my_vacancies_page").classList.add("active");
    }

} 