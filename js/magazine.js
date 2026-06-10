const chapters = [
  {
    num: "01",
    name: "DJ MARK KAMINS",
    role: "Seoul Drive / Producer",
    quote: "서울의 밤은 레코드처럼 천천히 쌓여 있어요. 그 안엔 각자의 기억과 리듬이 살고 있죠.",
    subtitle: "Morning crate dig"
  },
  {
    num: "02",
    name: "YUNA KANG",
    role: "Record Selector / Founder",
    quote: "좋은 선곡은 설명보다 먼저 공간을 바꿔요. 오래된 소리일수록 지금의 마음을 더 선명하게 건드리죠.",
    subtitle: "Analog room stories"
  },
  {
    num: "03",
    name: "JAE MIN ROW",
    role: "Night Radio Host / Archivist",
    quote: "새벽의 음악은 늘 조금 느리게 도착해요. 그래서 사람들은 그 시간에 더 솔직하게 듣는 것 같아요.",
    subtitle: "Night frequency notes"
  },
  {
    num: "04",
    name: "LENA CHOI",
    role: "Sound Curator / Researcher",
    quote: "큐레이션은 취향을 전시하는 일이 아니라, 누군가의 하루에 맞는 온도를 찾는 일에 가까워요.",
    subtitle: "Curated listening lab"
  }
];

const chapterButtons = document.querySelectorAll(".interview nav button");
const interviewImage = document.querySelector(".interview_image img");
const interviewName = document.querySelector(".interview_name");
const interviewRole = document.querySelector(".interview_role");
const interviewQuote = document.querySelector(".interview_quote p");
const interviewCurrent = document.querySelector(".interview_page .interview_num:first-child");
const interviewTotal = document.querySelector(".interview_page .interview_num:last-of-type");
const prevButton = document.querySelector(".interview_arrow_group img:first-child");
const nextButton = document.querySelector(".interview_arrow_group img:last-child");

const visualArea = document.querySelector(".visual_area");
const discImage = document.querySelector(".disc_image");
const labelImage = document.querySelector(".label_image");
const chapterTitle = document.querySelector(".chapter_title");
const chapterSubtitle = document.querySelector(".chapter_subtitle");
const progressCurrent = document.querySelector(".progress_current");
const progressTicks = document.querySelectorAll(".progress_tick");

let currentIndex = 0;
let rotation = 0;
let wheelLocked = false;

function formatQuote(text) {
  const chunks = text.split(" ");
  const lines = [];

  for (let i = 0; i < chunks.length; i += 3) {
    lines.push(chunks.slice(i, i + 3).join(" "));
  }

  return `
    <img class="quote_start_img" src="img/magazine/quote_start.png" alt="">
    <span class="quote_body">${lines.join("<br>")}</span>
    <img class="quote_end_img" src="img/magazine/quote_end.png" alt="">
  `;
}

function updateChapter(index) {
  const chapter = chapters[index];

  currentIndex = index;

  chapterButtons.forEach((button, buttonIndex) => {
    button.classList.toggle("active", buttonIndex === index);
  });

  interviewImage.src = `img/magazine/interview${chapter.num}.png`;
  interviewImage.alt = `Chapter ${chapter.num} 인물 이미지`;

  interviewName.textContent = chapter.name;
  interviewRole.textContent = chapter.role;
  interviewQuote.innerHTML = formatQuote(chapter.quote);

  interviewCurrent.textContent = chapter.num;
  interviewTotal.textContent = "04";

  progressCurrent.textContent = chapter.num;
  chapterTitle.textContent = `Chapter ${chapter.num}`;
  chapterSubtitle.textContent = chapter.subtitle;

  const activeCount = Math.ceil(progressTicks.length * ((index + 1) / chapters.length));
  progressTicks.forEach((tick, tickIndex) => {
    tick.classList.toggle("is_active", tickIndex < activeCount);
  });
}

function moveChapter(direction) {
  let nextIndex = currentIndex + direction;

  if (nextIndex < 0) nextIndex = chapters.length - 1;
  if (nextIndex >= chapters.length) nextIndex = 0;

  updateChapter(nextIndex);
}

function rotateLp(delta) {
  rotation += delta * 0.35;

  discImage.style.transform = `rotate(${rotation}deg)`;
  labelImage.style.transform = `translate(-50%, -50%) rotate(${rotation}deg)`;
}

