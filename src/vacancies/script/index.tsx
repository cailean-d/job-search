import { Main } from "./../../__common/main"; // general scripts, styles
import "./../style/index.scss"; // styles for current view

// external libraries
import "./../../__common/lib/script/bootstrap-slider.min.js";

// custom modules
import { Filter } from "./filter";
import { Pagination } from "./../../__common/pagination";

Main.activePage();
Main.modalProfile();
Main.modalLogin();
Main.modalReg();
Main.dropMenu();
Main.headerDropMenu();
Filter.slider();


let pag : Pagination = new Pagination('vacancies');
