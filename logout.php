<?php   
    session_start();
    session_destroy(); 
    header("location: registrationform.html");
    exit();
?>
