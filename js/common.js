$(function() {

    /* =========================
            HEADER
    ===========================*/
    const $window = $(window);
    const $header = $('.site-header');

    if($header.length){
        let lastScroll = 0;
        $window.on('scroll', function(){
            let currentScroll = $window.scrollTop();

            if (currentScroll <= 0){
                $header.removeClass('fixed hide');
            } else if (currentScroll > lastScroll ){
                $header.removeClass('fixed').addClass('hide');
            } else {
                $header.removeClass('hide').addClass('fixed');
            }
            lastScroll = currentScroll;
        })
    }

    /* =========================
            full-page-menu
    ===========================*/
    const hamburgerBtn = document.querySelector('.btn-hamburger');
    const fullPageMenu = document.querySelector('.full-page-menu');
    const body = document.body;

    hamburgerBtn.addEventListener('click', () => {
        hamburgerBtn.classList.toggle('active');
        
        fullPageMenu.classList.toggle('f-active');

        // 3. 메뉴가 열렸을 때 뒤쪽 화면 스크롤 못하게 막기
        if (fullPageMenu.classList.contains('f-active')) {
            body.style.overflow = 'hidden';
        } else {
            body.style.overflow = '';
        }
    });

});