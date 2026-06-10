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
    const siteHeader = document.querySelector('.site-header');
    const body = document.body;

    hamburgerBtn.addEventListener('click', () => {
        hamburgerBtn.classList.toggle('active');        
        fullPageMenu.classList.toggle('f-active');

        siteHeader.classList.toggle('menu-open')

        if (fullPageMenu.classList.contains('f-active')) {
            body.style.overflow = 'hidden';
        } else {
            body.style.overflow = '';
        }
    });

    /* =========================
            full-page-search
    ===========================*/
    const btnSearch = document.querySelector('.btn-search');
    const fullPageSearch = document.querySelector('.full-page-search');
    const btnCloseSearch = document.querySelector('.btn-close-search');
    const searchInput = document.querySelector('.search-input');

    btnSearch.addEventListener('click', () => {
        fullPageSearch.classList.add('s-active');
        body.style.overflow = 'hidden'; //
        
        setTimeout(() => {
            searchInput.focus();
        }, 100); 
    });

    btnCloseSearch.addEventListener('click', () => {
        fullPageSearch.classList.remove('s-active');
        body.style.overflow = '';
        searchInput.value = '';
    });



});