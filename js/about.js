// =====================
// 새로고침 시 맨 위로
// =====================
history.scrollRestoration = 'manual';
window.scrollTo(0, 0);

// =====================
// 메인 진입 모션
// =====================

(function () {
  'use strict';
 
  // 타이밍 설정 (ms)
  const T = {
    seoulDelay:  0,
    seoulDur:    700,
 
    line01Delay: 200,
    line01Dur:   600,
 
    l01Delay:    350,
    l02Delay:    420,
    l03Delay:    490,
    lDur:        500,
 
    rtgDelay:    500,   // Rtg01~03 기준 시작
    rtgStep:     80,    // 각 Rtg 간격
    rtgDur:      550,
 
    line02Delay: 650,
    line02Dur:   450,
 
    vinylDelay:  600,
    vinylDur:    700,
 
    rtg04Delay:  400,
    rtg04Dur:    700,
 
    line03Delay: 900,
    line03Dur:   500,
  };
 
  // ease 헬퍼 - cubic-bezier(0.22, 1, 0.36, 1) 느낌을 CSS 문자열로
  const EASE_OUT  = 'cubic-bezier(0.22, 1, 0.36, 1)';
  const EASE_LINE = 'cubic-bezier(0.4, 0, 0.2, 1)';
 
  function setInit(el, styles) {
    Object.assign(el.style, styles);
  }
 
  function animate(el, delay, duration, toStyles, easing = EASE_OUT) {
    setTimeout(() => {
      el.style.transition = Object.keys(toStyles)
        .map(p => `${p} ${duration}ms ${easing}`)
        .join(', ');
      Object.assign(el.style, toStyles);
    }, delay);
  }
 
  function initMain() {
    const section = document.querySelector('#main');
    if (!section) return;
 
    /* ── SEOUL ──────────────────────────────── */
    const seoul = section.querySelector('.text-seoul');
    setInit(seoul, { opacity: '0', transform: 'translateX(-120px)' });
    animate(seoul, T.seoulDelay, T.seoulDur, { opacity: '1', transform: 'translateX(0)' });
 
    /* ── line01 (오른쪽 가로선, 그어지는 느낌) ── */
    const line01 = section.querySelector('.line01');
    setInit(line01, { width: '0', opacity: '0' });
    animate(line01, T.line01Delay, T.line01Dur,
      { width: '70%', opacity: '1' }, EASE_LINE);
 
    /* ── L01 · L02 · L03 (위에서 페이드 드롭) ── */
    ['.L01', '.L02', '.L03'].forEach((sel, i) => {
      const el = section.querySelector(sel);
      if (!el) return;
      setInit(el, { opacity: '0', transform: 'translateY(-18px)' });
      const delay = [T.l01Delay, T.l02Delay, T.l03Delay][i];
      animate(el, delay, T.lDur, { opacity: '1', transform: 'translateY(0)' });
    });
 
    /* ── Rtg01 · Rtg02 · Rtg03 (왼쪽에서 슬라이드인) ── */
    ['.Rtg01', '.Rtg02', '.Rtg03'].forEach((sel, i) => {
      const el = section.querySelector(sel);
      if (!el) return;
      setInit(el, { opacity: '0', transform: 'translateX(-60px)' });
      animate(el, T.rtgDelay + i * T.rtgStep, T.rtgDur,
        { opacity: '1', transform: 'translateX(0)' });
    });
 
    /* ── line02 (왼쪽 짧은 선) ── */
    const line02 = section.querySelector('.line02');
    setInit(line02, { width: '0', opacity: '0' });
    animate(line02, T.line02Delay, T.line02Dur,
      { width: '30%', opacity: '1' }, EASE_LINE);
 
    /* ── VINYL ───────────────────────────────── */
    const vinyl = section.querySelector('.text-vinyl');
    setInit(vinyl, { opacity: '0', transform: 'translateX(120px)' });
    animate(vinyl, T.vinylDelay, T.vinylDur, { opacity: '1', transform: 'translateX(0)' });
 
    /* ── Rtg04 (오른쪽에서 슬라이드인) ── */
    const rtg04 = section.querySelector('.Rtg04');
    setInit(rtg04, { opacity: '0', transform: 'translateX(80px)' });
    animate(rtg04, T.rtg04Delay, T.rtg04Dur,
      { opacity: '1', transform: 'translateX(0)' });
 
    /* ── line03 (전체 가로선, 마지막) ── */
    const line03 = section.querySelector('.line03');
    setInit(line03, { width: '0', opacity: '0' });
    animate(line03, T.line03Delay, T.line03Dur,
      { width: '100%', opacity: '1' }, EASE_LINE);
  }
 
  // DOM 준비되면 실행
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMain);
  } else {
    initMain();
  }
})();


