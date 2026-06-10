<?php
    session_start();

    if (isset($_SESSION['userid'])) {
        echo "
            <script>
                alert('이미 로그인 되어있습니다.');
                location.href = '../main.html';
            </script>
        ";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seoul Vinyl - Login</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/member.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
                        <a href="#"><img src="../img/common/Group.png" alt="레코드 이미지"></a>
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








    

    <div class="login-area">
        <nav class="home-nav">
            <ul>
                <li><a href="../main.html">HOME</a></li>
                <li><span>&gt;</span></li>
                <li><span class="nav-span">LOGIN</span></li>
            </ul>
        </nav>
        <section class="login-container">
            <h2><img src="../img/common/login_h2.png" alt="로그인 기본 프로필 아이콘"></h2>
            
            <div class="form_wrap">
                <form name="member_form" method="post" action="login.php">
                    <div class="input-row">
                        <label for="userId"><img src="../img/common/login_id_img.png" alt="아이디 아이콘"></label>
                        <input type="text" id="userId" name="userId" placeholder="아이디를 입력하세요">
                    </div>
                    <div class="input-row">
                        <label for="userPw"><img src="../img/common/login_pass_img.png" alt="비밀번호 아이콘"></label>
                        <input type="password" id="userPw" name="userPw" placeholder="비밀번호를 입력하세요">
                    </div>
                    <div class="login-utils">
                        <div class="save-id">
                            <input type="checkbox" id="saveId" name="saveId">
                            <label for="saveId">아이디 저장</label>
                        </div>
                        <div class="find-info">
                            <a href="seoulvinyl_find_id.php">아이디 찾기</a>
                            <span>|</span>
                            <a href="seoulvinyl_find_pw.php">비밀번호 찾기</a>
                        </div>
                    </div>
                    <div class="submit-btn-area">
                        <button type="submit" class="btn-login" value="로그인">로그인</button>
                        <a href="seoulvinyl_member_form.php" class="btn-register">회원가입</a>
                    </div>
                </form>
            </div>
        </section>
    </div>










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