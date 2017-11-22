<?php 
    try{
        session_start();
        $db = new PDO('mysql:host=localhost;dbname=job;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));
    
        $query = $db->query("SELECT * FROM `users` WHERE email='".$email."' LIMIT 1");
        $data = $query->fetch(PDO::FETCH_ASSOC);   
    
        if ($data) {
            if(password_verify($password,$data['password'])){
                $_SESSION['authorized'] = true;
                $_SESSION['id'] = $data['id'];
                $_SESSION['firstname'] = $data['firstname'];
                $_SESSION['lastname'] = $data['lastname'];
                $_SESSION['type'] = $data['type'];
                header("Location: /index.php");
            } else {
                http_response_code(400);
                exit("Неверный пароль");
            }
        } else {
                http_response_code(400);
                exit("Логин не найден");
        }
    } catch (Exception $e) {
        echo $e->getMessage(); 
    }
