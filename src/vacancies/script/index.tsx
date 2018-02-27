import { Main } from "./../../__common/main"; // general scripts, styles
import "./../style/index.scss"; // styles for current view

// external libraries
import "./../../__common/lib/script/fontawesome-all.min.js";
import "./../../__common/lib/script/bootstrap.min.js";
import "./../../__common/lib/script/bootstrap-slider.min.js";

// custom modules
import { Filter } from "./filter";

Main.activePage();
Main.modalProfile();
Main.modalLogin();
Filter.slider();
