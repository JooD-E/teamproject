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

    // 2. Swiper 초기화
    const categorySwiper = new Swiper('.category-swiper', {
        slidesPerView: 4, // 한 줄에 보일 앨범 개수 (원하시는 대로 수정)
        spaceBetween: 30, // 앨범 사이 간격
        navigation: {
            nextEl: '.category-button-next',
            prevEl: '.category-button-prev',
        },
        breakpoints: {
            // 반응형 필요시 세팅 (예: 화면이 작아지면 2개씩 보이게)
            1024: { slidesPerView: 4 },
            768: { slidesPerView: 3 },
            480: { slidesPerView: 2 },
        }
    });

    // 3. 필터 버튼 클릭 이벤트
    $('.category-list-box button').on('click', function() {
        // 버튼 디자인 활성화 상태 변경
        $('.category-list-box button').removeClass('c-active');
        $(this).addClass('c-active');

        // 클릭한 버튼의 data-filter 값 가져오기 (예: "korean")
        const filterValue = $(this).attr('data-filter');

        // Swiper 안에 있는 기존 슬라이드들을 싹 다 날려버림
        categorySwiper.removeAllSlides(); 

        // 4. 슬라이드 걸러내기 (필터링 로직)
        if (filterValue === 'all') {
            // '전체' 버튼이면 아까 복사해둔 원본 슬라이드 전체를 다시 넣음
            categorySwiper.appendSlide(allSlides);
        } else {
            // 특정 카테고리면 해당 문자가 포함된(.includes) 슬라이드만 골라냄
            const filteredSlides = allSlides.filter(function() {
                const itemFilter = $(this).attr('data-filter');
                // 형님이 짜신 "only,korean" 처럼 여러개 섞여있어도 찾아냄!
                return itemFilter && itemFilter.includes(filterValue);
            });
            // 걸러진 슬라이드만 Swiper에 추가
            categorySwiper.appendSlide(filteredSlides);
        }

        // 5. Swiper에게 슬라이드 목록이 바뀌었다고 알려주고 1페이지로 땡김
        categorySwiper.update();
        categorySwiper.slideTo(0);
    });
})