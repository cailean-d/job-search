import "./../style/index.scss"; 
import "./../../__common/lib/script/bootstrap.min.js";
import "./../../__common/lib/script/fontawesome-all.min.js";


history.pushState(null, document.title, location.protocol + '//' + location.hostname + location.pathname);


var confirm = document.getElementById('confirm_button');
var textarea: any = document.getElementById('textarea');
var del_btn = document.querySelectorAll('.del');
var public_btn = document.querySelectorAll('.public');
var vacancy_id: any, vacancy_block: any;

for(let i = 0; i < del_btn.length; i++){
    let element: any = del_btn[i];
    element.onclick = function (e: any) {
        vacancy_block = e.target.parentNode.parentNode;
        vacancy_id = vacancy_block.querySelector('.id').innerHTML;
    }
}

for(let i = 0; i < public_btn.length; i++){
    let element: any = public_btn[i];
    element.onclick = function (e: any) {
        vacancy_block = e.target.parentNode.parentNode;
        vacancy_id = vacancy_block.querySelector('.id').innerHTML;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '?public=true&id=' + vacancy_id);
        xhr.send();
        xhr.onload = () => {
            
            if (xhr.readyState == 4 && xhr.status == 200) {
                    
                vacancy_block.parentNode.removeChild(vacancy_block);

            } else {
                alert(xhr.status + " : " + xhr.responseText);
            }

        }

    }
}

confirm.onclick = function () {
    var val = textarea.value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '?mistake=true&id=' + vacancy_id + '&message=' + val);
    xhr.send();

    xhr.onload = () => {
        
        if (xhr.readyState == 4 && xhr.status == 200) {
                
            vacancy_block.parentNode.removeChild(vacancy_block);

        } else {
            alert(xhr.status + " : " + xhr.responseText);
        }

    }

    textarea.value = null;
}