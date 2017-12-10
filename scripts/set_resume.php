<?php 
    try{
        session_start();
        include('db_connection.php');
    
        if(!$_POST['firstname']){
            http_response_code(400);
            exit("необходим firstname");
        }
        if(!$_POST['lastname']){
            http_response_code(400);
            exit("необходим lastname");
        }
        if(!$_POST['patronymic']){
            http_response_code(400);
            exit("необходим patronymic");
        }
        if(!$_POST['gender']){
            http_response_code(400);
            exit("необходим gender");
        }
        if(!$_POST['birthday']){
            http_response_code(400);
            exit("необходим birthday");
        }
        if(!$_POST['city']){
            http_response_code(400);
            exit("необходим city");
        }
        if(!$_POST['phone']){
            http_response_code(400);
            exit("необходим phone");
        }
        if(!$_POST['email']){
            http_response_code(400);
            exit("необходим email");
        }
        if(!$_POST['post']){
            http_response_code(400);
            exit("необходим post");
        }
        if(!$_POST['industry_id']){
            http_response_code(400);
            exit("необходим industry_id");
        }
        if(!$_POST['schedule_id']){
            http_response_code(400);
            exit("необходим schedule_id");
        }
        if(!$_POST['salary']){
            http_response_code(400);
            exit("необходим salary");
        }
        if(!$_POST['work_place_id']){
            http_response_code(400);
            exit("необходим salary");
        }

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

        
        if($_FILES["avatar"]){
            if($_FILES["avatar"]["size"] > 1024*3*1024){
                http_response_code(400);
                exit("Размер файла не должен превышать 3 мегабайта");
            }

            $basedir = "../images/avatar/";

            $dot = strpos($_FILES["avatar"]["name"], ".");
            $ext = substr($_FILES["avatar"]["name"], $dot);
            $filename = md5($_FILES["avatar"]["name"]).$ext;

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
            
            $query = $db->prepare("INSERT INTO user_avatar(user_id, source) VALUES (?, ?)");
            $values = ['source' => $_FILES['img']['name']];
            $query->execute(array(
                $user_id,
                "images/avatar/".$filename
            ));
        }

        $query = $db->prepare("INSERT INTO resumes
            (
                user_id, firstname, lastname, patronymic,
                gender, birthday, city, phone, email, post,
                industry_id, schedule_id, salary, work_place_id, 
                comp_skill_id, car, courses, skills
            ) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            

        $query->execute(array(
            $user_id, $firstname, $lastname, $patronymic,
            $gender, $birthday, $city, $phone, $email, $post, $industry_id,
            $schedule_id, $salary, $work_place_id, $comp_skill_id, $car, $courses, $skills
        ));

        $error = $query->errorInfo();

        if($error && $error[0] != 00000){
            http_response_code(400);
            exit($error);
        } else {
            echo "Запись добавлена успешно!";
        }

    } catch (Exception $e) {
        echo $e->getMessage(); 
    }