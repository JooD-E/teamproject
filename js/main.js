document.addEventListener("DOMContentLoaded", function (){
    const albumSwiper = new Swiper('.album-swiper', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        loop: true,
        slideToClickedSlide: true,
        coverflowEffect:{
            rotate:0,
            stretch: 50,
            depth:200,
            modifier:1,
            slideShadows:false,
        }
    });

    const textSwiper = new Swiper('.text-swiper', {
        direction: 'vertical',
        centeredSlides:true,
        slidesPerView:3,
        loop: true,
        allowTouchMove: false,
    });

    albumSwiper.on('slideChangeTransitionEnd', function () {
        const currentRealIndex = albumSwiper.realIndex;
        
        if (textSwiper.realIndex !== currentRealIndex) {
            textSwiper.slideToLoop(currentRealIndex, 300, false); 
        }
    });


    const arrivalSwiper = new Swiper('.arrival-swiper', {
        slidesPerView:'auto',
        loop:true,
        slideToClickedSlide: true,
        spaceBetween: 10,
        navigation: {
            nextEl: '.arrival-right',
            prevEl: '.arrival-left',
        },
    });
})