<?php

if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['id'])){
    print "<script>alert('Voce precisa estar logado!!!');</script>";
    print "<script>location.href='areaLogin.php';</script>";
}

?>