<?php
    session_start();
    
    $userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";

    include "dbconn.php";
    mysqli_query($connect, "set names utf8");

    $num = $_GET["num"];
    $page = $_GET["page"];

    $sql = "SELECT * FROM board WHERE num=$num";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);

    $id = $row["id"];
    $subject = $row["subject"];
    $content = $row["content"];
    $tags = $row["tags"];
    $thum = $row["thum"];

    if($userid != $id){
        echo "
            <script>
            alert('본인이 작성한 글만 수정할 수 있습니다.')
            history.go(-1);
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
    <title>Seoul Vinyl Archive</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/board.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="../js/common.js"></script>
    
    
</body>
</html>
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
<!-- ======================================================
               main
    =========================================================-->    
    <main>
        <section class="write-area">
            <nav class="archive-util-nav">
                <ul>
                    <li><a href="../main.html">HOME</a></li>
                    <li><span>&gt;</span></li>
                    <li><a href="./board.php">Community</a></li>
                    <li><span>&gt;</span></li>
                    <li><span class="nav-span" style="color:#f06a20;">게시글 수정</span></li>
                </ul>
            </nav>

            <div class="main-title-area">
                <h2 class="main-title"><a href="./board.php"><img src="../img/common/vinyl_archive.png" alt="VINYL ARCHIVE"></a></h2>
            </div>

            <div class="write-container">
                <form action="modify.php?num=<?=$num?>&page=<?=$page?>" method="post" enctype="multipart/form-data" id="boardWriteForm">
                    
                    <div class="write-table-top">
                        <div class="write-row">
                            <span class="row-label">회원 아이디 : </span>
                            <span class="row-label2"><?=$userid?></span>
                            <input type="hidden" name="userid" value="<?=$userid?>">
                        </div>

                        <div class="write-row">
                            <label for="subject" class="row-label">제목 :</label>
                            <input type="text" id="subject" name="subject" class="row-input" value="<?=$subject?>" required>
                        </div>

                        <div class="write-row">
                            <span class="row-label">#태그</span>
                            <div class="checkbox-group">
                                <?php
                                    function checkTag($fullText, $tagName){
                                        return (strpos($fullText, $tagName) !== false) ? "checked" : "";
                                    }
                                ?>
                                <label><input type="checkbox" name="tags[]" value="명반" <?=checkTag($tags, "명반")?>> #명반</label>
                                <label><input type="checkbox" name="tags[]" value="턴테이블" <?=checkTag($tags, "턴테이블")?>> #턴테이블</label>
                                <label><input type="checkbox" name="tags[]" value="LP자랑" <?=checkTag($tags, "LP자랑")?>> #LP자랑</label>
                                <label><input type="checkbox" name="tags[]" value="장비리뷰" <?=checkTag($tags, "장비리뷰")?>> #장비리뷰</label>
                                <label><input type="checkbox" name="tags[]" value="일상TALK" <?=checkTag($tags, "일상TALK")?>> #일상TALK</label>
                                <label><input type="checkbox" name="tags[]" value="방문후기" <?=checkTag($tags, "방문후기")?>> #방문후기</label>
                            </div>
                        </div>
                    </div>

                    <div class="write-section">
                        <p class="section-title">📷 [ 사진 변경 ]</p>
                        <div style="margin: 10px 0; color: #888; font-size:14px;">
                            <?php if($thum) { echo "현재 등록된 파일: <strong>$thum</strong> (새 파일을 올리면 교체됩니다)";}?>
                        </div>
                        <div class="drop-zone" id="drop-zone">
                            <span class="drop-text" id="drop-text">📁 클릭하거나 이미지를 여기로 끌어다 놓으세요.</span>
                            <input type="file" name="upfile[]" id="file-input" accept="image/*" multiple style="display: none;">
                        </div>
                    </div>

                    <div class="write-section">
                        <p class="section-title">[본문 수정]</p>
                        <textarea id="content" name="content" class="content-textarea"required><?=$content?></textarea>
                    </div>

                    <div class="write-btn-area">
                        <button type="button" class="btn-cancel" onclick="history.back();">취소</button>
                        <button type="submit" class="btn-submit">수정 완료</button>
                    </div>
                </form>
            </div>
        </section>
    </main>


    <!-- ======================================================
                Footer  -> common.css 연결 
    =========================================================-->
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
        const $dropZone = $('#drop-zone');
        const $fileInput = $('#file-input');
        const $dropText = $('#drop-text');

        $dropZone.on('click', function(e) {
            if (e.target.id !== 'file-input') {
                $fileInput.click();
            }
        });

        $fileInput.on('click', function(e) {
            e.stopPropagation(); 
        });

        $fileInput.on('change', function() {
            updateFileText(this.files);
        });

        $dropZone.on('dragover dragenter', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).css({
                'background-color': '#e0e0e0',
                'border': '2px dashed #f06a20'
            });
        });

        $dropZone.on('dragleave dragend', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).css({
                'background-color': '#efefef',
                'border': '2px dashed transparent'
            });
        });

        $dropZone.on('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).css({
                'background-color': '#efefef',
                'border': '2px dashed transparent'
            });

            const files = e.originalEvent.dataTransfer.files;
            $fileInput[0].files = files;
            updateFileText(files);
        });

        function updateFileText(files) {
            if (files.length > 0) {
                $dropText.text(`총 ${files.length}개의 이미지가 첨부되었습니다.`);
            } else {
                $dropText.text('📁 클릭하거나 이미지를 여기로 끌어다 놓으세요.');
            }
        }
    });
    </script>
</body>
</html>