<?php
    $userId = $_POST['userId'];
    $userPw = $_POST['userPw'];

    if(!$userId) {
        echo("
           <script>
             window.alert('아이디를 입력해 주세요.');
             history.go(-1); // 이전 페이지로 돌려보내기
           </script>
         ");
        exit;
    }
    if(!$userPw) {
        echo("
           <script>
             window.alert('비밀번호를 입력해 주세요.');
             history.go(-1);
           </script>
         ");
        exit;
    }

    include "dbconn.php"; 

    $sql = "SELECT * FROM member WHERE id='$userId'";
    $result = mysqli_query($connect, $sql);
    
    $num_match = mysqli_num_rows($result);

    if(!$num_match) {
        echo("
           <script>
             window.alert('등록되지 않은 아이디입니다.');
             history.go(-1);
           </script>
         ");
    } else {
        $row = mysqli_fetch_array($result);
        
        $db_pass = $row['pass'];

        if($userPw != $db_pass) {
            echo("
               <script>
                 window.alert('비밀번호가 틀립니다.');
                 history.go(-1);
               </script>
             ");
            exit;
        } else {
            session_start();
            $_SESSION['userid'] = $row['id'];
            $_SESSION['username'] = $row['name'];

            echo("
               <script>
                 location.href = '../main.html';
               </script>
             ");
        }
    }
    
    mysqli_close($connect);
?>