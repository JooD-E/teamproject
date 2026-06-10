<?php
    session_start();
    $userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";

    if ($userid == "") {
        echo("
            <script>
            alert('게시판은 로그인 후 이용하실 수 있습니다.');
            location.href = 'seoulvinyl_login.php';
            </script>
        ");
        exit;
    }
    
    include "dbconn.php";
    mysqli_query($connect, "set names utf8"); 

    $page = isset($_GET["page"]) ? $_GET["page"] : 1;

    $search_type = isset($_GET["search_type"]) ? $_GET["search_type"] : "";
    $search_keyword = isset($_GET["search_keyword"]) ? $_GET["search_keyword"] : "";

    if ($search_keyword != "") {
        $col = "";
        if ($search_type == "archive-subject") $col = "subject";
        else if ($search_type == "archive-content") $col = "content";
        else if ($search_type == "archive-name") $col = "id"; 

        $sql = "SELECT * FROM board WHERE $col LIKE '%$search_keyword%' ORDER BY num DESC";
        $search_params = "&search_type=$search_type&search_keyword=$search_keyword"; 
    } else {
        $sql = "SELECT * FROM board ORDER BY num DESC";
        $search_params = "";
    }
    
    $result = mysqli_query($connect, $sql);
    $total_record = mysqli_num_rows($result);

    $scale = 10;

    if($total_record % $scale == 0){
        $total_page = floor($total_record / $scale);
    } else {
        $total_page = floor($total_record / $scale) + 1;
    }

    $start = ($page -1 ) * $scale;
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seoul Vinyl</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/board.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="../js/common.js"></script>
</head>
<body>
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
                        <li>
                            <span class="main-menu-num">04</span>
                            <a href="../magazine.html" class="depth1">MAGAZINE</a>
                            <div class="depth2">
                                <a href="../magazine.html">INTERVIEW</a>
                                <a href="../magazine.html">TIMELINE</a>
                            </div>
                        </li>
                        <li>
                            <span class="main-menu-num">05</span>
                            <a href="../php/board.php" class="depth1">BOARD</a>
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
                    <a class="menu-log-out" href="./logout.php" style="display: flex !important;">
                        <img src="../img/common/logout.png" alt="로그아웃 하기">
                        <p>Logout</p>
                    </a>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>

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
                    <li><span class="nav-span">Community</span></li>
                </ul>
            </nav>

            <div class="main-title-area">
                <h2 class="main-title"><a href="./board.php"><img src="../img/common/vinyl_archive.png" alt="VINYL ARCHIVE"></a></h2>
            </div>

            <div class="archive-container">
                <div class="archive-header">
                    <p class="total-count">▶ 총 <?=$total_record?>개의 게시물이 있습니다.</p>
                    
                    <form action="" method="get" class="search-form">
                        <select name="search_type" class="search-select">
                            <option value="archive-subject">제목</option>
                            <option value="archive-content">내용</option>
                            <option value="archive-name">작성자</option>
                        </select>
                        <input type="text" name="search_keyword" class="search-input" placeholder="검색어를 입력해주세요..">
                        <button type="submit" class="archive-search-btn">검색</button>
                    </form>
                </div>

                <div class="gallery-grid">
                    <?php
                        if ($total_record == 0){
                            echo "<div style='grid-column: 1 / -1; text-align: center; padding: 100px 0; color: #aaa; font-size: 16px;'> 검색 결과나 등록된 게시물이 없습니다!</div>";
                        } else {
                            for ($i = $start; $i < $start + $scale && $i < $total_record; $i++){
                                mysqli_data_seek($result, $i);
                                $row = mysqli_fetch_array($result);
                                
                                $num = $row["num"];
                                $subject = $row["subject"];
                                $regist_day = $row["regist_day"];
                                $hit = $row["hit"];
                                $likes = $row["likes"];
                                $tags = $row["tags"];
                                $thum = $row["thum"];

                                if(empty($thum)){
                                    $img_path = "../img/common/no_img.png";
                                } else {
                                    $img_path = "./data/" . $thum;
                                }
                        ?>
                    <div class="gallery-item">
                        <div class="gallery-card-box">
                            <div class="gallery-card-img">
                                <img src="<?=$img_path?>" alt="썸네일">
                            </div>
                            <div class="card-content">
                                <span class="hashtags"><?=$tags?></span>
                                <h3 class="post-title">
                                    <a href="view.php?num=<?=$num?>&page=<?=$page?>" class="stretched-link"><?=$subject?></a>
                                </h3>
                                <div class="card-footer">
                            <span class="gallery-date"><?=$regist_day?></span>
                            
                            <button type="button" class="like-btn" data-num="<?=$num?>" style="position: relative; z-index: 10; background:none; border:none; cursor:pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="none" stroke="#f44336" stroke-width="2"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="item-stats">
                    <span>조회수 <span class="stats-strong"><?=$hit?></span></span>
                    <span>좋아요 <span class="stats-strong like-count-<?=$num?>"><?=$likes?></span></span>
                </div>
            </div>
                    <?php
                            } 
                        } 
                    ?>
                </div>
            </div>

            <div class="archive-bottom">
                <div class="bottom-left"></div>
                <div class="archive-pagination">
                    <?php
                        if ($page > 1) {
                            $prev = $page - 1;
                            echo "<a href='board.php?page=$prev$search_params' class='page-arrow'>&lt;</a>";
                        } else {
                            echo "<a href='#' class='page-arrow' style='color:#555;'>&lt;</a>";
                        }

                        for ($i = 1; $i <= $total_page; $i++){
                            if($page == $i){
                                echo "<a href='#' class='page-num active'>$i</a>";
                            } else {
                                echo "<a href='board.php?page=$i$search_params' class='page-num'>$i</a>";
                            }
                            if ($i != $total_page){
                                echo "<span class='divider'>|</span>";
                            }
                        }

                        if($page < $total_page) {
                            $next = $page + 1;
                            echo " <a href='board.php?page=$next$search_params' class='page-arrow'>&gt;</a>";
                        } else {
                            echo " <a href='#' class='page-arrow' style='color:#555;'>&gt;</a>";
                        }
                    ?>
                </div>

                <div class="bottom-right">
                    <button type="button" class="archive-write-btn" onclick="location.href='write_form.php'">게시글 작성</button>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-top-section">
            <div class="footer-top-container">
                <ul class="footer-top__left">
                    <li><a href="#"><strong>문의</strong></a></li>
                    <li><a href="#"><strong>이용약관</strong></a></li>
                    <li><a href="#"><strong>개인정보처리방침</strong></a></li>
                    <li><a href="#"><strong>사업자정보확인</strong></a></li>
                </ul>
                <ul class="footer-top__right">
                    <li><a href="#"><img src="../img/common/phone_icon_v2.png" alt="전화 아이콘"></a></li>
                    <li><a href="#"><img src="../img/common/mail_icon_v2.png" alt="메일 아이콘"></a></li>
                    <li><a href="#"><img src="../img/common/instagram_icon_v2.png" alt="인스타그램 아이콘"></a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom-section">
                <ul class="footer-bottom__txt">
                    <li>상호 : 주식회사 서울바이닐(SEOUL VINYL Co.,Ltd)</li>
                    <li>대표 : 이진욱</li>
                    <li>개인정보관리책임자 : 이진욱</li>
                    <li>전화 : 02-792-3110</li>
                    <li>이메일 : whatsupjin@hanmail.net</li>
                    <li>주소 : 서울특별시 용산구 신흥로 30, 1층/2층</li>
                    <li>사업자등록번호 : 713-81-02189</li>
                    <li>통신판매 : 제 2020-서울용산-2144호</li>
                </ul>

            <div class="footer-bottom__escrow">
                <img src="../img/common/escrow_inicisPay.png" alt="안전구매 에스크로 이미지">
                <span>안전구매(에스크로) 서비스 가맹점</span>
            </div>
        </div>
    </footer>

    <script>
    $(document).ready(function() {
        $('.like-btn').click(function(e) {
            e.preventDefault();
            e.stopPropagation(); 
            
            let btn = $(this);
            let postNum = btn.attr('data-num');

            $.ajax({
                url: "like_update.php",
                type: "POST",
                data: { num: postNum },
                success: function(response) {
                    $('.like-count-' + postNum).text(response);
                    btn.find('path').attr('fill', '#f44336');
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