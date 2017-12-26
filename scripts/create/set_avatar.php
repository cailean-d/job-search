<?php 
    try{
        // старт сессии
        session_start();
    
        // если нет необходимых переменных, выдать ошибку
        if(!$_FILES["avatar"]){
            http_response_code(400);
            exit("необходим avatar");
        }

        // подключение к БД, если все проверки были успешно пройдены
        include(realpath("../db_connection.php"));

        // сохранить файл, если добавлен аватар
        if($_FILES["avatar"]){
            // выдать ошибку, если размер более 3 мб.
            if($_FILES["avatar"]["size"] > 1024*3*1024){
                http_response_code(400);
                exit("Размер файла не должен превышать 3 мегабайта");
            }
            
            // директория для сохранения аватарок
            $basedir = "../../images/avatar/";

            // генерация случайного имени файла
            $dot = strpos($_FILES["avatar"]["name"], ".");
            $ext = substr($_FILES["avatar"]["name"], $dot);
            $filename = uniqid().$ext;

            // перемещение файла из временной папки в основную
            if(is_uploaded_file($_FILES["avatar"]["tmp_name"])){
                try{
                    move_uploaded_file($_FILES["avatar"]["tmp_name"], $basedir.$filename);
                } catch (Exception $e) {
                    echo $e->getMessage(); 
                }
        
            } else {
                http_response_code(400);
                exit("Ошибка загрузки файла");
            }

            
            $sql_avatar = "SELECT * FROM user_avatar WHERE user_id = " . $_SESSION['id'];
            $avatar_data = $db->query($sql_avatar);
            $avatar_data = $avatar_data->fetch();

            if(count($avatar_data) > 0){
                $query = $db->prepare("UPDATE user_avatar SET source = ? WHERE user_id = ?");
                $values = ['source' => $_FILES['img']['name']];
                $query->execute(["images/avatar/".$filename, $_SESSION['id']]);
            } else {
                $query = $db->prepare("INSERT INTO user_avatar(user_id, source) VALUES (?, ?)");
                $values = ['source' => $_FILES['img']['name']];
                $query->execute([$_SESSION['id'],"images/avatar/".$filename]);
            }

        }


    } catch (Exception $e) {
        echo $e->getMessage(); 
    }