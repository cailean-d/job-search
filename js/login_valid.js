(function(){

    var form = document.getElementById("login");
    
    if(!form){
        return;
    }
    
    var isValid = 0;
    
    var fields = [
        form.elements["email"],
        form.elements["password"],
    ];
    
    validateForm();
    
    form.onsubmit = function(e){
        e.preventDefault();
    
        for(var i = 0; i < fields.length; i++){
            var field = fields[i];
            checkInputs(field);
        }
    
        if (isValid == 0) {
            sendData(this);
        } else {
            alert("Форма заполнена неверно!");
        }
    }
    
    function checkInputs(that){
    
        var regexp = /(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    
        var error = that.parentNode.querySelector(".error");
    
        if(that.name == "password"){
            if(that.value.length < 6){
                error.innerHTML = "Не менее 6 символов!";
                error.style.display = "block";
                if(!that.classList.contains("error-border")){isValid--;}
                that.classList.add("error-border");
                return;
            } else {
                error.innerHTML = "";
                error.style.display = "none";
                if(that.classList.contains("error-border")){isValid++;}
                that.classList.remove("error-border");
                return;
            }
        }
    
        if(that.value.length > 30){
            error.innerHTML = "Не более 30 символов!";
            error.style.display = "block";
            if(!that.classList.contains("error-border")){isValid--;}
            that.classList.add("error-border");
            return;
        }
    
        if(that.value == ""){
            error.innerHTML = "Это поле обязательно для заполения!";
            error.style.display = "block";
            if(!that.classList.contains("error-border")){isValid--;}
            that.classList.add("error-border");
            return;
        }
    
        if(!regexp.test(that.value)){
            error.innerHTML = "Поле заполнено некорректно!";
            error.style.display = "block";
            if(!that.classList.contains("error-border")){isValid--;}
            that.classList.add("error-border");
        } else {
            error.innerHTML = "";
            error.style.display = "none";
            if(that.classList.contains("error-border")){isValid++;}
            that.classList.remove("error-border");
        }
    }
    
    function validateForm(){
        for(var i = 0; i < fields.length; i++){
            var field = fields[i];
            field.onblur = function(){checkInputs(this)};
        }
    }
    
    function sendData(that){
        var data = new FormData(that);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', that.action);
        xhr.send(data);
        var submit = form.querySelector("input[type=submit]");
        submit.disabled = true;
        submit.style.cursor = "not-allowed";
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4){
                if (xhr.status == 200) {
                    window.location.href = "index.php";
                } else {
                    alert(xhr.status + ': ' + xhr.statusText + ", " + xhr.responseText);
                    submit.disabled = false;
                    submit.style.cursor = "pointer";
                }
            } 
        }
    }

})();

