<?php
    include "dbconn.php";
    mysqli_query($connect, "set names utf8");

    $num = $_POST["num"];

    $sql = "UPDATE board SET likes = likes + 1 WHERE num = $num";
    mysqli_query($connect, $sql);

    $sql2 = "SELECT likes FROM board WHERE num = $num";
    $result = mysqli_query($connect, $sql2);
    $row = mysqli_fetch_array($result);

    $new_likes = $row["likes"];

    echo $new_likes;
?>