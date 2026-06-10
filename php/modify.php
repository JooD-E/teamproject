<?php
    session_start();
    $userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";

    if (!$userid) {
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
    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);

    $tags_arr = isset($_POST["tags"]) ? $_POST["tags"] : array();
    $tags_str = "";
    if (!empty($tags_arr)){
        foreach ($tags_arr as $tag){
            $tags_str .= "#" . $tag . " ";
        }
        $tags_str = trim($tags_str);
    }

    $files = $_FILES["upfile"];
    $upfile_name = $files["name"][0];
    $upfile_error = $files["error"][0];

    if ($upfile_name && !$upfile_error){
        $sql_select = "SELECT thum FROM board WHERE num = $num";
        $result = mysqli_query($connect, $sql_select);
        $row = mysqli_fetch_array($result);
        $old_thum = $row["thum"];

        if(!empty($old_thum)) {
            $old_file_path = "./data/" . $old_thum;
            if (file_exists($old_file_path)){
                unlink($old_file_path);
            }
        }

        $file = explode(".", $upfile_name);
        $file_ext = end($file);

        $new_file_name = date("YmdHis") . "_mod." . $file_ext;
        $upload_dir = "./data/";
        $uploaded_file = $upload_dir . $new_file_name;
        
        if(move_uploaded_file($files["tmp_name"][0], $uploaded_file)){
            $sql = "UPDATE board SET subject='$subject', content='$content', tags='$tags_str', thum='$new_file_name', file_name='$new_file_name' WHERE num=$num";
        }
    } else {
        $sql = "UPDATE board SET subject='$subject', content='$content', tags='$tags_str' WHERE num=$num";
    }

    mysqli_query($connect, $sql);
    mysqli_close($connect);

    echo "
        <script>
        alert('게시글 수정이 완료되었습니다.');
        location.href = 'view.php?num=$num&page=$page';
        </script>
    ";
?>