<?php 
    if(isset($_SESSION['authorized'])){
        header("Location: /");
    }
?>