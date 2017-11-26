var vacancy_block = document.querySelector(".add_vacancy");
var buttons = document.querySelectorAll("button:not(.del)");
var del_buttons = document.querySelectorAll("button.del");
var form = document.getElementById("vacancy");
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

    for(var i = 0; i < fields.length; i++){
        var field = fields[i];
        checkInputs(field);
    }

    for(var j = 0; j < array_fields.length; j++){
        var field = array_fields[j];
        if(field.length){
            for(var i = 0; i < field.length; i++){
                var el = field[i];
                checkArrayInputs(el);
            }
        } else {
            checkArrayInputs(field);
        }
    }

    if (isValid == 0) {
        sendData(this);
    } else {
        alert("Форма заполнена неверно!");
    }
}


//******************************************************
// FUNCTIONS
//******************************************************

function removeInputRow(){
    del_buttons = document.querySelectorAll("button.del");
    for(let i = 0; i < del_buttons.length; i++){
        var del_button = del_buttons[i];
        del_button.onclick = function(e){
            e.preventDefault();
            var row = this.parentNode;
            var input = row.querySelector("input");
            if(input.classList.contains("error-border")){
                isValid++;
            }
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
        '<div class="row m">' +
            '<input name="demands" type="text" placeholder="Требование">' +
            '<button class="del" title="Удалить поле">-</button>' +
        '</div>' + 
        '<div class="error error2">';
    } else if(that.id == "dutie"){
        newInput.innerHTML = 
        '<div class="row m">' +
            '<input name="duties" type="text" placeholder="Обязанность">' +
            '<button class="del" title="Удалить поле">-</button>' +
        '</div>' + 
        '<div class="error error2">';
    } else if(that.id == "condition"){
        newInput.innerHTML = 
        '<div class="row m">' +
            '<input name="conditions" type="text" placeholder="Условие">' +
            '<button class="del" title="Удалить поле">-</button>' +
        '</div>' + 
        '<div class="error error2">';
    }
    option.appendChild(newInput);
}

function sendData(that){
    var data = new FormData(that);
    var xhr = new XMLHttpRequest();
    data.set("demands", data.getAll("demands").join())
    data.set("duties", data.getAll("duties").join())
    data.set("conditions", data.getAll("conditions").join())
    if(data.get("desc") == ""){ data.delete("desc"); }
    xhr.open('POST', that.action);
    xhr.send(data);
    var submit = form.querySelector("input[type=submit]");
    submit.disabled = true;
    submit.style.cursor = "not-allowed";
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4){
            if (xhr.status == 200) {
                alert(xhr.responseText);
            } else {
                alert(xhr.status + ': ' + xhr.statusText + ", " + xhr.responseText);
                submit.disabled = false;
                submit.style.cursor = "pointer";
            }
        } 
    }
}


function checkInputs(that){

    var REGEXP_email = /(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var REGEXP_phone = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
    var REGEXP_exp = /(^\d+[-]*\d+$)|(^\d+$)/;
    var REGEXP_company = /^[A-zА-яЁё\"\s?]{5,}$/;
    var REGEXP_sentence = /^[A-zА-яЁё0-9\\-\\.\\!\"\s?]{5,}$/;
    var REGEXP_city = /^[A-zА-яЁё\-\"\s?]{4,}$/;

    var regexp;
    var error = that.parentNode.querySelector(".error");

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
        error.innerHTML = "Это поле обязательно для заполения!";
        error.style.display = "block";
        if(!that.classList.contains("error-border")){isValid--;}
        that.classList.add("error-border");
        return;
    }
    if(that.name != "desc"){
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
    } else {
        if(!regexp.test(that.value) && that.value.length > 0){
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

}

function checkArrayInputs(that){
    var regexp = /^[A-zА-яЁё\\-\\.\\!\"\s?]{5,}$/;
    var error = that.parentNode.parentNode.querySelector(".error");
    if(that.value == ""){
        error.innerHTML = "Это поле обязательно для заполения!";
        error.style.display = "block";
        if(!that.classList.contains("error-border")){isValid--;}
        that.classList.add("error-border");
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