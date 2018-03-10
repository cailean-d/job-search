export class Pagination{
    
    public dataLimit : number = 2;
    public dataLoaded : number = 0;
    public data : {}[];
    public baseUrl : string = "api/1.0.0/";
    public apiUrl : string;

    private doc : HTMLElement = document.documentElement;
    private win : Window = window;
    private isLoading : boolean = false;
    private stopLoad : boolean = false;

    constructor(api : string , limit? : number, loaded? : number){
        this.apiUrl = api;
        if(limit) this.dataLimit = limit;
        if(loaded) this.dataLoaded = loaded;
    }

    public setLoader(){}

    public removeLoader(){}

    public getData(onerror? : (st : number, err : string)=>{}, onsuccess? : ()=>{}){
	
        if (this.win.pageYOffset >= this.doc.offsetHeight - this.doc.clientHeight){

            if(!(this.isLoading || this.stopLoad)){

                this.isLoading = true;
                this.setLoader();

                let url : string = this.baseUrl + this.apiUrl;
                let data : string = '/' + this.dataLimit + '/' + this.dataLoaded;
                let request = url + data;

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

}