var range = document.getElementById("salary");
var view =  document.getElementById("salary-view");
// var header = document.getElementById("header");
// var main = document.querySelector(".app-body");

// var headerHeight = window.getComputedStyle(header, null).getPropertyValue('height');
// var mainPadding = window.getComputedStyle(main, null).getPropertyValue('padding-top');
// header.style.position = "fixed";
// header.style.top = 0;
// header.style.left = 0;
// main.style.paddingTop = parseInt(headerHeight) + parseInt(mainPadding) + "px";
view.innerHTML = range.value;

// document.getElementById("search").onclick = function(){
//     alert("Для Вас нет работы! Можете отдыхать.");
// }
range.oninput = function(){
   view.innerHTML = range.value;
}
range.onchange = function(){
   view.innerHTML = range.value;
}