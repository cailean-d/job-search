(function(){

    if(!document.getElementById("vacancy")){
        return;
    }

    var vacancy_block = document.querySelector(".add_vacancy");
    var buttons = document.querySelectorAll("button.add");
    var del_buttons = document.querySelectorAll("button.del");
    var form = document.getElementById("vacancy");
    var modal_message_text = document.querySelector("#modal .modal-body p");
    var isValid = 0;
    
    var fields = [
        form.elements["company"],
        form.elements["phone"],
        form.elements["email"],
        form.elements["salary"],
        form.elements["vacancy"],
        form.elements["exp"],
        form.elements["location"],
        form.elements["desc"]
    ];
    
    var array_fields = [
        form.elements["demands"],
        form.elements["duties"],
        form.elements["conditions"]
    ];
    
    vacancy_block.addEventListener('DOMNodeInserted', function(){
        removeInputRow();
        arrayFields();
    });
    vacancy_block.addEventListener('DOMNodeRemoved', function(){
        removeInputRow();
        arrayFields();
    });
    
    validateForm();
    
    for(var i = 0; i < buttons.length; i++){
        var button = buttons[i];
        button.onclick = function(e){
            addInputRow(e, this);
        }
    }
    
    
    form.onsubmit = function(e){
        e.preventDefault();
        array_fields = [
            form.elements["demands"],
            form.elements["duties"],
            form.elements["conditions"]
        ];
    
        isValid = 0;
    
        for(var i = 0; i < fields.length; i++){
            var field = fields[i];
            isValid += checkInputs(field);
        }
    
        for(var j = 0; j < array_fields.length; j++){
            var field = array_fields[j];
            if(field.length){
                for(var i = 0; i < field.length; i++){
                    var el = field[i];
                    isValid +=  checkArrayInputs(el);
                }
            } else {
                isValid += checkArrayInputs(field);
            }
        }
    
        if (isValid == 0) {
            sendData(this);
        } else {
            modal_message_text.innerHTML = "Форма заполнена неверно!";
            $('#modal').modal('show');
        }
    }
    
    
    //******************************************************
    // FUNCTIONS
    //******************************************************
    
    function removeInputRow(){
        del_buttons = document.querySelectorAll("button.del");
        for(var i = 0; i < del_buttons.length; i++){
            var del_button = del_buttons[i];
            del_button.onclick = function(e){
                e.preventDefault();
                var opt = this.parentNode.parentNode;
                opt.parentNode.removeChild(opt);
            }
        }
    }
    
    function addInputRow(e, that){
        e.preventDefault();
        var option = document.querySelector("." + that.id + 's');
        var newInput = document.createElement("div");
        newInput.classList.add("opt");
        if(that.id == "demand"){
            newInput.innerHTML = 
            '<div class="d-flex justify-content-between"><div class="input-group mb-2 col-11 pl-0"><div class="input-group-addon">@</div><input name="demands" type="text" class="form-control" id="conditions"></div><button class="btn btn-outline-primary col-1 del" role="button" style="height: 37px; padding: .5rem .3rem;">-</button></div><div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>';
        } else if(that.id == "dutie"){
            newInput.innerHTML = 
            '<div class="d-flex justify-content-between"><div class="input-group mb-2 col-11 pl-0"><div class="input-group-addon">@</div><input name="duties" type="text" class="form-control" id="conditions"></div><button class="btn btn-outline-primary col-1 del" role="button" style="height: 37px; padding: .5rem .3rem;">-</button></div><div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>';
        } else if(that.id == "condition"){
            newInput.innerHTML = 
            '<div class="d-flex justify-content-between"><div class="input-group mb-2 col-11 pl-0"><div class="input-group-addon">@</div><input name="conditions" type="text" class="form-control" id="conditions"></div><button class="btn btn-outline-primary col-1 del" role="button" style="height: 37px; padding: .5rem .3rem;">-</button></div><div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>';
        }
        option.appendChild(newInput);
    }
    
    function sendData(that){
        var data = new FormData(that);
        var xhr = new XMLHttpRequest();
        var server_script;
        data.set("demands", data.getAll("demands").join(';'))
        data.set("duties", data.getAll("duties").join(';'))
        data.set("conditions", data.getAll("conditions").join(';'))
        if(data.get("desc") == ""){ data.delete("desc"); }

        if(window.location.href.indexOf("page=edit") != -1){
            server_script = "scripts/update/update_vacancy.php";
            data.append("id", document.getElementById("vacancy_id").innerHTML.trim());
        } else {
            server_script = "scripts/create/set_vacancy.php";
        }

        xhr.open('POST', server_script);
        xhr.send(data);
        var submit = form.querySelector("input[type=submit]");
        var btn_close = document.querySelectorAll(".btn-close");
        submit.disabled = true;
        submit.classList.add("disabled");
        submit.style.pointerEvents = "auto";
        submit.innerHTML = "Отправка данных...";
    
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4){
                if (xhr.status == 200) {
    
                    modal_message_text.innerHTML = "Данные успешно отправлены!";
                    $('#modal').modal('show');
    
    
                    // перезагрузить страницу при закрытии модального окна
                    for(var i = 0; i < btn_close.length; i++){
                        var btn = btn_close[i];
                        btn.onclick = function(){
                            window.location.reload();
                        }
                    }
    
                    submit.disabled = false;
                    submit.classList.remove("disabled");
                    submit.innerHTML = "Отправить";
    
                } else {
                    modal_message_text.innerHTML = xhr.status + ': ' + xhr.statusText + ", " + xhr.responseText;
                    $('#modal').modal('show');
    
                    submit.disabled = false;
                    submit.classList.remove("disabled");
                    submit.innerHTML = "Отправить";
                }
            } 
        }
    }
    
    
    function checkInputs(that){
    
        var valid = 0;
    
        var REGEXP_email = /(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var REGEXP_phone = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
        var REGEXP_exp = /(^\d+[-]*\d+$)|(^\d+$)/;
        var REGEXP_company = /^[A-zА-яЁё\"\s?]{5,}$/;
        var REGEXP_sentence = /^[A-zА-яЁё0-9\(\)\-\.,!\:\"\s?]{5,}$/;
        var REGEXP_city = /^[A-zА-яЁё\-\"\s?]{4,}$/;
    
        var regexp;
    
        //внешний блок поля
        var outer_block = that.parentNode.parentNode;
    
        //блок для генерации ошибки
        var error_message = outer_block.querySelector(".error-block");
    
        if(that.name == "company"){
            regexp = REGEXP_company;
        } else if(that.name == "phone"){
            regexp = REGEXP_phone;
        } else if(that.name == "email"){
            regexp = REGEXP_email;
        } else if(that.name == "salary"){
            regexp = REGEXP_exp;
        } else if(that.name == "vacancy"){
            regexp = REGEXP_company;
        } else if(that.name == "exp"){
            regexp = REGEXP_exp;
        } else if(that.name == "location"){
            regexp = REGEXP_city;
        } else if(that.name == "desc"){
            regexp = REGEXP_sentence;
        }
    
        if(that.value == "" && that.name != "desc"){
            error_message.innerHTML = "Это поле обязательно для заполения!";
            error_message.classList.remove("hidden-xl-down");
            outer_block.classList.add("has-danger");
            return valid -1;
        }
        if(that.name != "desc"){
            if(!regexp.test(that.value)){
                error_message.innerHTML = "Поле заполнено некорректно!";
                error_message.classList.remove("hidden-xl-down");
                outer_block.classList.add("has-danger");
                return valid -1;
            } else {
                error_message.innerHTML = "";
                error_message.classList.add("hidden-xl-down");
                outer_block.classList.remove("has-danger");
                return valid;
            }
        } else {
            if(!regexp.test(that.value) && that.value.length > 0){
                error_message.innerHTML = "Поле заполнено некорректно!";
                error_message.classList.remove("hidden-xl-down");
                outer_block.classList.add("has-danger");
                return valid -1;
            } else {
                error_message.innerHTML = "";
                error_message.classList.add("hidden-xl-down");
                outer_block.classList.remove("has-danger");
                return valid;
            }
        }
    
    }
    
    function checkArrayInputs(that){
        var regexp = /^[A-zА-яЁё0-9\\-\\.\\!\\(\\)\\,\-\"\s?]{5,}$/;
        var valid = 0;
        //внешний блок поля
        var outer_block = that.parentNode.parentNode.parentNode;
    
        //блок для генерации ошибки
        var error_message = outer_block.querySelector(".error-block");
    
        if(that.value == ""){
            error_message.innerHTML = "Это поле обязательно для заполения!";
            error_message.classList.remove("hidden-xl-down");
            outer_block.classList.add("has-danger");
            return valid -1;
        }
        if(!regexp.test(that.value)){
            error_message.innerHTML = "Поле заполнено некорректно!";
            error_message.classList.remove("hidden-xl-down");
            outer_block.classList.add("has-danger");
            return valid -1;
        } else {
            error_message.innerHTML = "";
            error_message.classList.add("hidden-xl-down");
            outer_block.classList.remove("has-danger");
            return valid;
        }
    }
    
    function arrayFields(){
        
        array_fields = [
            form.elements["demands"],
            form.elements["duties"],
            form.elements["conditions"]
        ];
    
        for(var j = 0; j < array_fields.length; j++){
            var field = array_fields[j];
            if(field.length){
                for(var i = 0; i < field.length; i++){
                    var el = field[i];
                    el.onblur = function(){checkArrayInputs(this);}
                }
            } else {
                field.onblur = function(){checkArrayInputs(this);}
            }
        }
    }
    
    function validateForm(){
        form.elements["desc"].maxLength = 255;
        
        for(var i = 0; i < fields.length; i++){
            var field = fields[i];
            field.onblur = function(){checkInputs(this)};
        }
        
        arrayFields();
    }
})();
