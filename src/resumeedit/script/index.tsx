import { Main } from "./../../__common/main"; // general scripts, styles
import "./../style/index.scss"; // styles for current view

import "./../../__common/lib/script/datepicker.min.js";
import { Resume } from "./resume";

Main.activePage();
Main.modalProfile();
Main.modalLogin();
Main.modalReg();
Main.dropMenu();
Main.headerDropMenu();
Resume.init();
Main.init();

