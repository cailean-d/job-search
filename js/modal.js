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
        
})();