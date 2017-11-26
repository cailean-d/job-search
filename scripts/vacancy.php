<?php 
    try{
        session_start();
        include('get_vacancies.php');

        $REGEXP_email = '/(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ui';
        $REGEXP_phone = '/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/ui';
        $REGEXP_exp = '/(^\d+[-]*\d+$)|(^\d+$)/ui';
        $REGEXP_company = '/^[A-zА-яЁё\"\s?]{5,}$/ui';
        $REGEXP_sentence = '/^[A-zА-яЁё0-9\\-\\.\\!\"\s?]{5,}$/ui';
        $REGEXP_city = '/^[A-zА-яЁё\-\"\s?]{4,}$/ui';
    
        if(!$_POST['company']){
            http_response_code(400);
            exit("необходим company");
        }
        if(!$_POST['phone']){
            http_response_code(400);
            exit("необходим phone");
        }
        if(!$_POST['vacancy']){
            http_response_code(400);
            exit("необходим vacancy");
        }
        if(!$_POST['salary']){
            http_response_code(400);
            exit("необходим salary");
        }
        if(!$_POST['exp']){
            http_response_code(400);
            exit("необходим exp");
        }
        if(!$_POST['location']){
            http_response_code(400);
            exit("необходим location");
        }
        if(!$_POST['schedule']){
            http_response_code(400);
            exit("необходим employment");
        }
        if(!$_POST['industry']){
            http_response_code(400);
            exit("необходим industry");
        }
        if(!$_POST['demands']){
            http_response_code(400);
            exit("необходим demands");
        }
        if(!$_POST['duties']){
            http_response_code(400);
            exit("необходим duties");
        }
        if(!$_POST['conditions']){
            http_response_code(400);
            exit("необходим conditions");
        }
        if(!$_POST['email']){
            http_response_code(400);
            exit("необходим email");
        }
        
        if(!preg_match($REGEXP_company, $_POST['company'])){
            http_response_code(400);
            exit("Поле -company- заполнено некорректно!");
        }
        if(!preg_match($REGEXP_phone, $_POST['phone'])){
            http_response_code(400);
            exit("Поле -phone- заполнено некорректно!");
        }
        if(!preg_match($REGEXP_company, $_POST['vacancy'])){
            http_response_code(400);
            exit("Поле -vacancy- заполнено некорректно!");
        }
        if(!preg_match($REGEXP_exp, $_POST['salary'])){
            http_response_code(400);
            exit("Поле -salary- заполнено некорректно!");
        }
        if(!preg_match($REGEXP_exp, $_POST['exp'])){
            http_response_code(400);
            exit("Поле -exp- заполнено некорректно!");
        }
        if(!preg_match($REGEXP_city, $_POST['location'])){
            http_response_code(400);
            exit("Поле -location- заполнено некорректно!");
        }
        if(isset($_POST['desc']) && !preg_match($REGEXP_company, $_POST['desc'])){
            http_response_code(400);
            exit("Поле -desc- заполнено некорректно!");
        }

        $company = htmlspecialchars(trim($_POST['company']));
        $phone = htmlspecialchars(trim($_POST['phone']));
        $vacancy = htmlspecialchars(trim($_POST['vacancy']));
        $salary = explode("-",htmlspecialchars(trim($_POST['salary'])));
        $salary_min = $salary[0];
        $salary_max = (isset($salary[1])) ? $salary[1] : '';
        $exp = htmlspecialchars(trim($_POST['exp']));
        $location = htmlspecialchars(trim($_POST['location']));
        $schedule = htmlspecialchars(trim($_POST['schedule']));
        $industry = htmlspecialchars(trim($_POST['industry']));
        $desc = (isset($_POST['desc'])) ? htmlspecialchars(trim($_POST['desc'])) : '';
        $demands = htmlspecialchars(trim($_POST['demands']));
        $duties = htmlspecialchars(trim($_POST['duties']));
        $conditions = htmlspecialchars(trim($_POST['conditions']));
        $sender_name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
        $sender_id = $_SESSION['id'];
        $email = $_POST['email'];

        $query = $db->prepare("INSERT INTO 
            vacancies(
                sender_name, sender_id, company, 
                phone, vacancy, 
                salary_min, salary_max, exp, 
                location, schedule, 
                industry, description,
                demands, duties, conditions, email
            ) 
            VALUES (
                :sender_name, :sender_id, :company, 
                :phone, :vacancy, 
                :salary_min, :salary_max, :exp, 
                :location, :schedule, 
                :industry, :description,
                :demands, :duties, :conditions, :email
            )");
            
        $values = [
            'sender_name' => $sender_name, 
            'sender_id' => $sender_id, 
            'company' => $company, 
            'phone' => $phone,
            'vacancy' => $vacancy,
            'salary_min' => $salary_min, 
            'salary_max' => $salary_max, 
            'exp' => $exp, 
            'location' => $location,
            'schedule' => $schedule,
            'industry' => $industry, 
            'description' => $desc,
            'demands' => $demands,
            'duties' => $duties,
            'conditions' => $conditions,
            'email' => $email
        ];

        $query->execute($values);

        $error = $query->errorInfo();

        if($error && $error[0] != 00000){
            http_response_code(400);
            echo $error;
        } else {
            echo "Вакансия отправлена на обработку!";
        }

    } catch (Exception $e) {
        echo $e->getMessage(); 
    }