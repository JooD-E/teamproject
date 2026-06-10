<?php
    session_start();

    $userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
    if (!$userid) {
        $userid = isset($_POST["userid"]) ? $_POST["userid"] : "";
    }

    if (!$userid) {
        echo("
            <script>
            alert('게시글 작성 권한이 없습니다.');
            history.go(-1);
            </script>
        ");
        exit;
    }

    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);

    $tags_arr = isset($_POST["tags"]) ? $_POST["tags"] : array();
    $tags_str = "";
    if (!empty($tags_arr)) {
        foreach ($tags_arr as $tag) {
            $tags_str .= "#" . $tag . " ";
        }
        $tags_str = trim($tags_str);
    }
    
    $regist_day = date("Y.m.d");

    $upload_dir = "./data/";

    if(!is_dir($upload_dir)){
        mkdir($upload_dir, 0777, true);
    }

    $files = $_FILES["upfile"];
    $count = count($files["name"]);

    $copied_file_names = array();

    for ($i = 0; $i < $count; $i++){
        $upfile_name = $files["name"][$i];
        $upfile_tmp_name = $files["tmp_name"][$i];
        $upfile_type = $files["type"][$i];
        $upfile_size = $files["size"][$i];
        $upfile_error = $files["error"][$i];

        if($upfile_name && !$upfile_error){
            $file = explode(".", $upfile_name);
            $file_name = $file[0];
            $file_ext = end($file);

            $new_file_name = date("YmdHis") . "_" . $i . "." . $file_ext;
            $uploaded_file = $upload_dir . $new_file_name;

            if (move_uploaded_file($upfile_tmp_name, $uploaded_file)){
                $copied_file_names[] = $new_file_name;
            }
        }
    }

    $thum = isset($copied_file_names[0]) ? $copied_file_names[0] : "";

    $file_name_str = implode(",", $copied_file_names);

    include "dbconn.php";
    mysqli_query($connect, "set names utf8");

    $sql = "INSERT INTO board (id, name, subject, content, regist_day, hit, likes, tags, thum, is_html, file_name)";
    $sql .= "VALUES ('$userid', '$userid', '$subject', '$content', '$regist_day', 0, 0, '$tags_str', '$thum', 'n', '$file_name_str')";

    mysqli_query($connect, $sql);
    mysqli_close($connect);

    echo "
        <script>
        alert('게시글 등록이 완료되었습니다.');
        location.href = 'board.php';
        </script>
    ";
?>