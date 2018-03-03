export class Resume{
    
    static init(){
           
        // не выполнять код, если это не главная страница резюме
        if(window.location.pathname !== "/resume"){
            return;
        }

        var url_resume= 'api/1.0.0/resume';
        
        // кнопка удаления резюме
        var delete_resume_button : HTMLButtonElement = document.getElementById("delete_resume") as HTMLButtonElement;
        // кнопки закрытия модального окна
        var btn_close = document.querySelectorAll(".btn-close");
        // текст модального окна
        var modal_message_text = document.querySelector("#modal .modal-body p");
        // текст модального окна confirm
        var confirm_message_text = document.querySelector("#confirm .modal-body p");
        // 1 кнопка окна confirm
        var confirm_btn1 : HTMLButtonElement = document.querySelector("#confirm .option1");
        // 2 кнопка окна confirm
        var confirm_btn2 : HTMLButtonElement = document.querySelector("#confirm .option2");

        if(!delete_resume_button){
            return;
        }

        delete_resume_button.onclick = function(e){
            e.preventDefault();

            // предложить добавить данные в массив
            confirm_message_text.innerHTML = "Вы уверены?";
            // текст левой кнопки
            confirm_btn1.innerHTML = "Да";
            // текст правой кнопки
            confirm_btn2.innerHTML = "Нет";
            // добавить данные в массив и продолжить
            confirm_btn1.onclick = function(){

                // новый объект
                var xhr = new XMLHttpRequest();
            
                // отправка запроса
                xhr.open("DELETE", url_resume, true);
                xhr.send();        
        
                // заблокировать кнопку
                delete_resume_button.disabled = true;
                delete_resume_button.classList.add("disabled");
                delete_resume_button.style.pointerEvents = "auto";
                delete_resume_button.innerHTML = "Удаление <i class=\"fas fa-spinner fa-pulse\"></i>";
        
                // отправка запроса и отслеживание состояния 
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4){
                        if (xhr.status == 200) {
                            // если запрос выполнен успешно
                            modal_message_text.innerHTML = "Данные успешно удалены!";
                            $('#modal').modal('show');

                            delete_resume_button.innerHTML = "Резюме удалено";
        
                            // перезагрузить страницу при закрытии модального окна
                            for(var i = 0; i < btn_close.length; i++){
                                var btn = btn_close[i];
                                (btn as HTMLButtonElement).onclick = function(){
                                    window.location.reload();
                                }
                            }
        
                        } else {
                            // если запрос выполнен с ошибкой
                            modal_message_text.innerHTML = xhr.status + " : " + xhr.responseText;
                            $('#modal').modal('show');
        
                            // разблокировать кнопку
                            delete_resume_button.disabled = false;
                            delete_resume_button.classList.remove("disabled");
                            delete_resume_button.style.cursor = "pointer";
                            delete_resume_button.innerHTML = "Удалить резюме";
                        }
                    }
                }

                $('#confirm').modal('hide');
            };

            // не добавлять данные и продолжить
            confirm_btn2.onclick = function(){
                $('#confirm').modal('hide');
            };

            // показать модальное окно
            $('#confirm').modal('show');
        }

    }
}