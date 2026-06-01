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
});