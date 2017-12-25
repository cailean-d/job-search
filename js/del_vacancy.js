(function(){

    if(!document.querySelector(".vacancyz")){
        return;
    }

    var del_buttons = document.querySelectorAll(".vacancyz .del");
    var modal_message_text = document.querySelector("#modal .modal-body p");

    for(var i = 0; i < del_buttons.length; i++){
        var btn = del_buttons[i];
        btn.onclick = function(e){
            e.preventDefault();
            var parent = this.parentNode.parentNode;
            var id = parent.querySelector(".id").innerHTML;
            var data = "id=" + id;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', "scripts/delete/del_vacancy.php");
            xhr.setRequestHeader('Content-Type', "application/x-www-form-urlencoded");
            xhr.send(data);

            this.disabled = true;
            this.classList.add("disabled");
            this.style.pointerEvents = "auto";
            this.innerHTML = "Удаление записи...";

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4){
                    if (xhr.status == 200) {
        
                        modal_message_text.innerHTML = "Запись успешно удалена!";
                        $('#modal').modal('show');

                        $(parent).fadeOut(1000, function() {
                            parent.parentNode.removeChild(parent);
                         });
        
                    } else {
                        modal_message_text.innerHTML = xhr.status + ': ' + xhr.statusText + ", " + xhr.responseText;
                        $('#modal').modal('show');
        
                        this.disabled = false;
                        this.classList.remove("disabled");
                        this.innerHTML = "Удалить";
                    }
                } 
            }
        }
    }

})();