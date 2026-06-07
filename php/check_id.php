<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>아이디 중복확인 - Seoul Vinyl</title>
    <style>
        body {
            background-color: #2b2b2b;
            color: #ccc;
            font-family: 'Pretendard', sans-serif;
            text-align: center;
            padding: 40px 20px;
            margin: 0;
        }
        h3 {
            color: #fff;
            margin-bottom: 20px;
            font-size: 20px;
        }
        .msg-box {
            background-color: #404040;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            font-size: 15px;
            line-height: 1.6;
        }
        .highlight-success {
            color: #e66a2e;
            font-weight: bold;
            font-size: 16px;
        }
        .highlight-fail {
            color: #ff4d4d;
            font-weight: bold;
            font-size: 16px;
        }
        .btn-close {
            background-color: #e66a2e;
            color: #fff;
            border: none;
            padding: 10px 30px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-close:hover {
            background-color: #cf5e28;
        }
    </style>
</head>
<body>
    <h3>아이디 중복확인</h3>
    <div class="msg-box">
        <?php
            $id = $_GET['id'];

            if(!$id) {
                echo("아이디를 입력해 주세요.");
            } else {
                include "dbconn.php";
                
                mysqli_query($connect, 'set names utf8'); 
                $sql = "select * from member where id='$id'";
                $result = mysqli_query($connect, $sql);
                $num_record = mysqli_num_rows($result); 

                if ($num_record) {
                    echo "<span class='highlight-fail'>'{$id}'</span> 는(은)<br>";
                    echo "이미 사용 중인 아이디입니다.<br>";
                    echo "다른 아이디를 입력해 주세요.";
                } else {
                    // 사용 가능할 때 (성공 느낌)
                    echo "<span class='highlight-success'>'{$id}'</span> 는(은)<br>";
                    echo "사용 가능한 아이디입니다.";
                }
                
                mysqli_close($connect);
            }
        ?>
    </div>
    
    <button type="button" class="btn-close" onclick="javascript:self.close()">창 닫기</button>

</body>
</html>