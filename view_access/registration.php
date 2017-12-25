<?php 
    if(isset($_SESSION['authorized'])){
        header("Location: /index.php");
    }
?>