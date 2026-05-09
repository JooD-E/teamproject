document.addEventListener("DOMContentLoaded", function(){

    const sections = document.querySelectorAll(".section");
    const navLinks = document.querySelectorAll(".fixed_ul a");
    const trackDot = document.querySelector(".track_dot");
    // const trackLine = document.querySelector(".track_line");

    let currentSectionIndex = 0;
    let isScrolling = false;

    window.addEventListener('wheel', (e) => {
        e.preventDefault();

        if(isScrolling) return;

        if(e.deltaY > 0) {
            // 휠을 아래로 내릴 때
            if(currentSectionIndex < sections.length - 1){
                currentSectionIndex++;
            }
        } else {
            // 휠을 위로 올릴 때
            if(currentSectionIndex > 0){
                currentSectionIndex--;
            }
        }
        scrollToSection(currentSectionIndex);
    }, {passive: false});


    function scrollToSection(index) {
        if (isScrolling) return; 
        isScrolling = true;

        const targetPosition = sections[index].offsetTop;
        const startPosition = window.pageYOffset;
        const distance = targetPosition - startPosition;
        
        
        const duration = 1200; 
        let startTime = null;

        function animation(currentTime) {
            if (startTime === null) startTime = currentTime;
            const timeElapsed = currentTime - startTime;
            

            const run = easeInOut(timeElapsed, startPosition, distance, duration);
            window.scrollTo(0, run);
            
            if (timeElapsed < duration) {
                requestAnimationFrame(animation);
            } else {
                window.scrollTo(0, targetPosition); 
                isScrolling = false; 
            }
        }


        function easeInOut(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return c / 2 * t * t + b;
            t--;
            return -c / 2 * (t * (t - 2) - 1) + b;
        }

        requestAnimationFrame(animation);
    }


    navLinks.forEach((link, index) => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            if (isScrolling) return;
            currentSectionIndex = index;
            scrollToSection(currentSectionIndex);
        });
    });

    function updateNavTrack(index){
        const activeLi = navLinks[index].parentElement;

        const activeLeft = activeLi.offsetLeft;
        const activeWidth = activeLi.offsetWidth;

        const targetPosition = activeLeft + (activeWidth / 2);

        trackDot.style.transform = `translate(${targetPosition - 55}px, -50%)`;
    }

    const observerOptions = {
        threshold: 0.5
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting){
                const index = Array.from(sections).indexOf(entry.target);
                currentSectionIndex = index;

                navLinks.forEach(link => link.classList.remove('active'));
                navLinks[index].classList.add('active');

                updateNavTrack(currentSectionIndex);
            }
        });
    }, observerOptions);

    sections.forEach(section => observer.observe(section));

    updateNavTrack(0);

    


    const $toggleBtns = $('.toggle_btn');

    $toggleBtns.on('click', function() {
        const $btn = $(this);
        $btn.find('img').toggleClass('rotated');

        const $content = $(this).next('.skill_content');
        

        $content.slideToggle(300, function() {
            if ($content.is(':visible')) {
                const $circle = $content.find('.circle');
                

                let percentValue = $circle.data('percent') / 100;


                $circle.circleProgress({ value: 0, animation: false });

                $circle.circleProgress({
                    value: percentValue,
                    startAngle:300,
                    size: 140,
                    thickness: 10,
                    lineCap:"round",
                    reverse:true,
                    fill: { color: "#10b981" },
                    animation: { duration: 1200}
                }).on('circle-animation-progress', function(event, progress, stepValue) {
                    $(this).find('strong').html(Math.round(100 * stepValue) + '<i>%</i>');
                });
            }
        });
    });
});