$(function () {
  const $slides = $(".hero-slider .slide");
  const $dots = $(".slide-dot .dot");

  const activeDotImg = "img/product/btn-active.png";
  const defaultDotImg = "img/product/btn-default.png";

  let currentIndex = 0;
  let timer = null;
  const slideSpeed = 5000;

  function showSlide(index) {
    $slides.removeClass("active");
    $slides.eq(index).addClass("active");

    $dots.removeClass("active");

    $dots.each(function (i) {
      if (i === index) {
        $(this).addClass("active");
        $(this).find("img").attr("src", activeDotImg);
      } else {
        $(this).find("img").attr("src", defaultDotImg);
      }
    });

    currentIndex = index;
  }

  function nextSlide() {
    let nextIndex = currentIndex + 1;

    if (nextIndex >= $slides.length) {
      nextIndex = 0;
    }

    showSlide(nextIndex);
  }

  function prevSlide() {
    let prevIndex = currentIndex - 1;

    if (prevIndex < 0) {
      prevIndex = $slides.length - 1;
    }

    showSlide(prevIndex);
  }

  function startAutoSlide() {
    timer = setInterval(function () {
      nextSlide();
    }, slideSpeed);
  }

  function stopAutoSlide() {
    clearInterval(timer);
  }

  function resetAutoSlide() {
    stopAutoSlide();
    startAutoSlide();
  }

  $(".next-btn").on("click", function () {
    nextSlide();
    resetAutoSlide();
  });

  $(".prev-btn").on("click", function () {
    prevSlide();
    resetAutoSlide();
  });

  $dots.on("click", function () {
    const dotIndex = $(this).index();

    showSlide(dotIndex);
    resetAutoSlide();
  });

  showSlide(currentIndex);
  startAutoSlide();
});



//하단 배너
$(function () {
  const $bSlides = $(".soundtrack .b-slide");
  const $bPageBtns = $(".b-page-num button");

  let bCurrentIndex = 0;
  let bTimer = null;
  const bSlideSpeed = 5000;

  function showBSlide(index) {
    $bSlides.removeClass("active");
    $bSlides.eq(index).addClass("active");

    $bPageBtns.removeClass("active");
    $bPageBtns.eq(index).addClass("active");

    bCurrentIndex = index;
  }

  function nextBSlide() {
    let nextIndex = bCurrentIndex + 1;

    if (nextIndex >= $bSlides.length) {
      nextIndex = 0;
    }

    showBSlide(nextIndex);
  }

  function prevBSlide() {
    let prevIndex = bCurrentIndex - 1;

    if (prevIndex < 0) {
      prevIndex = $bSlides.length - 1;
    }

    showBSlide(prevIndex);
  }

  function startBSlide() {
    bTimer = setInterval(function () {
      nextBSlide();
    }, bSlideSpeed);
  }

  function stopBSlide() {
    clearInterval(bTimer);
  }

  function resetBSlide() {
    stopBSlide();
    startBSlide();
  }

  $(".b-next").on("click", function () {
    nextBSlide();
    resetBSlide();
  });

  $(".b-prev").on("click", function () {
    prevBSlide();
    resetBSlide();
  });

  $bPageBtns.on("click", function () {
    const index = $(this).index();

    showBSlide(index);
    resetBSlide();
  });

  showBSlide(bCurrentIndex);
  startBSlide();
});



//discover
// Discover 필터
(function () {
  let activeFilters = new Set();
  let excludeSoldOut = false;
  let sortMode = 'all';
  let showAll = true;

  const allItemsBtn = document.getElementById('allItemsBtn');
  const soldToggle  = document.getElementById('soldToggle');
  const sortSelect  = document.getElementById('sortSelect');
  const albumGrid   = document.getElementById('albumGrid');
  const sideButtons = document.querySelectorAll('.filter button[data-filter]');
  const cards       = Array.from(albumGrid.querySelectorAll('.album-card'));

  cards.forEach(card => {
    if (card.dataset.sold === 'true') card.classList.add('sold-out');
  });

  const filterGroups = {
    genre:   ['pop','soul','hip','jazz','city','ost','only'],
    era:     ['2020','2000','1980','1960'],
    format:  ['vinyl','album','lp','12'],
    country: ['us','uk','kor','global','jpn']
  };

  function getGroupOf(filter) {
    for (const [group, filters] of Object.entries(filterGroups)) {
      if (filters.includes(filter)) return group;
    }
    return null;
  }

  function cardMatches(card) {
    if (showAll) return true;
    const cats = card.dataset.category.trim().split(/\s+/);
    for (const [, filters] of Object.entries(filterGroups)) {
      const activeInGroup = filters.filter(f => activeFilters.has(f));
      if (activeInGroup.length === 0) continue;
      if (!activeInGroup.some(f => cats.includes(f))) return false;
    }
    return true;
  }

  function sortCards(list, mode) {
    const copy = [...list];
    switch (mode) {
      case 'newest':    return copy.sort((a, b) => +b.dataset.year    - +a.dataset.year);
      case 'popular':   return copy.sort((a, b) => +b.dataset.popular - +a.dataset.popular);
      case 'price-asc': return copy.sort((a, b) => +a.dataset.price   - +b.dataset.price);
      case 'price-desc':return copy.sort((a, b) => +b.dataset.price   - +a.dataset.price);
      default: return copy;
    }
  }

  function render() {
    let visible = cards.filter(card => {
      if (!cardMatches(card)) return false;
      if (excludeSoldOut && card.dataset.sold === 'true') return false;
      return true;
    });
    visible = sortCards(visible, sortMode);
    cards.forEach(c => c.classList.add('hide'));
    visible.forEach(c => {
      c.classList.remove('hide');
      albumGrid.appendChild(c);
    });
  }

  sideButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const f = btn.dataset.filter;
      const group = getGroupOf(f);
      if (btn.classList.contains('active')) {
        btn.classList.remove('active');
        activeFilters.delete(f);
      } else {
        if (group) {
          filterGroups[group].forEach(gf => {
            activeFilters.delete(gf);
            document.querySelector(`.filter button[data-filter="${gf}"]`)?.classList.remove('active');
          });
        }
        btn.classList.add('active');
        activeFilters.add(f);
      }
      showAll = activeFilters.size === 0;
      allItemsBtn.classList.toggle('active', showAll);
      render();
    });
  });

  allItemsBtn.addEventListener('click', () => {
    activeFilters.clear();
    sideButtons.forEach(b => b.classList.remove('active'));
    showAll = true;
    allItemsBtn.classList.add('active');
    render();
  });

  soldToggle.addEventListener('click', () => {
    excludeSoldOut = !excludeSoldOut;
    soldToggle.classList.toggle('on', excludeSoldOut);
    render();
  });

  sortSelect.addEventListener('change', () => {
    sortMode = sortSelect.value;
    render();
  });

  render();
})();