// =====================
// 스크롤 모션
// =====================

const observer = new IntersectionObserver((entries) => {
  entries.forEach(el => {
    if (el.isIntersecting) el.target.classList.add('is-visible');
  });
}, { threshold: 0.15 });

document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

// =====================
// 카카오 지도
// =====================
kakao.maps.load(function() {
    var fallback = document.getElementById('map-fallback');
    if (fallback) fallback.style.display = 'flex';

    var container = document.getElementById('kakao-map');
    var options = {
        center: new kakao.maps.LatLng(37.5410460922064, 126.98724102699),
        level: 3
    };
    var map = new kakao.maps.Map(container, options);

    if (fallback) fallback.style.display = 'none';

    var marker = new kakao.maps.Marker({
        position: new kakao.maps.LatLng(37.5410460922064, 126.98724102699)
    });
    marker.setMap(map);

    var content = '<div style="padding:8px 14px;margin:0;font-size:13px;font-weight:700;background:#202020;color:#EBE8E8;border-radius:6px;white-space:nowrap;">Seoul Vinyl</div>';

    var customOverlay = new kakao.maps.CustomOverlay({
        position: new kakao.maps.LatLng(37.5410460922064, 126.98724102699),
        content: content,
        xAnchor: 0.5,
        yAnchor: 2.3
    });
    customOverlay.setMap(map);
});


// =====================
// About 갤러리
// =====================

const mainImg = document.getElementById('mainImg');
const thumbs = document.querySelectorAll('.thumb-list .thumb');
const prevBtn = document.querySelector('.info-prev');
const nextBtn = document.querySelector('.info-next');
const thumbList = document.querySelector('.thumb-list');

let current = 0;
let isDragged = false;

function setActive(index) {
    current = index;
    mainImg.src = thumbs[index].src;
    thumbs.forEach(t => t.classList.remove('active'));
    thumbs[index].classList.add('active');
    scrollToThumb(index);
}

function scrollToThumb(index) {
    const thumb = thumbs[index];
    const listRect = thumbList.getBoundingClientRect();
    const thumbRect = thumb.getBoundingClientRect();
    const offset = thumbRect.left - listRect.left + thumbList.scrollLeft - (thumbList.offsetWidth / 2) + (thumb.offsetWidth / 2);
    thumbList.scrollTo({ left: offset, behavior: 'smooth' });
}

thumbs.forEach((thumb, i) => {
    thumb.addEventListener('click', () => {
        if (isDragged) return;
        setActive(i);
    });
});

prevBtn.addEventListener('click', () => {
    const next = (current - 1 + thumbs.length) % thumbs.length;
    setActive(next);
});

nextBtn.addEventListener('click', () => {
    const next = (current + 1) % thumbs.length;
    setActive(next);
});


// =====================
// 썸네일 리스트 스크롤
// =====================

const scrollTrack = document.createElement('div');
scrollTrack.className = 'scroll-track';
const scrollThumb = document.createElement('div');
scrollThumb.className = 'scroll-thumb';
scrollTrack.appendChild(scrollThumb);
thumbList.parentNode.insertBefore(scrollTrack, thumbList.nextSibling);

function updateScrollbar() {
    const ratio = thumbList.scrollWidth / thumbList.offsetWidth;
    const thumbWidth = Math.max(thumbList.offsetWidth / ratio, 40);
    const thumbLeft = (thumbList.scrollLeft / (thumbList.scrollWidth - thumbList.offsetWidth)) * (scrollTrack.offsetWidth - thumbWidth);
    scrollThumb.style.width = thumbWidth + 'px';
    scrollThumb.style.transform = `translateX(${thumbLeft}px)`;
}

thumbList.addEventListener('scroll', updateScrollbar);
window.addEventListener('resize', updateScrollbar);
updateScrollbar();

let isScrollDragging = false;
let scrollDragStartX = 0;
let scrollDragStartScroll = 0;

scrollThumb.addEventListener('mousedown', (e) => {
    isScrollDragging = true;
    scrollDragStartX = e.clientX;
    scrollDragStartScroll = thumbList.scrollLeft;
    document.body.style.userSelect = 'none';
});

