<?php
    //Mantendo a Sessão ou puxar a sessão
    session_start();
    //Finalizando a sessão
    session_destroy(); 
    //session_unset — Libera todas as variáveis de sessão
    session_unset(); 
 
        echo "<script>top.location.href='login.php';</script>";   
?>,