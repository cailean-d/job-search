export class Filter{

    slider () {

        let range : HTMLElement = document.getElementById("salary");
        let view : HTMLElement = document.getElementById("salary-view");
        
        $("#salary").slider({
            tooltip : "show",
            tooltip_position: "top",
            range : true,
        });
        
        $("#salary").on("slide", function(e) {
            view.innerHTML = String(e.value).replace(",", " - ");
        });

    }

}