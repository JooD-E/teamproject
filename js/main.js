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


    /* =========================
          Hero & Brand Intro CSS 동적 주입
    ===========================*/
    const style = document.createElement('style');
    style.textContent = `
      .hero-section h4,
      .hero-section img,
      .hero-section span.Rtg01,
      .hero-section span.Rtg02,
      .hero-section span.Rtg03,
      .hero-section span.Rtg04,
      .hero-section span.Rtg05,
      .hero-section span.Rtg06,
      .hero-section span.Rtg07,
      .hero-section span.Rtg08,
      .hero-section span.Rtg09 {
        opacity: 0;
        transform: translateY(18px);
        transition: opacity 0.7s ease, transform 0.7s ease;
      }
      .hero-section span.line01,
      .hero-section span.line02,
      .hero-section span.line03,
      .hero-section span.line04 {
        opacity: 0;
        transform: scaleX(0);
        transform-origin: left;
        transition: opacity 0.6s ease, transform 0.6s ease;
      }
      .hero-section span.line01 {
        transform-origin: right;
      }
      .hero-section.ready h4,
      .hero-section.ready img,
      .hero-section.ready span.Rtg01,
      .hero-section.ready span.Rtg02,
      .hero-section.ready span.Rtg03,
      .hero-section.ready span.Rtg04,
      .hero-section.ready span.Rtg05,
      .hero-section.ready span.Rtg06,
      .hero-section.ready span.Rtg07,
      .hero-section.ready span.Rtg08,
      .hero-section.ready span.Rtg09 {
        opacity: 1;
        transform: translateY(0);
      }
      .hero-section.ready span.line01,
      .hero-section.ready span.line02,
      .hero-section.ready span.line03,
      .hero-section.ready span.line04 {
        opacity: 1;
        transform: scaleX(1);
      }
      .brand-intro span.line05,
      .brand-intro span.line06 {
        opacity: 0;
        transform: scaleY(0);
        transform-origin: top;
        transition: opacity 0.6s ease, transform 0.6s ease;
      }
      .brand-intro .intro-logo,
      .brand-intro .intro-title01,
      .brand-intro .intro-title02,
      .brand-intro .intro-text {
        opacity: 0;
        transform: translate(-50%, 18px);
        transition: opacity 0.7s ease, transform 0.7s ease;
      }
      .brand-intro.show-line05 span.line05 {
        opacity: 1;
        transform: scaleY(1);
      }
      .brand-intro.show-content .intro-logo,
      .brand-intro.show-content .intro-title01,
      .brand-intro.show-content .intro-title02,
      .brand-intro.show-content .intro-text {
        opacity: 1;
        transform: translate(-50%, 0);
      }
      .brand-intro.show-line06 span.line06 {
        opacity: 1;
        transform: scaleY(1);
      }
    `;
    document.head.appendChild(style);

    /* =========================
          Hero Section 애니메이션 동작
    ===========================*/
    const hero = document.querySelector('.hero-section');
    if (hero) {
        hero.classList.remove('ready');

        const delay = (el, ms) => {
            if (el) el.style.transitionDelay = ms + 'ms';
        };

        delay(hero.querySelector('.line01'), 0);
        delay(hero.querySelector('.text-seoul'), 80);
        delay(hero.querySelector('.L01'), 160);
        delay(hero.querySelector('.L02'), 200);
        delay(hero.querySelector('.L03'), 240);
        delay(hero.querySelector('.line02'), 300);

        delay(hero.querySelector('.Rtg01'), 380);
        delay(hero.querySelector('.Rtg02'), 420);
        delay(hero.querySelector('.Rtg03'), 460);
        delay(hero.querySelector('.text-vinyl'), 400);
        delay(hero.querySelector('.Rtg08'), 440);

        delay(hero.querySelector('.Rtg04'), 540);
        delay(hero.querySelector('.Rtg05'), 580);
        delay(hero.querySelector('.Rtg06'), 560);

        delay(hero.querySelector('.text-a'), 640);
        delay(hero.querySelector('.text-record'), 680);
        delay(hero.querySelector('.line03'), 700);

        delay(hero.querySelector('.Rtg07'), 760);
        delay(hero.querySelector('.text-shop'), 780);

        const rtg09Els = hero.querySelectorAll('.Rtg09');
        rtg09Els.forEach((el, i) => delay(el, 820 + i * 40));

        delay(hero.querySelector('.line04'), 880);

        setTimeout(() => {
            hero.classList.add('ready');
        }, 50);
    }

    /* =========================
          Brand Intro 스크롤 애니메이션 동작
    ===========================*/
    const intro = document.querySelector('.brand-intro');
    if (intro) {
        const delay = (el, ms) => { if (el) el.style.transitionDelay = ms + 'ms'; };

        delay(intro.querySelector('.intro-logo'),    100);
        delay(intro.querySelector('.intro-title01'), 200);
        delay(intro.querySelector('.intro-title02'), 320);
        delay(intro.querySelector('.intro-text'),    440);

        const observer1 = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                intro.classList.add('show-line05');
                setTimeout(() => intro.classList.add('show-content'), 500);
                observer1.unobserve(entry.target);
            });
        }, { threshold: 0.1 });

        observer1.observe(intro);

        const observer2 = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                intro.classList.add('show-line06');
                observer2.unobserve(entry.target);
            });
        }, { threshold: 0.3 }); 

        observer2.observe(intro);
    }



})