"use strict";

// инкапсуляция данных
(function(){

    // если это не страница для создания резюме, то не выполнять код
    if(window.location.href.indexOf("resume.php?add") == -1){
        return;
    }

    // блок формы
    var form = document.getElementById("resume");
    // кнопка для скрытия блока опыта работы (ОР)
    var remove_exp = document.getElementById("remove_exp");
    // кнопка для сгенерации еще одного блока ОР
    var add_exp = document.getElementById("add_exp");
    // вернуть блок ОР
    var restore_exp = document.getElementById("restore_exp");
    // блок с полями ОР
    var experience_block = document.getElementById("exp_block");
    // блок, где указана инфо в случае скрытия предыдущего блока
    var no_experience_block = document.querySelector(".no_exp_block");
    // инпут с загрузкой картинки
    var avatar_input = document.getElementById("avatar");
    // прелоадер картинки
    var avatar_image = document.getElementById("avatar_img");
    // блок для генерации готовой формы ОР
    var completed_exp_forms = document.querySelector(".completed_exp_forms"); 
    // блок для генерации готовой формы образования
    var completed_edu_forms = document.querySelector(".completed_edu_forms"); 
    // кнопка для сгенерации блока с образованием
    var add_edu = document.getElementById("add_edu");
    // блок с кнопкой `remove_exp`
    var hide_exp_block = document.querySelector(".hide_exp_block");
    // текст модального окна alert
    var modal_message_text = document.querySelector("#modal .modal-body p");
    // текст модального окна confirm
    var confirm_message_text = document.querySelector("#confirm .modal-body p");
    // 1 кнопка окна confirm
    var confirm_btn1 = document.querySelector("#confirm .option1");
    // 2 кнопка окна confirm
    var confirm_btn2 = document.querySelector("#confirm .option2");
    // кнопка добавления языка
    var add_lang = document.getElementById("add_lang");
    // родительский блок для языков
    var lang_block = document.querySelector(".lang_block");
    // если есть опыт, то поля проверяются на валидность
    var hasExp = true;
    // если тип образования имеет факультет, то поле проверяется на валидность
    var hasFacult = false;
    // массив ОР
    var exp_array = [];
    // массив с образованием
    var edu_array = [];
    // массив с языками
    var lang_array = [];


    // все поля, требующие проверки
    var fields = [
        form.elements["firstname"],
        form.elements["lastname"],
        form.elements["patronymic"],
        form.elements["phone"],
        form.elements["birth"],
        form.elements["city"],
        form.elements["email"],

        form.elements["post"],
        form.elements["salary"],

        form.elements["exp_post"],
        form.elements["exp_company"],
        form.elements["exp_city"],
        form.elements["work_period"],
        form.elements["exp_func"],

        form.elements["edu_inst"],
        form.elements["edu_fac"],
        form.elements["edu_city"],
        form.elements["edu_period"],

        form.elements["add_courses"],
        form.elements["add_skills"]
    ];

    // поля для генерации нового места работы
    var fields_exp = [
        form.elements["exp_post"],
        form.elements["exp_company"],
        form.elements["exp_city"],
        form.elements["work_period"],
        form.elements["exp_func"],
    ];

    // поля для генерации нового учебного заведения
    var fields_edu = [
        form.elements["edu_inst"],
        form.elements["edu_city"],
        form.elements["edu_fac"],
        form.elements["edu_period"]
    ];

    // необязательные для заполнения поля опыта работы
    var not_required_exp = [
        "exp_post",
        "exp_company",
        "exp_city",
        "exp_func",
        "work_period",
    ];

    // необязательные для заполнения поля образования
    var not_required_add = [
        "add_courses",
        "add_skills"
    ];


    // нажатие на кнопку отправки
    form.onsubmit = function (e){
        e.preventDefault();

        // проверка на валидность основных полей
        validate_primary_form(function(){

            // проверка на валидность ОР
            validate_exp(function(){

                // проверка на валидность образования
                validate_education(function(){

                    // отправка основных данных формы
                    send_primary_data(function(){

                        // отправка данных об ОР
                        send_work_exp(function(){
                            
                            // отправка данных об образовании
                            send_education(function(){
                                
                                // формирования массива с языками
                                get_languages();
                                
                                // отправка данных о языках
                                send_languages();
                            });
                        });
                    });
                });
            });
        });
    }

    // проверка валидности полей при потери фокуса
    for(var i = 0; i < fields.length; i++){
        var field = fields[i];
        field.onblur = function(){
            validate_inputs(this);
        };
    }


    // валидация переданного в `that` одного поля
    function validate_inputs(that){

        // статус поля ( найдена ли ошибка )
        var valid = 0;
        
        // регулярные выражения для полей
        var regexp;
        var regexp_name = /^[A-ZА-ЯЁ]{1}[a-zа-яё\s?]{2,}$/;
        var regexp_phone = /^\+[\d]{11}$/;
        var regexp_city = /^[A-zА-яЁё\"-\s?]{4,}$/;
        var regexp_birth = /^[\d]{2}\.[\d]{2}\.[\d]{4}$/;
        var regexp_email = /(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var regexp_sentence = /^[A-zА-яЁё0-9\.,!:\\(\)#"-\s?]{4,}$/;
        var regexp_numbers = /^[\d]{1,}$/;
        var regexp_work_period = /^[A-zА-яЁё]{3,8}\s[\d]{4}\s\-\s[A-zА-яЁё]{3,8}\s[\d]{4}$/;
        var regexp_edu_period = /^[\d]{4}\s\-\s[\d]{4}$/;


        //внешний блок поля
        var outer_block = that.parentNode.parentNode;
        //блок для генерации ошибки
        var error_message = outer_block.querySelector(".error-block");

        // если это поле `edu_fac` и оно необязательное, то пропустить
        if(that.name == "edu_fac" && !hasFacult){
            return valid;
        }

        // присваивание регулярного выражения в зависимости от поля
        if(that.name == "lastname" ||
        that.name == "firstname" ||
        that.name == "patronymic") {
        regexp = regexp_name;
        } else if (that.name == "phone") {
            regexp = regexp_phone;
        } else if (that.name == "birth") {
            regexp = regexp_birth;
        } else if (
            that.name == "city" || 
            that.name == "exp_city" || 
            that.name == "edu_city"
            ) {
            regexp = regexp_city;
        } else if (that.name == "email") {
            regexp = regexp_email;
        } else if (
            that.name == "post" || 
            that.name == "exp_post" || 
            that.name == "exp_company" ||
            that.name == "exp_func" ||
            that.name == "edu_inst" ||
            that.name == "edu_fac" ||
            that.name == "add_courses" || 
            that.name == "add_skills"
            ) {
            regexp = regexp_sentence;
        } else if (that.name == "salary") {
            regexp = regexp_numbers;
        } else if (that.name == "work_period") {
            regexp = regexp_work_period;
        } else if (that.name == "edu_period") {
            regexp = regexp_edu_period;
        }

        // если поле пустое и обязятельное для заполнения
        if((not_required_exp.indexOf(that.name) != -1 && hasExp && that.value == "") ||
        (that.value == "" && 
        not_required_add.indexOf(that.name) == -1 && 
        not_required_exp.indexOf(that.name) == -1)){

            // красная граница у инпута
            outer_block.classList.add("has-danger");
            // показать блок с ошибкой 
            error_message.classList.remove("hidden-xl-down");
            // текст ошибки
            error_message.innerHTML = "Это поле обязательно для заполения!";

            return valid -1;
        }

        // валидация длины поля, если оно обязательное для заполения, 
        // либо необязательное поле имеет хоть один символ 
        if(
            (
                not_required_add.indexOf(that.name) == -1 && 
                not_required_exp.indexOf(that.name) == -1
            )
            ||
            (
                not_required_exp.indexOf(that.name) != -1 && hasExp
            )
            ||
            (
                that.value.length > 0
            )
        ){
            if(regexp == regexp_name && that.value.length < 3){
    
                outer_block.classList.add("has-danger");
                error_message.classList.remove("hidden-xl-down");
                error_message.innerHTML = "Поле должно содержать не менее 3 символов!";
                return valid -1;
            }
        
            if(regexp == regexp_phone && that.value.length < 11){

                outer_block.classList.add("has-danger");
                error_message.classList.remove("hidden-xl-down");
                error_message.innerHTML = "Поле должно содержать 11 символов!";
                return valid -1;
            }
        
            if(regexp == regexp_city && that.value.length < 4){

                outer_block.classList.add("has-danger");
                error_message.classList.remove("hidden-xl-down");
                error_message.innerHTML = "Поле должно содержать не менее 4 символов!";
                return valid -1;
            }
        
            if(regexp == regexp_sentence && that.value.length < 4){

                outer_block.classList.add("has-danger");
                error_message.classList.remove("hidden-xl-down");
                error_message.innerHTML = "Поле должно содержать не менее 4 символов!";
                return valid -1;
            }
        }

        // валидация по регулярному выражению, если это обязательное поле,
        // либо необязательное поле имеет хоть один символ 
        if(
            (
                !regexp.test(that.value) && 
                (
                    not_required_exp.indexOf(that.name) != -1 
                    || 
                    not_required_add.indexOf(that.name) != -1
                ) &&
                that.value.length > 0
            )
            ||
            (
                !regexp.test(that.value) && 
                not_required_exp.indexOf(that.name) == -1  &&
                not_required_add.indexOf(that.name) == -1 
            )
        ){     

            outer_block.classList.add("has-danger");
            error_message.classList.remove("hidden-xl-down");
            error_message.innerHTML = "Поле заполнено некорректно!";
            return valid -1;
        } else {

            // если нет ни одной ошибки, скрыть блок с ошибкой, убрать красный бордер
            outer_block.classList.remove("has-danger");
            error_message.classList.add("hidden-xl-down");
            error_message.innerHTML = "";
            return valid;
        }
    }

    // скрыть форму ОР
    remove_exp.onclick = function(e){
        e.preventDefault();
        // если нет ОР, не будут проверяться данные поля
        hasExp = false;
        // скрыть форму ОР
        experience_block.classList.add("hidden-xl-down");
        // показать иной блок
        no_experience_block.classList.remove("hidden-xl-down");
    }

    // вернуть форму ОР
    restore_exp.onclick = function(e){
        e.preventDefault();
        hasExp = true;
        experience_block.classList.remove("hidden-xl-down");
        no_experience_block.classList.add("hidden-xl-down"); 
    }

    // сгенерировать заполненный блок ОР
    add_exp.onclick = function(e){
        e.preventDefault();

        var exp_valid = 0;

        // валидность формы ОР
        for(var i = 0; i < fields_exp.length; i++){
            var field = fields_exp[i];
            exp_valid += validate_inputs(field);
        }

        // если возникла ошибка валидации
        if(exp_valid !== 0){
            modal_message_text.innerHTML = "Поля заполнены неверно!";
            $('#modal').modal('show');
            return;        
        }

        // ... если ошибок нет

        // генерация блока
        var block = document.createElement("div");
        block.classList.add("exp_job");
        block.innerHTML = '<div class="card mb-4" style="font-size: 14px;"><div class="card-block"><h3 class="card-title">'+form.elements["exp_post"].value+'</h3><div class="card-text mb-2"><div class="d-flex justify-content-between"><div class="left d-flex"><div class="company mr-2 text-muted">'+form.elements["exp_company"].value+'</div><div class="city text-muted">'+form.elements["exp_city"].value+'</div></div><div class="right text-muted">'+form.elements["work_period"].value+'</div></div><div class="text-muted">'+form.elements["exp_industry"].options[form.elements["exp_industry"].selectedIndex ].text+'</div><div>'+form.elements["exp_func"].value+'</div></div><a href="#" class="btn btn-primary mr-1 edit_job">Редактировать</a><a href="#" class="btn btn-secondary delete_job">Удалить</a></div></div>';

        // значение поля select `отрасль`, которое не проходит проверку
        var industry = form.elements["exp_industry"];

        // добавить данные в массив для отправки
        exp_array.push({
            "exp_post" : fields_exp[0].value,
            "exp_company" : fields_exp[1].value,
            "exp_city" : fields_exp[2].value,
            "work_period" : fields_exp[3].value,
            "exp_func" : fields_exp[4].value,
            "exp_industry" : industry.value
        });

        // добавить класс с номером в массиве, чтобы потом можно было корректо удалить
        block.classList.add("job" + (exp_array.length -1));

        // скрыть блок, где кнопка с удалением формы
        hide_exp_block.classList.add("hidden-xl-down");
        
        // добавить сгенерированный блок в родительский
        completed_exp_forms.appendChild(block);

        // очистить все поля
        industry.value = "1";
        for(var i = 0; i < fields_exp.length; i++){
            var field = fields_exp[i];
            field.value = "";
        }

    }

    // прелоадер для загрузки аватара
    avatar_input.onchange = function(){
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function (e) {
                avatar_image.src = e.target.result;
            };
        }
    }

    // удаление созданных блоков с ОР
    function delete_exp_job(){
        
        // массив кнопок
        var delete_buttons = document.querySelectorAll(".delete_job");
        
        for (var i = 0; i < delete_buttons.length; i++) {

            delete_buttons[i].onclick = function(e){
                e.preventDefault();
                
                // родительский блок
                var job = this.parentNode.parentNode.parentNode;
            
                // id записи
                var job_id = job.classList[1].slice(3);
                
                // удалить объект из массива данных
                delete exp_array[+job_id];
            
                // удаляем узел в DOM
                job.parentNode.removeChild(job);
                
                // подсчитываем число объектов в массиве
                var array_length = 0;
                
                for (var i = 0; i < exp_array.length; i++) {
                    if (exp_array[i] !== undefined) {
                        array_length++;
                    }
                }

                // если нет ни одного созданного блока ОР, вернем блок с `удалением` формы
                if(array_length === 0){
                    hide_exp_block.classList.remove("hidden-xl-down");
                }

            }

        }
    }

    // редактирование созданных блоков с ОР
    function edit_exp_job(){
            
        // массив кнопок
        var edit_buttons = document.querySelectorAll(".edit_job");
        
        for (var i = 0; i < edit_buttons.length; i++) {

            edit_buttons[i].onclick = function(e){
                e.preventDefault();
                
                // родительский блок
                var job = this.parentNode.parentNode.parentNode;
                
                // id записи
                var job_id = job.classList[1].slice(3);

                // сохраняем удаленный объект в переменную
                var object = exp_array[+job_id];
                
                // удалить объект из массива данных
                delete exp_array[+job_id];
                
                // удаляем узел в DOM
                job.parentNode.removeChild(job);
                
                // подсчитываем число объектов в массиве
                var array_length = 0;
                
                for (var i = 0; i < exp_array.length; i++) {
                    if (exp_array[i] !== undefined) {
                        array_length++;
                    }
                }

                // если нет ни одного созданного блока ОР, вернем блок с `удалением` формы
                if(array_length === 0){
                    hide_exp_block.classList.remove("hidden-xl-down");
                }

                // заполняем поля из объекта
                form.elements["exp_post"].value = object["exp_post"];
                form.elements["exp_company"].value = object["exp_company"];
                form.elements["exp_city"].value = object["exp_city"];
                form.elements["work_period"].value = object["work_period"];
                form.elements["exp_func"].value = object["exp_func"];
                form.elements["exp_industry"].value = object["exp_industry"];
            }
        }
    }

    // динамически выполняется функция при добавлении новых элементов в DOM
    completed_exp_forms.addEventListener('DOMNodeInserted', function(){
        delete_exp_job();
        edit_exp_job();
    });
    completed_exp_forms.addEventListener('DOMNodeRemoved', function(){
        delete_exp_job();
        edit_exp_job();
    });



    // сгенерировать заполненный блок образования
    add_edu.onclick = function(e){
        e.preventDefault();

        var edu_valid = 0;

        // валидность формы образования
        for(var i = 0; i < fields_edu.length; i++){
            var field = fields_edu[i];
            edu_valid += validate_inputs(field);
        }

        // если возникла ошибка валидации
        if(edu_valid !== 0){
            modal_message_text.innerHTML = "Поля заполнены неверно!";
            $('#modal').modal('show');
            return;        
        }

        // ... если ошибок нет

        // генерация блока
        var block = document.createElement("div");
        block.classList.add("edu");
        block.innerHTML = '<div class="card mb-4" style="font-size: 14px;"><div class="card-block"><h3 class="card-title">'+form.elements["edu_inst"].value+'</h3><div class="card-text mb-2"><div class="d-flex justify-content-between"><div class="left d-flex"><div class="company mr-2 text-muted">'+form.elements["edu_level"].options[form.elements["edu_level"].selectedIndex ].text+'</div><div class="city text-muted">'+form.elements["edu_city"].value+'</div></div><div class="right text-muted">'+form.elements["edu_period"].value+' гг.</div></div><div class="text-muted">'+form.elements["edu_fac"].value+'</div></div><a href="#" class="btn btn-primary mr-1 edit_edu">Редактировать</a><a href="#" class="btn btn-secondary delete_edu">Удалить</a></div></div>';

        // добавить данные в массив для отправки
        edu_array.push({
            "edu_level" : form.elements["edu_level"].value,
            "edu_inst" : fields_edu[0].value,
            "edu_city" : fields_edu[1].value,
            "edu_fac" : fields_edu[2].value,
            "edu_period" : fields_edu[3].value
        });

        // добавить класс с номером в массиве, чтобы потом можно было корректо удалить
        block.classList.add("edu" + (edu_array.length -1));
        
        // добавить сгенерированный блок в родительский
        completed_edu_forms.appendChild(block);

        // вернуть уровень образования к среднему
        form.elements["edu_level"].value = "1";

        // скрыть поле факультета, т.к уровень образования вернется к среднему
        hide_facult_field();

        // очистить все остальные поля
        for(var i = 0; i < fields_edu.length; i++){
            var field = fields_edu[i];
            field.value = "";
        }

    }

    // удаление созданных блоков с образованием
    function delete_edu(){
        
        // массив кнопок
        var delete_buttons = document.querySelectorAll(".delete_edu");
        
        for (var i = 0; i < delete_buttons.length; i++) {

            delete_buttons[i].onclick = function(e){
                e.preventDefault();
                
                // родительский блок
                var edu = this.parentNode.parentNode.parentNode;
            
                // id записи
                var edu_id = edu.classList[1].slice(3);
                
                // удалить объект из массива данных
                delete edu_array[+edu_id];
            
                // удаляем узел в DOM
                edu.parentNode.removeChild(edu);

            }

        }
    }

    // редактирование созданных блоков с образованием
    function edit_edu(){
        
    // массив кнопок
    var edit_buttons = document.querySelectorAll(".edit_edu");

        for (var i = 0; i < edit_buttons.length; i++) {

            edit_buttons[i].onclick = function(e){
                e.preventDefault();
                
                // родительский блок
                var edu = this.parentNode.parentNode.parentNode;
                
                // id записи
                var edu_id = edu.classList[1].slice(3);

                // сохраняем удаленный объект в переменную
                var object = edu_array[+edu_id];
                
                // удалить объект из массива данных
                delete edu_array[+edu_id];
                
                // удаляем узел в DOM
                edu.parentNode.removeChild(edu);

                // заполняем поля из объекта
                form.elements["edu_level"].value = object["edu_level"];
                form.elements["edu_inst"].value = object["edu_inst"];
                form.elements["edu_city"].value = object["edu_city"];
                form.elements["edu_fac"].value = object["edu_fac"];
                form.elements["edu_period"].value = object["edu_period"];

                // проверка уровня образования. если высшее, то вернуть поле с факультетом
                hide_facult_field();
            }
        }
    }

    // динамически выполняется функция при добавлении новых элементов в DOM
    completed_edu_forms.addEventListener('DOMNodeInserted', function(){
        delete_edu();
        edit_edu();
    });
    completed_edu_forms.addEventListener('DOMNodeRemoved', function(){
        delete_edu();
        edit_edu();
    });

    // если образованием не высшее, то скрыть после с факультетом
    function hide_facult_field(){
        if(
            form.elements["edu_level"].value != 3 && 
            form.elements["edu_level"].value != 4 && 
            form.elements["edu_level"].value != 5 && 
            form.elements["edu_level"].value != 6 && 
            form.elements["edu_level"].value != 7
        ){
            document.querySelector(".edu_facult").classList.add("hidden-xl-down");
            form.elements["edu_fac"].value = "";
            hasFacult = false;
        } else {
            document.querySelector(".edu_facult").classList.remove("hidden-xl-down");
            hasFacult = true;
        }
    }

    // проверить при загрузке
    hide_facult_field();

    // проверить при смене поля
    form.elements["edu_level"].onchange = function(){ hide_facult_field(); }

    // добавить еще один язык
    add_lang.onclick = function(e){
        e.preventDefault();

        // массив из id всех добавленных языков
        var lang_ids = document.querySelectorAll(".lang_id");

        // текстовое значение владением языка
        var selected_option = form.elements["lang_list"].options[form.elements["lang_list"].selectedIndex].text;

        // id языка
        var selected_value = form.elements["lang_list"].value;

        // если язык уже добавлен, выдать ошибку
        for(var i = 0; i < lang_ids.length; i++){
            if(lang_ids[i].innerText == selected_value){
                modal_message_text.innerHTML = "Данный язык уже добавлен!";
                $('#modal').modal('show');
                return;
            }
        }

        // генерация нового блока с языком
        var block = document.createElement("div");
        block.className = "d-flex col-10 pl-0 pr-0 mx-auto";
        block.innerHTML = '<div class="group col-11"><div class="form-group row"><div class="hidden-xl-down lang_id">'+selected_value+'</div><label class="col-3 col-form-label pl-0">'+selected_option+'</label><div class="col-9"><select class="form-control custom-select" name="lang"><option value="Не владею">Не владею</option><option value="Базовый">Базовый</option><option value="Технический">Технический</option><option value="Разговорный">Разговорный</option><option value="Свободно владею">Свободно владею</option></select></div></div></div><a class="btn btn-outline-primary col-1 delete_lang" href="#" role="button" style="height: 37px; padding: .5rem .3rem;">&#151;</a>';
        lang_block.appendChild(block);    
    }


    // удаление созданного блока с языком
    function delete_lang(){
        
        // массив кнопок
        var delete_buttons = document.querySelectorAll(".delete_lang");
        
        for (var i = 0; i < delete_buttons.length; i++) {

            delete_buttons[i].onclick = function(e){
                e.preventDefault();
                
                // родительский блок
                var lang = this.parentNode;
            
                // удаляем узел в DOM
                lang.parentNode.removeChild(lang);

            }

        }
    }

    // динамически выполняется функция при добавлении новых элементов в DOM
    lang_block.addEventListener('DOMNodeInserted', function(){
        delete_lang();
    });
    lang_block.addEventListener('DOMNodeRemoved', function(){
        delete_lang();
    });


    // получение объекта с языками
    function get_languages(next){

        var lang_ids = document.querySelectorAll(".lang_id");
        var lang_values = form.elements["lang"];

        lang_array = [];

        for(var i = 0; i < lang_ids.length; i++){

            var lang_id = lang_ids[i].innerHTML;
            var lang_level;

            if (lang_ids.length == 1) {
                lang_level = lang_values.value;
            } else {
                lang_level = lang_values[i].value;
            }
            
            lang_array.push({
                "lang_id" : lang_id,
                "lang_level" : lang_level
            });
        }

        if(next) next();
    }

    // асинхрнонный запрос на сервер
    function ajax(method, script, data, ismultidata, onsuccess, onerror){

        // необходимые переменные
        var method = method || "GET";
        var script = script;
        var encoding;

        // устанавливаем кодировку, если это post запрос
        if(method == "POST"){
            encoding = "application/x-www-form-urlencoded";
        }

        // новый объект
        var xhr = new XMLHttpRequest();

        // в зависимости от типа, формируем запрос
        if(method == "GET"){
            xhr.open(method, script + "?" + data, true);
            xhr.send();        
        } else {
            xhr.open(method, script, true);
            if(ismultidata == false) xhr.setRequestHeader('Content-Type', encoding);
            xhr.send(data);
        }
        
        // отправка запроса и отслеживание состояния 
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4){
                if (xhr.status == 200) {
                    // вызов функции, если запрос выполнен успешно
                    if(onsuccess) onsuccess(xhr.status, xhr.responseText);
                } else {
                    // вызов функции, если запрос выполнен с ошибкой
                    if(onerror) onerror(xhr.status, xhr.responseText);
                }
            }
        }
    }

    // отправить асинхронный запрос на добавление языков в БД
    function send_languages(){
                    
        if(lang_array.length > 0){

            // данные для отправки
            var data = "data=" + JSON.stringify(lang_array);
    
            ajax("POST", "scripts/set_language.php", data, false, 
            function(status, res){
                modal_message_text.innerHTML = "Данные отправлены успешно!";
                $('#modal').modal('show');
            }, 
            function(status, res){
                alert(xhr.status + ': ' + xhr.responseText);
            });
        } 
    }

    // отправка массива данных с ОР
    function send_work_exp(next){
        if(exp_array.length > 0){

            // данные для отправки
            var data = "data=" + JSON.stringify(exp_array);

            ajax("POST", "scripts/set_experience.php", data, false, 
            function(status, res){
                if(next) next();
            }, 
            function(status, res){
                alert(xhr.status + ': ' + xhr.responseText);
            });
            
        } else {
            if(next) next();
        }
    }

    // отправка массива данных с образованием
    function send_education(next){
        if(edu_array.length > 0){
            
            // данные для отправки
            var data = "data=" + JSON.stringify(edu_array);

            ajax("POST", "scripts/set_education.php", data, false, 
            function(status, res){
                if(next) next(status, res);
            }, 
            function(status, res){
                alert(xhr.status + ': ' + xhr.responseText);
            });
            
        } else {
            if(next) next();
        }
    }

    // массив данных с основными данными
    function send_primary_data(next){

        var data = new FormData();

        // добавление данных в объект FormData
        if(avatar_input.files[0]){data.append('avatar', avatar_input.files[0], 'avatar.jpg');}
        data.append('firstname', form.elements["firstname"].value);
        data.append('lastname', form.elements["lastname"].value);
        data.append('patronymic', form.elements["patronymic"].value);
        data.append('gender', form.elements["gender"].value);
        data.append('birthday', form.elements["birth"].value);
        data.append('city', form.elements["city"].value);
        data.append('phone', form.elements["phone"].value);
        data.append('email', form.elements["email"].value);
        data.append('post', form.elements["post"].value);
        data.append('industry_id', form.elements["industry"].value);
        data.append('schedule_id', form.elements["schedule"].value);
        data.append('salary', form.elements["salary"].value);
        data.append('work_place_id', form.elements["work_place"].value);
        data.append('comp_skill_id', form.elements["comp_skills"].value);
        data.append('car', form.elements["add_auto_exist"].value);
        data.append('courses', form.elements["add_courses"].value);
        data.append('skills', form.elements["add_skills"].value);

        // отправка данных
        ajax("POST", "scripts/set_resume.php", data, true, 
        function(status, res){
            if(next) next(status, res);
        }, 
        function(status, res){
            alert(status + ': ' + res);
        });

    }

    function validate_exp(next){
        // если не нажата кнопка об отсутствии опыта
        if(hasExp){

            // счетчик валидности полей
            var exp_valid = 0;

            // если уже есть массив с ОР
            if(exp_array.length > 0) {
                
                // переменная для проверки пустоты формы ОР
                var empty = true;

                // если хоть одно поле заполнено
                for(var i = 0; i < fields_exp.length; i++){
                    if(fields_exp[i].value !== ""){
                        empty = false;
                        break;
                    }
                }  

                // если поля не пустые
                if(!empty){

                    // проверить поля на валидность
                    for(var i = 0; i < fields_exp.length; i++){
                        var field = fields_exp[i];
                        exp_valid += validate_inputs(field);
                    } 

                    // если поля заполнены некорректно
                    if(exp_valid !== 0){
                        // сообщение модального окна
                        confirm_message_text.innerHTML = "Форма об опыте работы заполнена некорректно! Если вы хотите добавить эти данные для отправки, необходимо исправить ее, либо нажмите \"Не добавлять\"";
                        // текст левой кнопки
                        confirm_btn1.innerHTML = "Я хочу исправить";
                        // текст правой кнопки
                        confirm_btn2.innerHTML = "Не добавлять";
                        // отменить отправку для исправления ошибок
                        confirm_btn1.onclick = function(){
                            $('#confirm').modal('hide');
                        }
                        // валидация следующих полей
                        confirm_btn2.onclick = function(){
                            $('#confirm').modal('hide');
                            if(next) next();
                        };
                        // показать модальное окно
                        $('#confirm').modal('show');
                    } else {
                        // предложить добавить данные в массив
                        confirm_message_text.innerHTML = "Форма об опыте работы содержит данные, добавить в массив для отправки?";
                        // текст левой кнопки
                        confirm_btn1.innerHTML = "Да";
                        // текст правой кнопки
                        confirm_btn2.innerHTML = "Нет";
                        // добавить данные в массив и продолжить
                        confirm_btn1.onclick = function(){

                            // добавить данные в массив для отправки
                            exp_array.push({
                                "exp_post" : fields_exp[0].value,
                                "exp_company" : fields_exp[1].value,
                                "exp_city" : fields_exp[2].value,
                                "work_period" : fields_exp[3].value,
                                "exp_func" : fields_exp[4].value,
                                "exp_industry" : form.elements["exp_industry"].value
                            });

                            $('#confirm').modal('hide');
                            if(next) next();
                        };

                        // не добавлять данные и продолжить
                        confirm_btn2.onclick = function(){
                            $('#confirm').modal('hide');
                            if(next) next();
                        };
                        // открыть модальное окно
                        $('#confirm').modal('show');
                    }
                } else {
                    if(next) next();
                }
            }
            
            else 
            // если нет массива с ОР
            if(exp_array.length == 0){
                
                // проверить поля на валидность
                for(var i = 0; i < fields_exp.length; i++){
                    var field = fields_exp[i];
                    exp_valid += validate_inputs(field);
                } 

                if(exp_valid !== 0){
                    modal_message_text.innerHTML = "Поля опыта работы заполнены неверно! Если у Вас нет опыта работы, укажите это в соответствующем разделе.";
                    $('#modal').modal('show');
                } else {
                    // добавить данные в массив для отправки
                    exp_array.push({
                        "exp_post" : fields_exp[0].value,
                        "exp_company" : fields_exp[1].value,
                        "exp_city" : fields_exp[2].value,
                        "work_period" : fields_exp[3].value,
                        "exp_func" : fields_exp[4].value,
                        "exp_industry" : form.elements["exp_industry"].value
                    });

                    if(next) next();
                }
            }
        
        } else {
            if(next) next();
        }
    }

    function validate_education(next){

        // счетчик валидности полей
        var edu_valid = 0;

        // если уже есть массив с ОР
        if(edu_array.length > 0) {
            
            // переменная для проверки пустоты формы ОР
            var empty = true;

            // если хоть одно поле заполнено
            for(var i = 0; i < fields_edu.length; i++){
                if(fields_edu[i].value !== ""){
                    empty = false;
                    break;
                }
            }  

            // если поля не пустые
            if(!empty){

                // проверить поля на валидность
                for(var i = 0; i < fields_edu.length; i++){
                    var field = fields_edu[i];
                    edu_valid += validate_inputs(field);
                } 

                // если поля заполнены некорректно
                if(edu_valid !== 0){
                    confirm_message_text.innerHTML = "Форма об образовании заполнена некорректно! Если вы хотите добавить эти данные для отправки, необходимо исправить ее, либо нажмите \"Не добавлять\"";
                    confirm_btn1.innerHTML = "Я хочу исправить";
                    confirm_btn2.innerHTML = "Не добавлять";
                    confirm_btn1.onclick = function(){
                        $('#confirm').modal('hide');
                    }
                    confirm_btn2.onclick = function(){
                        $('#confirm').modal('hide');
                        if(next) next();
                    };
                    $('#confirm').modal('show');
                } else {
                    // предложить добавить данные в массив
                    confirm_message_text.innerHTML = "Форма об образовании содержит данные, добавить в массив для отправки?";
                    confirm_btn1.innerHTML = "Да";
                    confirm_btn2.innerHTML = "Нет";
                    confirm_btn1.onclick = function(){

                        // добавить данные в массив для отправки
                        edu_array.push({
                            "edu_level" : form.elements["edu_level"].value,
                            "edu_inst" : fields_edu[0].value,
                            "edu_city" : fields_edu[1].value,
                            "edu_fac" : fields_edu[2].value,
                            "edu_period" : fields_edu[3].value
                        });

                        $('#confirm').modal('hide');
                        if(next) next();
                    };

                    confirm_btn2.onclick = function(){
                        $('#confirm').modal('hide');
                        if(next) next();
                    };
                    $('#confirm').modal('show');
                }
            } else {
                if(next) next();
            }
        }
        
        else 
        // если нет массива с ОР
        if(edu_array.length == 0){
            
            // проверить поля на валидность
            for(var i = 0; i < fields_edu.length; i++){
                var field = fields_edu[i];
                edu_valid += validate_inputs(field);
            } 

            if(edu_valid !== 0){
                modal_message_text.innerHTML = "Поля об образовании заполнены неверно!";
                $('#modal').modal('show');
            } else {
                
                // добавить данные в массив для отправки
                edu_array.push({
                    "edu_level" : form.elements["edu_level"].value,
                    "edu_inst" : fields_edu[0].value,
                    "edu_city" : fields_edu[1].value,
                    "edu_fac" : fields_edu[2].value,
                    "edu_period" : fields_edu[3].value
                });

                if(next) next();
            }
        }
    }

    function validate_primary_form(next){

        var valid = 0;

        for(var i = 0; i < fields.length; i++){
            var field = fields[i];
            if(fields_exp.indexOf(field) == -1 && fields_edu.indexOf(field) == -1){
                valid += validate_inputs(field);
            }
        } 

        if(valid !== 0){
            modal_message_text.innerHTML = "Форма заполнена неверно.";
            $('#modal').modal('show');
        } else {
            if(next) next();
        }
    }

})();