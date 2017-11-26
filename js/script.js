var range = document.getElementById("salary");
var view =  document.getElementById("salary-view");
view.innerHTML = range.value;

range.oninput = function(){
   view.innerHTML = range.value;
}
range.onchange = function(){
   view.innerHTML = range.value;
}