document.addEventListener("DOMContentLoaded", function (){

    /* =========================
          DJ's PICK Swiper
    ===========================*/
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

    /* =========================
          New Arrival Swiper
    ===========================*/


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

    const allSlides = $('.category-swiper .swiper-slide').clone(); 

    const categorySwiper = new Swiper('.category-swiper', {
        slidesPerView: 4,
        spaceBetween: 20,
        loop:true,
        navigation: {
            nextEl: '.category-button-next',
            prevEl: '.category-button-prev',
        }
    });

    $('.category-list-box button').on('click', function() {
        $('.category-list-box button').removeClass('c-active');
        $(this).addClass('c-active');

        const filterValue = $(this).attr('data-filter');

        categorySwiper.removeAllSlides(); 

        if (filterValue === 'all') {
            categorySwiper.appendSlide(allSlides);
        } else {
            const filteredSlides = allSlides.filter(function() {
                const itemFilter = $(this).attr('data-filter');
                return itemFilter && itemFilter.includes(filterValue);
            });
            categorySwiper.appendSlide(filteredSlides);
        }

        categorySwiper.update();
        categorySwiper.slideTo(0);
    });


    const playlistBtns = document.querySelectorAll('.btn-playlist');
    const playlistItems = document.querySelectorAll('.mood-playlist__item');

    playlistBtns.forEach((btn, index) => {
        btn.addEventListener('click',()=> {
            playlistBtns.forEach(b => b.classList.remove('m-active'));
            btn.classList.add('m-active');

            playlistItems.forEach(item => item.classList.remove('track-active'));
            playlistItems[index].classList.add('track-active');

        });
    });


})