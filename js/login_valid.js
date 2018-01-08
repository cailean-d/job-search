(function(){

    // форма входа
    var form = document.getElementById("login");
    // текст модальнго окна
    var modal_message_text = document.querySelector("#modal .modal-body p");

    // если на странице нет формы входа, то не выполнять скрипт
    if(!form){
        return;
    }

    // счетчик валидации
    var isValid = 0;
    
    // поля формы
    var fields = [
        form.elements["email"],
        form.elements["password"],
    ];
    

    // при потере фокуса поля проверять на валидность
    validateForm();
    

    // при попытке отправить форму проверить на валидность и отправить данных
    // если все верно
    form.onsubmit = function(e){
        e.preventDefault();
    
        // проверка всех полей формы на валидность
        for(var i = 0; i < fields.length; i++){
            var field = fields[i];
            checkInputs(field);
        }
    
        // отправка данных, если нет ошибом
        if (isValid == 0) {
            sendData(this);
            $("#ajax-error-reg").addClass("hidden-xl-down");
            $("#ajax-error-reg > div").text("");
        } else {
        // вывод ошибки
            $("#ajax-error").removeClass("hidden-xl-down");
            $("#ajax-error > div").text("Форма заполнена неверно.");
        }
    }
    

    // проверка указанного поля  на валидность
    function checkInputs(that){
    
        var regexp = /(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    
        //внешний блок поля
        var outer_block = that.parentNode.parentNode;
        //блок для генерации ошибки
        var error_message = outer_block.querySelector(".error-block");
    
        // проверки для поля "password"
        if(that.name == "password"){
            // поле не должно быть пустым
            if(that.value.length == 0){
                // показать стили для ошибки
                error_message.innerHTML = "Это поле обязательно для заполения!";
                error_message.classList.remove("hidden-xl-down");
                if(!outer_block.classList.contains("has-danger")){isValid--;}
                outer_block.classList.add("has-danger");
                return;
            } else if(that.value.length < 6){
                // длина должна быть не менее 6 символов
                // показать стили для ошибки
                error_message.innerHTML = "Не менее 6 символов!";
                error_message.classList.remove("hidden-xl-down");
                if(!outer_block.classList.contains("has-danger")){isValid--;}
                outer_block.classList.add("has-danger");
                return;
            } else {
                // очистить стили ошибки, если все верно
                error_message.innerHTML = "";
                error_message.classList.add("hidden-xl-down");
                if(outer_block.classList.contains("has-danger")){isValid++;}
                outer_block.classList.remove("has-danger");
                return;
            }
        }
    
        //*** проверка для поля "email"
        // не более 30 символов
        if(that.value.length > 30){
            // показать стили для ошибки
            error_message.innerHTML = "Не более 30 символов!";
            error_message.classList.remove("hidden-xl-down");
            if(!outer_block.classList.contains("has-danger")){isValid--;}
            outer_block.classList.add("has-danger");
            return;
        }
    
        // поле не должно быть пустым
        if(that.value == ""){
            // показать стили для ошибки
            error_message.innerHTML = "Это поле обязательно для заполения!";
            error_message.classList.remove("hidden-xl-down");
            if(!outer_block.classList.contains("has-danger")){isValid--;}
            outer_block.classList.add("has-danger");
            return;
        }
    
        // проверка почты на валидность по регулярному выражению
        if(!regexp.test(that.value)){
             // показать стили для ошибки
            error_message.innerHTML = "Поле заполнено некорректно!";
            error_message.classList.remove("hidden-xl-down");
            if(!outer_block.classList.contains("has-danger")){isValid--;}
            outer_block.classList.add("has-danger");
        } else {
            // очистить стили ошибки, если все верно
            error_message.innerHTML = "";
            error_message.classList.add("hidden-xl-down");
            if(outer_block.classList.contains("has-danger")){isValid++;}
            outer_block.classList.remove("has-danger");
        }
    }
    
    // проверка валидности при потери фокуса 
    function validateForm(){
        for(var i = 0; i < fields.length; i++){
            var field = fields[i];
            field.onblur = function(){checkInputs(this);};
        }
    }
    
    // отправка данных
    function sendData(that){

        // создание объекта для отправки
        var data = new FormData(that);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', that.action);
        xhr.send(data);

        // кнопка отправки (скрытая)
        var submit = document.getElementById("sub_form");
        // label для скрытой кнопки submit
        var submit_label = document.getElementById("send_form");

        // блокировка формы во время отправки
        submit.disabled = true;
        submit_label.disabled = true;
        submit_label.classList.add("disabled");
        submit_label.style.pointerEvents = "auto";
        submit_label.innerHTML = "Отправка данных...";

        // скрыть блок с ошибкой
        $("#ajax-error").addClass("hidden-xl-down");
        $("#ajax-error > div").text("");

        // отслеживание состояния 
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4){
                if (xhr.status == 200) {

                    // перезагрузить страницу, если данные верны
                    window.location.reload();
                } else {

                    // показать блок с ошибкой
                    $("#ajax-error").removeClass("hidden-xl-down");
                    $("#ajax-error > div").text(xhr.status + " : " + xhr.responseText);
                    
                    // разблокировать кнопку, если возникла ошибка
                    submit.disabled = false;
                    submit_label.disabled = false;
                    submit_label.classList.remove("disabled");
                    submit_label.innerHTML = "Войти";
                }
            } 
        }
    }

    // добавить стили для отображения "активности" кнопки
    document.getElementById("login_link").onclick = function(){
        this.classList.add("active");
    }

    // убрать стили для отображения "активности" кнопки
    $('#modal_login').on('hidden.bs.modal', function (e) {
        document.getElementById("login_link").classList.remove("active");
    })


})();

