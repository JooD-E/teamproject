<?php
    $name = $_POST['name'];
    $hp   = $_POST['hp'];

    include "dbconn.php";

    mysqli_query($connect, "set names utf8");

    $sql = "select * from member where name='$name' and hp ='$hp'";
    $result = mysqli_query($connect, $sql);

    $num_match = mysqli_query($connect, $sql);

    if(!$num_match) {
        echo("
            <script>
                window.alert('등록된 정보가 없습니다.\\n이름과 휴대폰 번호를 다시 확인해 주세요.');
                history.go(-1); 
            </script>
        ");
    } else {
        $row = mysqli_fetch_array($result);
        $found_id = $row['id'];

        echo("
            <script>
                window.alert('회원님의 아이디는 [ {$found_id} ] 입니다.');
                location.href = 'seoulvinyl_login.php';
            </script>
        ");
    }

    mysqli_close($connect);
?>