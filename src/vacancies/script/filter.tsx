import { EventEmitter } from 'events';

interface FilterData {

    query : string;
    industry : string;
    location : string;
    time : string;
    schedule : string;
    salary_min : string;
    salary_max : string;

}

export class Filter extends EventEmitter{

    private _queryString : string = "";
    public readonly container : HTMLElement;

    private filters_form : HTMLFormElement = document.getElementById("filters") as HTMLFormElement;
    private filter_fields : HTMLFormControlsCollection = this.filters_form.elements;
    
    private query : HTMLInputElement = this.filter_fields.namedItem('query') as HTMLInputElement;
    private industry : HTMLSelectElement = this.filter_fields.namedItem('industry') as HTMLSelectElement;
    private location : HTMLSelectElement = this.filter_fields.namedItem('location') as HTMLSelectElement;
    private time : HTMLSelectElement = this.filter_fields.namedItem('time') as HTMLSelectElement;
    private schedule : HTMLSelectElement = this.filter_fields.namedItem('schedule') as HTMLSelectElement;
    private salary : HTMLSelectElement = this.filter_fields.namedItem('salary') as HTMLSelectElement;

    private default_salary : string = document.querySelector("#__default-salary").innerHTML.trim();
    

    get queryString(){
        return this._queryString;
    }

    set queryString(q : string){
        this._queryString = q;
        this.emit("query_changed");
    }

    constructor(el : HTMLElement){
        super();
        this.container = el;
    }

    slider () : void {

        let range : HTMLElement = document.getElementById("salary");
        let slider_view : HTMLElement = document.getElementById("salary-view");

        $("#salary").slider({
            tooltip : "show",
            tooltip_position: "top",
            range : true,
        });
        
        $("#salary").on("slide", function(e) {
            slider_view.innerHTML = (e.value as any)[0] + " - " + (e.value as any)[1];
        });

    }

    applyFilter() : void {

        this.setSearchQuery();

        let applyFilter : HTMLButtonElement = document.querySelector(".__apply-filter");

        applyFilter.onclick = (e : MouseEvent) => {

            e.preventDefault();

            this.queryString = "";
            
            let data = {} as FilterData;

            if(this.query.value != "") data.query = this.query.value;
            if(this.industry.value != "-1") data.industry = this.industry.value;
            if(this.location.value != "-1") data.location = this.location.value;
            if(this.time.value != "0") data.time = this.time.value;
            if(this.schedule.value != "-1") data.schedule = this.schedule.value;
            if(this.salary.value != this.default_salary){
                data.salary_min = this.salary.value.split(",")[0];
                data.salary_max = this.salary.value.split(",")[1];
            }


            if(Object.keys(data).length > 0){

                this.queryString = "?" + this.encodeQueryData(data);

            }

            this.changeUrl();
            this.clearContainer();

        }
        
    }

    encodeQueryData(data : {}) {
        let ret = [];
        for (let d in data)
          ret.push(encodeURIComponent(d) + '=' + encodeURIComponent((data as any)[d]));
        return ret.join('&');
    }

    searchToObject() {

        let pairs = window.location.search.substring(1).split("&"),
            obj = {} as any,
            pair,
            i;
      
        for ( i in pairs ) {
          if ( pairs[i] === "" ) continue;
      
          pair = pairs[i].split("=");
          obj[ decodeURIComponent( pair[0] ) ] = decodeURIComponent( pair[1] );
        }
      
        return obj;
        
    }

    changeUrl() : void {
        
        let newurl = window.location.protocol + "//" + 
        window.location.host + 
        window.location.pathname + this.queryString;

        window.history.pushState({path:newurl},'',newurl);
        
    }

    clearContainer() : void {
        this.container.innerHTML = "";
    }

    setSearchQuery(){
        this.queryString = window.location.search;
    }

    resetForm() {

        let arr : number[] = [+this.default_salary.split(",")[0], +this.default_salary.split(",")[1]];
        let slider_view : HTMLElement = document.getElementById("salary-view");

        this.query.value = "";
        this.industry.value = this.industry.options[0].value;
        this.location.value = this.location.options[0].value;
        this.time.value = this.time.options[0].value;
        this.schedule.value = this.schedule.options[0].value;
        $("#salary").slider('setValue', arr);
        slider_view.innerHTML = arr[0] + ' - ' + arr[1];

    }

}