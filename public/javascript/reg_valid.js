(function(){

    var form = document.getElementById("registration");
    
    // если на странице нет формы регистрации, то не выполнять скрипт
    if(!form){
        return;
    }
    
    // счетчик валидации
    var isValid = 0;
    
    // поля формы 
    var fields = [
        form.elements["firstname"],
        form.elements["lastname"],
        form.elements["email"],
        form.elements["password"],
        form.elements["password2"],
        form.elements["type"],
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
            $("#ajax-error-reg").removeClass("hidden-xl-down");
            $("#ajax-error-reg > div").text("Форма заполнена неверно.");
        }
    }
    
    function checkInputs(that){
        
        // регулярные выражения для проверки
        var regexp_email = /(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var regexp_name = /^[A-ZА-ЯЁ]{1}[a-zа-яё\s?]{2,}$/;
    
        var regexp;

        //внешний блок поля
        var outer_block = that.parentNode.parentNode;

        //блок для генерации ошибки
        var error_message = outer_block.querySelector(".error-block");
    
        // если это поле "имя" или "фамилия"
        if(that.name == "firstname" || that.name == "lastname"){
            regexp = regexp_name;
        } else if(that.name == "email"){
            regexp = regexp_email;
        } 
    
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

                // поле должно содержать 6 или более символов
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
    
        // проверки поля "повторите пароль"
        if(that.name == "password2"){

            // поле должно быть заполнено
            if(that.value.length == 0){
                error_message.innerHTML = "Это поле обязательно для заполения!";
                error_message.classList.remove("hidden-xl-down");
                if(!outer_block.classList.contains("has-danger")){isValid--;}
                outer_block.classList.add("has-danger");
                return;
            // поле должно совпадать с полем "password"
            } else if(form.elements["password"].value != form.elements["password2"].value){
                error_message.innerHTML = "Пароли не совпадают!";
                error_message.classList.remove("hidden-xl-down");
                if(!outer_block.classList.contains("has-danger")){isValid--;}
                outer_block.classList.add("has-danger");
                return;
            } else {
                // скрыть ошибки, если все верно
                error_message.innerHTML = "";
                error_message.classList.add("hidden-xl-down");
                if(outer_block.classList.contains("has-danger")){isValid++;}
                outer_block.classList.remove("has-danger");
                return;
            }
        }

        if(that.name == "type"){
            if(that.value == ""){
                error_message.innerHTML = "Выберите тип учетной записи!";
                error_message.classList.remove("hidden-xl-down");
                if(!outer_block.classList.contains("has-danger")){isValid--;}
                outer_block.classList.add("has-danger");
                return;
            } else {
                // скрыть ошибки, если все верно
                error_message.innerHTML = "";
                error_message.classList.add("hidden-xl-down");
                if(outer_block.classList.contains("has-danger")){isValid++;}
                outer_block.classList.remove("has-danger");
                return;
            }
        }
    
        // проверки полей имени и фамилии
        // поле должно быть менее 30 символов
        if(that.value.length > 30){
            error_message.innerHTML = "Не более 30 символов!";
            error_message.classList.remove("hidden-xl-down");
            if(!outer_block.classList.contains("has-danger")){isValid--;}
            outer_block.classList.add("has-danger");
            return;
        }
    
        // поле должно быть заполнено
        if(that.value.length == 0){
            error_message.innerHTML = "Это поле обязательно для заполения!";
            error_message.classList.remove("hidden-xl-down");
            if(!outer_block.classList.contains("has-danger")){isValid--;}
            outer_block.classList.add("has-danger");
            return;
        }

        // проверка поля по регулярному выражению
        if(!regexp.test(that.value)){

            // поле должно содержать 3 и более символов
            if(that.value.length < 3){
                error_message.innerHTML = "Не менее 3 символов!";
                error_message.classList.remove("hidden-xl-down");
                if(!outer_block.classList.contains("has-danger")){isValid--;}
                outer_block.classList.add("has-danger");
                return;
            // первый символ должен быть заглавной буквой
            } else if(!/^[А-ЯA-Z]$/.test(that.value[0])){
                error_message.innerHTML = "Поле должно начинаться с заглавной буквы!";
                error_message.classList.remove("hidden-xl-down");
                if(!outer_block.classList.contains("has-danger")){isValid--;}
                outer_block.classList.add("has-danger");
                return;
            } else {
                // скрыть ошибки, если все верно
                error_message.innerHTML = "Поле заполнено некорректно!";
                error_message.classList.remove("hidden-xl-down");
                if(!outer_block.classList.contains("has-danger")){isValid--;}
                outer_block.classList.add("has-danger");
                return;
            }

        } else {
            // скрыть ошибки, если все верно
            error_message.innerHTML = "";
            error_message.classList.add("hidden-xl-down");
            if(outer_block.classList.contains("has-danger")){isValid++;}
            outer_block.classList.remove("has-danger");
        }
    }
    
    // валидация полей при потере фокуса
    function validateForm(){
        for(var i = 0; i < fields.length; i++){
            var field = fields[i];
            field.onblur = function(){checkInputs(this)};
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
        var submit = document.getElementById("sub_form_reg");
        // label для скрытой кнопки submit
        var submit_label = document.getElementById("send_form_reg");

        // заблокировать форму
        submit.disabled = true;
        submit_label.disabled = true;
        submit_label.classList.add("disabled");
        submit_label.style.pointerEvents = "auto";
        submit_label.innerHTML = "Отправка данных <i class=\"fas fa-spinner fa-pulse\"></i>";


        // скрыть блок с ошибкой
        $("#ajax-error-reg").addClass("hidden-xl-down");
        $("#ajax-error-reg > div").text("");

        // отслеживание состояния 
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4){
                if (xhr.status == 200) {
                    // перезагрузить страницу, если данные верны
                    window.location.reload();
                } else {
                    // показать блок с ошибкой
                    $("#ajax-error-reg").removeClass("hidden-xl-down");
                    $("#ajax-error-reg > div").text(xhr.status + " : " + xhr.responseText);
                    
                    // разблокировать кнопку, если возникла ошибка
                    submit.disabled = false;
                    submit_label.disabled = false;
                    submit_label.classList.remove("disabled");
                    submit_label.innerHTML = "Регистрация";
                }
            } 
        }
    }

    
    // добавить стили для отображения "активности" кнопки
    document.getElementById("reg_link").onclick = function(){
        this.classList.add("active");
    }

    // убрать стили для отображения "активности" кнопки
    $('#modal_reg').on('hidden.bs.modal', function (e) {
        document.getElementById("reg_link").classList.remove("active");
    })


})();