/* LP 영역에서 마우스 휠을 움직이면 LP를 회전시키고 챕터를 한 단계씩 변경 */
visualArea.addEventListener(
  "wheel",
  (event) => {
    event.preventDefault();

    rotateLp(event.deltaY);

    if (wheelLocked) return;

    wheelLocked = true;
    moveChapter(event.deltaY > 0 ? 1 : -1);

    setTimeout(() => {
      wheelLocked = false;
    }, 520);
  },
  { passive: false }
);

/* 왼쪽 챕터 버튼 클릭 시 해당 챕터로 이동 */
chapterButtons.forEach((button, index) => {
  button.addEventListener("click", () => {
    updateChapter(index);
  });
});

/* 하단 이전/다음 화살표 클릭 시 챕터 이동 */
prevButton.addEventListener("click", () => {
  moveChapter(-1);
});

nextButton.addEventListener("click", () => {
  moveChapter(1);
});

/* 초기 화면은 Chapter 01 활성화 */
updateChapter(0);


/* ######################### Timeline track ############################ */
const timelineImages = document.querySelectorAll(".timeline_image li");
const timelineItems = document.querySelectorAll(".timeline_item");
const timelineDots = document.querySelectorAll(".timeline_dot_button");

function updateTimeline(index) {
  timelineImages.forEach((image, imageIndex) => {
    image.classList.toggle("active", imageIndex === index);
  });

  timelineItems.forEach((item, itemIndex) => {
    item.classList.toggle("active", itemIndex === index);
  });

  timelineDots.forEach((dot, dotIndex) => {
    dot.classList.toggle("active", dotIndex === index);
  });

  timelineImages.forEach((image, index) => {
  image.addEventListener("click", () => {
    updateTimeline(index);
  });
});
}

timelineDots.forEach((dot, index) => {
  dot.addEventListener("click", () => {
    updateTimeline(index);
  });
});

updateTimeline(0);


/* ###################### SOUND ANATOMY 버튼 클릭 ########################## */
const lpTabs = document.querySelectorAll(".lp_tab li");
const lpTxtBoxes = document.querySelectorAll(".lp_txt_box");

function updateLpTab(index) {
  lpTabs.forEach((tab, tabIndex) => {
    tab.classList.toggle("active", tabIndex === index);
  });

  lpTxtBoxes.forEach((box, boxIndex) => {
    box.classList.toggle("active", boxIndex === index);
    box.classList.toggle("default", boxIndex !== index);
  });
}

lpTabs.forEach((tab, index) => {
  tab.addEventListener("click", () => {
    updateLpTab(index);
  });
});

updateLpTab(0);

const soundSection = document.querySelector(".sound");

const soundObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        soundSection.classList.add("show");
      }
    });
  },
  {
    threshold: 0.35,
  }
);

soundObserver.observe(soundSection);


/* 스크롤 휠 이벤트 (배너에서 넘어갈 때) */
const magazineBanner = document.querySelector(".magazine_banner");
const interviewSection = document.querySelector(".interview");

let bannerWheelLocked = false;

function smoothScrollTo(targetY, duration = 1400) {
  const startY = window.scrollY;
  const distance = targetY - startY;
  const startTime = performance.now();

  function easeInOutCubic(t) {
    return t < 0.5
      ? 4 * t * t * t
      : 1 - Math.pow(-2 * t + 2, 3) / 2;
  }

  function animation(currentTime) {
    const elapsed = currentTime - startTime;
    const progress = Math.min(elapsed / duration, 1);
    const easedProgress = easeInOutCubic(progress);

    window.scrollTo(0, startY + distance * easedProgress);

    if (progress < 1) {
      requestAnimationFrame(animation);
    }
  }

  requestAnimationFrame(animation);
}

magazineBanner.addEventListener(
  "wheel",
  (event) => {
    if (event.deltaY <= 0) return;
    if (bannerWheelLocked) return;

    event.preventDefault();
    bannerWheelLocked = true;

    const targetY =
      interviewSection.getBoundingClientRect().top + window.scrollY;

    smoothScrollTo(targetY, 1500);

    setTimeout(() => {
      bannerWheelLocked = false;
    }, 1600);
  },
  { passive: false }
);