<?php
    session_start();
    $userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";

    if(!$userid){
        echo "
            <script>
            alert('로그인 후 이용해 주세요.');
            history.go(-1);
            </script>
        ";
        exit;
    }

    include "dbconn.php";
    mysqli_query($connect, "set names utf8");

    $num = $_GET["num"];
    $page = $_GET["page"];

    $sql = "SELECT thum FROM board WHERE num = $num";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
    $thum = $row["thum"];

    if (!empty($thum)){
        $file_path = "./data/" . $thum;
        if(file_exists($file_path)){
            unlink($file_path);
        }
    }

    $sql_delete = "DELETE FROM board WHERE num = $num";
    mysqli_query($connect, $sql_delete);

    mysqli_close($connect);

    echo "
        <script>
        alert('게시글이 성공적으로 삭제되었습니다!')
        location.href = 'board.php?page=$page';
        </script>
    ";
?>