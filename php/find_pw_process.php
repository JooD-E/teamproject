<?php
    $id   = $_POST['id'];
    $name = $_POST['name'];
    $hp   = $_POST['hp'];

    include "dbconn.php"; 
    mysqli_query($connect, "set names utf8");

    $sql = "select * from member where id='$id' and name='$name' and hp='$hp'";
    $result = mysqli_query($connect, $sql);
    
    // 4. 검색 결과 확인
    $num_match = mysqli_num_rows($result);

    if (!$num_match) {
        echo("
            <script>
                window.alert('등록된 정보가 없습니다.\\n아이디, 이름, 휴대폰 번호를 다시 확인해 주세요.');
                history.go(-1);
            </script>
        ");
    } else {
        $row = mysqli_fetch_array($result);
        $found_pw = $row['pass'];

        echo("
            <script>
                window.alert('회원님의 비밀번호는 [ {$found_pw} ] 입니다.');
                location.href = 'seoulvinyl_login.php';
            </script>
        ");
    }

    mysqli_close($connect);
?>