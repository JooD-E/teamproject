<?php
    session_start();

    if(!isset($_SESSION['userid'])) {
        echo("
            <script>
                alert('로그인 후 이용해주세요!');
                location.href = 'seoulvinyl_login.php';
            </script>
        ");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>마이페이지 - Seoul Vinyl</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/common.css">
    
    <style>
        body {
            background-color: #2b2b2b; 
            font-family: 'Pretendard', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .mypage-wrap {
            background-color: #404040;
            padding: 60px 40px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 600px;
        }
        .mypage-wrap h2 {
            color: #fff;
            font-size: 28px;
            margin-bottom: 20px;
        }
        .mypage-wrap p {
            color: #ccc;
            font-size: 18px;
            margin-bottom: 40px;
            line-height: 1.5;
        }
        .user-id-highlight {
            color: #e66a2e; 
            font-weight: bold;
            font-size: 22px;
        }
        .btn-group {
            display: flex;
            gap: 10px;
        }
        .btn-group a {
            flex: 1;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 6px;
            font-size: 15px;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s;
        }
        
        .btn-home { background-color: #888; color: #fff; }
        .btn-home:hover { background-color: #666; }

        .btn-edit { background-color: #fff; color: #333; }
        .btn-edit:hover { background-color: #f0f0f0; }

        .btn-logout { background-color: #e66a2e; color: #fff; }
        .btn-logout:hover { background-color: #cf5e28; }

        .btn-delete { background-color: #b33939; color: #fff; }
        .btn-delete:hover { background-color: #8c2a2a; }
    </style>
</head>
<body>

    <div class="mypage-wrap">
        <h2>내 정보</h2>
        
        <p>
            환영합니다!<br>
            <span class="user-id-highlight"><?php echo $_SESSION['userid']; ?></span> 님의 마이페이지입니다.
        </p>

        <div class="btn-group">
            <a href="../main.html" class="btn-home">메인으로</a>
            <a href="seoulvinyl_member_form_modify.php" class="btn-edit">정보수정</a>
            <a href="logout.php" class="btn-logout">로그아웃</a>
            <a href="member_delete.php" class="btn-delete" onclick="return confirm('정말로 서울 바이닐을 탈퇴하시겠습니까?\n탈퇴 시 회원 정보는 즉시 삭제되며 복구할 수 없습니다.');">회원탈퇴</a>
        </div>
    </div>

</body>
</html>