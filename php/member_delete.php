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

    include "dbconn.php"; 
    mysqli_query($connect, "set names utf8");

    $sql = "delete from member where id='$id'";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        session_unset();
        session_destroy();

        echo("
            <script>
                window.alert('회원 탈퇴가 완료되었습니다.\\n그동안 서울 바이닐을 이용해 주셔서 진심으로 감사합니다.');
                location.href = '../main.html'; /* 탈퇴 완료 후 홈으로 튕겨내기 */
            </script>
        ");
    } else {
        echo("
            <script>
                window.alert('탈퇴 처리 중 오류가 발생했습니다. 다시 시도해 주세요.');
                history.go(-1);
            </script>
        ");
    }

    mysqli_close($connect);
?>