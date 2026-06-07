<?php
    session_start();

    session_unset();

    session_destroy();

    echo("
        <script>
            alert('성공적으로 로그아웃 되었습니다. 안녕히가세요.');
            location.href = '../main.html'; 
        </script>
    ");
?>