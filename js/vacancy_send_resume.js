(send_resume = function(){

    if(!document.getElementById("send_resume")){
        return;
    }

    var modal_message_text = document.querySelector("#modal .modal-body p");
    var id = document.querySelector(".vacancy_id").innerHTML.trim();

    document.getElementById("send_resume").onclick = function(e){
        e.preventDefault();

        var that = this;

        var xhr = new XMLHttpRequest();
        
        // отправка запроса
        xhr.open("POST", "scripts/create/set_vacancy_resume.php", true);
        xhr.setRequestHeader('Content-Type', "application/x-www-form-urlencoded");
        xhr.send("id=" + id);    

        // заблокировать кнопку
        this.disabled = true;
        this.classList.add("disabled");
        this.style.pointerEvents = "auto";
        this.innerHTML = "Отправка данных...";

        // отправка запроса и отслеживание состояния 
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4){
                if (xhr.status == 200) {
                    // если запрос выполнен успешно
                    modal_message_text.innerHTML = "Резюме успешно отправлено!";
                    $('#modal').modal('show');

                    document.querySelector(".footer").innerHTML = '<div class="alert alert-info" role="alert"><strong>Ваше резюме отправлено</strong></div><button class="btn btn-primary btn-lg btn-block hand" id="del_resume">Удалить резюме</button>';

                    del_resume();

                } else {
                    // если запрос выполнен с ошибкой
                    modal_message_text.innerHTML = xhr.status + " : " + xhr.responseText;
                    $('#modal').modal('show');

                    // разблокировать кнопку
                    that.disabled = false;
                    that.classList.remove("disabled");
                    that.innerHTML = "Отправить резюме";
                }
            }
        }
    }

})();


(del_resume = function(){

    if(!document.getElementById("del_resume")){
        return;
    }

    var modal_message_text = document.querySelector("#modal .modal-body p");
    var id = document.querySelector(".vacancy_id").innerHTML.trim();
    

    document.getElementById("del_resume").onclick = function(e){
        e.preventDefault();

        var that = this;

        var xhr = new XMLHttpRequest();
        
        // отправка запроса
        xhr.open("POST", "scripts/delete/del_vacancy_resume.php", true);
        xhr.setRequestHeader('Content-Type', "application/x-www-form-urlencoded");
        xhr.send("id=" + id);    
        // заблокировать кнопку
        this.disabled = true;
        this.classList.add("disabled");
        this.style.pointerEvents = "auto";
        this.innerHTML = "Удаление данных...";

        // отправка запроса и отслеживание состояния 
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4){
                if (xhr.status == 200) {
                    // если запрос выполнен успешно
                    modal_message_text.innerHTML = "Резюме успешно удалено!";
                    $('#modal').modal('show');

                    document.querySelector(".footer").innerHTML = '<button class="btn btn-primary btn-lg btn-block hand" id="send_resume">Отправить резюме</button>';

                    send_resume();

                } else {
                    // если запрос выполнен с ошибкой
                    modal_message_text.innerHTML = xhr.status + " : " + xhr.responseText;
                    $('#modal').modal('show');

                    // разблокировать кнопку
                    that.disabled = false;
                    that.classList.remove("disabled");
                    that.innerHTML = "Удалить резюме";
                }
            }
        }
    }

})();