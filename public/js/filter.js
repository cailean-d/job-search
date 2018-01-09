(function(){

    // не выполнять ф, если на странице нет формы с фильтрами
    if(!document.getElementById("filters")){
        return;
    }

    var range = document.getElementById("salary");
    var view =  document.getElementById("salary-view");
    
    $("#salary").slider({
        tooltip : "show",
        tooltip_position: "top",
        range : "true",
    });
    
    $("#salary").on("slide", function(e) {
        view.innerHTML = String(e.value).replace(",", " - ");
    });

})();