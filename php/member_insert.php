<?php
    $id    = $_POST['id'];
    $pass  = $_POST['pass'];
    $name  = $_POST['name'];
    $hp    = $_POST['hp'];
    $email1 = $_POST['email1'];
    $email2 = $_POST['email2'];
    $addr  = $_POST['addr'];

    include "dbconn.php"; 

    mysqli_query($connect, "set names utf8");

    $sql_check = "select * from member where id='$id'";
    $result_check = mysqli_query($connect, $sql_check);
    $num_record = mysqli_num_rows($result_check);
    $regist_day = date("y.m.d");

    if ($num_record) {
        echo("
            <script>
                window.alert('이미 존재하는 아이디입니다.');
                history.go(-1);
            </script>
        ");
        exit;
    }

    $sql = "INSERT INTO member (id, pass, name, hp, addr, email, regist_day) ";
    $sql .= "VALUES ('$id', '$pass', '$name', '$hp', '$addr', '$email', '$regist_day')";

    $result = mysqli_query($connect, $sql);

    if ($result) {
        echo("
            <script>
                window.alert('서울 바이닐의 회원이 되신 것을 환영합니다!');
                location.href = 'seoulvinyl_login.php'; 
            </script>
        ");
    } else {
        // 혹시 모를 DB 에러 발생 시
        echo("
            <script>
                window.alert('회원가입 처리 중 오류가 발생했습니다. 다시 시도해 주세요.');
                history.go(-1);
            </script>
        ");
    }

    // DB 연결 종료
    mysqli_close($connect);
?>