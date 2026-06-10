<?php
    session_start();

    if (isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
    } else {
        echo("
            <script>
            window.alert('로그인 후 이용해 주세요.');
            location.href = './seoulvinyl_login.php';
            </script>
        ");
        exit;
    }

    include "./dbconn.php";

    $sql = "SELECT * FROM member WHERE id='$userid'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);

    $username = $row['name'];
    $user_address = $row['addr'];
    $user_email = $row['email'] ? $row['email'] : "이메일 데이터가 비어있습니다";
    
    $join_date = $row['regist_day'];

    $sql_board = "SELECT count(*) as cnt FROM board WHERE id='$userid'";
    $result_board = mysqli_query($connect, $sql_board);
    $row_board = mysqli_fetch_assoc($result_board);
    $post_count = $row_board['cnt'];

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seoul Vinyl</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/mypage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="../js/common.js"></script>
    <script src="../js/mypage.js"></script>
    
    
    
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
                        <li><a href="./mypage.php">Wishlist</a></li>
                        <li><a href="./mypage.php">My page</a></li>
                        <li><a href="./mypage.php">Order</a></li>
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
                <?php if(!isset($_SESSION['userid'])) { ?>
                <a class="menu-log-in" href="./seoulvinyl_login.php">
                    <img src="../img/common/login.png" alt="로그인 하기">
                    <p>Login</p>
                </a>
                <?php } else { ?>
                <a class="menu-log-out" href="./logout.php">
                    <img src="../img/common/logout.png" alt="로그아웃 하기">
                    <p>Logout</p>
                </a>
                <?php } ?>
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
    


    <main class="mypage-container">
            <section class="user-summary">
                <div class="summary-header">
                    <h2>SEOUL VINYL</h2>
                    <p>My Page</p>
                </div>

                <div class="summary-wrap">
                    <div class="summary-title">
                        <img src="../img/common/mypage_user.png" alt="고객 이미지">
                        <p><?= $userid ?> 님</p>
                        <span>가입일 <?= $join_date ?></span>
                    </div>

                    <div class="summary-info">
                        <h3>서울 바이닐에 오신 것을 환영합니다.</h3>
                        <p><?= $username ?></p>
                        <p><?= $user_address ?></p>
                        <p><?= $user_email ?></p>
                        <div class="summary-log">
                            <a href="./seoulvinyl_member_form_modify.php" class="member-modify">회원 정보 수정</a>
                            <a href="./logout.php" class="member-logout">로그아웃</a>
                        </div>
                    </div>
                    
                    <div class="summary-util">
                        <div class="summary-utilbox">
                            <img class="truckimg" src="../img/common/truck.png" alt="주문 배송 이미지">
                            <div class="summary-hr"></div>
                            <p>주문 / 배송 내역</p>
                            <span>2건</span>
                        </div>

                        <div class="summary-utilbox">
                            <img src="../img/common/heart.png" alt="하트 이미지">
                            <div class="summary-hr"></div>
                            <p>위시 리스트</p>
                            <span>12개</span>
                        </div>

                        <div class="summary-utilbox">
                            <img src="../img/common/message.png" alt="게시판 이미지">
                            <div class="summary-hr"></div>
                            <p>내 게시글</p>
                            <span><?= $post_count ?>건</span>
                        </div>

                        <div class="summary-utilbox">
                            <img src="../img/common/Phone.png" alt="고객센터 이미지">
                            <div class="summary-hr"></div>
                            <p>고객센터</p>
                            <span>02-123-4567</span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="order-history-section">
                <h2>주문 / 배송 내역</h2>

                <ul class="order-grid-list">
                    <li class="grid-row header-row">
                        <div class="col-date">주문 날짜</div>
                        <div class="col-info">상품 정보</div>
                        <div class="col-price">금액</div>
                        <div class="col-status">상태</div>
                    </li>

                    <li class="grid-row item-row">
                        <div class="col-date">2026.06.08</div>
                        <div class="col-info product-detail">
                            <img src="../img/main/aimyo01.png" alt="4집 눈에 떨어지는 레코드" class="product-img">
                            <div class="product-text">
                                <p class="product-title">4집 눈에 떨어지는 레코드</p>
                                <p class="product-artist">aimyo 아이묘</p>
                            </div>
                        </div>
                        <div class="col-price">43,000</div>
                        <div class="col-status">배송중</div>
                    </li>

                    <li class="grid-row item-row">
                        <div class="col-date">2026.06.08</div>
                        <div class="col-info product-detail">
                            <img src="../img/main/aimyo02.png" alt="5집 고양이에게 질투" class="product-img">
                            <div class="product-text">
                            <p class="product-title">5집 고양이에게 질투</p>
                            <p class="product-artist">aimyo 아이묘</p>
                            </div>
                        </div>
                        <div class="col-price">52,000원</div>
                        <div class="col-status">배송완료</div>
                    </li>
                </ul>
            </section>

            <section class="wishlist-section">
                <h2 class="wishlist-title">위시리스트</h2>
                
                <ul class="wishlist-grid">
                    <li class="wishlist-item">
                        <img src="../img/main/colde-love_part2.png" alt="Love part2" class="wishlist-img">
                        <p class="item-title">Love part2</p>
                        <p class="item-artist">colde 콜드</p>
                        <p class="item-specs">1LP, color vinyl</p>
                        <button type="button" class="btn-icon btn-cart" aria-label="장바구니 담기">
                            <img src="../img/common/shopping_bag.png" alt="장바구니">
                        </button>
                        <button type="button" class="btn-icon btn-heart" aria-label="위시리스트 삭제">
                            <img src="../img/common/heart_white.png" alt="하트">
                        </button>
                    </li>

                    <li class="wishlist-item">
                        <img src="../img/main/playboi_carti-playboi_carti_vinyl.png" alt="Playboi Carti" class="wishlist-img">
                        <p class="item-title">Playboi Carti</p>
                        <p class="item-artist">Playboi Carti</p>
                        <p class="item-specs">1LP, color vinyl</p>
                        <button type="button" class="btn-icon btn-cart" aria-label="장바구니 담기">
                            <img src="../img/common/shopping_bag.png" alt="장바구니">
                        </button>
                        <button type="button" class="btn-icon btn-heart" aria-label="위시리스트 삭제">
                            <img src="../img/common/heart_white.png" alt="하트">
                        </button>
                    </li>

                    <li class="wishlist-item">
                        <img src="../img/main/korean02.png" alt="개화" class="wishlist-img">
                        <p class="item-title">개화</p>
                        <p class="item-artist">Akmu 악뮤</p>
                        <p class="item-specs">1LP, color vinyl</p>
                        <button type="button" class="btn-icon btn-cart" aria-label="장바구니 담기">
                            <img src="../img/common/shopping_bag.png" alt="장바구니">
                        </button>
                        <button type="button" class="btn-icon btn-heart" aria-label="위시리스트 삭제">
                            <img src="../img/common/heart_white.png" alt="하트">
                        </button>
                    </li>

                    <li class="wishlist-item">
                        <img src="../img/main/Don_toliver-Heaven_Or_Hell_clear_colored_vinyl.png" alt="Heaven or Hell" class="wishlist-img">
                        <p class="item-title">Heaven or Hell</p>
                        <p class="item-artist">Don Toliver</p>
                        <p class="item-specs">1LP, color vinyl</p>
                        <button type="button" class="btn-icon btn-cart" aria-label="장바구니 담기">
                            <img src="../img/common/shopping_bag.png" alt="장바구니">
                        </button>
                        <button type="button" class="btn-icon btn-heart" aria-label="위시리스트 삭제">
                            <img src="../img/common/heart_white.png" alt="하트">
                        </button>
                    </li>
                </ul>
            </section>

            <section class="my-posts-section">
                <h2 class="section-title">내 게시글</h2>

                <ul class="board-list">
                    <li class="board-row board-header">
                        <div class="col-title">제목</div>
                        <div class="col-desc">내용</div>
                        <div class="col-views">조회수</div>
                        <div class="col-date">작성일</div>
                    </li>

                    <?php
                        $sql_list = "SELECT * FROM board WHERE id='$userid' ORDER BY num DESC LIMIT 3";
                        $result_list = mysqli_query($connect, $sql_list);

                        if(mysqli_num_rows($result_list) > 0) {
                            while($row_list = mysqli_fetch_array($result_list)) {
                                $b_subject = $row_list['subject'];
                                $b_content = strip_tags($row_list['content']);
                                $b_hit = $row_list['hit'];
                                $b_date = $row_list['regist_day'];
                    ?>
                    <li class="board-row item-row">
                        <div class="col-title text-ellipsis"><?= $b_subject ?></div>
                        <div class="col-desc text-ellipsis"><?= $b_content ?></div>
                        <div class="col-views"><?= $b_hit ?>건</div>
                        <div class="col-date"><?= $b_date ?></div>
                    </li>
                    <?php
                            }
                        } else {
                    ?>
                    <li class="board-row item-row" style="justify-content: center; padding: 30px 0;">
                        <div style="color: #666;">작성된 게시글이 없습니다.</div>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </section>


        <aside class="mypage-sidebar" id="followSidebar">
        
            <div class="sidebar-profile">
                <img src="../img/common/mypage_user.png" alt="프로필 이미지" class="profile-img">
                <div class="profile-info">
                    <p class="name"><strong><?= $userid ?></strong> 님</p>
                    <p class="greeting">환영합니다</p>
                    <p class="date">가입일 <?= $join_date ?></p>
                </div>
            </div>


            <nav class="sidebar-nav">
                <ul>
                    <li class="active"><a href="./mypage.php"><img src="../img/common/house.png" alt=""> 마이페이지</a></li>
                    <li><a href="./seoulvinyl_member_form_modify.php"><img src="../img/common/login_id_img.png" alt=""> 회원 정보 수정</a></li>
                    <li><a href="#"><img src="../img/common/truck.png" alt=""> 주문/배송</a></li>
                    <li><a href="#"><img src="../img/common/heart.png" alt=""> 위시리스트</a></li>
                    <li><a href="./board.php"><img src="../img/common/message.png" alt=""> 내 게시글</a></li>
                    <li><a href="./logout.php"><img src="../img/common/logout_black.png" alt=""> 로그아웃</a></li>
                    <li class="withdraw"><a href="./member_delete.php"><img src="../img/common/info-circle.png" alt=""> 회원탈퇴</a></li>
                </ul>
            </nav>
            <div class="sidebar-cs">
                <p class="cs-title">고객센터</p>
                <p class="cs-phone">02-123-4567</p>
                <p class="cs-time">평일 10:00 - 18:00</p>
            </div>
        </aside>
        
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
    </body>
</html>