document.addEventListener('mousemove', (e) => {
    if (!isScrollDragging) return;
    const delta = e.clientX - scrollDragStartX;
    const ratio = (thumbList.scrollWidth - thumbList.offsetWidth) / (scrollTrack.offsetWidth - scrollThumb.offsetWidth);
    thumbList.scrollLeft = scrollDragStartScroll + delta * ratio;
});

document.addEventListener('mouseup', () => {
    isScrollDragging = false;
    document.body.style.userSelect = '';
});


// ── 마우스 드래그 스크롤 ──
let isMouseDown = false;
let startX = 0;
let scrollStart = 0;
let velocity = 0;
let lastX = 0;
let lastTime = 0;
let rafId = null;

thumbList.addEventListener('mousedown', (e) => {
    isMouseDown = true;
    isDragged = false;
    startX = e.pageX;
    scrollStart = thumbList.scrollLeft;
    lastX = e.pageX;
    lastTime = Date.now();
    velocity = 0;
    cancelAnimationFrame(rafId);
    thumbList.style.cursor = 'grabbing';
    e.preventDefault();
});

document.addEventListener('mousemove', (e) => {
    if (!isMouseDown) return;
    if (Math.abs(e.pageX - startX) > 5) isDragged = true;
    const now = Date.now();
    const dt = now - lastTime;
    if (dt > 0) velocity = (e.pageX - lastX) / dt;
    lastX = e.pageX;
    lastTime = now;
    thumbList.scrollLeft = scrollStart - (e.pageX - startX);
});

document.addEventListener('mouseup', () => {
    if (!isMouseDown) return;
    isMouseDown = false;
    thumbList.style.cursor = '';
    applyInertia();
});

function applyInertia() {
    velocity *= 10;
    function step() {
        if (Math.abs(velocity) < 0.5) return;
        thumbList.scrollLeft -= velocity;
        velocity *= 0.92;
        rafId = requestAnimationFrame(step);
    }
    rafId = requestAnimationFrame(step);
}


// ── 터치 스와이프 ──
let touchStartX = 0;
let touchScrollStart = 0;
let touchLastX = 0;
let touchVelocity = 0;
let touchLastTime = 0;

thumbList.addEventListener('touchstart', (e) => {
    touchStartX = e.touches[0].pageX;
    touchScrollStart = thumbList.scrollLeft;
    touchLastX = touchStartX;
    touchLastTime = Date.now();
    touchVelocity = 0;
    cancelAnimationFrame(rafId);
}, { passive: true });

thumbList.addEventListener('touchmove', (e) => {
    const now = Date.now();
    const dt = now - touchLastTime;
    const x = e.touches[0].pageX;
    if (dt > 0) touchVelocity = (x - touchLastX) / dt;
    touchLastX = x;
    touchLastTime = now;
    thumbList.scrollLeft = touchScrollStart - (x - touchStartX);
}, { passive: true });

thumbList.addEventListener('touchend', () => {
    touchVelocity *= 10;
    function step() {
        if (Math.abs(touchVelocity) < 0.5) return;
        thumbList.scrollLeft -= touchVelocity;
        touchVelocity *= 0.92;
        rafId = requestAnimationFrame(step);
    }
    rafId = requestAnimationFrame(step);
});


// =====================
// 바이닐 가이드
// =====================

(function () {
  const gl = document.querySelector('.Guidelist');
  if (!gl) return;
  const items = [...gl.querySelectorAll(':scope > li')];
  const EXPAND_MS = 400;
  let timer = null;
  let guideActive = null;

  function activate(item) {
    if (guideActive === item) return;

    clearTimeout(timer);

    if (guideActive) {
      const prev = guideActive.querySelector('.Guide-content');
      prev.style.transition = 'opacity 0s';
      prev.style.opacity = '0';
      guideActive.classList.remove('guide-active');
    }

    guideActive = item;
    items.forEach(i => {
      i.style.flex = i === item ? '2.2 1 0' : '0.65 1 0';
    });
    item.classList.add('guide-active');

    timer = setTimeout(() => {
      if (guideActive !== item) return;
      const content = item.querySelector('.Guide-content');
      content.style.transition = 'opacity 0.28s ease';
      content.style.opacity = '1';
    }, EXPAND_MS);
  }

  function deactivate() {
    clearTimeout(timer);
    if (guideActive) {
      const content = guideActive.querySelector('.Guide-content');
      content.style.transition = 'opacity 0.15s ease';
      content.style.opacity = '0';
      guideActive.classList.remove('guide-active');
      guideActive = null;
    }
    items.forEach(i => { i.style.flex = '1 1 0'; });
  }

  // 마우스 (데스크탑)
  gl.addEventListener('mouseover', (e) => {
    const li = e.target.closest('.Guidelist > li');
    if (li) activate(li);
  });
  gl.addEventListener('mouseleave', () => deactivate());

  // 터치 (모바일)
  gl.addEventListener('touchstart', (e) => {
    const li = e.target.closest('.Guidelist > li');
    if (!li) return;
    if (guideActive === li) {
      deactivate();
    } else {
      activate(li);
    }
  }, { passive: true });

})();


