<?php
    session_start();
    $userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";

    include "dbconn.php";
    mysqli_query($connect, "set names utf8");

    $num  = $_GET["num"];
    $page  = $_GET["page"];

    $sql = "UPDATE board SET hit = hit + 1 WHERE num=$num";
    mysqli_query($connect, $sql);

    $sql = "SELECT * FROM board WHERE num=$num";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);

    $id      = $row["id"];
    $name      = $row["name"];
    $subject    = $row["subject"];
    $content    = $row["content"];
    $regist_day = $row["regist_day"];
    $hit        = $row["hit"];
    $likes      = $row["likes"];
    $tags       = $row["tags"];
    $thum       = $row["thum"];

    $content = str_replace(" ", "&nbsp;", $content);
    $content = str_replace("\n", "<br>", $content);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seoul Vinyl - 상세 보기</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/board.css">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../js/common.js"></script>
</head>
<body>
    <!-- ======================================================
                Header  -> common.css  common.js 연결 /
    =========================================================-->
    <header class="site-header">
        <div class="site-header-inner">
            <h1 class="logo">
                <a href="../main.html"><img src="../img/common/logo_white.png" alt="SEOUL VINYL 홈으로 가기"></a>
            </h1>

            <nav class="util-nav">
                <ul>
                    <li>
                        <button type="button" class="btn-search">
                        <img src="../img/common/search.png" alt="검색 버튼">
                        </button>
                    </li>
                    <li>
                        <a href="#">
                            <img src="../img/common/Group.png" alt="레코드 이미지">
                        </a>
                    </li>
                    <li><a href="./mypage.php"><img src="../img/common/user.png" alt="내 정보"></a></li>
                    <li>
                        <button type="button" class="btn-hamburger" aria-label="메뉴 열기/닫기">
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- ======================================================
                MENU  -> common.css  common.js 연결 /
    =========================================================-->

    <div class="full-page-menu">

        <div class="menu-container">
            <div class="menu-inner">
                <nav class="menu-util-nav" aria-label="사용자 유틸 메뉴">
                    <ul>
                        <li><a href="#">Wishlist</a></li>
                        <li><a href="#">My page</a></li>
                        <li><a href="#">Order</a></li>
                    </ul>
                </nav>

                <nav class="main-menu-nav">
                    <ul>
                        <li>
                            <span class="main-menu-num">01</span>
                            <a href="../product.html" class="depth1">SHOP</a>
                            <div class="depth2">
                                <a href="../product.html">ALL RECOREDS</a>
                                <a href="../product.html">NEW ARRIVAL</a>
                                <a href="../product.html">DJ'S PICK</a>
                                <a href="../product.html">GENRE</a>
                            </div>
                        </li>
                        <li>
                            <span class="main-menu-num">02</span>
                            <a href="../discovery.html" class="depth1">DISCOVER</a>
                            <div class="depth2">
                                <a href="../discovery.html">SEOUL DRIVE</a>
                                <a href="../discovery.html">RAINY NIGHT</a>
                                <a href="../discovery.html">SUNDAY MORNING</a>
                                <a href="../discovery.html">SUMMER MOOD</a>
                                <a href="../discovery.html">LATE COFFEE</a>
                            </div>
                        </li>
                        <li>
                            <span class="main-menu-num">03</span>
                            <a href="../about.html" class="depth1">ABOUT US</a>
                            <div class="depth2">
                                <a href="../about.html">BRAND STORY</a>
                                <a href="../about.html">STORE INFO</a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="menu-footer">
                    <h3>Seoul Vinyl</h3>
                    <p>Contact Us</p>
                    <a href="#">Instagram @seoulvinyl</a>
                </div>
            </div>

            <div class="menu-log">
                <?php
                    if (!$userid) {
                ?>
                    <a class="menu-log-in" href="./seoulvinyl_login.php">
                        <img src="../img/common/login.png" alt="로그인 하기">
                        <p>Login</p>
                    </a>
                <?php
                    } else {
                ?>
                    <a class="menu-log-out" href="./logout.php">
                        <img src="../img/common/logout.png" alt="로그아웃 하기">
                        <p>Logout</p>
                    </a>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>


    <!-- ======================================================
                SEARCH  -> common.css  common.js 연결 /
    =========================================================-->

    <div class="full-page-search">
        <button type="button" class="btn-close-search" aria-label="검색창 닫기">
            <span class="bar-search"></span>
            <span class="bar-search"></span>
        </button>

        <div class="search-container">
            <img src="../img/common/search.png" alt="검색 아이콘" class="search-icon-inner">
            <input type="text" class="search-input" placeholder="검색어를 입력하세요..." autocomplete="off">
        </div>
    </div>

    <main>
        <section class="archive-area">
            <nav class="archive-util-nav">
                <ul>
                    <li><a href="../main.html">HOME</a></li>
                    <li><span>&gt;</span></li>
                    <li><a href="board.php">Community</a></li>
                    <li><span>&gt;</span></li>
                    <li><span class="nav-span">상세 보기</span></li>
                </ul>
            </nav>

            <div class="main-title-area">
                <h2 class="main-title"><a href="./board.php"><img src="../img/common/vinyl_archive.png" alt="VINYL ARCHIVE"></a></h2>
            </div>

            <div class="view-container">
                <div class="view-header">
                    <h3 class="view-title"><?=$subject?></h3>
                    <div class="view-info">
                        <div class="view-info-left">
                            <span class="view-writer">By. <?=$name?></span>
                            <span class="view-date"><?=$regist_day?></span>
                        </div>
                        <div class="view-info-right">
                            <span>조회수 <?=$hit?></span>
                            <span>좋아요 <span id="like-count"><?=$likes?></span></span>
                        </div>
                    </div>
                </div>

                <div class="view-tags">
                    <?=$tags?>
                </div>

                <div class="view-content-area">
                    <?php
                        if(!empty($thum)) {
                            echo "<div class='view-image'><img src='./data/$thum' alt='첨부이미지'></div>";
                        }
                    ?>
                    
                    <div class="view-text">
                        <?=$content?>
                    </div>
                </div>
                <div class="view-like-area" style="text-align: center; margin: 40px 0;">
                    <button type="button" id="btn-like" data-num="<?=$num?>" style="background:none; border:none; cursor:pointer; transition: transform 0.2s;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50" height="50">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="#f06a20" stroke="#f06a20" stroke-width="1"/>
                        </svg>
                        <p style="color:#f06a20; margin-top:10px; font-weight:bold; font-family:'Pretendard';">LIKE</p>
                    </button>
                </div>

                <div class="view-btn-area">
                    <div class="view-btn-group-left">
                        <button type="button" class="btn-list" onclick="location.href='board.php?page=<?=$page?>'">목록으로</button>
                    </div>
                    
                    <div class="view-btn-group-right">
                        <?php
                            if ($userid == $id) {
                        ?>
                                <button type="button" class="btn-edit" onclick="location.href='modify_form.php?num=<?=$num?>&page=<?=$page?>'">수정</button>
                                <button type="button" class="btn-delete" onclick="location.href='board_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            </section>
    </main>



    <script>
        $(document).ready(function() {
            $('#btn-like').mousedown(function(){ $(this).css('transform', 'scale(0.9)'); });
            $('#btn-like').mouseup(function(){ $(this).css('transform', 'scale(1)'); });

            $('#btn-like').click(function() {
                let postNum = $(this).attr('data-num');

                $.ajax({
                    url: "like_update.php",
                    type: "POST",
                    data: { num: postNum },
                    success: function(response) {
                        $('#like-count').text(response);
                        alert("이 게시글에 좋아요를 눌렀습니다.");
                    },
                    error: function() {
                        alert("서버 통신에 실패했습니다.");
                    }
                });
            });
        });
    </script>
</body>
</html>