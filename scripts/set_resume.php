<?php 
    try{
        // старт сессии
        session_start();

        // регулярные выражения для проверки валидности
        $regexp_name = '/^[A-ZА-ЯЁ]{1}[a-zа-яё\s?]{2,}$/ui';
        $regexp_phone = '/^\+[\d]{11}$/ui';
        $regexp_city = '/^[A-zА-яЁё\"-\s?]{4,}$/ui';
        $regexp_birth = '/^[\d]{2}\.[\d]{2}\.[\d]{4}$/ui';
        $regexp_email = '/(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ui';
        $regexp_sentence = '/^[A-zА-яЁё0-9\.,!:\\(\)#"-\s?]{4,}$/ui';
        $regexp_numbers = '/^[\d]{1,}$/ui';
        $regexp_work_period = '/^[A-zА-яЁё]{3,8}\s[\d]{4}\s\-\s[A-zА-яЁё]{3,8}\s[\d]{4}$/ui';
        $regexp_edu_period = '/^[\d]{4}\s\-\s[\d]{4}$/ui';
    
        // если нет необходимых переменных, выдать ошибку
        if(!$_POST['firstname']){
            http_response_code(400);
            exit("необходим firstname");
        }
        elseif(!$_POST['lastname']){
            http_response_code(400);
            exit("необходим lastname");
        }
        elseif(!$_POST['patronymic']){
            http_response_code(400);
            exit("необходим patronymic");
        }
        elseif(!$_POST['gender']){
            http_response_code(400);
            exit("необходим gender");
        }
        elseif(!$_POST['birthday']){
            http_response_code(400);
            exit("необходим birthday");
        }
        elseif(!$_POST['city']){
            http_response_code(400);
            exit("необходим city");
        }
        elseif(!$_POST['phone']){
            http_response_code(400);
            exit("необходим phone");
        }
        elseif(!$_POST['email']){
            http_response_code(400);
            exit("необходим email");
        }
        elseif(!$_POST['post']){
            http_response_code(400);
            exit("необходим post");
        }
        elseif(!$_POST['industry_id']){
            http_response_code(400);
            exit("необходим industry_id");
        }
        elseif(!$_POST['schedule_id']){
            http_response_code(400);
            exit("необходим schedule_id");
        }
        elseif(!$_POST['salary']){
            http_response_code(400);
            exit("необходим salary");
        }
        elseif(!$_POST['work_place_id']){
            http_response_code(400);
            exit("необходим work_place_id");
        }

        // проверка все входящих переменных на валидность п регулярному выражению
        elseif(!preg_match($regexp_name, $_POST['firstname'])){
            http_response_code(400);
            exit("Поле -firstname- заполнено некорректно!");
        }
        elseif(!preg_match($regexp_name, $_POST['lastname'])){
            http_response_code(400);
            exit("Поле -lastname- заполнено некорректно!");
        }
        elseif(!preg_match($regexp_name, $_POST['patronymic'])){
            http_response_code(400);
            exit("Поле -patronymic- заполнено некорректно!");
        }
        elseif(!preg_match($regexp_birth, $_POST['birthday'])){
            http_response_code(400);
            exit("Поле -birthday- заполнено некорректно!");
        }
        elseif(!preg_match($regexp_city, $_POST['city'])){
            http_response_code(400);
            exit("Поле -city- заполнено некорректно!");
        }
        elseif(!preg_match($regexp_phone, $_POST['phone'])){
            http_response_code(400);
            exit("Поле -phone- заполнено некорректно!");
        }
        elseif(!preg_match($regexp_email, $_POST['email'])){
            http_response_code(400);
            exit("Поле -email- заполнено некорректно!");
        }
        elseif(!preg_match($regexp_sentence, $_POST['post'])){
            http_response_code(400);
            exit("Поле -post- заполнено некорректно!");
        }
        elseif(!preg_match($regexp_numbers, $_POST['industry_id'])){
            http_response_code(400);
            exit("Поле -industry_id- заполнено некорректно!");
        }
        elseif(!preg_match($regexp_numbers, $_POST['schedule_id'])){
            http_response_code(400);
            exit("Поле -schedule_id- заполнено некорректно!");
        }
        elseif(!preg_match($regexp_numbers, $_POST['work_place_id'])){
            http_response_code(400);
            exit("Поле -work_place_id- заполнено некорректно!");
        }
        elseif(!preg_match($regexp_numbers, $_POST['salary'])){
            http_response_code(400);
            exit("Поле -salary- заполнено некорректно!");
        }
        elseif($_POST['gender'] != "Мужской" && $_POST['gender'] != "Женский"){
            http_response_code(400);
            exit("Поле -gender- заполнено некорректно!");
        }
        elseif(
                !empty($_POST['comp_skill_id']) && 
                !preg_match($regexp_numbers, $_POST['comp_skill_id'])
               ){
            http_response_code(400);
            exit("Поле -comp_skill_id- заполнено некорректно!");
        }
        elseif(
                !empty($_POST['car']) && 
                ($_POST['car'] != "Да" && $_POST['car'] != "Нет")
               ){
            http_response_code(400);
            exit("Поле -car- заполнено некорректно!");
        }
        elseif(
                !empty($_POST['courses']) && 
                !preg_match($regexp_sentence, $_POST['courses'])
               ){
            http_response_code(400);
            exit("Поле -courses- заполнено некорректно!");
        }
        elseif(
                !empty($_POST['skills']) && 
                !preg_match($regexp_sentence, $_POST['skills'])
               ){
            http_response_code(400);
            exit("Поле -skills- заполнено некорректно!");
        }

        // преобразование спецсимволов
        $user_id = $_SESSION['id'];        
        $firstname = htmlspecialchars(trim($_POST['firstname']));
        $lastname = htmlspecialchars(trim($_POST['lastname']));
        $patronymic = htmlspecialchars(trim($_POST['patronymic']));
        $gender = htmlspecialchars(trim($_POST['gender']));
        $birthday = htmlspecialchars(trim($_POST['birthday']));
        $city = htmlspecialchars(trim($_POST['city']));
        $phone = htmlspecialchars(trim($_POST['phone']));
        $email = htmlspecialchars(trim($_POST['email']));
        $post = htmlspecialchars(trim($_POST['post']));
        $industry_id = htmlspecialchars(trim($_POST['industry_id']));
        $schedule_id = htmlspecialchars(trim($_POST['schedule_id']));
        $salary = htmlspecialchars(trim($_POST['salary']));
        $work_place_id = htmlspecialchars(trim($_POST['work_place_id']));
        $comp_skill_id = (!empty($_POST['comp_skill_id'])) ? htmlspecialchars(trim($_POST['comp_skill_id'])) : "";
        $car = (!empty($_POST['car'])) ? htmlspecialchars(trim($_POST['car'])) : "";
        $courses = (!empty($_POST['courses'])) ? htmlspecialchars(trim($_POST['courses'])) : "";
        $skills = (!empty($_POST['skills'])) ? htmlspecialchars(trim($_POST['skills'])) : "";

        // подключение к БД, если все проверки были успешно пройдены
        include('db_connection.php');
        
        // сохранить файл, если добавлен аватар
        if($_FILES["avatar"]){
            // выдать ошибку, если размер более 3 мб.
            if($_FILES["avatar"]["size"] > 1024*3*1024){
                http_response_code(400);
                exit("Размер файла не должен превышать 3 мегабайта");
            }
            
            // директория для сохранения аватарок
            $basedir = "../images/avatar/";

            // генерация случайного имени файла
            $dot = strpos($_FILES["avatar"]["name"], ".");
            $ext = substr($_FILES["avatar"]["name"], $dot);
            $filename = md5($_FILES["avatar"]["name"]).$ext;

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
            
            // добавление записи с аватаром в БД
            $query = $db->prepare("INSERT INTO user_avatar(user_id, source) VALUES (?, ?)");
            $values = ['source' => $_FILES['img']['name']];
            $query->execute(array(
                $user_id,
                "images/avatar/".$filename
            ));
        }

        // подготовка запроса на добавление основных данных
        $query = $db->prepare("INSERT INTO resumes
            (
                user_id, firstname, lastname, patronymic,
                gender, birthday, city, phone, email, post,
                industry_id, schedule_id, salary, work_place_id, 
                comp_skill_id, car, courses, skills
            ) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
        // выполнение запроса
        $query->execute(array(
            $user_id, $firstname, $lastname, $patronymic,
            $gender, $birthday, $city, $phone, $email, $post, $industry_id,
            $schedule_id, $salary, $work_place_id, $comp_skill_id, $car, $courses, $skills
        ));

        $error = $query->errorInfo();

        // проверка произошла ли ошибка при выполнении запроса 
        if($error && $error[0] != 00000){
            http_response_code(400);
            exit($error);
        } else {
            echo "Запись добавлена успешно!";
        }

    } catch (Exception $e) {
        echo $e->getMessage(); 
    }