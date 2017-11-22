<?php 
    try{
        session_start();
        $db = new PDO('mysql:host=localhost;dbname=job;charset=utf8', 'root', '');

        $regexp_email = '/(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ui';
        $regexp_name = '/^[A-ZА-ЯЁ]{1}[a-zа-яё\s?]{2,}$/ui';
    
        if(!$_POST['firstname']){
            http_response_code(400);
            exit("необходим firstname");
        }
        if(!$_POST['lastname']){
            http_response_code(400);
            exit("необходим lastname");
        }
        if(!$_POST['email']){
            http_response_code(400);
            exit("необходим email");
        }
        if(!$_POST['password']){
            http_response_code(400);
            exit("необходим password");
        }
        if(!$_POST['type']){
            http_response_code(400);
            exit("необходим type");
        }

        if($_POST['password'] != $_POST['password2']){
            http_response_code(400);
            exit("пароли не совпадают");
        }

        if(!preg_match($regexp_name, $_POST['firstname'])){
            http_response_code(400);
            exit("Поле -firstname- заполнено некорректно!");
        }

        if(!preg_match($regexp_name, $_POST['lastname'])){
            http_response_code(400);
            exit("Поле -lastname- заполнено некорректно!");
        }

        if(!preg_match($regexp_email, $_POST['email'])){
            http_response_code(400);
            exit("Поле -email- заполнено некорректно!");
        }

        if($_POST['type'] != '0' && $_POST['type'] != '1'){
            http_response_code(400);
            exit("Поле -type- заполнено некорректно!");
        }

        $firstname = htmlspecialchars(trim($_POST['firstname']));
        $lastname = htmlspecialchars(trim($_POST['lastname']));
        $email = htmlspecialchars(trim($_POST['email']));
        $type = htmlspecialchars(trim($_POST['type']));
        $password = password_hash(htmlspecialchars(trim($_POST['password'])), PASSWORD_DEFAULT);
        
        $result = $db->query("SELECT * FROM `users` WHERE `email` ='".$email."' LIMIT 1");
        $data = $result->fetch(PDO::FETCH_ASSOC);

        if($email == $data['email']) { 
            http_response_code(400);
            exit("Email уже существует!");
        }
        
        $query = $db->prepare("INSERT INTO users(email, firstname, lastname, type, password) VALUES (:email, :firstname, :lastname, :type, :password)");
        $values = [
            'email' => $email, 
            'firstname' => $firstname, 
            'lastname' => $lastname,
            'type' => $type, 
            'password' => $password
        ];

        $query->execute($values);

        $error = $query->errorInfo();
        
        if($error && $error[0] != 00000){
            var_dump($error);
        } else {
            $_SESSION['authorized'] = true;
            $_SESSION['id'] = $db->lastInsertId(); 
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['type'] = $type;
            echo "Вы зарегистрированы!";
        }
    } catch (Exception $e) {
        echo $e->getMessage(); 
    }