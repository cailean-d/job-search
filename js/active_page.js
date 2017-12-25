var page = window.location.pathname;

if(page.indexOf("index") != -1 || (page.indexOf("/") == 0 && page.length == 1)){
    if(document.getElementById("index_page")){
        document.getElementById("index_page").classList.add("active");
    }
} else if(page.indexOf("add_vacancy") != -1){
    if(document.getElementById("add_vacancy_page")){
        document.getElementById("add_vacancy_page").classList.add("active");
    }
} else if(page.indexOf("resume") != -1){
    if(document.getElementById("resume_page")){
        document.getElementById("resume_page").classList.add("active");
    }
} else if(page.indexOf("my_vacancies") != -1){
    if(document.getElementById("my_vacancies_page")){
        document.getElementById("my_vacancies_page").classList.add("active");
    }
} 