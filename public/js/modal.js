(function(){

    var name = document.querySelector("#header .name");
    var logout = document.querySelector("#header .logout");
    
    if(name != null){
        var isOpen = false;
        
        document.querySelector("#header .name .dd").onclick = function(e){
        e.preventDefault();
                if(isOpen){
                    logout.style.display = "none";
                    isOpen = false;
                    document.querySelector(".name > a").classList.remove("menu-active");
                } else {
                    logout.style.display = "block";
                    isOpen = true;
                    document.querySelector(".name > a").classList.add("menu-active");
                }
        }
    
        logout.onclick = function(e){
            var xhr = new XMLHttpRequest();
            xhr.open('POST', "scripts/logout.php");
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
        var input = document.getElementById("avatar_upload");
        var temp_img, preload = document.getElementById("avatar_preload");
        var confirm_message_text = document.querySelector("#confirm .modal-body p");
        var modal_message_text = document.querySelector("#modal .modal-body p");
        var confirm_btn1 = document.querySelector("#confirm .option1");
        var confirm_btn2 = document.querySelector("#confirm .option2");

        input.onchange = function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.readAsDataURL(this.files[0]);
                reader.onload = function (e) {
                    temp_img = preload.src;
                    preload.src = e.target.result;

                    confirm_message_text.innerHTML = "Изменить аватар?";
                    confirm_btn1.innerHTML = "Да";
                    confirm_btn2.innerHTML = "Нет";
                    confirm_btn1.onclick = function(){

                        var btn = this;
                        var data = new FormData();
                        data.append('avatar', input.files[0], 'avatar.jpg');

                        var xhr = new XMLHttpRequest();
                
                        xhr.open('POST', "scripts/create/set_avatar.php");
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
        
})();