// =====================
// FAQ
// =====================
 
const faqItems = document.querySelectorAll('#FAQ .FAQ-content li');
 
faqItems.forEach(item => {
    const q = item.querySelector('.FAQ_Q');
    const a = item.querySelector('.FAQ_A');
    const img = q.querySelector('img');
 
    q.style.cursor = 'pointer';
    a.style.maxHeight = '0';
 
    q.addEventListener('click', () => {
        const isOpen = item.classList.contains('faq-open');
 
        // 모든 항목 닫기 — 인라인 opacity 없이 클래스만으로 제어
        faqItems.forEach(other => {
            const otherA = other.querySelector('.FAQ_A');
            const otherImg = other.querySelector('.FAQ_Q img');
            other.classList.remove('faq-open');
            otherA.style.maxHeight = '0';
            otherImg.style.transform = 'rotate(0deg)';
        });
 
        if (!isOpen) {
            item.classList.add('faq-open');
            a.style.maxHeight = (a.scrollHeight + 50) + 'px';
            img.style.transform = 'rotate(180deg)';
        }
    });
});



// =====================
// 갤러리 인스타 팝업
// =====================

(function () {
    const overlay = document.getElementById('igOverlay');
    const popupImg = document.getElementById('igPopupImg');
    const igBody = document.getElementById('igBody');
    const igLikes = document.getElementById('igLikes');
    const igLink = document.getElementById('igLink');
    const prevBtn = document.getElementById('igPrev');
    const nextBtn = document.getElementById('igNext');

    const items = [...document.querySelectorAll('.gallerylist li')];
    let current = 0;

    function render(index) {
        current = index;
        const li = items[index];
        const img   = li.dataset.img;
        const likes = li.dataset.likes;
        const time  = li.dataset.time;
        const url   = li.dataset.url;
        const caption = li.dataset.caption.replace(/&#10;/g, '\n').replace(/\n/g, '<br>');
        const hashtags = li.dataset.hashtags;

        const igImgPane = document.querySelector('.ig-img-pane');
        const isVideo = li.dataset.type === 'video';

        if (isVideo) {
            igImgPane.innerHTML = `
                <video src="${li.dataset.video}" autoplay muted loop playsinline
                    style="width:100%;height:100%;object-fit:cover;display:block;cursor:pointer;">
                </video>`;
            const vid = igImgPane.querySelector('video');
            vid.addEventListener('click', () => {
                vid.paused ? vid.play() : vid.pause();
            });
        } else {
            igImgPane.innerHTML = `<img src="${img}" alt="" style="width:100%;height:100%;object-fit:cover;display:block;">`;
        }
        igLikes.textContent = likes;
        igLink.href = url;

        igBody.innerHTML = `
            <div class="ig-cap-text">
                <strong>seoulvinyl</strong>${caption}
                <span class="ig-hashtags">${hashtags}</span>
            </div>
            <div class="ig-cap-time">${time}</div>
        `;
    }

    function open(index) {
        render(index);
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function close() {
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }
    document.getElementById('igClose').addEventListener('click', close);
    
    // 갤러리 클릭
    items.forEach((li, i) => {
        li.addEventListener('click', () => open(i));
    });

    // 이전 / 다음
    prevBtn.addEventListener('click', () => render((current - 1 + items.length) % items.length));
    nextBtn.addEventListener('click', () => render((current + 1) % items.length));

    // 오버레이 클릭 닫기
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) close();
    });

    // ESC / 방향키
    document.addEventListener('keydown', (e) => {
        if (!overlay.classList.contains('active')) return;
        if (e.key === 'Escape') close();
        if (e.key === 'ArrowLeft')  render((current - 1 + items.length) % items.length);
        if (e.key === 'ArrowRight') render((current + 1) % items.length);
    });
})();