interface IData{

    id : number;
    vacancy_name : string;
    company : string; 
    schedule_name : string; 
    demands : string; 
    location : string; 
    date : string;
    salary_min : string;
    salary_max : string;

}


export class Pagination{
    
    public dataLimit : number = 2;
    public dataLoaded : number = 0;
    public data : IData[];
    public baseUrl : string = "api/1.0.0/";
    public apiUrl : string;
    private _parameters : string = "";

    private doc : HTMLElement = document.documentElement;
    private win : Window = window;
    private isLoading : boolean = false;
    public stopLoad : boolean = false;

    constructor(api : string , limit? : number, loaded? : number){
        this.apiUrl =  this.baseUrl + api;
        if(limit) this.dataLimit = limit;
        if(loaded) this.dataLoaded = loaded;
    }

    get parameters(){
        return this._parameters;
    }

    set parameters(p : string){
        this._parameters = p;
    }

    private getPar(){
        return this._parameters;
    }

    public setLoader(){}

    public removeLoader(){}

    public getData(onerror? : (st : number, err : string) => void, onsuccess? : () => void){

        if(!(this.isLoading || this.stopLoad)){

            this.isLoading = true;
            this.setLoader();

            let data : string = '/' + this.dataLimit + '/' + this.dataLoaded;
            let request = this.apiUrl + data + this.parameters;

            let xhr : XMLHttpRequest = new XMLHttpRequest();

            xhr.open('GET', request);
            xhr.send();

            xhr.onload = () => {

                this.isLoading = false;
                this.removeLoader();
    
                if (xhr.readyState == 4 && xhr.status == 200) {

                    this.data = JSON.parse(xhr.responseText);
                    this.dataLoaded += this.data.length;

                    if(this.data.length < this.dataLimit){
                        this.stopLoad = true;
                    }

                    onsuccess();

                } else {
                    
                    onerror(xhr.status, JSON.parse(xhr.responseText).error);

                }

            }
        }
            
    }

}