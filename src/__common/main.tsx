import "./main.scss";

export class Main{

    static activePage(){

        let page = window.location.pathname;
        let regexp_vacancy_add = /vacancy\/add$/;
        let regexp_resume = /resume(\/?(add|edit))?$/;
        let regexp_vacancy = /vacancy$/;

        if((page.indexOf("/") == 0 && page.length == 1) && (document.querySelector(".__home"))){

            document.querySelector(".__home").classList.add("active");

        } else if(regexp_vacancy_add.test(page) && document.querySelector(".__vacancy-add")){

            document.querySelector(".__vacancy-add").classList.add("active");

        } else if(regexp_resume.test(page) && document.querySelector(".__resume")){

            document.querySelector(".__resume").classList.add("active");

        } else if(regexp_vacancy.test(page) && document.querySelector(".__my-vacancies")){

            document.querySelector(".__my-vacancies").classList.add("active");

        } 

    }

    static modalProfile(){

        var modal_profile_btn : HTMLElement = document.querySelector("#header .__modal_profile_btn");
        var modal_profile : any = document.getElementById("__profile_update_form");
        var submit_label = document.getElementById("__save_profile_label");
        var submit_btn = document.getElementById("__save_profile");
    
        var url = "api/1.0.0/user";
    
        var regexp_name = /^[A-ZА-ЯЁ]{1}[a-zа-яё\s?]{2,}$/;
        var regexp_email = /(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    
        if(modal_profile != null){
    
            var fields_values : any = {};
    
            var fields = [
                modal_profile.elements["firstname"],
                modal_profile.elements["lastname"],
                modal_profile.elements["email"],
                modal_profile.elements["old_password"],
                modal_profile.elements["password"],
                modal_profile.elements["password2"],
                modal_profile.elements["gender"],
            ];
    
            saveFormValues(fields, fields_values);
    
            checkFieldsOnBlur(fields);
    
            formChangeOnInput(modal_profile, fields, submit_label, submit_btn);
        
            modal_profile_btn.onclick = function(e){
    
                e.preventDefault();
    
                openProfile();
    
                hideDropmenu();
        
            }
    
            modal_profile.onsubmit = function (e : any){
    
                e.preventDefault();
    
                var formHasError = checkFieldsOnSubmit(this, fields);
    
                if(formHasError){
    
                    showFormError(this, "Форма заполнена неверно!");
    
                } else {
    
                    buttonLoading(submit_label);
                    disableButton(submit_label, submit_btn);
    
                    var data = new FormData(this);
                    var xhr = new XMLHttpRequest();
    
                    delNotRequiredData(data);
    
                    xhr.open('PUT', url);
                    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                    xhr.send(urlencodeFormData(data));
        
                    xhr.onload = () => {
        
                        if (xhr.readyState == 4 && xhr.status == 200) {
                                
                            showFormSuccess(this, "Данные успешно сохранены");
                            buttonText(submit_label, "Сохранить");
                            saveFormValues(fields, fields_values);
    
                        } else {
                            
                            var res = JSON.parse(xhr.responseText);
                            showFormError(this, xhr.status + " : " + res.error);
                            enableButton(submit_label, submit_btn);
                            buttonText(submit_label, "Сохранить");
        
                        }
        
                    }
    
                }
    
            }
    
            $('#__modal_profile').on('hidden.bs.modal', function (e) {
                
                hideFormMessage(modal_profile);
                hideAllErrors(fields);
                disableButton(submit_label, submit_btn);
                restoreFormValues(modal_profile, fields_values);
                
            });
    
        }
    
        function hideDropmenu(){
    
            (document.querySelector("#header .__drop_menu") as any).style.display = "none";
            document.querySelector(".__dropdown_btn").classList.remove("menu-active");
    
        }
    
        function openProfile(){
    
            $('#__modal_profile').modal('show');
    
        }
    
        function disableButton(button : any, button2 : any){
    
            button.disabled = true;
            button2.disabled = true;
            button.classList.add("disabled");
            button.style.pointerEvents = "auto";
    
        }
    
        function buttonLoading(button : any){
    
            button.innerHTML = "Отправка данных <i class=\"fas fa-spinner fa-pulse\"></i>";
    
        }
    
        function buttonText(button : any, text : any){
    
            button.innerHTML = text;
    
        }
    
        function enableButton(button : any, button2 : any){
    
            button.disabled = false;
            button2.disabled = false;
            button.classList.remove("disabled");
    
        }
    
        function showFormError(element : any, text : any){
    
            var modal = findAncestor(element, 'modal');
    
            modal.querySelector('.__error-outer').classList.remove("hidden-xl-down");
            modal.querySelector('.__error-inner').classList.add("bg-danger");
            modal.querySelector('.__error-inner').innerHTML = text;
    
        }
        
        function showFormSuccess(element : any, text : any){
    
            var modal = findAncestor(element, 'modal');
    
            modal.querySelector('.__error-outer').classList.remove("hidden-xl-down");
            modal.querySelector('.__error-inner').classList.add("bg-success");
            modal.querySelector('.__error-inner').innerHTML = text;
    
        }
    
        function hideFormMessage(element : any){
    
            var modal = findAncestor(element, 'modal');
    
            modal.querySelector('.__error-outer').classList.add("hidden-xl-down");
            modal.querySelector('.__error-inner').classList.remove("bg-danger");
            modal.querySelector('.__error-inner').classList.remove("bg-success");
            modal.querySelector('.__error-inner').innerHTML = '';
    
        }
        
        function urlencodeFormData(fd : any){
            var s = '';
            function encode(s : any){ return encodeURIComponent(s).replace(/%20/g,'+'); }
            for(var pair of fd.entries()){
                if(typeof pair[1]=='string'){
                    s += (s?'&':'') + encode(pair[0])+'='+encode(pair[1]);
                }
            }
            return s;
        }
    
        function findAncestor (el : any, cls : any) {
            while ((el = el.parentElement) && !el.classList.contains(cls));
            return el;
        }
    
        function showAlert(text : any){
    
            document.querySelector("#modal .__text").innerHTML = text;
            $('#modal').modal('show');
    
        }
    
        function setFieldError(field : any, text : any){
    
            var field_outer = findAncestor(field, '__field');
            var field_error = field_outer.querySelector(".__error_msg");
    
            field_error.innerHTML = text;
            field_error.classList.remove("hidden-xl-down");
            field_outer.classList.add("has-danger");
    
        }
    
        function hideFieldError(field : any){
            
            var field_outer = findAncestor(field, '__field');
            var field_error = field_outer.querySelector(".__error_msg");
    
            field_error.innerHTML = '';
            field_error.classList.add("hidden-xl-down");
            field_outer.classList.remove("has-danger");
    
        }
    
        function checkField(field : any){
    
            if(field.name == "firstname"){
    
                var error = checkName(field);
                
                if(error) return true;
    
            } else if (field.name == "lastname") {
    
                var error = checkName(field);
    
                if(error) return true;
    
            } else if (field.name == "email") {
    
                var error = checkEmail(field);
    
                if(error) return true;
    
            } else if (field.name == "old_password") {
    
                var error = checkPassword(field);
    
                if(error) return true;
    
            } else if (field.name == "password") {
    
                var error = checkPassword(field);
    
                if(error) return true;
    
            } else if (field.name == "password2") {
    
                var error = checkPassword2(field, modal_profile.elements["password"]);
    
                if(error) return true;
    
            }
    
            hideFieldError(field);
    
            return false;
    
        }
    
        function checkName(field : any){
    
            var lengthError = checkFieldLength(field);
            if(lengthError) return true;
    
            if(field.value.length < 3){
    
                setFieldError(field, "Не менее 3 символов!");
    
                return true;
    
            } else if(!regexp_name.test(field.value)){
    
                setFieldError(field, "Поле заполнено некорректно!");
    
                return true;
    
            } else {
    
                return false;
    
            }
    
        }
        
        function checkEmail(field : any){
    
            if(!regexp_email.test(field.value)){
    
                setFieldError(field, "Поле заполнено некорректно!");
    
                return true;
    
            } else {
    
                return false;
    
            }
    
        }
    
        function checkPassword(field : any){
    
            if(field.value.length != 0 && field.value.length < 6){
    
                setFieldError(field, "Не менее 6 символов!");
    
                return true;
    
            } else {
    
                return false;
    
            }
    
        }
    
        function checkPassword2(field : any, field2 : any){
    
            checkPassword(field);
    
            if(field.value != field2.value){
    
                setFieldError(field, "Пароли не совпадают!");
    
                return true;
    
            } else {
    
                return false;
    
            }
    
        }
    
        function checkFieldsOnBlur(object : any){
    
            for(var i = 0; i < object.length; i++){
    
                var field = object[i];
    
                field.onblur = function(){
    
                    checkField(this);
    
                };
    
            }
    
        }
    
        function checkFieldsOnSubmit(form : any, object : any){
    
            var invalid = false;
    
            for(var i = 0; i < object.length; i++){
    
                var field = object[i];
    
                var hasError = checkField(field);
    
                if(hasError && !invalid){
    
                    invalid = true;
    
                }
    
            }
    
            if(invalid) {
    
                return true;
    
            } else {
    
                return false;
    
            }
    
        }
    
        function checkFieldLength(field : any){
    
            if(field.value.length == 0){
    
                setFieldError(field, "Это поле обязательно для заполения!");
    
                return true;
    
            } else if(field.value.length > 30){
    
                setFieldError(field, "Не более 30 символов!");
    
                return true;            
    
            } else {
    
                return false;
    
            }
    
        }
    
        function delNotRequiredData(formData : any){
    
            var password = formData.get("password");
    
            if (password.length == 0){
    
                formData.delete("password");
                formData.delete("password2");
                formData.delete("old_password");
    
            }
    
        }
    
        function hideAllErrors(object : any){
    
    
            for(var i = 0; i < object.length; i++){
    
                var field = object[i];
    
                hideFieldError(field);
    
            }
    
    
    
        }
    
        function saveFormValues(input : any, output : any){
    
            for(var i = 0; i < input.length; i++){
    
                var field_name = input[i].name;
                var field_value = input[i].value;
    
                output[field_name] = field_value;
    
            }
    
        }
    
        function restoreFormValues(form : any, obj : any){
    
            for(var i = 0; i < form.elements.length; i++){
    
                var el = form.elements[i];
    
                if(obj[el.name]){
    
                    el.value = obj[el.name];
    
                }
    
            }
    
        }
    
        function formChangeOnInput(form : any, object : any, btn1 : any, btn2 : any){
            
            for(var i = 0; i < object.length; i++){
    
                var field = object[i];
    
                field.oninput = function(){
    
                    if(this.value != fields_values[this.name]){
    
                        enableButton(btn1, btn2);
    
                    } else {
    
                        disableButton(btn1, btn2);
    
                    }
    
                };
    
            }
    
        }

    }

    static modalLogin(){

        // форма входа
        var form : any = document.getElementById("login");
        // текст модальнго окна
        var modal_message_text = document.querySelector("#modal .modal-body p");
    
        var login_url = "api/1.0.0/user/login";
    
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
        form.onsubmit = function(e : any){
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
        function checkInputs(that : any){
        
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
        function sendData(that : any){
    
            // создание объекта для отправки
            var data = new FormData(that);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', login_url);
            xhr.send(data);
    
            // кнопка отправки (скрытая)
            var submit : any = document.getElementById("sub_form");
            // label для скрытой кнопки submit
            var submit_label : any = document.getElementById("send_form");
    
            // блокировка формы во время отправки
            submit.disabled = true;
            submit_label.disabled = true;
            submit_label.classList.add("disabled");
            submit_label.style.pointerEvents = "auto";
            submit_label.innerHTML = "Отправка данных <i class=\"fas fa-spinner fa-pulse\"></i>";
    
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
    
                        var res = JSON.parse(xhr.responseText);
    
                        // показать блок с ошибкой
                        $("#ajax-error").removeClass("hidden-xl-down");
                        $("#ajax-error > div").text(xhr.status + " : " + res.error);
                        
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
        
    }

    static modalReg(){

        var form : any = document.getElementById("registration");
        
        var reg_url = "api/1.0.0/user/register";
        
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
            form.elements["gender"],
            form.elements["email"],
            form.elements["password"],
            form.elements["password2"],
            form.elements["type"],
        ];
    
        // при потере фокуса поля проверять на валидность
        validateForm();
        
        // при попытке отправить форму проверить на валидность и отправить данных
        // если все верно
        form.onsubmit = function(e : any ){
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
        
        function checkInputs(that : any ){
            
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
    
            if(that.name == "gender"){
    
                if(that.value.length == 0 || !that.value){
    
                    error_message.innerHTML = "Это поле обязательно для заполения!";
                    error_message.classList.remove("hidden-xl-down");
                    if(!outer_block.classList.contains("has-danger")){isValid--;}
                    outer_block.classList.add("has-danger");
                    return;
    
                } else {
    
                    error_message.innerHTML = "";
                    error_message.classList.add("hidden-xl-down");
                    if(outer_block.classList.contains("has-danger")){isValid++;}
                    outer_block.classList.remove("has-danger");
                    return;
    
                }
    
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
        function sendData(that : any ){
    
            // создание объекта для отправки
            var data = new FormData(that);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', reg_url);
            xhr.send(data);
    
            // кнопка отправки (скрытая)
            var submit : any  = document.getElementById("sub_form_reg");
            // label для скрытой кнопки submit
            var submit_label : any  = document.getElementById("send_form_reg");
    
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
    
                        var res = JSON.parse(xhr.responseText);
                        $("#ajax-error-reg").removeClass("hidden-xl-down");
                        $("#ajax-error-reg > div").text(xhr.status + " : " + res.error);
                        
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
        
    }

    static dropMenu(){

        var name = document.querySelector("#header .name");
        var drop_menu : any = document.querySelector("#header .drop_menu");
        var logout : HTMLElement = document.querySelector("#header .logout");
        let toggle_menu : HTMLElement = document.querySelector(".header-menu-m");
    
        var avatar_url = "api/1.0.0/user/avatar";
        var logout_url = "api/1.0.0/user/logout";
        
        if(name != null){
            
            (document.querySelector(".__dropdown_btn") as any).onclick = function(e : any){

                e.preventDefault();

                if(toggle_menu.classList.contains("header-menu-m-fadein")){
                    toggle_menu.classList.remove("header-menu-m-fadein");
                }

                if(document.querySelector(".name > a").classList.contains("menu-active")){
                    drop_menu.style.display = "none";
                    document.querySelector(".name > a").classList.remove("menu-active");
                } else {
                    drop_menu.style.display = "block";
                    document.querySelector(".name > a").classList.add("menu-active");
                }
            }
        
            logout.onclick = function(e : any){
                var xhr = new XMLHttpRequest();
                xhr.open('POST', logout_url);
                xhr.send();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4){
                        if (xhr.status == 200) {
                            window.location.reload();
                        } else {
                            alert(xhr.status + ': ' + xhr.statusText);
                        }
                    }
                }
            }
        }
    
        if(document.getElementById("avatar_upload")){
            var input : any = document.getElementById("avatar_upload");
            var temp_img : any, preload : any= document.getElementById("avatar_preload");
            var confirm_message_text = document.querySelector("#confirm .modal-body p");
            var modal_message_text = document.querySelector("#modal .modal-body p");
            var confirm_btn1 : HTMLElement = document.querySelector("#confirm .option1");
            var confirm_btn2 : HTMLElement = document.querySelector("#confirm .option2");
    
            input.onchange = function(){
                if ((this as any).files && (this as any).files[0]) {
                    var reader = new FileReader();
                    reader.readAsDataURL((this as any).files[0]);
                    reader.onload = function (e : any) {
                        temp_img = preload.src;
                        preload.src = e.target.result;
    
                        confirm_message_text.innerHTML = "Изменить аватар?";
                        confirm_btn1.innerHTML = "Да";
                        confirm_btn2.innerHTML = "Нет";
                        confirm_btn1.onclick = function(){
    
                            var btn : any = this;
                            var data = new FormData();
                            data.append('avatar', input.files[0], 'avatar.jpg');
    
                            var xhr = new XMLHttpRequest();
                    
                            xhr.open('POST', avatar_url);
                            xhr.send(data);
    
                            btn.disabled = true;
                            btn.classList.add("disabled");
                            btn.style.pointerEvents = "auto";
                            btn.innerHTML = "Отправка данных <i class=\"fas fa-spinner fa-pulse\"></i>";
                        
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState == 4){
                                    if (xhr.status == 200) {
                        
                                        modal_message_text.innerHTML = "Аватар изменен!";
                                        $('#confirm').modal('hide');
    
                                        setTimeout(function(){
                                            $('#modal').modal('show');
                                        }, 500);
                        
                                        btn.disabled = false;
                                        btn.classList.remove("disabled");
                                        btn.innerHTML = "";
                        
                                    } else {
                                        modal_message_text.innerHTML = xhr.status + ': ' + xhr.statusText + ", " + xhr.responseText;
                                        $('#modal').modal('show');
                        
                                        btn.disabled = false;
                                        btn.classList.remove("disabled");
                                        btn.innerHTML = "Да";
                                    }
                                } 
                            }
                        }
                    
                        confirm_btn2.onclick = function(){
                            preload.src = temp_img;
                            input.value = null;
                            $('#confirm').modal('hide');
                        };
    
                        $('#confirm').modal('show');
                    };
                    
                }
            }
        }
                
    }

    static headerDropMenu(){

        let toggle_button : HTMLAnchorElement = document.querySelector(".__toggle-hmenu");
        let toggle_drop_menu : HTMLAnchorElement = document.querySelector(".__dropdown_btn");
        let toggle_menu : HTMLElement = document.querySelector(".header-menu-m");
        let drop_menu : HTMLElement = document.querySelector("#header .drop_menu");

        toggle_button.onclick = () => {

            if(toggle_drop_menu && toggle_drop_menu.classList.contains("menu-active")){
                drop_menu.style.display = "none";
                toggle_drop_menu.classList.remove("menu-active");
            }

            if(toggle_menu.classList.contains("header-menu-m-fadein")){

                toggle_menu.classList.remove("header-menu-m-fadein");

            } else {

                toggle_menu.classList.add("header-menu-m-fadein");
                
            }
            
        }

       this.hideHeaderMenu();
    }

    private static hideHeaderMenu(){
        let toggle_menu : HTMLElement = document.querySelector(".header-menu-m");
        let drop_menu : HTMLElement = document.querySelector("#header .drop_menu");
        let toggle_drop_menu : HTMLAnchorElement = document.querySelector(".__dropdown_btn");

        document.onscroll = () => {

            if(toggle_menu.classList.contains("header-menu-m-fadein")){
                toggle_menu.classList.remove("header-menu-m-fadein");
            } 

            if(toggle_drop_menu && toggle_drop_menu.classList.contains("menu-active")){
                drop_menu.style.display = "none";
                toggle_drop_menu.classList.remove("menu-active");
            }
        }
    }
}