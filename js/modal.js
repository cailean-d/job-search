(function(){
    
    var modal_button = document.getElementById("show_modal_login");
    var modal = document.querySelector(".modal_login");
    var show_login = document.getElementById("show_login");
    var name = document.querySelector(".name");
    var logout = document.querySelector(".logout");
    
    
    if(modal_button != null){
        modal_button.onclick = function(){
            modal.style.display = "flex";
        }
        
        modal.onclick = function(e){
            if(e.target.className == "modal_login"){
                modal.style.display = "none";
            }
        }
        
        window.onkeydown = function(e){
            if(e.keyCode == 27){
                modal.style.display = "none";
            }
        }
        
        if(show_login){
            show_login.onclick = function(e){
                e.preventDefault();
                modal.style.display = "flex";
            }
        }
    }
    
    if(name != null){
        var isOpen = false;
        
        document.querySelector(".name .dd").onclick = function(e){
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
        
})();