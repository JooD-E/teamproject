<?php
    session_start();

    if (!isset($_SESSION['userid'])) {
        echo("
            <script>
                alert('비정상적인 접근입니다.');
                location.href = 'seoulvinyl_login.php';
            </script>
        ");
        exit;
    }

    $id = $_SESSION['userid']; 

    $pass   = $_POST['pass'];
    $name   = $_POST['name'];
    $hp     = $_POST['hp'];
    $addr   = $_POST['addr'];
    
    $email1 = $_POST['email1'];
    $email2 = $_POST['email2'];
    $email  = $email1 . "@" . $email2;

    include "dbconn.php"; 
    mysqli_query($connect, "set names utf8");

    $sql = "update member set pass='$pass', name='$name', hp='$hp', email='$email', addr='$addr' ";
    $sql .= "where id='$id'";

    $result = mysqli_query($connect, $sql);

    if ($result) {
        if(isset($_SESSION['username'])) {
            $_SESSION['username'] = $name;
        }

        echo("
            <script>
                window.alert('회원정보가 성공적으로 수정되었습니다.');
                location.href = 'mypage.php';
            </script>
        ");
    } else {
        echo("
            <script>
                window.alert('정보 수정 중 오류가 발생했습니다. 다시 시도해 주세요.');
                history.go(-1);
            </script>
        ");
    }

    mysqli_close($connect);
?>